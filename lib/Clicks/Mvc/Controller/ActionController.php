<?php

namespace Clicks\Mvc\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Clicks\ConfigAwareInterface;

class ActionController extends AbstractActionController
    implements ConfigAwareInterface
{

    /**
     *
     * @var array
     */
    protected $config;
    protected $session;

    /**
     *
     * @return array
     */
    public function getAuth()
    {
        $userSess = $this->getServiceLocator()->get('pidLogin');

        return $userSess;
    }

    /**
     *
     * @return type
     */
    public function checkAuth()
    {
        $session = $this->getSession();
        if (is_null($session)) {
            $this->redirect()->toUrl("/");

            return array();
        }
    }

    /**
     *
     * @return type
     */
    public function getSession()
    {
        $session = $this->getServiceLocator()->get('pidLogin');
        if (is_null($session->getIdentity())) {
            return null;
        }

        return $session;
    }

    public function setConfig($config)
    {
        $this->config = $config;
    }

    public function setSession($session)
    {
        $this->session = $session;
    }

    /**
     *
     * @return type
     */
    public function getDbAdapter()
    {
        $dbAdapter = $this->getServiceLocator()->get('DbAdapter');

        return $dbAdapter;
    }

}
