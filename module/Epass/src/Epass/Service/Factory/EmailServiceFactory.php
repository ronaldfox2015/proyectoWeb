<?php

namespace Epass\Service\Factory;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    Epass\Service\EmailService;

class EmailServiceFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $email = new EmailService();
        $email->setConfig($config['mail']);

        return $email;
    }

}
