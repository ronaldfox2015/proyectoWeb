<?php

namespace Clicks\Mvc\Controller;

class PluginManager extends \Zend\Mvc\Controller\PluginManager
{

    /**
     * Default set of plugins
     *
     * @var array
     */
    protected $invokableClasses = array(
        'flashmessenger' => 'Zend\Mvc\Controller\Plugin\FlashMessenger',
        'forward' => 'Zend\Mvc\Controller\Plugin\Forward',
        'layout' => 'Zend\Mvc\Controller\Plugin\Layout',
        'params' => 'Zend\Mvc\Controller\Plugin\Params',
        'postredirectget' => 'Zend\Mvc\Controller\Plugin\PostRedirectGet',
        'redirect' => 'Zend\Mvc\Controller\Plugin\Redirect',
        'url' => 'Zend\Mvc\Controller\Plugin\Url'
    );

}
