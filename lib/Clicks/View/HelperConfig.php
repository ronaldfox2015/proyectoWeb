<?php

namespace Clicks\View;

use Zend\ServiceManager\ConfigInterface;
use Zend\ServiceManager\ServiceManager;

class HelperConfig implements ConfigInterface
{

    /**
     * @var array Pre-aliased view helpers
     */
    protected $invokables = array(
        'action' => 'Clicks\View\Helper\Action',
        'uri' => 'Clicks\View\Helper\Uri',
        'link' => 'Clicks\View\Helper\Link',
        'formAttr' => 'Clicks\Form\View\Helper\FormAttr',
        'input' => 'Clicks\Form\View\Helper\Input',
        'label' => 'Clicks\Form\View\Helper\Label',
        'widget' => 'Clicks\View\Helper\Widget',
        'textDelay' => 'Clicks\View\Helper\TextDelay',
        'hasModule' => 'Clicks\View\Helper\HasModule',
        'thumb' => 'Clicks\View\Helper\Thumb',
        'datetime' => 'Clicks\View\Helper\Datetime',
        'googleAnalytics' => 'Clicks\View\Helper\GoogleAnalytics',
        'flashMessenger' => 'Clicks\View\Helper\FlashMessenger',
        'gravatarLink' => 'Clicks\View\Helper\GravatarLink',
        'subText' => 'Clicks\View\Helper\SubText',
        'callback' => 'Clicks\View\Helper\Callback',
        'assets' => 'Clicks\View\Helper\Assets',
        'jsAssets' => 'Clicks\View\Helper\JsAssets',
        'cssAssets' => 'Clicks\View\Helper\CssAssets',
    );

    /**
     * Configure the provided service manager instance with the configuration
     * in this class.
     *
     * In addition to using each of the internal properties to configure the
     * service manager, also adds an initializer to inject ServiceManagerAware
     * classes with the service manager.
     *
     * @param  ServiceManager $serviceManager
     * @return void
     */
    public function configureServiceManager(ServiceManager $serviceManager)
    {
        foreach ($this->invokables as $name => $service) {
            $serviceManager->setInvokableClass($name, $service);
        }
    }

}
