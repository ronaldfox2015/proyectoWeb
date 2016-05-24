<?php

namespace Application\Service\Factory;

use Application\Service\ComprobanteService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ComprobanteServiceFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Application\Service\ComprobanteService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $comprobanteConfig = $config['list-comprobantes'];
        $comprobante = new ComprobanteService($comprobanteConfig);

        return $comprobante;
    }
}
