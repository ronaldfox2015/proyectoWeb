<?php
namespace Epass\View\Helper\Factory;

use Epass\View\Helper\Link;
use Epass\View\Helper\Popup;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Helper para el manejo de cdn
 */
class PopupFactory implements FactoryInterface
{

  public function createService(ServiceLocatorInterface $serviceLocator)
  {
      $serviceLocator = $serviceLocator->getServiceLocator();

      //var_dump($serviceLocator->get('popup'));
      $helper = new Popup();
      $helper->setServiceLocator($serviceLocator);
      $plugin = $serviceLocator->get('Popup');
      $helper->setPopupPlugin($plugin);

      //$helper->setConfig($config['cdn']);
      //$helper->setType('statics');
      return $helper;
  }

}
