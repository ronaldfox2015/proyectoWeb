<?php
return [
  'visa'=> [
    'eticket'=>'http://qas.multimerchantvisanet.com/WSGenerarEticket/WSEticket.asmx?wsdl',
    'formulario'=>'http://qas.multimerchantvisanet.com/formularioweb/formulariopago.asp',
    'consulta'=>'http://qas.multimerchantvisanet.com/WSConsulta/WSConsultaEticket.asmx?wsdl',
    'keyCommerce'=>'515678501',
    'options'=>[
      'encoding' => 'UTF-8'
    ],
    'proxy_on'=>false,
    'proxy'=>[
      'proxy_host'     => 'host',
      'proxy_port'     => 'port',
      'proxy_login'    => 'user',
      'proxy_password' => 'pass'
    ]
  ],
  'master'=>[
    'action'=>'https://server.punto-web.com/gateway/PagoWebHd.asp',
    'KeyMerchant'=>'druphEJUs6EJapAfruQachaSpecubusp',
    'Comercio'=>'8004617',
    'Moneda'=>'PEN',
    'Pais'=>'PER',
    'Fecha'=>'Ymd',
    'Hora'=>'His',
    'codCliente'=>'REG002',
    'tarjeta'=>'MC'
  ],
  'amex'=>[
    'action'=>'https://server.punto-web.com/gateway/PagoWebAm.asp',
    'KeyMerchant'=>'druphEJUs6EJapAfruQachaSpecubusp',
    'Comercio'=>'8004617',
    'Moneda'=>'PEN',
    'Pais'=>'PER',
    'Fecha'=>'Ymd',
    'Hora'=>'His',
    'codCliente'=>'REG001',
  ],
  'dinners'=>[
    'action'=>'https://server.punto-web.com/gateway/PagoWebDn.asp',
    'KeyMerchant'=>'druphEJUs6EJapAfruQachaSpecubusp',
    'Comercio'=>'8004617',
    'Moneda'=>'PEN',
    'Pais'=>'PER',
    'Fecha'=>'Ymd',
    'Hora'=>'His',
    'codCliente'=>'REG002',
  ]
];
