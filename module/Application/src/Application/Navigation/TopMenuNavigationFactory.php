<?php

namespace Application\Navigation;

use Zend\Navigation\Service\DefaultNavigationFactory;

class TopMenuNavigationFactory extends DefaultNavigationFactory
{
    protected function getName()
    {
        return 'top_menu_navigation';
    }

}