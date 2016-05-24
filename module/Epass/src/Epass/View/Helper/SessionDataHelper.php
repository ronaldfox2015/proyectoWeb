<?php

namespace Epass\View\Helper;

use Zend\View\Helper\AbstractHelper;  
use Zend\ServiceManager\ServiceLocatorAwareInterface;  
use Zend\ServiceManager\ServiceLocatorInterface;  

class SessionDataHelper extends AbstractHelper implements ServiceLocatorAwareInterface  
{  
    /** 
     * Set the service locator. 
     * 
     * @param ServiceLocatorInterface $serviceLocator 
     * @return CustomHelper 
     */  
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)  
    {  
        $this->serviceLocator = $serviceLocator;  
        return $this;  
    }  
    /** 
     * Get the service locator. 
     * 
     * @return \Zend\ServiceManager\ServiceLocatorInterface 
     */  
    public function getServiceLocator()  
    {  
        return $this->serviceLocator;  
    }  
    
    public function __invoke()  
    {  
        $serviceLocator = $this->getServiceLocator()->getServiceLocator();  
        $auth = $serviceLocator->get('AuthService');
        $data = null;
        if ($auth->hasIdentity()) {
            $data_sesion_user = $auth->getStorage()->read();
            $data =  $data_sesion_user;
        }
        return $data;
    }  
}  
