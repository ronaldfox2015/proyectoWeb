<?php
namespace ModPruebas;

use Zend\Db\Adapter\Adapter as DbAdapter;
use ModPruebas\Model\Table;
use ModPruebas\Model\Collection;
use Clicks\MongoDB\Adapter\MongoDB as ClicksMongoDB;
use Clicks\Service\Epass;

class Module
{
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

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }



    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'DbAdapter' => function ($sm) {
                    $config = $sm->get('config');
                    $config = $config['db'];
                    $dbAdapter = new DbAdapter($config);

                    return $dbAdapter;
                },
                'MongoClient' => function ($sm) {
                    $config = $sm->get('config');
                    $config = $config['mongodb']['db'];

                    return new ClicksMongoDB($config);
                },
                /*'UsersTable' => function ($sm) {
                    $UsersTable = new Table\UsersTable('wp_users', $sm->get('DbAdapter'));
                    return $UsersTable;
                },*/
                'UsuariosCollection' => function ($sm) {
                    $mongoDb = $sm->get('MongoClient')->getMongoDB();

                    return new Collection\UsuariosCollection(
                            'usuarios', $mongoDb
                    );
                },
                'EpassService' => function ($sm) {
                    $config = $sm->get('config');

                    return new \Clicks\Service\Epass($config);
                },
            ),
            'aliases' => array(
                //'UsersModel' => 'UsersTable',
            ),
        );
    }
}
