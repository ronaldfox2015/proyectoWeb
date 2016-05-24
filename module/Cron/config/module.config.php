<?php
return array(
    'router' => array(
        'routes' => array(                        
            'cron' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/cron[/:controller[/:action]]',                    
                    'defaults' => array(
                        '__NAMESPACE__' => 'Cron\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(                    
                    'default' => array(
                        'type' => 'Wildcard',
                        'options' => array(                            
                        ),
                    ),                    
                ),
            ),            
        ),
    ),
    'view_manager' => array(     
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'console' => array(
        'router' => array(
            'routes' => array(
                'reprocess' => array(
                    'options' => array(
                        'route' => 'reprocess [index|transactions]:action',
                        'defaults' => array(
                            '__NAMESPACE__' => 'Cron\Controller',
                            'controller' => 'Reprocess',
                        )
                    )
                ), 
                'cron-migrar-cuentas-diarias' => array(
                    'type' => 'simple',
                    'options' => array(
                        'route' => 'cron-migrar-cuentas-diarias',
                        'defaults' => array(
                            'controller' => 'Cron\Controller\Cuenta',
                            'action' => 'import'
                        )
                    )
                ),
                'cron-migrar-cuentas-inicial' => array(
                    'type' => 'simple',
                    'options' => array(
                        'route' => 'cron-migrar-cuentas-inicial',
                        'defaults' => array(
                            'controller' => 'Cron\Controller\Cuenta',
                            'action' => 'migrarCuentasInicial'
                        )
                    )
                ),                
                'cron-inicio-transitos' => array(
                    'type' => 'simple',
                    'options' => array(
                        'route' => 'cron inicio transitos',
                        'defaults' => array(
                            'controller' => 'Cron\Controller\Transito',
                            'action' => 'inicioTransitos'
                        )
                    )
                ),
                'cron-migrar-transitos' => array(
                    'type' => 'simple',
                    'options' => array(
                        'route' => 'cron import transitos [--params=]',
                        'defaults' => array(
                            'controller' => 'Cron\Controller\Transito',
                            'action' => 'import'
                        )
                    )
                ),
                'cron-email-nuevas-afiliaciones' =>  array(
                    'type' => 'simple',
                    'options' => array(
                        'route'=>'email-nuevas-afiliaciones',
                        'defaults' => array(
                            'controller' => 'Cron\Controller\Cuenta',
                            'action'     => 'emailNuevasAfiliaciones'
                        )
                    )
                ),
                'cron-visa-update-status' =>  array(
                    'type' => 'simple',
                    'options' => array(
                        'route'=>'cron-visa-update-status',
                        'defaults' => array(
                            'controller' => 'Cron\Controller\Visa',
                            'action'     => 'updateStatus'
                        )
                    )
                ),                
            )
        )
    ),
);