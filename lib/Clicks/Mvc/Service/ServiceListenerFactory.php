<?php

namespace Clicks\Mvc\Service;

class ServiceListenerFactory extends \Zend\Mvc\Service\ServiceListenerFactory
{

    public function __construct()
    {
        $this->defaultServiceConfig['factories']['ViewHelperManager'] = 'Clicks\Mvc\Service\ViewHelperManagerFactory';
    }

}
