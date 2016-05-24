<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Zend\Session\Container,
    Zend\View\Model\JsonModel;

/**
 *
 */
class PasarelaController extends AbstractActionController
{

    protected $messageError = 'En estos momentos el portal de pagos no se encuentran en servicio, inténtalo mas tarde';

    public function indexAction()
    {
        return new ViewModel();

    }

    public function generateAction()
    {
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            $sessionAfiliate = new Container('afiliacion');
            $sessionAfiliate->req_ReceiptType = 'B';
            $sessionAfiliate->req_BillingDocNumber = $sessionAfiliate->txtNumDocumento;
            $nombre = empty($sessionAfiliate->txtNombreTitular) ? '' : $sessionAfiliate->txtNombreTitular;
            $apellido = empty($sessionAfiliate->txtApellidosTitular) ? '' : $sessionAfiliate->txtApellidosTitular;
            $sessionAfiliate->req_BillingDesignation = $nombre . ' ' . $apellido;

            if (!isset($sessionAfiliate->recarga)) {
                $receiptType = strtoupper(substr($data['medio_de_pago_dash'], 0,
                                1));
                $sessionAfiliate->req_ReceiptType = $receiptType;
                if ($receiptType == 'F') {
                    $sessionAfiliate->req_BillingDocNumber = $data['comp_ruc'];
                    $sessionAfiliate->req_BillingDesignation = $data['comp_raz_soc'];
                }
                $this->registerTotal();
            }
            
            if (isset($sessionAfiliate->flagUserCorporativo)) {
                if ($sessionAfiliate->flagUserCorporativo == true) {
                    $sessionAfiliate->document_number = $sessionAfiliate->txtNumDocumentoC;
                    $sessionAfiliate->tipo_doc = 'factura';
                    $sessionAfiliate->razon_social = $sessionAfiliate->txtRazonSocialC;
                }
            }
            
            if (isset($data['medio_de_pago']) && !empty($data['medio_de_pago'])) {
                $this->layout()->pago = true;
                switch ($data['medio_de_pago']) {
                    case 'visa':
                        $datos = $this->processTransaction(1);
                        $response = $this->processVisa($datos);
                        break;
                    case 'master':
                        $datos = $this->processTransaction(2);
                        $response = $this->processMaster($datos);
                        break;
                    case 'amex':
                        $datos = $this->processTransaction(3);
                        $response = $this->processAmex($datos);
                        break;
                    case 'diners':
                        $datos = $this->processTransaction(4);
                        $response = $this->processDiners($datos);
                        break;
                    default:
                        $this->flashMessenger()->addErrorMessage('no existe el medio de pago seleccionado');
                        $this->redirect()->toUrl("/");
                        break;
                }
                //$sessionAfiliate->getManager()->getStorage()->clear('afiliacion');
                return new ViewModel(array('campos' => $response['fields'], 'action' => $response['action']));
            }
        }

