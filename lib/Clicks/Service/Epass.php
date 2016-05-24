<?php

namespace Clicks\Service;

use Clicks\Service\SoapGeneric;

class Epass extends SoapGeneric
{
    protected $options = array();

	public function __construct($options = array())
	{
        $this->options = array_merge($this->options, $options['epass']);
	}

	//guarda usuario
	public function requestAccountCreation($data)
	{
		try {

			$result = $this->loadService("requestAccountCreation", $data);
			var_dump($result);

        } catch (\Exception $exc) {
        	echo $exc->getMessage();
		    }
	}

	//Suscribe plan
	public function subscribePlan($data){}

	//agregar vehiculo
	public function addVehicle($data){}

	//Suscribe promoción
	public function subscribePromotion($data){}

	//Adjuntar archivo
	public function attachDocumentToAccount($data){}

	//agregar usuario autorizado
	public function addAuthPers($data){}

	//afiliación de recarga automatica
	public function autoRechargeAffiliation($data){}

	//recarga prepago
	public function rechargePrepayAccount($data){}

	//recarga prepago
	public function rechargePrepayAndRequestTagAccount($data){}

}
