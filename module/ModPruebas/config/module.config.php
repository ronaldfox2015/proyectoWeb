<?php
return array(
    'router' => array(
        'routes' => array(
            'pruebas' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/pruebas',
                    'defaults' => array(
                        '__NAMESPACE__' => 'ModPruebas\Controller',
                        'controller' => 'Index',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'ModPruebas\Controller\Index' => 'ModPruebas\Controller\IndexController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
           'ModPruebas' => __DIR__ . '/../view',
        ),
    ),
);