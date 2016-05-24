<?php

namespace Cron\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class VisaController extends AbstractActionController
{        
    public function updateStatusAction()
    {     
        echo "hola, soy un cron" . PHP_EOL; 

        $t = $this->getServiceLocator()->get('TransactionsModel');
        $transactions = $t->getTransactionByStatus(1);

        echo "Total Transacciones: " . count($transactions) . PHP_EOL;
        foreach ($transactions as $key => $tran) {
            echo $tran['external_id'] . PHP_EOL;
            
            //consultar WS
            $visaService = $this->getServiceLocator()->get('Epass\Service\VisaService');
            $response = $visaService->processResponce($tran['external_id']);

            //echo "---> " . $response['code'] . PHP_EOL;
            //var_dump($response); //die();
            
            //actualizar estado
            if($response['code'] == 200){
                //pago correcto status 3
                $status = 3;
                $pay_day = $this->dateMysqlFormat($response['transactions']['fechayhora_tx']);

                $datosTransaction = array(
                    'id' => intval($response['transactions']['nordent']),
                    'card_number' => $response['transactions']['pan'],
                    'responce_code' => $response['transactions']['cod_accion'],
                    'status' => $status,
                    'respuesta' => json_encode($response['transactions']),
                    'pay_day' => $pay_day,
                    'updated_at' => date('Y-m-d H:i:s')
                );
            }else{
                $status = 4;                

                $datosTransaction = array(
                    'id' => $tran['id'],
                    'status' => $status,
                    'updated_at' => date('Y-m-d H:i:s')
                );
            }
            
            $idTransaction = $t->save($datosTransaction);
            $datosProceso = $t->getDataByOperation($idTransaction);            
            $TipoOperacion = $datosProceso['transaccion'];
            if($status == 3){
                if ($TipoOperacion == 2){
                    $this->_soloRecarga($idTransaction);
                    echo " -Recarga: ".$idTransaction.PHP_EOL;
                }else{
                    //guardar MPE
                    $idAccount = $this->_crearUsuarioMPE($idTransaction);
                    
                    if ($idAccount) {
                        echo " -Usuario MPE: ".$idTransaction.PHP_EOL;

                        $cPlan = $this->_crearPlanMPE($idTransaction);
                        if ($cPlan) {
                            echo " -Plan MPE: ".$idTransaction.PHP_EOL;

                            $vehicles = $this->_crearVehiclesMPE($idTransaction);
                        }
                    }
                }
            }
        }
    }

    protected function _crearUsuarioMPE($idTransaction)
    {
        $mpe = $this->getServiceLocator()->get('mpe');
        $t = $this->getServiceLocator()->get('TransactionsModel');
        $params=$t->getDataCrearUsuarioMPE($idTransaction);

        $idUser=$params['user_id'];
        $idUserPlan=$params['user_plan_id'];
        unset($params['user_id']);
        unset($params['user_plan_id']);
        
        $rq = $mpe->requestAccountCreation($params);
        //$this->log(array("proceso" => "rpta_params_create_account",'data'=>$params, "rpta" => $rq));
        if ($rq->status === 'ok') {
            //actualizar users
            $usersModel = $this->getServiceLocator()->get('UsersModel');
            $data = [
                'id' => $idUser,
                'migrate' => 1
            ];
            $users = $usersModel->saveUser($data);
            //actualizar user_plan
            $userPlansModel = $this->getServiceLocator()->get('UserPlansModel');
            $data = [
                'id' => $idUserPlan,
                'account_id' => $rq->data->AccountId
            ];
            $idUserPlan = $userPlansModel->saveUserPlans($data);
            $account = $this->getServiceLocator()->get('WebServicesCollection');
            $datos = [
                'Services' => 'requestAccountCreation',
                'idUser' => $idUser,
                'data' => $data,
                'status' => $rq,
                'message' => $rq->message,
            ];
            $account->saveWebServicesLog($datos);
            return $rq->data->AccountId;
        } else {
            
            $account = $this->getServiceLocator()->get('WebServicesCollection');
            $datos = [
                'Services' => 'requestAccountCreation',
                'idUser' => $idUser,
                'data' => $params,
                'status' => $rq->status,
                'message' => $rq->message,
            ];
            $account->saveWebServicesLog($datos);
            return false;
        }
    }

    protected function _crearPlanMPE($idTransaction)
    {        
        $mpe = $this->getServiceLocator()->get('mpe');
        $t = $this->getServiceLocator()->get('TransactionsModel');
        $params=$t->getDatacrearPlanMPE($idTransaction);
        $accountId=$params['req_AccountId'];
        $idPlan=$params['req_PlanId'];
        $idUserPlan=$params['user_plan_id'];
        unset($params['user_plan_id']);
        
        $rq = $mpe->subscribePlan($params);
        //$this->log(array("proceso" => "params_crear_plan_mpe","data"=>$params ,"rpta" => $rq));
        if ($rq->status === 'ok') {
            //actualizar user_plan
            $userPlansModel = $this->getServiceLocator()->get('UserPlansModel');
            $data = [
                'id' => $idUserPlan,
                'migrate' => 1
            ];
            $userPlansModel->saveUserPlans($data);
            return $this->_crearPromotionMPE($accountId, $idUserPlan,$idPlan);
        } else {
            //guardar en la collection de errores
            $account = $this->getServiceLocator()->get('WebServicesCollection');
            $datos = [
                'Services' => 'subscribePlan',
                'idUserPlan' => $idUserPlan,
                'data' => $params,
                'status' => $rq->status,
                'message' => $rq->message,
            ];
            $account->saveWebServicesLog($datos);
            return false;
        }
    }

