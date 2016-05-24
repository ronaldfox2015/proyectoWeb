<?php

namespace Application\Service\Factory;


use Application\Http\Zendesk\Zendesk;
use Application\Service\ZendeskService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ZendeskServiceFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config  = $serviceLocator->get('config')['zendesk'];

        $subdomain      = $config['subdomain'];
        $username       = $config['username'];
        $token          = $config['token'];
        $customFields   = $config['custom_fields'];

        $zendesk = new Zendesk($subdomain, $username, $token);
        $zendesk->setCustomFields($customFields);

        return $zendesk;
    }
}