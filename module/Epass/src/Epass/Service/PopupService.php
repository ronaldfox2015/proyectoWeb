<?php
namespace Epass\Service;

use Zend\Session\Container;
use Zend\Session\ManagerInterface as Manager;

/**
 *
 */
class PopupService
{

  const TEMPLATE_LABEL='template';
  const PARAMS_LABEL='param';
  const NAME_CONTAINER='PopupMessenger';
  const USE_POPUP='visualizado';

  protected $config;
  protected $pasarela;
  protected $datos=array();
  protected $container;
  protected $session;
  protected $messageAdded;

  public function getContainer()
  {
      if ($this->container instanceof Container) {
          return $this->container;
      }

      $manager = $this->getSessionManager();
      $this->container = new Container(self::NAME_CONTAINER, $manager);

      return $this->container;
  }

  public function setContainer($container)
  {
      $this->container = $container;

      return $this->container;
  }

  public function setSessionManager(Manager $manager)
  {
      $this->session = $manager;

      return $this;
  }

  public function getSessionManager()
  {
      if (!$this->session instanceof Manager) {
          $this->setSessionManager(Container::getDefaultManager());
      }

      return $this->session;
  }

  public function getNamespace()
  {
    return self::NAME_CONTAINER;
  }

  public function addParams(array $params,$hops = 1)
  {
    $this->setUse(false);
    $container = $this->getContainer();
    if ($container instanceof Container) {
        $container->offsetSet(self::PARAMS_LABEL,$params);
    }

    return $this;
  }

  public function getParams()
  {
    $container = $this->getContainer();
    if ($container instanceof Container) {
        return $container->offsetGet(self::PARAMS_LABEL);
    }
    return array();

  }

  public function setTemplate($template)
  {
    if(empty($template))
      throw new Exception("Template no debe estar vacio", 1);

    $container = $this->getContainer();
    $container->offsetSet(self::TEMPLATE_LABEL,$template);
  }

  public function setUse($use = true)
  {
    $container = $this->getContainer();
    $container->offsetSet(self::USE_POPUP,$use);
  }

  public function getUse()
  {
    $container = $this->getContainer();
    if ($container instanceof Container) {
        return $container->offsetGet(self::USE_POPUP);
    }
    return false;
  }

  public function getTemplate()
  {
    $container = $this->getContainer();
    if ($container instanceof Container) {
        return $container->offsetGet(self::TEMPLATE_LABEL);
    }
    return false;
  }

  public function clearPopup()
  {
      $container = $this->getContainer();
      if ($container instanceof Container) {
          $container->getManager()->getStorage()->clear(self::NAME_CONTAINER);
          $this->setContainer=NULL;
      }
  }
}
