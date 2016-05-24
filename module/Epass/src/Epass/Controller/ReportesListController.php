<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Epass\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

/**
 * Description of ReportesController
 *
 * @author ronald
 */
class ReportesListController extends AbstractRestfulController
{

    //put your code here
    public function getList()
    {
        $query = array();
        $auth = $this->getServiceLocator()->get('AuthService');
        if (!$auth->hasIdentity()) {
            return new JsonModel($query);
        }
        parse_str($_SERVER['QUERY_STRING'], $query);

        $data_sesion_user = $auth->getStorage()->read();
        $user_plans = $this->getServiceLocator()->get('UserPlansModel');
        $data_users_plans = $user_plans->getPlansbyUser($data_sesion_user->id);
        $req_EndDate = date("Ymd");
        $req_StartDate = date("Ymd",
                strtotime('-1 months', strtotime($req_EndDate)));
        $mpe = $this->getServiceLocator()->get('mpe');
        $reportesMovimiento = array();
        if (isset($query["periodo"])) {
            $req_StartDate = $query["periodo"];
        }
        foreach ($data_users_plans as $key => $value) {
            $movimiento = $this->Movimientos($mpe->getMovementsByAccount(
                            array(
                                'req_AccountId' => $value["account_id"],
                                'req_StartDate' => $req_StartDate,
                                'req_EndDate' => $req_EndDate,
            )));
            foreach ($movimiento as $k => $v) {
                if (isset($query["tipo"])) {
                    $tipo=\Application\Form\Reportes::$_tipo;
                    var_dump($v["req_PaymentType"],$tipo);
                    if (isset(\Application\Form\Reportes::$_tipo[$v["req_PaymentType"]])) {
                        $movimiento[$k] = $v;
                    } else {
                        unset($movimiento[$k]);
                    }
                }
            }exit;
            $reportesMovimiento[] = $movimiento;
        }
        $response = $this->getResponseWithHeader()
                ->setContent(json_encode($reportesMovimiento,
                        JSON_UNESCAPED_UNICODE));
        return $response;

    }

    private function Movimientos($datos)
    {
        $result = array();
        $dataSoap = isset($datos->data->movementsByAccountDefinition) ? $datos->data->movementsByAccountDefinition : array();
        foreach ($dataSoap as $key => $value) {
            $ano = substr($value->req_Time, 0, 4);
            $mes = substr($value->req_Time, 4, 2);
            $dia = substr($value->req_Time, 6, 2);
            $h = substr($value->req_Time, 8, 2);
            $m = substr($value->req_Time, 10, 2);
            $s = substr($value->req_Time, 12, 2);
            $value->datetime = "$ano-$mes-$dia $h:$m:$s";
            $value->date = "$dia/$mes/$ano";

            $value->tipo = isset(\Application\Form\Reportes::$_tipoSelect[$value->req_PaymentType]) ? \Application\Form\Reportes::$_tipoSelect[$value->req_PaymentType] : '';
            $result[] = (array) $value;
        }
        return $result;

    }

    public function getResponseWithHeader()
    {
        $response = $this->getResponse();
        $response->getHeaders()
                ->addHeaderLine('Access-Control-Allow-Origin', '*')
                //->addHeaderLine('Access-Control-Allow-Methods','POST PUT DELETE GET')
                ->addHeaderLine('Access-Control-Allow-Methods', 'GET')
                ->addHeaders(array('Content-Type' => 'application/json;charset=UTF-8'));
        return $response;

    }

}
