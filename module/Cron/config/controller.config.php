<?php
namespace Cron;

return array(
    'invokables' => array(
        'Cron\Controller\Reprocess' => 'Cron\Controller\ReprocessController', 
        'Cron\Controller\Transito' => 'Cron\Controller\TransitoController', 
        'Cron\Controller\Cuenta' => 'Cron\Controller\CuentaController', 
        'Cron\Controller\Visa' => 'Cron\Controller\VisaController',         
    ),
);