<?php

namespace Epass\Service\Factory;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    Epass\Service\FtpService;

class FtpServiceFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $ftpService = new FtpService();

        return $ftpService;
    }

}
