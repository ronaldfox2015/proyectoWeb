<?php

namespace Cron\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface,
    Zend\ServiceManager\FactoryInterface;
use Cron\Service\TransitoImportService;

class TransitoImportFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {                             
        return new TransitoImportService($serviceLocator);
    }
}