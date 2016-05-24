<?php
return [
    'ftp-transacciones' => array(
        'server'=> '200.48.248.122',
        'user' => 'limitado',
        'password' => 'limitado',
        'fileLocal' => getcwd().'/transito/'
    ),    
  'urlPath'=>'http://dev.epass.clickslatam.com',
  'api' => array(
        'secret'=>'epass',
        'exp'=>86400
   ),
  'ftp-transacciones' => array(
        'server'=> '200.48.248.121',
        'user' => 'ftp_mpe',
        'password' => 'Mpe2021**!',
        'fileLocal' => getcwd().'/importacion/',
        'fileServer' => 'TEST/'
   ),
  'cdn'=>[
    'link_helper' => [
        'enabled' => true,
    ],
    'statics' => array(
      'scheme' => 'https',
      'host' => 'storage.googleapis.com/epass-dev/static',
      'port' => NULL,
    ),
    'elements' => array(
      'scheme' => 'http',
      'host' => 'dev.3c.urbania.e3.pe/elements',
      'port' => NULL,
    ),
    'file_lastCommit' => ROOT_PATH . 'last_commit',
  ],
    'list-comprobantes' => [
        'ruc-odebrecht' => '20600778871',
        'razon-social-odebrecht' => 'ODEBRECHT PERU PEAJES S.A.C.',
        'serie-correlativo' => 'B000-00000000',
        'url-recibo' => '/PROD/Extractos/<parte-uno>/<parte-dos>',
        'url-comprobante-ws' => 'http://200.48.248.117/wssConsultaDocPeru/consultaDocumentosPeru.asmx?wsdl',
        'ftp' => array(
                'server' => '200.48.248.121',
                'user' => 'ftp_mpe',
                'pass' => 'Mpe2021**!',
                'port' => '21',
              ),
        'ruc-rdl' => '20550372640',
        'razon-social-rdl' => 'RUTAS DE LIMA S.A.C.',
        /*'url-recibo' => 'http://10.22.0.113/extractos/<parte-uno>/<parte-dos>',
        'url-comprobante-ws' => 'http://10.22.0.113/wssConsultaDocPeru/consultaDocumentosPeru.asmx?wsdl'*/
    ],
    'google_analytics'=>[
        'key'=>'UA-76045364-1',
        'enable'=>false
    ]
];
