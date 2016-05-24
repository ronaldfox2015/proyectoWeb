<?php

namespace Epass\Service\Factory;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    Epass\Service\McService;

/**
 *
 */
class AmexServiceFactory implements FactoryInterface
{

  protected $pasarela='amex';

  public function createService(ServiceLocatorInterface $serviceLocator)
  {
    $config = $serviceLocator->get("config");
    $amex = new McService($this->pasarela,$config[$this->pasarela]);
    $amex->setErrors($config['errores']['mc']);
    return $amex;
  }
}
