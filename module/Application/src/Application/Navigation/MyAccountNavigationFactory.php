<?php

namespace Application\Navigation;


use Zend\Navigation\Service\DefaultNavigationFactory;

class MyAccountNavigationFactory extends DefaultNavigationFactory
{
    public function getName()
    {
        return 'my_account_navigation';
    }
}