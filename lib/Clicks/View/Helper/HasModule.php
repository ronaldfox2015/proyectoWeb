<?php

namespace Clicks\View\Helper;

use Zend\Mvc\Router\RouteStackInterface,
    Zend\Mvc\Router\RouteMatch,
    Zend\View\Exception,
    Clicks\Uri\Uri as CoreUri;

/**
 * Check module whether installed
 *
 * @category   Clicks
 * @package    Clicks_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2012 AlloVince (http://avnpc.com/)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class HasModule extends \Zend\View\Helper\AbstractHelper
{

    /**
     *
     * @param  string|array               $moduleNameOrArray
     * @return boolean
     * @throws Exception\RuntimeException
     */
    public function __invoke($moduleNameOrArray)
    {
        //TODO: use ServiceManager here to get Modules
        //TODO: also check module depends

        $loadedModules = \Clicks\Api::_()->getModuleLoaded();
        if (true === is_string($moduleNameOrArray)) {
            if (true === in_array($moduleNameOrArray, $loadedModules)) {
                return true;
            }

            return false;
        }

        if (true === is_array($moduleNameOrArray)) {
            foreach ($moduleNameOrArray as $moduleName) {
                if (false === in_array($moduleName, $loadedModules)) {
                    return false;
                }

                return true;
            }
        }

        return false;
    }

}
