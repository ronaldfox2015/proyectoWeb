<?php

namespace Epass\Service\Factory;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    Epass\Service\McService;

/**
 *
 */
class MasterCardServiceFactory implements FactoryInterface
{

  protected $pasarela='master';

  public function createService(ServiceLocatorInterface $serviceLocator)
  {
    $config = $serviceLocator->get("config");
    $master = new McService($this->pasarela,$config[$this->pasarela]);
    $master->setErrors($config['errores']['mc']);
    return $master;
  }
}
