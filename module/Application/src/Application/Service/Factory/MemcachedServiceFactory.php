<?php

namespace Application\Service\Factory;

use Application\Service\MemcachedService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MemcachedServiceFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Application\Service\MemcachedService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $memcached = new MemcachedService($config['memcached']);

        return $memcached;
    }
}