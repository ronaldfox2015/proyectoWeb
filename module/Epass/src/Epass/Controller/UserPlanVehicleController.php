<?php

namespace Epass\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class UserPlanVehicleController extends AbstractRestfulController
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
        $UserPlanVehicleModel = $this->getServiceLocator()->get('UserPlanVehicleModel');
        $UserPlanVehicleModel->saveUserPlanVehicle($datos);
        return new JsonModel(array(
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
