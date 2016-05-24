<?php

return array(
    'session' => array(
        'config' => array(
            'options' => array(
                'use_cookies' => true,
                'cookie_httponly' => true,                
                'remember_me_seconds' => 3600,
                'gc_maxlifetime' => 3600,
                'cookie_lifetime' => 3600,
            ),
        ),
//        'storage' => 'Zend\Session\Storage\SessionArrayStorage',
//        'save_handler' => 'HandlerSession',
        'validators' => array(
            'Zend\Session\Validator\RemoteAddr',
            'Zend\Session\Validator\HttpUserAgent',
        ),
    ),
);

