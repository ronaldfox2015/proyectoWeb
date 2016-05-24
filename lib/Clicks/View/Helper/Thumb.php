<?php

namespace Clicks\View\Helper;

class Thumb extends \Zend\View\Helper\AbstractHelper
{

    public function __invoke($url, array $args = array())
    {
        if (!$args || !$url) {
            return $url;
        }

        sort($args);
        $url = explode('/', $url);
        $fileName = array_pop($url);
        $nameArray = explode('.', $fileName);
        $nameExt = array_pop($nameArray);
        $nameFinal = array_pop($nameArray);
        $nameFinal .= ',' . implode(',', $args);
        array_push($nameArray, $nameFinal, $nameExt);
        $fileName = implode('.', $nameArray);

        array_push($url, $fileName);

        return implode('/', $url);
    }

}
