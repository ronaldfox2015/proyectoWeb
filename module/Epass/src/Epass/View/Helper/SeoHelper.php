<?php

namespace Epass\View\Helper;


use Zend\Form\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SeoHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    protected $serviceLocator;


    public function __invoke($route)
    {
        $sl = $serviceLocator = $this->getServiceLocator()->getServiceLocator();
        $config = $sl->get('config')['seo'];
        $routes = $config['routes'];
        $titles = $config['titles'];

        if (array_key_exists($route, $routes) && array_key_exists($route, $titles)) {
            $tags = [
                'keywords'    => $config['keywords'],
                'description' => $routes[$route],
                'title'       => $titles[$route]
            ];
        } else {
            $tags = [
                'keywords'    => 'Peaje, epass, e-pass, Perú, Comprar',
                'description' => 'e-pass es el Servicio de Pago electronico para peajes y estacionamientos',
                'title'       => 'e-pass',
            ];
        }

        return $tags;
    }

    /**
     * Set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}