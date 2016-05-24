<?php

namespace Epass\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface,
    Zend\ServiceManager\FactoryInterface;
use Epass\Service\TransactionService;

class TransactionFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {                             
        return new TransactionService($serviceLocator);
    }
}