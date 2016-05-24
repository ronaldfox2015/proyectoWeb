<?php

/**
 * EvaEngine
 *
 * @link      https://github.com/AlloVince/eva-engine
 * @copyright Copyright (c) 2012 AlloVince (http://avnpc.com/)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Eva_Api.php
 * @author    AlloVince
 */

namespace Clicks\Mvc\Service;

/**
 * @category   Eva
 * @package    Eva_Mvc
 * @subpackage Service
 * @copyright  Copyright (c) 2012 AlloVince (http://avnpc.com/)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class ViewHelperManagerFactory extends \Zend\Mvc\Service\ViewHelperManagerFactory
{

    public function __construct()
    {
        $this->defaultHelperMapClasses[] = 'Clicks\View\HelperConfig';
        $this->defaultHelperMapClasses[] = 'Clicks\I18n\View\HelperConfig';
    }

}
