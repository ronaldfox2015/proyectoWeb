<?php

namespace Epass\Service;

/**
 *
 */
class McService
{

  protected $config;
  protected $pasarela;
  protected $errors;

  function __construct($pasarela,$config)
  {
      $this->pasarela = $pasarela;
      $this->config = $config;
  }

  public function getDataForHash($numOrd,$monto)
  {
    $datos[] = $this->config['Comercio']; //Comercio
    $datos[] = $this->formatNumOrden($numOrd); //NroOrden
    $datos[] = $monto; //Monto
    $datos[] = $this->config['Moneda']; //Moneda
    $datos[] = date($this->config['Fecha']); //FechaTxn
    $datos[] = date($this->config['Hora']); //HoraTxn
    $datos[] = substr(md5(time()),0,11); //Aleatorio
    $datos[] = $this->config['codCliente']; //CodCliente
    $datos[] = $this->config['Pais']; //CodPais
    $datos[] = $this->config['KeyMerchant']; //KeyMerchant(32 BYTES)
    flog('Get data for hash MC',$datos);
    return $datos;
  }
  
  public function formatNumOrden($numOrd)
  {
      $largoMinimo=5;
      $largoActual=strlen($numOrd);
      if($largoActual>=$largoMinimo){
          return $numOrd;
      }
      
      $cadena = '';
      $faltante = $largoMinimo-$largoActual;
      for($i=0;$i<$faltante;$i++){
          $cadena.='0';
      }
      
      return $cadena.$numOrd;
  }

  public function getDataForm($values,$hash)
  {
    if(!empty($values)){
      array_pop($values);
      $values[]=$hash;
      $cont=1;
      foreach ($values as $value) {
        $datos["I{$cont}"]=$value;
        $cont++;
      }

      return $datos;
    }

    return [];
  }



  public function getHash($values, $hex = false) {
    $key = $this->config['KeyMerchant'];
    $data = implode("",$values);

    $blocksize=64;
    $hashfunc='sha1';
    if (strlen($key)>$blocksize)
    $key=pack('H*', $hashfunc($key));
    $key=str_pad($key,$blocksize,chr(0x00));
    $ipad=str_repeat(chr(0x36),$blocksize);
    $opad=str_repeat(chr(0x5c),$blocksize);
    $hmac = pack('H*',$hashfunc(($key^$opad).pack('H*',$hashfunc(($key^$ipad).$data))));
    if ($hex == false) {
       return urlencode(base64_encode($hmac));
    }else{
       return urlencode(base64_encode(bin2hex($hmac)));
    }
  }

  public function getAction()
  {
    return $this->config['action'];
  }

  public function processResponse($data)
  {
    $rpta = ['code'=>200,'transactions'=>array(),'message'=>''];
    $rpta['transactions']=$data;
    if($data['O1']=='A'){
      $mensaje='El pago se realiz&oacute; de manera correcta, en breve se
      le estar&aacute; enviando un email con los detalles de la operaci&oacute;n.';
      $rpta['transactions']['status']=3;
    }else{
      $rpta['code']=$data['O13'];
      $rpta['mensaje']=isset($this->errors[$data['O13']])?$this->errors[$data['O13']]:'Por favor, intente nuevamente realizar el pago.';
      $rpta['transactions']['status']=4;
    }

    return $rpta;
  }

  public function setErrors($errors)
  {
    $this->errors=$errors;
  }
}
