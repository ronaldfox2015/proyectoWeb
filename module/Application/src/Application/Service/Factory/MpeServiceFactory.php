<?php

namespace Application\Service\Factory;

use Application\Service\MemcachedService;
use Application\Service\MpeService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MpeServiceFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Application\Service\MpeService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $mpeConfig = $config['mpe'];
//        $WebServiceMongoModel = $serviceLocator->get('MongoModifyAccountDataCollection');
        $mpe = new MpeService($mpeConfig);
        $mpe->setMemcached($serviceLocator->get('memcached'));
//        $mpe->setMomgoModifyAccount($WebServiceMongoModel);

        return $mpe;
    }
}
