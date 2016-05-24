<?php

namespace Epass\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class VehicleController extends AbstractRestfulController
{
    public function options()
    {
        $response = $this->getResponse();
        $response->getHeaders()
        ->addHeaderLine('Allow', implode(',', array('POST'/*,'DELETE','GET','PUT'*/)));
        return $response;
    }
    public function create($datos)
    {
        $vehiclesModel = $this->getServiceLocator()->get('VehiclesModel');
        $datos['type'] = $datos['type']['CLASS'];
        $datos['brand'] = $datos['brand']['INDEX'];
        $datos['model'] = $datos['model']['INDEX'];
        $vehicles = $vehiclesModel->saveVehicle($datos);
        return new JsonModel(array(
            'vehicle_id' => $vehicles,
        ));
    }
    public function getResponseWithHeader()
    {
        $response = $this->getResponse();
        $response->getHeaders()
                ->addHeaderLine('Access-Control-Allow-Origin', '*')
                ->addHeaderLine('Access-Control-Allow-Methods','POST')
                ->addHeaders(array('Content-Type' => 'application/json;charset=UTF-8'));
        return $response;

    }

}
