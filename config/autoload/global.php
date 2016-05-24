<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
use Zend\Cache\Storage\Adapter\MemcachedResourceManager;
use Zend\Cache\StorageFactory;

return array(
    'ftp-transacciones' => array(
        'server'=> '200.48.248.122',
        'user' => 'limitado',
        'password' => 'limitado',
        'fileLocal' => getcwd().'/transito/'
    ),
    'recaptcha' => array(
        'name'      => 'recaptcha',
        'privKey'   => '6LexyhoTAAAAAPQs0PBpjV4UUqPpqxhKnMZs7u9I',
        'pubKey'    => '6LexyhoTAAAAAHaWMgaEU8q9F3VTFCspJ-_rfOQp',
    ),
    'zendesk' => [
        'subdomain' => 'epass-test',
        'username'  => 'martin.cruz@clicksandbricks.pe',
        'token'     => 'vXMTzKG1SVuBysCXVNa2DqgYUegG4pkUIyFBt9Le',
        'custom_fields' => [
            'theme' => 30725898,
            'subtheme' => 30729878
        ]
    ],
    'mpe' => [
        'url'      => 'http://testcrm.epass.pe/axis2/services/TDLTollSys_WebCRM.wsdl',
        'location' => 'http://testcrm.epass.pe/axis2/services/TDLTollSys_WebCRM',
        'option'   => [
            'encoding' => 'UTF-8'
        ]
    ],
    'memcached' => [
        'host' => '10.128.0.4',
        'port' => '11211',
    ],
    'migrations' => [
        'default' => [
            'adapter' => 'adapter'
        ],
    ],
    'db'=> [
        'adapters'=>[
            'adapter' => [
                'driver' => 'pdo_mysql',
                'host' => '10.128.0.4', // ip-interno: 10.128.0.4 ip-extreno: 104.197.247.250
                'dbname' => 'db_epass_dev',
                'username' => 'u_epass_dev',
                'password' => 'aewusee7Oogeej',
                'port' => '3306',
                'connectTimeoutMS' => -1,
                'options' => ['buffer_results' => true],
                'driver_options' => [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'utf8\''
                ]
            ],
            'adapter2' => [
                'driver'         => 'Pdo',
                'dsn'            => 'dblib:host=mpe;dbname=TOLLMPE',
                'charset'        =>  'UTF-8',
                'username'       => 'u_mpe_dev',
                'password'       => 'eiJah6eD5pee1t',
                'pdotype'        => 'dblib',
            ],
            'adapter3' => [
                'driver'         => 'OCI8',
                'connection_string' => '54.209.155.221/xe',
                'character_set'  => 'AL32UTF8',
                'username'       => 'epass',
                'password'       => 'fagheev4gahK6g',
            ],
        ]
    ],
    'mongodb' => array(
        'db' => array(
            'dbname' => 'mdb_epass_dev',
            'host' => '10.128.0.4', // ip-interno: 10.128.0.4 ip-extreno: 104.197.247.250
            'port' => '27017',
            'username' => 'u_epass_dev',
            'password' => 'Yuedahziev6aeW',
            'connectTimeoutMS' => -1
        )
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Db\Adapter\AdapterAbstractServiceFactory',
        ),
        'aliases' => array(

        ),
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',


            /*'reCaptchaService' => function(ZendServiceManagerServiceManager $sm) {
                $config = $sm->get('Config');
                return new ZendCaptchaReCaptcha($config['recaptcha']);
            },*/

        ),
    ),
    'google' => array(
        'bucket' => 'e-epass-dev',
    )
);
