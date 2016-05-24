<?php

return array(
    'factories' => array(                
        'Cron\Service\TransitoImportService' => 'Cron\Service\Factory\TransitoImportFactory',
        'Cron\Service\CuentaImportService' => 'Cron\Service\Factory\CuentaImportFactory',
    ),
    'invokables' => array(
    ),
);