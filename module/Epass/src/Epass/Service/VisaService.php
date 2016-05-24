<?php

namespace Epass\Service;

use Zend\Soap\Client;

/**
 * Clase para la pasarela de pago VISANET
 */
class VisaService
{

  protected $config;
  protected $fields = array(
  "respuesta","estado","cod_tienda","nordent","cod_accion","pan","nombre_th",
  "ori_tarjeta","nom_emisor","eci","dsc_eci","cod_autoriza","cod_rescvv2",
  "id_unico","imp_autorizado","fechayhora_tx","fechayhora_deposito",
  "fechayhora_devolucion","dato_comercio"
  );
  protected $errors;

  function __construct($config)
  {
    $this->config=$config;
  }

  public function generateEticket($numPedido,$monto)
  {
    try {
      $client = new Client($this->config['eticket'],$this->config['options']);
      $monto=str_replace(',','',$monto);
      $monto=number_format((double)$monto,2,'.','');
      $xmlIn = "";
      $xmlIn = $xmlIn . "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
      $xmlIn = $xmlIn . "<nuevo_eticket>";
      $xmlIn = $xmlIn . "	<parametros>";
      $xmlIn = $xmlIn . "		<parametro id=\"CANAL\">3</parametro>";
      $xmlIn = $xmlIn . "		<parametro id=\"PRODUCTO\">1</parametro>";
      $xmlIn = $xmlIn . "		<parametro id=\"CODTIENDA\">{$this->config['keyCommerce']}</parametro>";
      $xmlIn = $xmlIn . "		<parametro id=\"NUMORDEN\">{$numPedido}</parametro>";
      $xmlIn = $xmlIn . "		<parametro id=\"MOUNT\">{$monto}</parametro>";
      $xmlIn = $xmlIn . "	</parametros>";
      $xmlIn = $xmlIn . "</nuevo_eticket>";
      $params = array('xmlIn'=>$xmlIn);

      $result = $client->GeneraEticket($params);
      flog('Result Eticket',$result);
      $rpta = $this->eticketProcess($result);
      return $rpta;
    } catch (\SoapFault $e) {
      $rpta = ['code'=>$e->getCode(),'message'=>$e->getMessage()];
      return $rpta;
    }
  }

  public function eticketProcess($eticket)
  {
    $rpta = ['code'=>200,'eticket'=>$eticket,'message'=>''];
    $xmlDocument = new \DOMDocument();
    if ($xmlDocument->loadXML($eticket->GeneraEticketResult)){
      $numMessages= $this->getMessageNumber($xmlDocument);
      if ($numMessages > 0){
        $error='';
        for($i=0;$i < $numMessages; $i++){
          $error.='Mensaje #'.($i +1).': '.$this->getMessage($xmlDocument, $i+1).PHP_EOL;
        }
        $rpta = array_merge($rpta,['code'=>204,'message'=>$error]);
      }
      $rpta['eticket'] = $this->getEticket($xmlDocument);
      return $rpta;

    }else{
      throw new \Exception("Error cargando Xml",1);
    }
  }

  public function getAction()
  {
    return $this->config['formulario'];
  }

  public function setErrors($errors)
  {
    $this->errors=$errors;
  }

  public function getMessageNumber($xmlDoc)
  {
    $xpath = new \DOMXPath($xmlDoc);
    $nodeList = $xpath->query('//mensajes', $xmlDoc);
    $XmlNode= $nodeList->item(0);

    if($XmlNode==null)
      return 0;

    return $XmlNode->childNodes->length;
  }

  //Funcion que recupera el valor de uno de los mensajes XML de respuesta
	public function getMessage($xmlDoc,$iNumMensaje)
  {
		$xpath = new \DOMXPath($xmlDoc);
		$nodeList = $xpath->query("//mensajes/mensaje[@id='{$iNumMensaje}']");
		$XmlNode= $nodeList->item(0);

		if($XmlNode==null)
			return "";

		return $XmlNode->nodeValue;
	}

  //Funcion que recupera el valor del Eticket
  public function getEticket($xmlDoc)
  {
    $strReturn = "";
    $xpath = new \DOMXPath($xmlDoc);
    $nodeList = $xpath->query("//registro/campo[@id='ETICKET']");
    $XmlNode= $nodeList->item(0);

    if($XmlNode==null){
      $strReturn = "";
    }else{
      $strReturn = $XmlNode->nodeValue;
    }
    return $strReturn;
  }

