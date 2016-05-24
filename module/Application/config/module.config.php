<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Controller\CuentaController;
use Zend\Mvc\Application;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            /* fin router general application */
            /* Router de pasarelas */
            'pasarelas' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/pasarela',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Pasarela',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'visa-confirm' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/visa',
                            'defaults' => array(
                                'action' => 'visa',
                            ),
                        ),
                    ),
                    'master-response' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/mastercard',
                            'defaults' => array(
                                'action' => 'master',
                            ),
                        ),
                    ),
                    'amex-response' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/amex',
                            'defaults' => array(
                                'action' => 'amex',
                            ),
                        ),
                    ),
                    'diners-response' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/diners',
                            'defaults' => array(
                                'action' => 'diners',
                            ),
                        ),
                    ),
                ),
            ),
            /* fin de router de pagos */
            'auth' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/login',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Auth',
                        'action' => 'login',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'actions' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/:action',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'recuperar' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/change-password',
                    'defaults' => array(
                        'controller' => 'Application\Controller\RecuperarPassword',
                        'action' => 'changePassword',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'actions' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/recuperar/:key[/]',
                            'constraints' => array(
                                'key' => '[a-zA-Z0-9$]+'
                            ),
                            'defaults' => array(
                                'controller' => 'Application\Controller\RecuperarPassword',
                                'action' => 'recoverPassword',
                            ),
                        ),
                    ),
                ),
            ),
            'verificacion-email' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/verificacion-email/:token[/]',
                    'constraints' => array(
                        'token' => '[a-zA-Z0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\VerificacionEmail',
                        'action' => 'index',
                    ),
                ),
            ),
            'personas' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/personas',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Personas',
                        'action' => 'index',
                    ),
                ),
            ),
            'registro-cuenta' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/registro-cuenta',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Cuenta',
                        'action' => 'registro',
                    ),
                ),
            ),        
            'cuentas-asociadas' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/cuentas-asociadas',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Cuenta',
                        'action' => 'cuentasAsociadas',
                    ),
                ),
            ),
            'terminos-y-condiciones' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/terminos-y-condiciones',
                    'defaults' => array(
                        'controller' => 'Application\Controller\EpassController',
                        'action' => 'terminosCondiciones',
                    ),
                ),
            ),

            'contactanos' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/contactanos',
                    'defaults' => array(
                        'controller' => 'Application\Controller\EpassController',
                        'action'     => 'contactanos',
                    ),
                ),
            ),

            'que-es-epass' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/que-es-epass',
                    'defaults' => array(
                        'controller' => 'Application\Controller\EpassController',
                        'action' => 'que-es-epass',
                    ),
                ),
            ),
             'limpiar-cache' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/limpiar-cache',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'limpiarcache',
                    ),
                ),
            ),
            'beneficios' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/beneficios',
                    'defaults' => array(
                        'controller' => 'Application\Controller\EpassController',
                        'action' => 'beneficios',
                    ),
                ),
            ),
            'empresas' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/empresas',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Empresas',
                        'action' => 'index',
                    ),
                ),
            ),
            'donde' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/donde-adquirir-el-epass',
                    'defaults' => array(
                        'controller' => 'Application\Controller\EpassController',
                        'action' => 'donde',
                    ),
                ),
            ),
            'como' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/como-poner-tu-epass',
                    'defaults' => array(
                        'controller' => 'Application\Controller\EpassController',
                        'action' => 'como',
                    ),
                ),
            ),
            'paquete-individual' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/paquete-individual',
                    'defaults' => array(
                        'controller' => 'Application\Controller\EpassController',
                        'action' => 'paquete-individual',
                    ),
                ),
            ),
            'paquete-familiar' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/paquete-familiar',
                    'defaults' => array(
                        'controller' => 'Application\Controller\EpassController',
                        'action' => 'paquete-familiar',
                    ),
                ),
            ),
            'paquete-empresas' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/paquete-empresas',
                    'defaults' => array(
                        'controller' => 'Application\Controller\EpassController',
                        'action' => 'paquete-empresas',
                    ),
                ),
            ),
            'afiliacion-individual' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/registro-individual',
                    'defaults' => array(
                        'controller' => 'Application\Controller\EpassController',
                        'action' => 'afiliacion-individual',
                    ),
                ),
            ),
            'afiliacion-familiar' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/registro-familiar',
                    'defaults' => array(
                        'controller' => 'Application\Controller\EpassController',
                        'action' => 'afiliacion-familiar',
                    ),
                ),
            ),
            'afiliacion-familiar-vehiculos' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/registro-familiar-vehiculos',
                    'defaults' => array(
                        'controller' => 'Application\Controller\EpassController',
                        'action' => 'afiliacion-familiar-vehiculos',
                    ),
                ),
            ),
            'afiliacion-empresas' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/registro-empresas',
                    'defaults' => array(
                        'controller' => 'Application\Controller\EpassController',
                        'action' => 'afiliacion-empresas',
                    ),
                ),
            ),
            'afiliacion-empresas-vehiculos' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/registro-empresas-vehiculos',
                    'defaults' => array(
                        'controller' => 'Application\Controller\EpassController',
                        'action' => 'afiliacion-empresas-vehiculos',
                    ),
                ),
            ),
            'afiliacion_modal' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/#',
                ),
            ),
            'preguntas-frecuentes' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/preguntas-frecuentes',
                    'defaults' => array(
                        'controller' => 'Application\Controller\EpassController',
                        'action' => 'preguntasFrecuentes',
                    ),
                ),
            ),
            'afiliate' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/afiliate',
                ),
            ),
            'recarga' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/#',
                ),
            ),
            'recarga-empresas' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/recarga-empresas',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Empresas',
                        'action' => 'recarga',
                    ),
                ),
            ),
            'recarga-personas' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/recarga-personas',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Personas',
                        'action' => 'recarga',
                    ),
                ),
            ),
            'descargar-comprobante' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/#',
                ),
            ),
            'iniciar-sesion' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/#',
                ),
            ),
            'reclamaciones' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/libro-de-reclamaciones',
                    'defaults' => array(
                        'controller' => 'Application\Controller\EpassController',
                        'action' => 'reclamaciones',
                    ),
                ),
            ),
            'contacto' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/contacto',
                    'defaults' => array(
                        'controller' => 'Application\Controller\EpassController',
                        'action' => 'contacto',
                    ),
                ),
            ),
            'afiliate-pago' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/afiliate-pago',
                    'defaults' => array(
                        'controller' => 'Application\Controller\EpassController',
                        'action' => 'afiliate-pago'
                    )
                ),
            ),
            'ajax-find-user' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/ajax-find-user',
                    'defaults' => array(
                        'controller' => 'Application\Controller\EpassController',
                        'action' => 'ajax-find-user',
                    ),
                ),
            ),
            'ajax-Vehicles' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/ajax-vehicles',
                    'defaults' => array(
                        'controller' => 'Application\Controller\EpassController',
                        'action' => 'ajax-vehicles',
                    ),
                ),
            ),
            'cuenta' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/mi-cuenta',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Cuenta',
                        'action' => 'index',
                    //  'n-router' => 1
                    ),
                // 'spec' => '/mi-cuenta',
                ),
            ),
            'cuenta-recarga' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/mi-cuenta/:recarga',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Cuenta',
                        'action' => 'index',
                        'n-router' => 1
                    ),
                'spec' => '/mi-cuenta/%recarga%',
                ),
            ),
            'reportes' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/reportes',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Cuenta',
                        'action' => 'reportes',
                    ),
                ),
            ),
            'vehiculos' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/mis-vehiculos',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Cuenta',
                        'action' => 'vehiculos',
                    ),
                ),
            ),
            'vehiculo' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/vehiculo',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Cuenta',
                        'action' => 'vehiculo',
                    ),
                ),
            ),
            'comprobantes' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/comprobantes-de-pago',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Cuenta',
                        'action' => 'comprobantes',
                    ),
                ),
            ),
            'logout' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '#'
                ),
            ),
            'ajax-mis-datos' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/ajax-mis-datos',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Cuenta',
                        'action' => 'ajax-mis-datos',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'alias' => array(
            'CuentaService' => 'Application\Service\CuentaService'
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
            'Application\Service\CuentaService' => 'Application\Service\Factory\CuentaServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => Controller\IndexController::class,
            'Application\Controller\EpassController' => Controller\EpassController::class,
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Personas' => 'Application\Controller\PersonasController',
            'Application\Controller\Empresas' => 'Application\Controller\EmpresasController',
            'Application\Controller\Auth' => 'Application\Controller\AuthController',
            'Application\Controller\Pasarela' => Controller\PasarelaController::class,
            'Application\Controller\Cuenta' => 'Application\Controller\CuentaController',
            'Application\Controller\RecuperarPassword' => 'Application\Controller\RecuperarPasswordController',
            'Application\Controller\VerificacionEmail' => 'Application\Controller\VerificacionEmailController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/epass/queEsEpass' => __DIR__ . '/../view/application/epass/que-es-epass.phtml',
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
            'renders/menu_top' => __DIR__ . '/../view/layout/renders/menu_top.phtml',
            'renders/menu_bottom' => __DIR__ . '/../view/layout/renders/menu_bottom.phtml',
            'renders/footer' => __DIR__ . '/../view/layout/renders/footer.phtml',
            'renders/seo_tags' => __DIR__ . '/../view/layout/renders/seo_tags.phtml',
            'renders/modal_status_solicitudes' => __DIR__ . '/../view/layout/renders/modal_status_solicitudes.phtml',
            
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
