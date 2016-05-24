<?php
return array(
    'router' => array(
        'routes' => array(                        
            'front' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/front[/:controller[/:action]]',                    
                    'defaults' => array(
                        '__NAMESPACE__' => 'Front\Controller',                        
                        '__CONTROLLER__'=> 'index',
                        'module'        => 'Front',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                    'constraints' => array(
                        'page' => '[0-9]+',
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
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Home',
                'route' => 'front',
                'action' => 'home',
            ),
            array(
                'label' => 'Front',
                'route' => 'front',
                'action' => 'index',
            ),
        ),
    ),
    'view_manager' => array(     
        'template_map' => array(
            'layout/front'              => __DIR__ . '/../view/layout/layout.phtml',
        ),
        'template_path_stack' => array(
            'Front' => __DIR__ . '/../view',
        ),
    ),   
);