<?php

namespace Cron\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface,
    Zend\ServiceManager\FactoryInterface;
use Cron\Service\CuentaImportService;

class CuentaImportFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {                             
        return new CuentaImportService($serviceLocator);
    }
}