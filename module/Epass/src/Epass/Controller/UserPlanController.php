<?php

namespace Epass\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class UserPlanController extends AbstractRestfulController
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
        $userPlansModel = $this->getServiceLocator()->get('UserPlansModel');
        if(isset($datos['district']))
        {        
            $datos['department_id'] = 15;
            $datos['province_id'] = 128;
            $datos['district_id'] = $datos['district']['INDEX'];
            unset($datos['district']);
        }
        $idUserPlan = $userPlansModel->saveUserPlans($datos);
        return new JsonModel(array(
            'user_plan_id' => $idUserPlan,
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
