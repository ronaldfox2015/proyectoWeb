<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Epass\View\Helper\SeoHelper;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Epass\Model\Roles;
use Zend\Authentication\Adapter\DbTable;
use Zend\Authentication\AuthenticationService;
use Zend\Permissions\Acl\Role\GenericRole;
use Zend\Permissions\Acl\Resource\GenericResource;
use Zend\Permissions\Acl\Acl;

use Zend\Session\Config\SessionConfig;
use Zend\Authentication\Storage\Session;
use Zend\Session\Container;

use Zend\Cache\StorageFactory;
use Zend\Session\SaveHandler\Cache;
use Zend\Session\SessionManager;

use Mongo;
use Zend\Session\SaveHandler\MongoDB;
use Zend\Session\SaveHandler\MongoDBOptions;
use Clicks\MongoDB\Adapter\MongoDB as Mongoclicks;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                'Zend\Session\SessionManager' => function ($sm) {
                    $config = $sm->get('config');
                    if (isset($config['session'])) {
                        $session = $config['session'];

                        $sessionConfig = null;
                        if (isset($session['config'])) {
                            $options = isset($session['config']['options']) ? $session['config']['options'] : array();
                            $sessionConfig = new SessionConfig();
                            $sessionConfig->setOptions($options);
                        }

                        $sessionStorage = null;
                        if (isset($session['storage'])) {
                            $class = $session['storage'];
                            $sessionStorage = new $class();
                        }
                      
                        $sessionSaveHandler = null;
                        $config = $sm->get('config');
                        $dbmongo = $config['mongodb']['db'];
                        
//                        $config_memcached = $config['memcached'];
//                        $cache = StorageFactory::factory(array(
//                            'adapter' => array(
//                                'name' => 'memcached',
//                                'options' => array(
//                                    'namespace' => 'epass-auth',
//                                    'servers' => array($config_memcached['host'],$config_memcached['port']),                                    
//                                ),
//                            ),
//                            'plugins' => array(
//                                   'exception_handler' => array('throw_exceptions' => false),
//                            ),
//                        ));
//                        $sessionSaveHandler = new Cache($cache);       
                        
                        $mongo = new Mongoclicks($dbmongo);
                        $options = new MongoDBOptions(array(
                            'database'   => $dbmongo['dbname'],
                            'collection' => 'sessions',
                        ));
                        $sessionSaveHandler = new MongoDB($mongo, $options);
                        
                        $sessionManager = new SessionManager($sessionConfig, $sessionStorage, $sessionSaveHandler);

                    } else {
                        $sessionManager = new SessionManager();
                    }
                    
                    Container::setDefaultManager($sessionManager);
                    return $sessionManager;
                },
                      
                'Epass\Model\EpassStorage' => function($sm){
                    return new \Epass\Model\EpassStorage('login_storage');
                },
                        
                'AuthService' => function ($sm) {
                        $dbAdapter = $sm->get('adapter');
                        $dbTableAuthAdapter = new DbTable($dbAdapter, 'users', 'email', 'password', 'MD5(?)');
                        $authService = new AuthenticationService();
                        $authService->setAdapter($dbTableAuthAdapter);
                        $authService->setStorage($sm->get('Epass\Model\EpassStorage'));
                        return $authService;
                },
            ],
           
        ];

    }
    
    public function getViewHelperConfig()
    {
        return array(
           'factories' => array(
                'session_active_helper' => function ($sm) {
                    $helper = new \Epass\View\Helper\SessionHelper();
                    return $helper;
                },
                'session_data_helper' => function ($sm) {
                    $helper = new \Epass\View\Helper\SessionDataHelper();
                    return $helper;
                },

                'seoConfig' => function ($serviceManager) {
                    return new SeoHelper();
                }
           ),
        );
    }
    
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
                
        if (PHP_SAPI != "cli") {
//            $this->initAcl($e);
//            $eventManager->attach(MvcEvent::EVENT_ROUTE, array($this, 'checkAcl'));
              $this->initSession($e);    
        }
        
        $this->initRedirects($e);
    }
    
    public function initSession(MvcEvent $e){
        
        $session = $e->getApplication()
                     ->getServiceManager()
                     ->get('Zend\Session\SessionManager');
        $session->start();
        $container = new Container('initcontainer');
        if (!isset($container->init)) {
            $serviceManager = $e->getApplication()->getServiceManager();
            $request        = $serviceManager->get('Request');

            $session->regenerateId(true);
            $container->init          = 1;
            $container->remoteAddr    = $request->getServer()->get('REMOTE_ADDR');
            $container->httpUserAgent = $request->getServer()->get('HTTP_USER_AGENT');
            $config = $serviceManager->get('Config');
            if (!isset($config['session'])) {
                return;
            }

            $sessionConfig = $config['session'];
            /*if (isset($sessionConfig['validators'])) {
                $chain   = $session->getValidatorChain();

                foreach ($sessionConfig['validators'] as $validator) {
                    switch ($validator) {
                        case 'Zend\Session\Validator\HttpUserAgent':
                            $validator = new $validator($container->httpUserAgent);
                            break;
                        case 'Zend\Session\Validator\RemoteAddr':
                            $validator  = new $validator($container->remoteAddr);
                            break;
                        default:
                            $validator = new $validator();
                    }

                    $chain->attach('session.validate', array($validator, 'isValid'));
                }
            }*/
        }
        
    }
    
    public function initAcl(MvcEvent $e) {
 
        $acl = new Acl();
        $rol = new Roles();
        //$roles = $rol->getDbRoles($e);
        $roles = $rol->getRoles();

        foreach ($roles as $role => $resources) {

            $role = new GenericRole($role);
            $acl->addRole($role);

            foreach ($resources["allow"] as $resource) {
                 if(!$acl->hasResource($resource)){
                    $acl->addResource(new GenericResource($resource));
                 }
                 $acl->allow($role, $resource);
            }
        
            if(!empty($resources["deny"])){
                foreach ($resources["deny"] as $resource) {
                     if(!$acl->hasResource($resource)){
                        $acl->addResource(new GenericResource($resource));
                     }
                     $acl->deny($role, $resource);
                }
            }
            
        }
        $e->getViewModel()->acl = $acl;
    }
    
    public function checkAcl(MvcEvent $e) {
        $route = $e->getRouteMatch()->getMatchedRouteName();
        $user = $e->getApplication()->getServiceManager()->get('AuthService')->getStorage()->read();
        
        if(is_object($user) && property_exists($user, 'role')){
            $user_role = $user->role;
        }else{
            $user_role = 'publico';
        }

        if (!$e->getViewModel()->acl->hasResource($route) || !$e->getViewModel()->acl->isAllowed($user_role, $route)) {
            $response = $e->getResponse();
            //$response->getHeaders()->addHeaderLine('Location', $e->getRequest()->getBaseUrl() . '/');
            $response->getHeaders()->addHeaderLine('Location', $e->getRequest()->getBaseUrl() . '/404');
            $response->setStatusCode(404);
            $response->sendHeaders();

            exit;
        }
    }

    /**
     * Redirige a la url especificada
     *
     * @param type $e
     * @param type $url
     * @return type
     */
    private function _redirect($e, $url)
    {
        if (PHP_SAPI == "cli") {
            return;
        }
        $response = $e->getResponse();
        $response->getHeaders()->addHeaderLine('Location', $url);
        $response->setStatusCode(301);
        $response->sendHeaders();
        exit;
    }

    public function initRedirects(MvcEvent $e)
    {
        if (PHP_SAPI == "cli") {
            return;
        }
        $config = $e->getApplication()->getServiceManager()->get('config');
        $uri = $e->getRequest()->getUri();

        if (isset($config['redirects'][$uri->getPath()])) {
            $url = $uri->getscheme() . '://' . $uri->getHost() . $config['redirects'][$uri->getPath()];
            $this->_redirect($e, $url);
        }
    }
}
