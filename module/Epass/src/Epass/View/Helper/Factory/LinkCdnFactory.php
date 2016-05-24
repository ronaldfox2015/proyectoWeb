<?php
namespace Epass\View\Helper\Factory;

use Epass\View\Helper\Link;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Helper para el manejo de cdn
 */
class LinkCdnFactory implements FactoryInterface
{

  public function createService(ServiceLocatorInterface $serviceLocator)
  {
      $serviceLocator = $serviceLocator->getServiceLocator();
      $config = $serviceLocator->get('Config');
      $helper = new Link();
      $helper->setConfig($config['cdn']);
      $helper->setType('statics');
      return $helper;
  }

}