        $this->redirect()->toUrl("/");

    }

    protected function processTransaction($paymentMethod)
    {
        $dbAdapter = $this->getServiceLocator()->get('adapter');
        $db = $dbAdapter->getDriver()->getConnection();
        $sessionAfiliate = new Container('afiliacion');

        $db->beginTransaction();
        try {//afiliacion
            $this->saldoUso = $sessionAfiliate->offsetGet('saldoUso');
            $tasaRecarga = $sessionAfiliate->offsetGet('tasaRecarga');
            $costoTag = number_format($sessionAfiliate->offsetGet('costoTag'), 2);
            $costoPromocionalTag = number_format($sessionAfiliate->offsetGet('costoPromocionalTag'),
                    2);
            $costoTagFinal = ($costoPromocionalTag > 0) ? $costoPromocionalTag : $costoTag;
            $costoTotal = $sessionAfiliate->offsetGet('costoTotal');
            $idPlan = $sessionAfiliate->offsetGet('idPlan');
            $title = $sessionAfiliate->offsetGet('title');
            $idUserPlan = $sessionAfiliate->offsetGet('idUserPlan');
            $idUser = $sessionAfiliate->offsetGet('idUser');
            $TipoOperacion = $sessionAfiliate->offsetGet('flagTipoAfiliacion');
            $numVehicles = $sessionAfiliate->offsetGet('numVehicles');
            $document_number = $sessionAfiliate->offsetGet('document_number');
            $tipo_doc = $sessionAfiliate->offsetGet('tipo_doc');
            $razon_social = $sessionAfiliate->offsetGet('razon_social');
            $costoTotal = str_replace(',', "", $costoTotal);
            $urlFail = $sessionAfiliate->offsetGet('urlFail');

            $saldoUso = $costoTotal - $costoTagFinal;
             /*$datosLog=array('params_process_transaction'=>array('tasaRecarga'=>$tasaRecarga,'costoTag'=>$costoTag,
              'costoPromocionalTag'=>$costoPromocionalTag,'costoTagFinal'=>$costoTagFinal,
              'costoTotal'=>$costoTotal,'idPlan'=>$idPlan,'title'=>$title,'idUserPlan'=>$idUserPlan,
              'idUser'=>$idUser,'TipoOperacion'=>$TipoOperacion,'numVehicles'=>$numVehicles,
              'document_number'=>$document_number,'tipo_doc'=>$tipo_doc,'razon_social'=>$razon_social,
              'saldoUso'=>$saldoUso));
              flog('datosLog',$datosLog);*/ 

            //recuperamos el idUser,monto,y creamos la transaccion
            $datosDetalle = array('package_id' => $idPlan, 'cost_tag' => $costoTagFinal,
                'recharge_amount' => $saldoUso, 'recharge_rate' => $tasaRecarga,
                'use_balance' => $costoTotal, 'total_vehicles' => $numVehicles);

            //obtenemos la tabla transaction_detail
            $td = $this->getServiceLocator()->get('TransactionDetailModel');
            //guardamos el detalle de la transaccion
            $idDetalle = $td->save($datosDetalle);
            //obtenemos la tabla transactions
            $t = $this->getServiceLocator()->get('TransactionsModel');
            //recuperamos los valores para la transaccion
            $datosTransaction = array(
                'payment_method_id' => $paymentMethod,
                'transaction_type_id' => isset($sessionAfiliate->recarga) ? 2 : 1,
                'user_plan_id' => $idUserPlan,
                'mount' => $costoTotal,
                'status' => 0,
                'transaction_detail_id' => $idDetalle,
                'document_number' => $document_number,
                'tipo_doc' => $tipo_doc,
                'razon_social' => $razon_social,
                'urlFail'=> $urlFail
            );

            //guardamos la transaccion
            $idTransaction = $t->save($datosTransaction);
            
            // eliminamos la variable recarga
            if (isset($sessionAfiliate->recarga))
                unset($sessionAfiliate->recarga);

            $db->commit();
            return array('id' => $idTransaction, 'monto' => $costoTotal);
        } catch (\Exception $e) {
            $db->rollBack();

            if (isset($sessionAfiliate->urlError)) {
                $this->flashMessenger()->addErrorMessage('Error el del sistema de pagos porfavor vuelva a intentarlo');
                $this->redirect()->toUrl($sessionAfiliate->urlError);
            }
            $this->flashMessenger()->addErrorMessage($e->getMessage());
            $this->redirect()->toUrl("/");
        }

    }

    protected function processVisa($datos)
    {
        $sessionAfiliate = new Container('afiliacion');
        try {
            //Obtenemos el servicio para pagos con visa
            $VisaService = $this->getServiceLocator()->get('Epass\Service\VisaService');
            //generamos el eticket
            $generaEticket = $VisaService->generateEticket($datos['id'],
                    $datos['monto']);
            //verificamos si el eticket se genero correctamenta
            if ($generaEticket['code'] != 200) {
                $this->flashMessenger()->addErrorMessage($this->messageError);
                $this->redirect()->toUrl("/");
            }
            $this->setInterId($datos['id'], $generaEticket['eticket']);
            $fields = array('ETICKET' => $generaEticket['eticket']);

            return array('fields' => $fields, 'action' => $VisaService->getAction());
        } catch (\Exception $e) {
            if (isset($sessionAfiliate->urlError)) {
                $this->flashMessenger()->addErrorMessage('Se a producido un problema generando su ticket de visa');
                $this->redirect()->toUrl($sessionAfiliate->urlError);
            }

            $this->flashMessenger()->addErrorMessage('Se a producido un problema generando su ticket de visa');
            $this->redirect()->toUrl("/");
        }

    }

    protected function processMaster($datos)
    {
        $sessionAfiliate = new Container('afiliacion');

        try {
            $service = $this->getServiceLocator()->get('Epass\Service\MasterService');
            $values = $service->getDataForHash($datos['id'], $datos['monto']);
            $hash = $service->getHash($values);
            $fields = $service->getDataForm($values, $hash);
            $this->setInterId($datos['id'], $hash);
            return array('fields' => $fields, 'action' => $service->getAction());
        } catch (\Exception $exc) {
            if (isset($sessionAfiliate->urlError)) {
                $this->flashMessenger()->addErrorMessage('Se a producido un problema generando su ticket de Master Card');
                $this->redirect()->toUrl($sessionAfiliate->urlError);
            }
            $this->flashMessenger()->addErrorMessage('Se a producido un problema generando su ticket de Master Card');
            $this->redirect()->toUrl("/");
        }

    }

    protected function processAmex($datos)
    {
        $sessionAfiliate = new Container('afiliacion');

        try {
            $service = $this->getServiceLocator()->get('Epass\Service\AmexService');

            $values = $service->getDataForHash($datos['id'], $datos['monto']);
            $hash = $service->getHash($values);
            $fields = $service->getDataForm($values, $hash);
            $this->setInterId($datos['id'], $hash);
            return array('fields' => $fields, 'action' => $service->getAction());
        } catch (\Exception $exc) {
            if (isset($sessionAfiliate->urlError)) {
                $this->flashMessenger()->addErrorMessage('Se a producido un problema generando su ticket de American Express');
                $this->redirect()->toUrl($sessionAfiliate->urlError);
            }
            $this->flashMessenger()->addErrorMessage('Se a producido un problema generando su ticket de American Express');
            $this->redirect()->toUrl("/");
        }

    }

    protected function processDiners($datos)
    {
        $sessionAfiliate = new Container('afiliacion');

        try {
            $service = $this->getServiceLocator()->get('Epass\Service\DinnerService');

            $values = $service->getDataForHash($datos['id'], $datos['monto']);
            $hash = $service->getHash($values);
            $fields = $service->getDataForm($values, $hash);
            $this->setInterId($datos['id'], $hash);
            return array('fields' => $fields, 'action' => $service->getAction());
        } catch (\Exception $exc) {
            if (isset($sessionAfiliate->urlError)) {
                $this->flashMessenger()->addErrorMessage('Se a producido un problema generando su ticket de Diners Club.');
                $this->redirect()->toUrl($sessionAfiliate->urlError);
            }
            $this->flashMessenger()->addErrorMessage('Se a producido un problema generando su ticket de Diners Club');
            $this->redirect()->toUrl("/");
        }

    }

    protected function setInterId($id, $code)
    {
        $t = $this->getServiceLocator()->get('TransactionsModel');
        $datosTransaction = array('id' => $id, 'status' => 1, 'external_id' => $code, 'updated_at' => date('Y-m-d H:i:s'));
        $idTransaction = $t->save($datosTransaction);
        return $idTransaction;

    }

    public function visaAction()
    {
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            if (!empty($data) && isset($data['eticket'])) {
                $eticket = $data['eticket'];
                $VisaService = $this->getServiceLocator()->get('Epass\Service\VisaService');
                $response = $VisaService->processResponce($eticket);

                if ($response['code'] == 200) {
                    $mensaje = 'El pago se realiz&oacute; de manera correcta, en breve se
          le estar&aacute; enviando un email con los detalles de la operaci&oacute;n';
                    $status = 3;
                } else {
                    $mensaje = $response['message'];
                    $status = 4;
                }
                //actualizar la transaccion
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

                $t = $this->getServiceLocator()->get('TransactionsModel');
                $idTransaction = $t->save($datosTransaction);
                $datosProceso=$t->getDataByOperation($idTransaction);
                $uriError = $datosProceso['urlFail'];
                $plantilla = $datosProceso['plantilla'];
                $TipoOperacion = $datosProceso['transaccion'];
                $idUserPlan = $datosProceso['idUserPlan'];
                $title = $datosProceso['title'];
                
//                $sessionAfiliate = new Container('afiliacion');
                //$title = $sessionAfiliate->offsetGet('title');
                //$uriError = $sessionAfiliate->offsetGet('urlFail');
                //$newTitle = str_replace(array('-', ' '), '', strtolower($title));
                //$plantilla = ($newTitle != 'prepago') ? 'boletaPago.phtml' : 'boletaEmpresa.phtml';
                
                $asunto = 'Recibo de Pago e-pass';
                //$TipoOperacion = $sessionAfiliate->offsetGet('flagTipoAfiliacion');
                
                $operacion = ($TipoOperacion == 2) ? 'Recarga' : 'Afiliacion';

                $diaPago = substr($response['transactions']['fechayhora_tx'], 0,
                        10);
                $datosPago = array('mensaje' => $mensaje, 'transaccion' => $idTransaction,
                    'day' => $diaPago, 'nombre' => $response['transactions']['nombre_th'],
                    'monto' => $response['transactions']['imp_autorizado'], 'tarjeta' => 'Visa',
                    'plan' => $title, 'operacion' => $operacion);
                $service = $this->getServiceLocator()->get('Popup');
                $service->addParams($datosPago);
                if ($status == 3) {
                    if ($TipoOperacion == 2) {
                        $this->soloRecarga($idTransaction);
                        $redirect = '/mi-cuenta';
                    } else {
                        $regMpe = $this->registroTotalMPE($idTransaction);
                        if ($regMpe) {
                            $this->activarCuenta($idUserPlan);
                            $rpta = $this->sendMessagePago($asunto,
                                    $idTransaction, $plantilla, $datosPago);
                            $this->afiliacionRecarga($idTransaction);
                            $redirect = '/';
                        } else {
                            $this->flashMessenger()->addErrorMessage('Se a produciodo un error en el registro del usuario');
                            $redirect = '/';
                        }
                    }
                    $service->setTemplate('renders/modal_comprobante');
//                    $sessionAfiliate->getManager()->getStorage()->clear('afiliacion');
                } else {
                    $service->setTemplate('renders/modal_check_error');
                    if ($TipoOperacion == 2) {
                        $redirect = '/mi-cuenta/recarga-directa';
                    } else {
                        $redirect = $uriError;
                    }
                    //$redirect = '/personas';
                }
                $this->redirect()->toUrl($redirect);
            }
        } else {
            $this->redirect()->toUrl("/");
        }

    }

    public function masterAction()
    {
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            $service = $this->getServiceLocator()->get('Epass\Service\MasterService');
            $this->mcProcess($service, $data, 'MasterCard');
            return new ViewModel();
        } else {
            $this->redirect()->toUrl("/");
        }

    }

    public function amexAction()
    {
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            $service = $this->getServiceLocator()->get('Epass\Service\AmexService');
            $this->mcProcess($service, $data, 'American Express');
            return new ViewModel();
        } else {
            $this->redirect()->toUrl("/");
        }

    }

    public function dinersAction()
    {
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            $service = $this->getServiceLocator()->get('Epass\Service\DinnerService');
            $this->mcProcess($service, $data, 'Diners Club');
            return new ViewModel();
        } else {
            $this->redirect()->toUrl("/");
        }

    }

    public function mcProcess($service, $data, $tarjeta)
    {

        $response = $service->processResponse($data);
        $time = strtotime("{$response['transactions']['O11']}{$response['transactions']['O12']}");
        $pay_day = date('Y-m-d H:i:s', $time);
        $diaPago = date('d/m/Y', $time);

        $datosTransaction = array(
            'id' => $response['transactions']['O10'],
            'card_number' => $response['transactions']['O15'],
            'responce_code' => $response['transactions']['O13'],
            'status' => $response['transactions']['status'],
            'respuesta' => json_encode($response['transactions']),
            'pay_day' => $pay_day
        );

        $t = $this->getServiceLocator()->get('TransactionsModel');
        $idTransaction = $t->save($datosTransaction);
        
        $datosProceso=$t->getDataByOperation($idTransaction);
        $uriError = $datosProceso['urlFail'];
        $plantilla = $datosProceso['plantilla'];
        $TipoOperacion = $datosProceso['transaccion'];
        $idUserPlan = $datosProceso['idUserPlan'];
        $title = $datosProceso['title'];
                
//        flog('idTransacion',$idTransaction);
//        $sessionAfiliate = new Container('afiliacion');
//        $title = $sessionAfiliate->offsetGet('title');
//        $TipoOperacion = $sessionAfiliate->offsetGet('flagTipoAfiliacion');
//        $newTitle = str_replace(array('-', ' '), '', strtolower($title));
//        $uriError = $sessionAfiliate->offsetGet('urlFail');
//        
//        $plantilla = ($newTitle != 'prepago') ? 'boletaPago.phtml' : 'boletaEmpresa.phtml';
        
        $operacion = ($TipoOperacion == 2) ? 'Recarga' : 'Afiliacion';
        
        $asunto = 'Recibo de Pago e-pass';
        $datosPago = array('mensaje' => $response['mensaje'], 'transaccion' => $idTransaction,
            'day' => $diaPago, 'monto' => $response['transactions']['O9'],
            'tarjeta' => $tarjeta, 'plan' => $title, 'operacion' => $operacion);

        $service = $this->getServiceLocator()->get('Popup');
        $service->addParams($datosPago);
        $account = $this->getServiceLocator()->get('WebServicesCollection');
        $datos = [
            'Services' => 'respuestaPasarela',
            'response' => $response,
            'TransactionsModel' => $datosTransaction,
            'pasarela' => $datosPago,
            'message' => 'error-pagos',
        ];
        $account->saveWebServicesLog($datos);


        if ($response['transactions']['status'] == 3) {

            if ($TipoOperacion == 2) {
                $this->soloRecarga($idTransaction);
                $redirect = '/mi-cuenta';
            } else {
                $this->registroTotalMPE($idTransaction);
                $this->activarCuenta($idUserPlan);
                $this->sendMessagePago($asunto, $idTransaction, $plantilla,
                        $datosPago);
                $this->afiliacionRecarga($idTransaction);
                $redirect = '/';
            }
            $service->setTemplate('renders/modal_comprobante');
//            $sessionAfiliate->getManager()->getStorage()->clear('afiliacion');
        } else {
            $service->setTemplate('renders/modal_check_error');
            if ($TipoOperacion == 2) {
                $redirect = '/mi-cuenta/recarga-directa';
            } else {
                $redirect = $uriError;
            }
        }

        $this->redirect()->toUrl($redirect);

    }

    public function sendMessagePago($asunto, $idTransaction, $plantilla, $datos)
    {
        try {
            $t = $this->getServiceLocator()->get('TransactionsModel');
            $ALinkedListTable = $this->getServiceLocator()->get('Epass\Model\ALinkedListTable');
            $config = $this->getServiceLocator()->get('config');
            $datosUser = $t->getDataByTransaction($idTransaction);
            $datosPago = array_merge($datos, $datosUser);
            $datosPago['url'] = $config['urlPath'];
            $dataMail = array(
                'asunto' => $asunto,
                'email' => $datosUser['email'],
                'tipo' => \Epass\Enum\EmailType::WITH_TEMPLATE,
                'template' => EMAIL_PATH . $plantilla,
                'data' => $datosPago,
            );
            $department = $ALinkedListTable->getUbigeofetchPairs(array('LIST' => 3, 'INDEX' => $datosUser['department_id']));
            $district = $ALinkedListTable->getUbigeofetchPairs(array('LIST' => 5, 'INDEX' => $datosUser['district_id']));
            $province = $ALinkedListTable->getUbigeofetchPairs(array('LIST' => 4, 'INDEX' => $datosUser['province_id']));

            $data = array();

            $data['delivery'] = $datosUser['delivery'];
            $data['department'] = $department[$datosUser['department_id']];
            $data['district'] = $district[$datosUser['district_id']];
            $data['province'] = $province[$datosUser['province_id']];
            $data['address'] = $datosUser['address'];
            $data['observations'] = $datosUser['observations'];
            $data['email'] = $datosUser['email'];

            $dataReporte = array(
                'asunto' => 'Nueva afiliación en e-pass',
                'email' => $config['mail']['toEmailInfoAfiliacion'],
                'tipo' => \Epass\Enum\EmailType::WITH_TEMPLATE,
                'template' => EMAIL_PATH . "/area_operacion.phtml",
                'data' => array_merge($datosPago,$data),
            );
            $envioReporte = $this->getEventManager()->trigger(\Epass\Event\Listener::MAIL_EVENT,
                    $this, $dataReporte);
            return $envioReporte; /*$this->getEventManager()->trigger(\Epass\Event\Listener::MAIL_EVENT,
                            $this, $dataMail);*/
        } catch (\Exception $e) {
            return false;
        }

    }

    public function afiliacionRecarga($idTransaction)
    {
        try {
            $t = $this->getServiceLocator()->get('TransactionsModel');
            $migrado= $t->getMigrateById($idTransaction);
            flog('migrado afiliacion',$migrado);
            if(!$migrado){  
                $datosUser = $t->getDataByAfiliation($idTransaction);
                $mpe = $this->getServiceLocator()->get('mpe');
                $datosEstaticos = array('req_Source' => 'portal-web');
                $datosws = array_merge($datosUser, $datosEstaticos);
                /* Log de la trama enviada al ws */
                $this->log(array("proceso" => 'afiliacion', "data" => $datosws));
                /* ============================= */
                if (!empty($datosUser['req_AccountId'])) {
                    $rpta = $mpe->rechargePrepayAndRequestTagAccount($datosws);
                    $this->log(array("proceso"=>'afiliacion',"data"=> $datosws,"rpta"=>$rpta));
                    if ($rpta->status == 'ok') {
                        $data = array('id' => $idTransaction, 'migrate' => 1);
                        $t->save($data);
                    }
                }
                return true;
            }
            return true;
        } catch (\Exception $e) {
            //continue;
        }

    }

    public function soloRecarga($idTransaction)
    {
        try {
            $t = $this->getServiceLocator()->get('TransactionsModel');
            $datosUser = $t->getDataByRecarga($idTransaction);
            $migrado= $t->getMigrateById($idTransaction);
            flog('migrado recarga',$migrado);
            if(!$migrado){
                $mpe = $this->getServiceLocator()->get('mpe');
                $datosEstaticos = array('req_Source' => 'portal-web');
                $datosws = array_merge($datosUser, $datosEstaticos);
                /* Log de la trama enviada al ws req_AccountId */
                $this->log(array("proceso" => 'soloRecarga', "datos" => $datosws));
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

    public function activarCuenta($id)
    {
        $up = $this->getServiceLocator()->get('UserPlansTable');
        $data = array('id' => $id, 'enable' => 1);
        $up->save($data);

    }

    public function log($data)
    {
        $log = $this->getServiceLocator()->get('EmailLogCollection');
        $log->save($data);

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

    private function registroTotalMPE($idTransaction)
    {
        $idAccount = $this->CrearUsuarioMPE($idTransaction);
        flog('idAccount-MPE',$idAccount);
        if ($idAccount) {
            $cPlan = $this->crearPlanMPE($idTransaction);
            if ($cPlan) {
                $vehicles = $this->crearVehiclesMPE($idTransaction);
            }
            $this->enviarActivacionUsers($idTransaction);
            
//            $session_validate_plan_with_login = new Container('validate_plan_with_session');
//            if (!$session_validate_plan_with_login->offsetExists('id_user_validate_plan_in_session')) {
//                $this->enviarActivacionUsers($sa->offsetGet('idUser'), $sa,$individual);
//            }
            return true;
        }
        return false;

    }

    private function CrearUsuarioMPE($idTransaccion)
    {
        flog('entra CrearUsuarioMPE',true);
        $mpe = $this->getServiceLocator()->get('mpe');
        $t = $this->getServiceLocator()->get('TransactionsModel');
        $params=$t->getDataCrearUsuarioMPE($idTransaccion);
        flog('params crear usuario mpe',$params);
        $idUser=$params['user_id'];
        $idUserPlan=$params['user_plan_id'];
        unset($params['user_id']);
        unset($params['user_plan_id']);
        
        $rq = $mpe->requestAccountCreation($params);
        $this->log(array("proceso" => "rpta_params_create_account",'data'=>$params, "rpta" => $rq));
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
            //guardar en la collection de errores
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

    private function crearPlanMPE($idTransaccion)
    {
        flog('entra crearPlanMPE',true);
        $mpe = $this->getServiceLocator()->get('mpe');
        $t = $this->getServiceLocator()->get('TransactionsModel');
        $params=$t->getDatacrearPlanMPE($idTransaccion);
        $accountId=$params['req_AccountId'];
        $idPlan=$params['req_PlanId'];
        $idUserPlan=$params['user_plan_id'];
        unset($params['user_plan_id']);
        flog('crearPlanMPE params',$params);
        $rq = $mpe->subscribePlan($params);
        $this->log(array("proceso" => "params_crear_plan_mpe","data"=>$params ,"rpta" => $rq));
        if ($rq->status === 'ok') {
            //actualizar user_plan
            $userPlansModel = $this->getServiceLocator()->get('UserPlansModel');
            $data = [
                'id' => $idUserPlan,
                'migrate' => 1
            ];
            $userPlansModel->saveUserPlans($data);
            return $this->crearPromotionMPE($accountId, $idUserPlan,$idPlan);
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

    private function crearPromotionMPE($accountId, $idUserPlan,$idPlan)
    {
        flog('entra crearPromotionMPE',true);
        $mpe = $this->getServiceLocator()->get('mpe');
        $params = array(
            'req_ProductId' => 1,
            'req_PlanId' => (int)$idPlan
        );
        $rq = $mpe->getAllPromotionsByPlanByProduct($params);
        $this->log(array("proceso" => "params_Promo_mpe","data" => $params,'rpta'=>$rq));
        if ($rq->status === 'ok') {
            $promo = $rq->data->allPromotionsByPlanByProductDefinition;
            foreach ($promo as $value) {
                $paramsPromotion = array(
                    'req_AccountId' => $accountId,
                    'req_PromotionId' => $value->req_PromotionId
                );
                $this->log(array("proceso" => "paramsPromotion", "data" => $paramsPromotion));
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

    private function crearVehiclesMPE($idTransaccion)
    {
        flog('entra crearVehiclesMPE',true);
        $t = $this->getServiceLocator()->get('TransactionsModel');
        $mpe = $this->getServiceLocator()->get('mpe');
        $vehicles = $t->getDataCreateVehicle($idTransaccion);
        flog('vehiculos MPE',$vehicles);
        $cont = 0;
        foreach ($vehicles as $vehicle) {
            if (is_numeric($vehicle['idVehicle'])) {
                $rq = $mpe->addVehicle($vehicle);
                $this->log(array("proceso" => "crear vehicles MPE", "data" => $vehicles,'actual'=>$vehicle,'rpta'=>$rq));
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
                $this->log(array('is_numeric_vehicle_id' => 'no es numerico'));
            }
            $cont++;
        }
    }

    /* Proceso previo a la seleccion de medio de pago */

    private function registerTotal()
    {
        $dbAdapter = $this->getServiceLocator()->get('adapter');
        $db = $dbAdapter->getDriver()->getConnection();
        $sa = new Container('afiliacion');
        $db->beginTransaction();
        try {
            $docAct = $sa->tipoDoc;
            if (empty($docAct)) {
                $sa->offsetSet('tipoDoc', '00');
            }
            $session_validate_plan_with_login = new Container('validate_plan_with_session');
            if ($session_validate_plan_with_login->offsetExists('id_user_validate_plan_in_session')) {
                $idUser = $session_validate_plan_with_login->id_user_validate_plan_in_session;
                $this->log(array("proceso" => "get_iduser_with_session", "data" => $idUser));
            } else {
                $idUser = $this->registroUsers($sa);
                $this->log(array("proceso" => "get_iduser_without_session", "data" => $idUser));
            }
            if ($idUser) {

                $sa->offsetSet('idUser', $idUser);
                $idUserPlan = $this->registroUserPlans($sa, $idUser);

                if ($idUserPlan) {
                    $this->log(array("proceso" => "get_iduserPlan", "data" => $idUserPlan));
                    $sa->offsetSet('idUserPlan', $idUserPlan);
                    $vehicles = $this->registroVehicles($sa);
                    if (!empty($vehicles)) {
                        foreach ($vehicles as $idVehicle) {
                            $this->registroUserPlanVehicle($idUserPlan,
                                    $idVehicle);
                        }
                    }
                    $db->commit();
                    return true;
                } else {
                    $this->log(array("proceso" => "get_iduserPlan", "data" => "ocurrio un error"));
                    throw new \Exception('Error generando idUserPlan', 502);
                }
            } else {
                $this->log(array("proceso" => "get_iduser", "data" => "ocurrio un error"));
                throw new \Exception('Error generando idUser', 502);
            }
        } catch (\Exception $e) {
            $db->rollBack();
            $this->flashMessenger()->addErrorMessage('Se a producido un error, por favor vuelva a intentar en unos minutos.');
            $this->redirect()->toUrl("/");
        }

    }

    //Registro de usuarios en mysql
    private function registroUsers($datos)
    {
        $usersModel = $this->getServiceLocator()->get('UsersModel');
        $usuario = $usersModel->findUsersByCorreo($datos->txtCorreo);
        if(!empty($usuario)){
            return $usuario['id'];
        }
        $data = [
            'name' => empty($datos->txtNombreTitular) ? 'Anonimo' : $datos->txtNombreTitular,
            'role_id' => \Epass\Model\RolesTable::PUBLICO,
            'lastname' => empty($datos->txtApellidosTitular) ? $datos->txtNombreTitular : $datos->txtApellidosTitular,
            'email' => empty($datos->txtCorreo) ? '' : $datos->txtCorreo,
            'password' => empty($datos->txtContrasenia) ? '' : md5($datos->txtContrasenia),
            'psw_desencriptado' => empty($datos->txtContrasenia) ? '' : $datos->txtContrasenia,
            'terms_check' => empty($datos->CkTerminos) ? '' : $datos->CkTerminos,
            'news_check' => empty($datos->CkNovedades) ? '' : $datos->CkNovedades,
        ];
        if (isset($datos->id)) {
            $adicionales = ['id' => (int) $datos->id];
            $data = array_merge($data, $adicionales);
        }
        $users = $usersModel->saveUser($data);
        $this->log(array('proceso'=>'registroUsers','datos'=>$data,'rpta'=>$users));
        return $users;

    }

    //Registro en la tabla user_plan
    private function registroUserPlans($datos, $idUser)
    {
        if ($datos->offsetExists('isContactEmpresa') && $datos->isContactEmpresa != 0) {
            $contact = $datos->txtNombreTitular;
        } else {
            $contact = '';
        }
        $newTitle = str_replace(array('-', ' '), '', strtolower($datos->title));
        $individual = ($newTitle == 'prepago') ? 'N' : 'Y';

        $userPlansModel = $this->getServiceLocator()->get('UserPlansModel');
        $data = [
            'user_id' => $idUser,
            'plan_id' => $datos->idPlan,
            'plan_name' => $datos->namePlan,
            'flagDelivery' => $datos->radTipo,
            'document_type_id' => $datos->tipoDoc,
            'document_number' => $datos->txtNumDocumento,
            'razon_social' => empty($datos->txtRazonSocial) ? '' : $datos->txtRazonSocial,
            'telephone' => $datos->txtTelefono,
            'department_id' => $datos->idDpto,
            'province_id' => $datos->idProvin,
            'district_id' => $datos->idDistrito,
            // 'address' => $datos->txtNombVia,
            //  'address_number' => $datos->txtNumVia,
            //    'inside_address' => $datos->txtDptoVia,
            'address' => $datos->txtDireccion,
            'observations' => $datos->txtReferencia,
            'contact' => $contact,
            'billing_doc_number' => $datos->req_BillingDocNumber,
            'billing_designation' => $datos->req_BillingDesignation,
            'billing_receipt_type' => $datos->req_ReceiptType,
            'individual' => $individual
        ];

        $idUserPlan = $userPlansModel->saveUserPlans($data);
        return $idUserPlan;

    }

    //Realiza el envio de email de activacioncuent
    private function enviarActivacionUsers($idTransaction)
    {
        try {
            $t = $this->getServiceLocator()->get('TransactionsModel');
            $dataEmail= $t->getDataByEmail($idTransaction);
            $this->log(array('proceso'=>'enviarActivacionUsers','data'=>$dataEmail));
            if(!(bool)$dataEmail['activo']){
                $config = $this->getServiceLocator()->get('config');
                $usersModel = $this->getServiceLocator()->get('UsersModel');
                $url = $config['urlPath'] . $this->url()->fromRoute('verificacion-email',
                                array('token' => $usersModel->generarToken($dataEmail['idUser'],
                                    86400)));

//              $nombre = ($individual)?utf8_encode($datos->txtNombreTitular.' '.$datos->txtApellidosTitular) : utf8_encode($datos->txtRazonSocial);
                $dataMail = array(
                    'asunto' => 'Registro Epass',
                    'email' => $dataEmail['correo'],
                    'tipo' => \Epass\Enum\EmailType::WITH_TEMPLATE,
                    'template' => EMAIL_PATH . "/activacioncuenta.phtml",
                    'data' => array('name'=>$dataEmail['nombre'],'correo' => $dataEmail['correo'], 'url' => $url),
                );
                $envioAct = $this->getEventManager()->trigger(\Epass\Event\Listener::MAIL_EVENT,
                        $this, $dataMail);
                return $envioAct;

            }
            return true;
        } catch (\Exception $e) {
            return false;
        }

    }

    private function registroVehicles($datos)
    {
        $vehiclesModel = $this->getServiceLocator()->get('VehiclesModel');
        $sa = new Container('afiliacion');
        $keys = ['', '2', '3', '4', '5', '6', '7', '8', '9', '10'];
        foreach ($keys as $key) {
            $tipo = $datos->{'idTipoVehiculo' . $key};
            if (isset($tipo) && !empty($tipo)) {
                $vehiculo = [
                    'type' => $datos->{'idTipoVehiculo' . $key},
                    'brand' => $datos->{'idMarca' . $key},
                    'model' => $datos->{'idModelo' . $key},
                    'license_plate' => $datos->{'txtPlaca' . $key},
                    'color' => $datos->{'txtColor' . $key}
                ];
                $idVehicle=$vehiclesModel->saveVehicle($vehiculo);
                if(!$idVehicle){
                    return false;
                }
                $idVehicles[] = $idVehicle;
            }
        }
        $sa->offsetSet('idVehicles', $idVehicles);
        return $idVehicles;

    }

    //Registro en user_plan_vehicle
    private function registroUserPlanVehicle($idUserPlan, $idVehicle)
    {
        $UserPlanVehicleModel = $this->getServiceLocator()->get('UserPlanVehicleModel');
        $data = [
            'user_plan_id' => $idUserPlan,
            'vehicle_id' => $idVehicle
        ];
        return $UserPlanVehicleModel->saveUserPlanVehicle($data);

    }

}
