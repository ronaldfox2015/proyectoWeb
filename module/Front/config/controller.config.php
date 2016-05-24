<?php
namespace Application;

return array(
    'invokables' => array(
        'Front\Controller\Index' => 'Front\Controller\IndexController',
        'Front\Controller\Cuenta' => 'Front\Controller\CuentaController',
        'Front\Controller\Reclamaciones' => 'Front\Controller\ReclamacionesController',
        'Front\Controller\Email' => 'Front\Controller\EmailController'
    ),
);