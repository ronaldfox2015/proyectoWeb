<?php

namespace Epass\View\Helper;

use Zend\View\Helper\AbstractHelper;  
use Zend\ServiceManager\ServiceLocatorAwareInterface;  
use Zend\ServiceManager\ServiceLocatorInterface;  

class SessionHelper extends AbstractHelper implements ServiceLocatorAwareInterface  
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
        $isauth = 0;
        if ($auth->hasIdentity()) {
            $isauth = 1;
        }
        return $isauth;
    }  
}  
