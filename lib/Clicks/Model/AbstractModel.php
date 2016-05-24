<?php

namespace Clicks\Model;

use Zend\Di\Di,
    Zend\Di\Config as DiConfig,
    Eva\Config\Config,
    Zend\Mvc\Exception\MissingLocatorException,
    Eva\Mvc\Exception\InvalidEventException,
    Zend\ServiceManager\ServiceLocatorAwareInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    Zend\Stdlib\Hydrator\ClassMethods;


abstract class AbstractModel implements ServiceLocatorAwareInterface
{

    protected $serviceLocator;

    /**
     *
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     *
     * @return \Zend\ServiceManager\ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     *
     * @return \Zend\EventManager\EventManager
     */
    public function getEvent()
    {
        return $this->getServiceLocator()->get('Application')->getEventManager();
    }

}
