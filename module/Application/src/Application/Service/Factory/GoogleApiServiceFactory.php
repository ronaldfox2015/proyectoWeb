<?php

namespace Application\Service\Factory;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;

use Application\Service\GoogleApiService;

class GoogleApiServiceFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get("config");
        $GoogleApiService = new GoogleApiService();
        $GoogleApiService->setConfig($config['google']);
        
        return $GoogleApiService;
    }
}
