<?php

namespace Epass\Service\Factory;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    Epass\Service\PopupService;

/**
 *
 */
class PopupServiceFactory implements FactoryInterface
{
  public function createService(ServiceLocatorInterface $serviceLocator)
  {
    $config = $serviceLocator->get("config");
    $popup = new PopupService();
    return $popup;
  }
}
