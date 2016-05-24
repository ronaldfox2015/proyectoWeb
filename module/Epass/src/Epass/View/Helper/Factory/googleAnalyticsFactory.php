<?php

namespace Epass\View\Helper\Factory;

use Epass\View\Helper\googleAnalytics,
    Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;

class googleAnalyticsFactory implements FactoryInterface
{
    const CONFIG_LABEL='google_analytics';

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
        $serviceLocator = $serviceLocator->getServiceLocator();
        $config = $serviceLocator->get('Config');
        $helper = new googleAnalytics($config[self::CONFIG_LABEL]);
        return $helper;
    }

}
