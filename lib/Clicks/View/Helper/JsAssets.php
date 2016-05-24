<?php

namespace Clicks\View\Helper;

use Zend\View\Exception;

/**
 * View helper for js assets
 *
 * @category   Zend
 * @package    Zend_Form
 * @subpackage View
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class JsAssets extends \Zend\View\Helper\AbstractHelper
{

    /**
     * Invoke helper as functor
     *
     * Proxies to {@link render()}.
     *
     * @param  ElementInterface $element
     * @return string
     */
    public function __invoke($files = array(), $compress = false)
    {
        if (!$files) {
            return $this;
        }

        $view = $this->getView();
        $config = $view->getHelperPluginManager()->getServiceLocator()->get('config');
        $config = $config['site']['assets'];
        $prefix = $config['cache'] ? $config['cachePath'] : $config['phpPath'];

        if (is_array($files)) {
            foreach ($files as $file) {
                $view->headScript()->appendFile($prefix . $file,
                    'text/javascript');
            }
        } elseif (is_string($files)) {
            $view->headScript()->appendFile($prefix . $files, 'text/javascript');
        } else {
            throw new Exception\InvalidArgumentException(sprintf(
                'Js Assets helper require file array or string input'
            ));
        }

        return $this;
    }

}
