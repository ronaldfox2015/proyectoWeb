<?php

use Application\Navigation\BottomMenuNavigationFactory;
use Application\Navigation\TopMenuNavigationFactory;
use Application\Navigation\MyAccountNavigationFactory;

return [
    'navigation' => [
        'top_menu_navigation' => [
            [
                'label' => 'Afiliate',
                'route' => 'afiliacion_modal',
                'data-toggle' => 'modal',
                'data-target' => '#modal_afiliate'
            ],
            [
                'label' => 'Recarga',
                'route' => 'recarga',
                'data-toggle' => 'modal',
                'data-target' => '#modal_recarga'
            ],
            [
                'label' => 'Personas',
                'route' => 'personas',
            ],
            [
                'label' => 'Empresas',
                'route' => 'empresas',
            ],
            [
                'label' => 'Iniciar Sesión',
                'route' => 'iniciar-sesion',
                'class' => 'iniciar_sesion',
                'login' => '1'
            ],
            [
                'label' => 'Ir a Mi Cuenta',
                'route' => 'cuenta',
                'class' => 'iniciar_sesion',
                'logout' => '1'
            ],
        ],
        'bottom_menu_navigation' => [
            [
                'label' => 'Inicio',
                'title' => 'Inicio',
                'route' => 'home',
            ],
            [
                'label' => '¿Qué es <span class=italic>e-pass</span>?',
                'title' => '¿Qué es e-pass?',
                'route' => 'que-es-epass',
            ],
            [
                'label' => 'Beneficios',
                'title' => 'Beneficios',
                'route' => 'beneficios',
            ],
            [
                'label' => '¿Dónde adquirir tu <span class=italic>e-pass</span>?',
                'title' => '¿Dónde adquirir tu e-pass?',
                'route' => 'donde',
            ],
            [
                'label' => '¿Cómo colocar tu <span class=italic>e-pass</span>?',
                'title' => '¿Cómo colocar tu e-pass?',
                'route' => 'como',
            ],
            [
                'label' => 'Preguntas Frecuentes',
                'title' => 'Preguntas Frecuentes',
                'route' => 'preguntas-frecuentes',
            ],
        ],
        'my_account_navigation' => [
            [
                'label' => 'Mi Cuenta',
                'route' => 'cuenta',
                'action' => 'index',
            ],
            [
                'label' => 'Reportes',
                'route' => 'reportes',
                'action' => 'reportes',
            ],
            [
                'label' => 'Mis Vehículos',
                'route' => 'vehiculos',
                'action' => 'vehiculos',
            ],
            [
                'label' => 'Descargar Comprobante',
                'route' => 'comprobantes',
                'action' => 'comprobantes',
            ],
            [
                'label' => 'Cerrar Sesión',
                'route' => 'auth/actions',
                'action' => 'logout',
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            'top_menu_navigation' => TopMenuNavigationFactory::class,
            'bottom_menu_navigation' => BottomMenuNavigationFactory::class,
            'my_account_navigation' => MyAccountNavigationFactory::class
        ]
    ]
];
