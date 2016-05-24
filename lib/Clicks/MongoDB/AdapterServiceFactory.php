<?php

namespace Clicks\MongoDB;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Clicks\MongoDB\Adapter\MongoDB as ClicksMongoDB;

class AdapterServiceFactory implements FactoryInterface
{

    /**
     * Create db adapter service
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return Adapter
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');

        return new ClicksMongoDB($config['mongodb']['db']);
    }

}
