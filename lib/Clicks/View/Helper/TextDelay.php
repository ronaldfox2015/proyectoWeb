<?php

namespace Clicks\View\Helper;

use Zend\View\Helper\Placeholder;

/**
 * Set a text Placeholder
 *
 * @category   Clicks
 * @package    Clicks_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2012 AlloVince (http://avnpc.com/)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class TextDelay extends \Zend\View\Helper\Placeholder\Container\AbstractStandalone
{

    /**
     * Registry key for placeholder
     * @var string
     */
    protected $_regKey = 'Clicks_View_Helper_TextDelay';
    protected $_autoEscape = false;

    /**
     * Retrieve placeholder for title element and optionally set state
     *
     * @param  string                      $title
     * @param  string                      $setType
     * @return \Zend\View\Helper\HeadTitle
     */
    public function __invoke($textKey, $text = null)
    {
        if ($textKey) {
            $textKey = $this->_regKey . '_' . $textKey;
            $this->setContainer($this->getRegistry()->getContainer($textKey));
        }
        if ($text) {
            $this->getContainer()->set($text);
        }

        return $this;
    }

    /**
     * Turn helper into string
     *
     * @param  string|null $indent
     * @param  string|null $locale
     * @return string
     */
    public function toString()
    {
        $items = array();
        foreach ($this as $item) {
            $items[] = $item;
        }
        $output = '';
        $output .= implode('', $items);

        return $output;
    }

}
