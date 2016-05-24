<?php

namespace Epass\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Session\Container;

/**
 * Description of UerPlansController
 *
 * @author ronald
 */
class UserPlansController extends AbstractRestfulController
{

    //put your code here
    public function getList()
    {


        $query = array();
        $auth = $this->getServiceLocator()->get('AuthService');
        if (!$auth->hasIdentity()) {
            return new JsonModel($query);
        }
        $data = array('STATUS' => false);
        parse_str($_SERVER['QUERY_STRING'], $query);

        if (isset($query['save'])) {
            $this->_cambiarCuenta($query['account_id']);
            $data = array('STATUS' => true);
        }
        if (isset($query['recarga'])) {
            if ($query['recarga']) {
                $sessionAfiliate = new Container('afiliacion');
                $sessionAfiliate->saldoUso = $query['saldoUso'];

                $sessionAfiliate->tasaRecarga = $query['tasaRecarga'];
                $sessionAfiliate->costoTag = $query['costoTag'];
                $sessionAfiliate->costoPromocionalTag = $query['costoPromocionalTag'];
                $sessionAfiliate->costoTotal = $query['costoTotal'];

                $data = array('STATUS' => true,
                    'total' => $query['costoTotal']
                );
            }
        }
        $response = $this->getResponseWithHeader()
                ->setContent(json_encode($data, JSON_UNESCAPED_UNICODE));
        return $response;

    }

    public function getResponseWithHeader()
    {
        $response = $this->getResponse();
        $response->getHeaders()
                //->addHeaderLine('Access-Control-Allow-Origin','*')
                //->addHeaderLine('Access-Control-Allow-Methods','POST PUT DELETE GET')
                ->addHeaderLine('Access-Control-Allow-Methods', 'GET')
                ->addHeaders(array('Content-Type' => 'application/json;charset=UTF-8'));
        return $response;

    }

    public function cambiarCuentaAction()
    {
        $account_id = $this->get('account_id');
        $this->_cambiarCuenta($account_id);

    }

    private function _cambiarCuenta($account_id)
    {
        $auth = $this->getServiceLocator()->get('AuthService');
        $user_plans = $this->getServiceLocator()->get('UserPlansModel');
        
        $plan = $user_plans->getByAccount($account_id);
        
        $data_sesion_user = $auth->getStorage()->read();
        $data_sesion_user->plan = $plan;
        $data_sesion_user->idPlan = $plan['plan_id'];
        $data_sesion_user->account_id = $plan['account_id'];
        $data_sesion_user->planTitle = \Application\Service\CuentaService::getPlanTitle($plan['plan_name']);
    }

}
