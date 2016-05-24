<?php

namespace Epass;

use Epass\Model\ALinkedListTable;
use Epass\Model\ALinkedList;
use Epass\Model\ADocumentTypeTable;
use Epass\Model\ADocumentType;
use Epass\Model\APlanTable;
use Epass\Model\APlan;
use Epass\Model\AClassTable;
use Epass\Model\AClass;
use Epass\Model\ReclamacionesTable;
use Epass\Model\SolicitudesTable;
use Epass\Model\SolicitudTemaTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Epass\Model\UsersTable;
use Epass\Model\RolesTable;
use Epass\Model\Amember;
use Epass\Model\AmemberTable;
use Epass\Model\VehiclesTable;
use Epass\Model\UserPlansTable;
use Epass\Model\TransactionTypesTable;
use Epass\Model\UserPlanVehicleTable;
use Epass\Model\APromotionTable;
use Epass\Model\TransactionsTable;
use Epass\Model\TransactionDetailTable;
use Zend\EventManager\StaticEventManager;
use Application\Service\MemcachedService;
use Clicks\MongoDB\Adapter\MongoDB as ClicksMongoDB;
use Epass\Model\Collection;
use Epass\Model\ContactanosTable;
use Epass\Model\TransitosTable;
use Epass\Model\TransitoVersionTable;
use Epass\Model\ImportTable;
use Epass\Model\APlazaTable;