  //Funcion de ejemplo que obtiene la cantidad de operaciones
  public function getOperationNumber($xmlDoc, $eTicket)
  {

    $xpath = new \DOMXPath($xmlDoc);
    $nodeList = $xpath->query('//pedido[@eticket="' . $eTicket . '"]', $xmlDoc);

    $XmlNode= $nodeList->item(0);

    if($XmlNode==null)
      return 0;

    return $XmlNode->childNodes->length;;
  }

  //Funcion que recupera el valor de uno de los campos del XML de respuesta
  public function getField($xmlDoc,$numOperation,$nameField)
  {

      $xpath = new \DOMXPath($xmlDoc);
      $nodeList = $xpath->query("//operacion[@id='{$numOperation}']/campo[@id='{$nameField}']");

      $XmlNode= $nodeList->item(0);

      if($XmlNode==null)
        return "";

      return $XmlNode->nodeValue;
  }

  //Funcion que muestra en pantalla los parଥtros de cada operacion
  //asociada al Nro. de pedido consultado
  public function getResponse($xmlDoc, $numOperation)
  {
      $values=array();

      foreach ($this->fields as $field) {
        $values[$field]=$this->getField($xmlDoc,$numOperation,$field);
      }

      return $values;
  }

  public function processResponce($eticket)
  {
    $rpta = ['code'=>200,'transactions'=>array(),'message'=>''];
    $options=$this->config['options'];
    $numOperation =0;
    $numMessages = 0;
    //Se arma el XML de requerimiento
    $xmlIn = "";
    $xmlIn = $xmlIn . "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
    $xmlIn = $xmlIn . "<consulta_eticket>";
    $xmlIn = $xmlIn . "	<parametros>";
    $xmlIn = $xmlIn . "		<parametro id=\"CODTIENDA\">{$this->config['keyCommerce']}</parametro>";
    $xmlIn = $xmlIn . "		<parametro id=\"ETICKET\">{$eticket}</parametro>";
    $xmlIn = $xmlIn . "	</parametros>";
    $xmlIn = $xmlIn . "</consulta_eticket>";

    //Se asigna la url del servicio
    $servicio= $this->config['consulta'];

    //Se habilita el parametro PROXY_ON en el archivo "lib.inc" si se maneja algun proxy para realizar conexiones externas.
    if($this->config['proxy_on'] == true){
      $options=array_merge($this->config['options'],$this->config['proxy']);
    }

    $client = new Client($servicio,$options);

    //parametros de la llamada
    $parametros['xmlIn']= $xmlIn;
    //Aqui captura la cadena de resultado
    $result = $client->ConsultaEticket($parametros);

    //Aqui carga la cadena resultado en un XMLDocument (DOMDocument)
    $xmlDocument = new \DOMDocument();
    if ($xmlDocument->loadXML($result->ConsultaEticketResult)) {

      //Ejemplo para determinar la cantidad de operaciones
      //asociadas al Nro. de pedido

      $numOperation= $this->getOperationNumber($xmlDocument, $eticket);

      //Ejemplo para mostrar los parametros de las operaciones
      //asociadas al Nro. de pedido
      if($numOperation > 0){
        //for($i=0;$i < $numOperation; $i++){
          $transactions=$this->getResponse($xmlDocument, $numOperation);
          if($transactions['respuesta']=="2"){
            $rpta['code']=$transactions['cod_accion'];
            $rpta['message']=isset($this->errors[$transactions['cod_accion']])?$this->errors[$transactions['cod_accion']]:'Por favor, intente nuevamente realizar el pago.';
          }
        //}
        $rpta['transactions']=$transactions;
      }


      //Ejemplo para determinar la cantidad de mensajes
      //asociadas al Nro. de pedido
      $numMessages = $this->getMessageNumber($xmlDocument);

      //Ejemplo para mostrar los mensajes de las operaciones
      //asociadas al Nro. de pedido
      if($numMessages > 0){
        $error='';
        for($j=0;$j < $numMessages; $j++){
          $error.='Mensaje #'.($j +1).': '.$this->getMessage($xmlDocument, $j+1).PHP_EOL;
        }
        $rpta = array_merge($rpta,['code'=>204,'message'=>$error]);
      }

      return $rpta;

    }else{
      throw new \Exception("Error cargando Xml",1);
    }
  }

}