    protected function _crearVehiclesMPE($idTransaction)
    {        
        $t = $this->getServiceLocator()->get('TransactionsModel');
        $mpe = $this->getServiceLocator()->get('mpe');
        $vehicles = $t->getDataCreateVehicle($idTransaction);
        
        $cont = 0;
        foreach ($vehicles as $vehicle) {
            if (is_numeric($vehicle['idVehicle'])) {
                $rq = $mpe->addVehicle($vehicle);
                //$this->log(array("proceso" => "crear vehicles MPE", "data" => $vehicles,'actual'=>$vehicle,'rpta'=>$rq));
                if ($rq->status === 'ok') {
                    $vehiclesModel = $this->getServiceLocator()->get('VehiclesModel');
                    $data = [
                        'id' => $vehicle['idVehicle'],
                        'migrate' => 1
                    ];
                    $vehiclesModel->saveVehicle($data);
                } else {
                    //guardar en la collection de errores
                    $account = $this->getServiceLocator()->get('WebServicesCollection');
                    $datos = [
                        'Services' => 'addVehicle',
                        'data' => $vehicle,
                        'status' => $rq->status,
                        'message' => $rq->message,
                    ];
                    $account->saveWebServicesLog($datos);
                    return false;
                }
            } else {
                //$this->log(array('is_numeric_vehicle_id' => 'no es numerico'));
            }
            $cont++;
        }
    }

    protected function _crearPromotionMPE($accountId, $idUserPlan,$idPlan)
    {
        
        $mpe = $this->getServiceLocator()->get('mpe');
        $params = array(
            'req_ProductId' => 1,
            'req_PlanId' => (int)$idPlan
        );
        $rq = $mpe->getAllPromotionsByPlanByProduct($params);
        //$this->log(array("proceso" => "params_Promo_mpe","data" => $params,'rpta'=>$rq));
        if ($rq->status === 'ok') {
            $promo = $rq->data->allPromotionsByPlanByProductDefinition;

            foreach ($promo as $value) {
                $paramsPromotion = array(
                    'req_AccountId' => $accountId,
                    'req_PromotionId' => $value->req_PromotionId
                );
                //$this->log(array("proceso" => "paramsPromotion", "data" => $paramsPromotion));
                $mpe->subscribePromotion($paramsPromotion);
            }
            return true;
        } else {
            //guardar en la collection de errores
            $account = $this->getServiceLocator()->get('WebServicesCollection');
            $datos = [
                'Services' => 'getAllPromotionsByPlanByProduct',
                'idUserPlan' => $idUserPlan,
                'data' => $params,
                'status' => $rq->status,
                'message' => $rq->message,
            ];
            $account->saveWebServicesLog($datos);
            return false;
        }

    }

    protected function _soloRecarga($idTransaction)
    {
        try {
            $t = $this->getServiceLocator()->get('TransactionsModel');
            $datosUser = $t->getDataByRecarga($idTransaction);
            $migrado= $t->getMigrateById($idTransaction);
            
            if(!$migrado){
                $mpe = $this->getServiceLocator()->get('mpe');
                $datosEstaticos = array('req_Source' => 'portal-web');
                $datosws = array_merge($datosUser, $datosEstaticos);
                
                //$this->log(array("proceso" => 'soloRecarga', "datos" => $datosws));
                /* ============================= */
                if (!empty($datosUser['req_AccountId'])) {
                    $rpta = $mpe->rechargePrepayAccount($datosws);
                    if ($rpta->status == 'ok') {
                        $data = array('id' => $idTransaction, 'migrate' => 1);
                        $t->save($data);
                    }
                }
                $mpe->RemoveCacheGetSaldoByAccount($datosUser['req_AccountId']);

                $mpe->RemoveCacheMovementsByAccount($datosUser['req_AccountId']);
                return true;
            }
            return true;
        } catch (\Exception $e) {
            //continue;
        }

    }

    public function dateMysqlFormat($moment)
    {
        $datos = explode(' ', $moment);
        $fecha = explode('/', $datos[0]);
        $time = explode(':', $datos[1]);
        $meridiano = $datos[2];
        $timestamp = mktime($time[0], $time[1], 0, $fecha[1], $fecha[0],
                $fecha[2]);
        return date('Y-m-d H:i:s', $timestamp);

    }
       
}