class Module
{

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';

    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );

    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'MongoClient' => function ($sm) {
                    $config = $sm->get('config');
                    $config = $config['mongodb']['db'];

                    return new ClicksMongoDB($config);
                },
                'Epass\Model\ALinkedListTable' => function($sm) {
                    $tableGateway = $sm->get('ALinkedListTableGateway');
                    $table = new ALinkedListTable($tableGateway);
                    $config = $sm->get('config');
                    $config_memcached = $config['memcached'];
                    $cache = new MemcachedService($config_memcached);
                    $table->setCache($cache);
                    return $table;
                },
                'ALinkedListTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new ALinkedList());
                    return new TableGateway('alinkedlist', $dbAdapter, null,
                            $resultSetPrototype);
                },
                'Epass\Model\AmemberTable' => function($sm) {
                    $tableGateway = $sm->get('AmemberTableGateway');
                    $table = new AmemberTable($tableGateway);
                    return $table;
                },
                'AmemberTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('adapter2');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Amember());
                    return new TableGateway('AMEMBER', $dbAdapter, null,
                            $resultSetPrototype);
                },
                'Epass\Model\ADocumentTypeTable' => function($sm) {
                    $tableGateway = $sm->get('ADocumentTypeTableGateway');
                    $table = new ADocumentTypeTable($tableGateway);
                    return $table;
                },
                'ADocumentTypeTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new ADocumentType());
                    return new TableGateway('adocumenttype', $dbAdapter, null,
                            $resultSetPrototype);
                },
                'Epass\Model\APlanTable' => function($sm) {
                    $tableGateway = $sm->get('APlanTableGateway');
                    $table = new APlanTable($tableGateway);

                    return $table;
                },
                'APlanTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('adapter2');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new APlan());
                    return new TableGateway('APLAN', $dbAdapter, null,
                            $resultSetPrototype);
                },
                'Epass\Model\AClassTable' => function($sm) {
                    $tableGateway = $sm->get('AClassTableGateway');
                    $table = new AClassTable($tableGateway);
                    return $table;
                },
                'AClassTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new AClass());
                    return new TableGateway('aclass', $dbAdapter, null,
                            $resultSetPrototype);
                },
                'UsersTable' => function ($sm) {
                    $UsersTable = new UsersTable('users', $sm->get('adapter'));
                    return $UsersTable;
                },
                'RolesTable' => function ($sm) {
                    $RolesTable = new RolesTable('roles', $sm->get('adapter'));
                    return $RolesTable;
                },
                'VehiclesTable' => function ($sm) {
                    $VehiclesTable = new VehiclesTable('vehicles',
                            $sm->get('adapter'));
                    return $VehiclesTable;
                },
                'UserPlansTable' => function ($sm) {
                    $UserPlansTable = new UserPlansTable('user_plans',
                            $sm->get('adapter'));
                    $config = $sm->get('config');
                    $config_memcached = $config['memcached'];
                    $cache = new MemcachedService($config_memcached);
                    $UserPlansTable->setCache($cache);
                    return $UserPlansTable;
                },
                'UserPlanVehicleTable' => function ($sm) {
                    $UserPlanVehicleTable = new UserPlanVehicleTable('user_plan_vehicle',
                            $sm->get('adapter'));
                    return $UserPlanVehicleTable;
                },
                'TransactionTypesTable' => function ($sm) {
                    $TransactionTypesTable = new TransactionTypesTable('transaction_types',
                            $sm->get('adapter'));
                    return $TransactionTypesTable;
                },
                'APromotionTable' => function($sm) {
                    $APromotionTable = new APromotionTable('APROMOTION',
                            $sm->get('adapter2'));
                    return $APromotionTable;
                },
                'ReclamacionesTable' => function ($sm) {
                    return new ReclamacionesTable('claims', $sm->get('adapter'));
                },
                'SolicitudesTable' => function ($sm) {
                    return new SolicitudesTable('solicitudes', $sm->get('adapter'));
                },
                'SolicitudTemaTable' => function ($sm) {
                    return new SolicitudTemaTable('solicitudes_tema', $sm->get('Zend\Db\Adapter\Adapter'));
                },
                'SolicitudSubtemaTable' => function ($sm) {
                    return new SolicitudSu('solicitudes_subtema', $sm->get('Zend\Db\Adapter\Adapter'));
                },
                'TransactionDetailTable' => function ($sm) {
                    $TransactionDetailTable = new TransactionDetailTable('transaction_detail',
                            $sm->get('adapter'));
                    return $TransactionDetailTable;
                },
                'TransactionsTable' => function ($sm) {
                    $TransactionsTable = new TransactionsTable('transactions',
                            $sm->get('adapter'));
                    return $TransactionsTable;
                },
                'WebServicesCollection' => function ($sm) {
                    $mongoDb = $sm->get('MongoClient')->getMongoDB();

                    return new Collection\WebServicesCollection(
                            'WebServices', $mongoDb
                    );
                },
                'MongoModifyAccountDataCollection' => function ($sm) {
                    $mongoDb = $sm->get('MongoClient')->getMongoDB();
                    return new Collection\MongoModifyAccountDataCollection(
                            'MongoModifyAccountData', $mongoDb
                    );
                },
                'EmailLogCollection' => function ($sm) {
                    $mongoDb = $sm->get('MongoClient')->getMongoDB();
                    return new Collection\EmailLogCollection(
                            'logWsPagos', $mongoDb
                    );
                },
                'CronLogCollection' => function ($sm) {
                    $mongoDb = $sm->get('MongoClient')->getMongoDB();
                    return new Collection\CronLogCollection(
                            'CronLog', $mongoDb
                    );
                },
                'ContactanosTable' => function ($sm) {
                    return new ContactanosTable('contactanos', $sm->get('adapter'));
                },
                'TransitosTable' => function ($sm) {
                    $transitosImportTable = new TransitosTable('transitos', $sm->get('adapter'));
                    return $transitosImportTable;
                },
                'TransitoVersionTable' => function ($sm) {
                    $transitoVersionTable = new TransitoVersionTable('transito_version', $sm->get('adapter'));
                    return $transitoVersionTable;
                },
                'ImportTable' => function ($sm) {
                    $importTable = new ImportTable('import', $sm->get('adapter'));
                    return $importTable;
                },
                'APlazaTable' => function ($sm) {
                    $aplazaTable = new APlazaTable('aplaza', $sm->get('adapter'));
                    return $aplazaTable;
                },
            ),
            'aliases' => array(
                'UsersModel' => 'UsersTable',
                'VehiclesModel' => 'VehiclesTable',
                'UserPlansModel' => 'UserPlansTable',
                'UserPlanVehicleModel' => 'UserPlanVehicleTable',
                'APromotionModel' => 'APromotionTable',
                'ReclamacionesModel' => 'ReclamacionesTable',
                'SolicitudesModel' => 'SolicitudesTable',
                'TransactionDetailModel'=>'TransactionDetailTable',
                'TransactionsModel'=>'TransactionsTable',
                'TransactionTypesModel' => 'TransactionTypesTable',
                'ContactanosModel' => 'ContactanosTable',
                'TransitosModel' => 'TransitosTable',
                'TransitoVersionModel' => 'TransitoVersionTable',
                'ImportModel' => 'ImportTable',
                'APlazaModel' => 'APlazaTable',
            )
        );

    }

    public function onBootstrap($event)
    {
        $app = $event->getApplication();
        $serviceManager = $app->getServiceManager();
        /* $eventManager = $app->getEventManager();
          $moduleRouteListener = new ModuleRouteListener();
          $moduleRouteListener->attach($eventManager); */

        $events = StaticEventManager::getInstance();
        $events->attach('*', Event\Listener::MAIL_EVENT, function ($event) use ($serviceManager) {
            
            $config = $serviceManager->get('config');
            if (isset($config['mail']['enabled']) && $config['mail']['enabled'] == false) {
                return;
            }
            $params = $event->getParams();
            $mail = $serviceManager->get('EmailService');
            $tipo = $params['tipo'];
            $asunto = $params['asunto'];
            $email = $params['email'];
            $desdeEmail = $desdeNombre = null;
            if (isset($params['from'])) {
                if (is_array($params['from'])) {
                    if (count($params['from'])) {
                        list($desdeEmail, $desdeNombre) = $params['from'];
                    }
                }
            }
            $view = $serviceManager->get('Zend\View\Renderer\RendererInterface');
            $params['data']['view'] = $view;
            $copias = null;
            if (isset($config['mail']['test.control']['enabled']) && $config['mail']['test.control']['enabled'] == true) {
                $email = $config['mail']['test.control']['emails'];
            } else {
                if (isset($params['cc']) || isset($params['bcc'])) {
                    $cc = isset($params['cc']) ? (array) $params['cc'] : array();
                    $bcc = isset($params['bcc']) ? (array) $params['bcc'] : array();
                    $copias = array('cc' => $cc, 'bcc' => $bcc);
                }
            }

            if ($tipo == Enum\EmailType::WITH_TEMPLATE) {
                $template = $params['template'];
                $data = $params['data'];

                $res = $mail->enviarMail($asunto, $email, $template, $data,
                        $copias, $desdeEmail, $desdeNombre);
            }

            if ($tipo == Enum\EmailType::EXCEPTION) {
                $template = $params['template'];
                $data = $params['data'];
                $res = $mail->enviarMailException($asunto, $email, $template,
                        $data, $copias);
            }
            if ($tipo == Enum\EmailType::WITHOUT_TEMPLATE) {
                $mensaje = $params['mensaje'];
                $res = $mail->enviarMailExceptionNoTemplate($asunto, $email,
                        $mensaje, $copias);
            }
            if ($tipo == Enum\EmailType::WITH_TEMPLATE_RECEIVE) {
                  $data = $params['data'];
                  $template = $params['template'];
                  //asunto - fromMail - tempalte - data - toMail
                  $res = $mail->recibirMail($asunto, $email, $template, $data);
              }
            return $res;
        });
    }

}
