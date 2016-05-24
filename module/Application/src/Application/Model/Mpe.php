<?php

namespace Application\Model;

use Zend\Soap\Client;

Class Mpe{

  protected $client;

  public function __construct(){
    $client = new Client("http://testcrm.epass.pe/axis2/services/TDLTollSys_WebCRM.wsdl",array('encoding' => 'UTF-8'));
    $client->setLocation('http://testcrm.epass.pe/axis2/services/TDLTollSys_WebCRM');

    $this->client = $client;
    return $this;
  }

  public function sendData($functionName,array $paramsVehicle){
    $params = new \stdClass();
    foreach ($paramsVehicle as $key => $value) {
      $params->{$key}=$value;
    }

    $result = $this->client->{$functionName}($params);
    return $result;
  }


}
