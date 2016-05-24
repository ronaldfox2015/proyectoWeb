<?php

namespace Application\Navigation;

use Zend\Navigation\Service\DefaultNavigationFactory;

class BottomMenuNavigationFactory extends DefaultNavigationFactory
{
    protected function getName()
    {
        return 'bottom_menu_navigation';
    }

}