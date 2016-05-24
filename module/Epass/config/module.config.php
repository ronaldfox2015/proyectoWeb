<?php
return array(
    'router' => array(
        'routes' => array(                        
            'epass' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/epass[/:controller[/:action]]',                    
                    'defaults' => array(
                        '__NAMESPACE__' => 'Epass\Controller',
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
            'alinkedlist' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/alinkedlist[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Epass\Controller\ALinkedList',
                    ),
                ),
            ),
            'UserPlans' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/UserPlans[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Epass\Controller\UserPlans',
                    ),
                ),
            ),
          'solicitudes' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/solicitudes[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Epass\Controller\Solicitudes',
                    ),
                ),
            ),
            'ajax-solicitudes-by-user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/ajax-solicitudes-by-user/[:id]',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Epass\Controller\Solicitudes',
                        'action' => 'ajaxGetByUser'
                    ),
                ),
            ),

            'ajax-temas-zendesk' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/ajax-temas-zendesk',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Epass\Controller\Solicitudes',
                        'action' => 'ajaxTemasZendesk'
                    ),
                ),
            ),
          'ajax-temas-solicitudes' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/ajax-temas-solicitudes',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Epass\Controller\Solicitudes',
                        'action' => 'ajaxTemasSolicitudes'
                    ),
                ),
            ),
          'ajax-subtemas-solicitudes' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/ajax-subtemas-solicitudes/[:id]',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Epass\Controller\Solicitudes',
                        'action' => 'ajaxSubtemasSolicitudes'
                    ),
                ),
            ),
          'mpe-all-plans' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/mpe/all-plans',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Epass\Controller\Mpe',
                        'action' => 'getAllPlansWithPromotions'
                    ),
                ),
            ),
            'adocumenttype' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/adocumenttype[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Epass\Controller\ADocumentType',
                    ),
                ),
            ),
            'aplan' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/aplan[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Epass\Controller\APlan',
                    ),
                ),
            ),
            'aclass' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/aclass[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Epass\Controller\AClass',
                    ),
                ),
            ),
            'apromotion' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/apromotion[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Epass\Controller\APromotion',
                    ),
                ),
            ),
            'user' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/user[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Epass\Controller\User',
                    ),
                ),
            ),
            'user-plan' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/user-plan[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Epass\Controller\UserPlan',
                    ),
                ),
            ),            
            'user-plan-vehicle' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/user-plan-vehicle[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Epass\Controller\UserPlanVehicle',
                    ),
                ),
            ),            
            'vehicle' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/vehicle[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Epass\Controller\Vehicle',
                    ),
                ),
            ), 
            'api' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/api',
                    'defaults' => array(
                        'controller' => 'Epass\Controller\Api',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'actions' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/:action',
                            'constraints' => array(
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
            'Epass\Controller\ALinkedList' => 'Epass\Controller\ALinkedListController',
            'Epass\Controller\ADocumentType' => 'Epass\Controller\ADocumentTypeController',
            'Epass\Controller\APlan' => 'Epass\Controller\APlanController',
            'Epass\Controller\AClass' => 'Epass\Controller\AClassController',
            'Epass\Controller\APromotion' => 'Epass\Controller\APromotionController',
            'Epass\Controller\User' => 'Epass\Controller\UserController',
            'Epass\Controller\UserPlans' => 'Epass\Controller\UserPlansController',
            'Epass\Controller\UserPlan' => 'Epass\Controller\UserPlanController',
            'Epass\Controller\UserPlanVehicle' => 'Epass\Controller\UserPlanVehicleController',
            'Epass\Controller\Vehicle' => 'Epass\Controller\VehicleController',
            'Epass\Controller\Api' => 'Epass\Controller\ApiController',
            'Epass\Controller\Solicitudes' => 'Epass\Controller\SolicitudesController',
            'Epass\Controller\Mpe' => 'Epass\Controller\MpeController',
        ),
    ),
    'service_manager' => array(
      'factories'=>array(
          'Epass\Service\VisaService' => 'Epass\Service\Factory\VisaServiceFactory',
          'Epass\Service\MasterService' => 'Epass\Service\Factory\MasterCardServiceFactory',
          'Epass\Service\AmexService' => 'Epass\Service\Factory\AmexServiceFactory',
          'Epass\Service\DinnerService' => 'Epass\Service\Factory\DinnerServiceFactory',
          'Epass\Service\EmailService' => 'Epass\Service\Factory\EmailServiceFactory',
          'Epass\Service\PopupService' => 'Epass\Service\Factory\PopupServiceFactory',
          'Epass\Service\FtpService' => 'Epass\Service\Factory\FtpServiceFactory',

          // Memcached service instance
          'Application\Service\MemcachedService' => 'Application\Service\Factory\MemcachedServiceFactory',

          // Mpe service instance
          'Application\Service\MpeService' => 'Application\Service\Factory\MpeServiceFactory',

          // Zendesk service instance
          'Application\Http\Zendesk\Zendesk' => 'Application\Service\Factory\ZendeskServiceFactory',

          // Comprobante serive instance
          'Application\Service\ComprobanteService' => 'Application\Service\Factory\ComprobanteServiceFactory',
          'Epass\Service\TransactionService' => 'Epass\Service\Factory\TransactionFactory',
          
          // Comprobante serive instance
          'Application\Service\GoogleApiService' => 'Application\Service\Factory\GoogleApiServiceFactory',
      ),
      'aliases' => array(
          'EmailService' => 'Epass\Service\EmailService',
          'Popup' => 'Epass\Service\PopupService',
          'FtpService' => 'Epass\Service\FtpService',

          'memcached' => 'Application\Service\MemcachedService',
          'mpe'       => 'Application\Service\MpeService',
          'zendesk'       => 'Application\Http\Zendesk\Zendesk',
          'comprobante' => 'Application\Service\ComprobanteService',
          'google'       => 'Application\Service\GoogleApiService',
      )
    ),
    'console' => array(
        'router' => array(
            'routes' => array(
            )
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Epass' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'view_helpers' => array(
        'factories' => array(
            'linkCdn' => 'Epass\View\Helper\Factory\LinkCdnFactory',
            'linkElements' => 'Epass\View\Helper\Factory\LinkElementsFactory',
            'popup' => 'Epass\View\Helper\Factory\PopupFactory',
            'googleAnalytics'=> 'Epass\View\Helper\Factory\googleAnalyticsFactory',
        )
    )
);
