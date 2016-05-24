<?php

namespace Epass\Service\Factory;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    Epass\Service\McService;

/**
 *
 */
class DinnerServiceFactory implements FactoryInterface
{

  protected $pasarela='dinners';

  public function createService(ServiceLocatorInterface $serviceLocator)
  {
    $config = $serviceLocator->get("config");
    $diners = new McService($this->pasarela,$config[$this->pasarela]);
    $diners->setErrors($config['errores']['mc']);
    return $diners;
  }
}
