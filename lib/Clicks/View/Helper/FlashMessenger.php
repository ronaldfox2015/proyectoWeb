<?php

namespace Clicks\View\Helper;

class FlashMessenger extends \Zend\View\Helper\AbstractHelper
{

    protected static $_flashMessenger;

    public function __invoke($namespace = 'default')
    {

        if (!self::$_flashMessenger) {

            self::$_flashMessenger = new \Zend\Mvc\Controller\Plugin\FlashMessenger;
        }

        return self::$_flashMessenger->setNamespace($namespace);
    }

}
