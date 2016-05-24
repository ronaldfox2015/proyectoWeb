<?php

namespace Clicks\View\Helper;

/**
 * Gravatar
 *
 * @category   Clicks
 * @package    Clicks_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2012 AlloVince (http://avnpc.com/)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class GravatarLink extends \Zend\View\Helper\AbstractHelper
{

    public function __invoke($email, $size = 60, $default = '')
    {
        $gravUrl = "http://www.gravatar.com/avatar.php?" .
            "gravatar_id=" . md5(strtolower($email)) .
            "&size=" . $size;

        return $gravUrl;
    }

}
