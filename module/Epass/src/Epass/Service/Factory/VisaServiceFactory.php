<?php

namespace Epass\Service\Factory;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    Epass\Service\VisaService;

/**
 *
 */
class VisaServiceFactory implements FactoryInterface
{

  protected $pasarela='visa';

  public function createService(ServiceLocatorInterface $serviceLocator)
  {
    $config = $serviceLocator->get("config");
    $visa = new VisaService($config[$this->pasarela]);
    $visa->setErrors($config['errores'][$this->pasarela]);
    return $visa;
  }
}
