<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        $referer = $this->getRequest()->getHeader('Referer');
        if ($referer) {
            $path = $referer->uri()->getPath();
            if ($path == '/mi-cuenta')
                $this->flashMessenger()->clearMessages();
        }
        return new ViewModel();

    }

    public function queEsEpassAction()
    {

        return new ViewModel();

    }

    public function limpiarcacheAction()
    {
        $mpe = $this->getServiceLocator()->get('mpe');
        $mis_vehiculos = $mpe->flush();
        echo $mis_vehiculos;
        exit;
        return new ViewModel();

    }
    public function generateMobileAction()
    {
        if ($this->getRequest()->isPost()) {
            try {
                $post = $this->params()->fromPost();
                $data = array_map('json_decode', $post);
                $idPlan = $data['paquete']->planId;
                $saldoUso = $data['paquete']->saldoUso;
                $tasaRecarga = $data['paquete']->tasaRecarga;
                $sessionAfiliate = new Container('afiliacion');
                $sessionAfiliate->req_ReceiptType = 'B';
                $sessionAfiliate->req_BillingDocNumber = $data['user']->txtNumDocumento;
                $nombre = empty($data['user']->txtNombreTitular) ? '' : $data['user']->txtNombreTitular;
                $apellido = empty($data['user']->txtApellidosTitular) ? '' : $data['user']->txtApellidosTitular;
                $sessionAfiliate->req_BillingDesignation = $nombre . ' ' . $apellido;                                    
                if ($data['transaction_type_id'] == 1) {
                    $sessionAfiliate->tipoDoc = $data['user']->tipoDoc;
                    $sessionAfiliate->txtNombreTitular = $data['user']->txtNombreTitular;
                    $sessionAfiliate->txtApellidosTitular = $data['user']->txtApellidosTitular;
                    $sessionAfiliate->txtCorreo = $data['user']->txtCorreo;
                    $sessionAfiliate->txtContrasenia = $data['user']->txtContrasenia;
                    $sessionAfiliate->CkTerminos = 1;
                    $sessionAfiliate->CkNovedades = 0;
                    $sessionAfiliate->idPlan = $data['paquete']->planId;
                    $sessionAfiliate->namePlan = $data['paquete']->namePlan;
                    $sessionAfiliate->radTipo = $data['user']->radTipo;
                    $sessionAfiliate->txtNumDocumento = $data['user']->txtNumDocumento;
                    $sessionAfiliate->txtRazonSocial = '';
                    $sessionAfiliate->txtTelefono = $data['user']->txtTelefono;
                    $sessionAfiliate->idDpto = $data['user']->idDepartamento;
                    $sessionAfiliate->idProvin = $data['user']->idProvincia;
                    $sessionAfiliate->idDistrito = $data['user']->idDistrito;
                    $sessionAfiliate->txtDireccion = $data['user']->txtNombVia;
                    $sessionAfiliate->idUser = $data['user']->id;
                    if (!empty($data['user']->id)) {
                        $session_validate_plan_with_login = new Container('validate_plan_with_session');
                        $session_validate_plan_with_login->offsetSet('id_user_validate_plan_in_session',$data['user']->id);                        
                    }
                    $sessionAfiliate->txtReferencia = $data['user']->txtReferencia;
                    $sessionAfiliate->vehicles = $data['user']->vehicles;
                    $sessionAfiliate->title = $this->matchTitle($data['paquete']->namePlan);
                    $sessionAfiliacion->maxVehiculos = $data['paquete']->maxVehiculos;
                    if($data['paquete']->planId=="39"||$data['paquete']->planId=="38")
                    {
                        $sessionAfiliacion->isContactEmpresa = 0;
                    } else {
                        $sessionAfiliacion->isContactEmpresa = 1;
                    }
                    $receiptType = ($data['comprobante']->medio_de_pago_dash == '2') ? 'F' : 'B';
                    $sessionAfiliate->req_ReceiptType = $receiptType;
                    if ($receiptType == 'F') {
                        $sessionAfiliate->req_BillingDocNumber = $data['comprobante']->comp_ruc;
                        $sessionAfiliate->req_BillingDesignation = $data['comprobante']->comp_raz_soc;
                    }                    
                    $this->crearSessionVehiculosAfiliacion($data['user']->vehicles);
                    $this->registerTotal();
                    $costoTag = $data['paquete']->costoFijoTag;
                    $costoPromocionalTag = $data['paquete']->costoPromocionalTag;
                    $costoTotal = number_format($data['paquete']->costoTotal, 2);
                    $numVehicles = 0;
                    $idUserPlan = $sessionAfiliate->idUserPlan;
                } else {
                    $costoTag = 0;
                    $costoPromocionalTag = 0;
                    $costoTotal = number_format($data['paquete']->total, 2);
                    $numVehicles = 0;
                    $idUserPlan = $data['plan']->id;
                }
                $sessionAfiliate->flagTipoAfiliacion = $data['transaction_type_id'];
                $costoTagFinal = ($costoPromocionalTag > 0) ? $costoPromocionalTag : $costoTag;
                $tipo_doc = ($data['comprobante']->medio_de_pago_dash == '2') ? 'factura' : 'boleta';
                $document_number = $data['comprobante']->comp_ruc;
                $razon_social = $data['comprobante']->comp_raz_soc;
                $urlFail='/movil';
                $datosDetalle = array(
                    'package_id' => $idPlan,
                    'cost_tag' => $costoTagFinal,
                    'recharge_amount' => $saldoUso,
                    'recharge_rate' => $tasaRecarga,
                    'use_balance' => $costoTotal,
                    'total_vehicles' => $numVehicles
                );
                $td = $this->getServiceLocator()->get('TransactionDetailModel');
                $t = $this->getServiceLocator()->get('TransactionsModel');
                $idDetalle = $td->save($datosDetalle);
                $medios = array(
                    'Visa','Master Card','American Express','Diners Club'
                );
                $medio_de_pago = $medios[$data['medio_de_pago']-1];
                switch ($medio_de_pago) {
                    case 'Visa':
                        $datosTransaction = array(
                            'payment_method_id' => 1,
                            'transaction_type_id' => $data['transaction_type_id'],
                            'user_plan_id' => $idUserPlan,
                            'mount' => $costoTotal,
                            'status' => 0,
                            'transaction_detail_id' => $idDetalle,
                            'document_number' => $document_number,
                            'tipo_doc' => $tipo_doc,
                            'razon_social' => $razon_social,
                            'urlFail'=> $urlFail
                        );
                        $idTransaction = $t->save($datosTransaction);
                        $datos = array('id' => $idTransaction, 'monto' => $costoTotal);
                        $response = $this->processVisa($datos);
                        break;
                    case 'Master Card':
                        $datosTransaction = array(
                            'payment_method_id' => 2,
                            'transaction_type_id' => $data['transaction_type_id'],
                            'user_plan_id' => $idUserPlan,
                            'mount' => $costoTotal,
                            'status' => 0,
                            'transaction_detail_id' => $idDetalle,
                            'document_number' => $document_number,
                            'tipo_doc' => $tipo_doc,
                            'razon_social' => $razon_social,
                            'urlFail'=> $urlFail
                        );
                        $idTransaction = $t->save($datosTransaction);
                        $datos = array('id' => $idTransaction, 'monto' => $costoTotal);
                        $response = $this->processMaster($datos);
                        break;
                    case 'American Express':
                        $datosTransaction = array(
                            'payment_method_id' => 3,
                            'transaction_type_id' => $data['transaction_type_id'],
                            'user_plan_id' => $idUserPlan,
                            'mount' => $costoTotal,
                            'status' => 0,
                            'transaction_detail_id' => $idDetalle,
                            'document_number' => $document_number,
                            'tipo_doc' => $tipo_doc,
                            'razon_social' => $razon_social,
                            'urlFail'=> $urlFail
                        );
                        $idTransaction = $t->save($datosTransaction);
                        $datos = array('id' => $idTransaction, 'monto' => $costoTotal);
                        $response = $this->processAmex($datos);
                        break;
                    case 'Diners Club':
                        $datosTransaction = array(
                            'payment_method_id' => 4,
                            'transaction_type_id' => $data['transaction_type_id'],
                            'user_plan_id' => $idUserPlan,
                            'mount' => $costoTotal,
                            'status' => 0,
                            'transaction_detail_id' => $idDetalle,
                            'document_number' => $document_number,
                            'tipo_doc' => $tipo_doc,
                            'razon_social' => $razon_social,
                            'urlFail'=> $urlFail
                        );
                        $idTransaction = $t->save($datosTransaction);
                        $datos = array('id' => $idTransaction, 'monto' => $costoTotal);
                        $response = $this->processDiners($datos);
                        break;
                }
                $viewModel = new ViewModel(array('mp'=>$medio_de_pago,'action' => $response['action'], 'datos' => $response['fields']));
                $viewModel->setTerminal(true);
                return $viewModel;
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        } else {
            $this->redirect()->toUrl("/");
        }
    }
    
    private function crearSessionVehiculosAfiliacion($data)
    {
        $sessionAfiliacion = new Container('afiliacion');
        $maxVehiculos = $sessionAfiliacion->maxVehiculos;
        $key=1;
        foreach ($data as $vehicle) {
            $tipo = $vehicle->type->CLASS;
            if (isset($tipo) && !empty($tipo)) {
                if($key==1)
                    $key='';
                $sessionAfiliacion->offsetSet('idTipoVehiculo' . $key,
                        $vehicle->type->CLASS);
                $sessionAfiliacion->offsetSet('idMarca' . $key,
                        $vehicle->brand->INDEX);
                $sessionAfiliacion->offsetSet('txtPlaca' . $key,
                        $vehicle->license_plate);
                $sessionAfiliacion->offsetSet('idModelo' . $key,
                        $vehicle->model->INDEX);
                $sessionAfiliacion->offsetSet('txtColor' . $key,
                        $vehicle->color);
                if($key=='')
                    $key=1;
                $key++;
                if($key>=$maxVehiculos)
                    break;                
            }
        }

    }
    
    protected function processVisa($datos) {
        $VisaService = $this->getServiceLocator()->get('Epass\Service\VisaService');
        $generaEticket = $VisaService->generateEticket($datos['id'], $datos['monto']);
        $eticket = 0;
        if ($generaEticket['code'] == 200) {
            $eticket = $generaEticket['eticket'];
        }
        $this->setInterId($datos['id'], $eticket);
        $fields = array('ETICKET' => $eticket);
        return array('fields' => $fields, 'action' => $VisaService->getAction());
    }

    protected function processMaster($datos) {
        $service = $this->getServiceLocator()->get('Epass\Service\MasterService');
        $values = $service->getDataForHash($datos['id'], $datos['monto']);
        $hash = $service->getHash($values);
        $fields = $service->getDataForm($values, $hash);
        $this->setInterId($datos['id'], $hash);
        return array('fields' => $fields, 'action' => $service->getAction());
    }

    protected function processAmex($datos) {
        $service = $this->getServiceLocator()->get('Epass\Service\AmexService');
        $values = $service->getDataForHash($datos['id'], $datos['monto']);
        $hash = $service->getHash($values);
        $fields = $service->getDataForm($values, $hash);
        $this->setInterId($datos['id'], $hash);
        return array('fields' => $fields, 'action' => $service->getAction());
    }

    protected function processDiners($datos) {
        $service = $this->getServiceLocator()->get('Epass\Service\DinnerService');
        $values = $service->getDataForHash($datos['id'], $datos['monto']);
        $hash = $service->getHash($values);
        $fields = $service->getDataForm($values, $hash);
        $this->setInterId($datos['id'], $hash);
        return array('fields' => $fields, 'action' => $service->getAction());
    }

    protected function setInterId($id, $code) {
        $t = $this->getServiceLocator()->get('TransactionsModel');
        $datosTransaction = array('id' => $id, 'status' => 1, 'external_id' => $code, 'updated_at' => date('Y-m-d H:i:s'));
        $idTransaction = $t->save($datosTransaction);
        return $idTransaction;
    }

    private function registerTotal() {
        $sa = new Container('afiliacion');
        $docAct = $sa->tipoDoc;
        if (empty($docAct)) {
            $sa->offsetSet('tipoDoc', '00');
        }
        if (!empty($sa->idUser)) {
            $idUser = $sa->idUser;
        } else {
            $idUser = $this->registroUsers($sa);
        }
        if ($idUser) {
            $sa->offsetSet('idUser', $idUser);
            $idUserPlan = $this->registroUserPlans($sa, $idUser);
            if ($idUserPlan) {
                $sa->offsetSet('idUserPlan', $idUserPlan);
                $vehicles = $this->registroVehicles($sa);
                if (!empty($vehicles)) {
                    foreach ($vehicles as $idVehicle) {
                        $this->registroUserPlanVehicle($idUserPlan, $idVehicle);
                    }
                }
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function registroUsers($datos) {
        $usersModel = $this->getServiceLocator()->get('UsersModel');
        $data = [
            'name' => empty($datos->txtNombreTitular) ? '' : $datos->txtNombreTitular,
            'role_id' => \Epass\Model\RolesTable::PUBLICO,
            'lastname' => empty($datos->txtApellidosTitular) ? '' : $datos->txtApellidosTitular,
            'email' => empty($datos->txtCorreo) ? '' : $datos->txtCorreo,
            'password' => empty($datos->txtContrasenia) ? '' : md5($datos->txtContrasenia),
            'terms_check' => empty($datos->CkTerminos) ? '' : $datos->CkTerminos,
            'news_check' => empty($datos->CkNovedades) ? '' : $datos->CkNovedades,
        ];
        if (isset($datos->id)) {
            $adicionales = ['id' => (int) $datos->id];
            $data = array_merge($data, $adicionales);
        }
        $users = $usersModel->saveUser($data);
        return $users;
    }

    private function registroUserPlans($datos, $idUser) {
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
            'address' => utf8_encode($datos->txtDireccion),
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

    private function registroVehicles($datos) {
        $vehiclesModel = $this->getServiceLocator()->get('VehiclesModel');
        $sa = new Container('afiliacion');
        foreach ($datos['vehicles'] as $vehicle) {
            $tipo = $vehicle->type->CLASS;
            if (isset($tipo) && !empty($tipo)) {
                $vehiculo = [
                    'type' => $vehicle->type->CLASS,
                    'brand' => $vehicle->brand->INDEX,
                    'model' => $vehicle->model->INDEX,
                    'license_plate' => $vehicle->license_plate,
                    'color' => $vehicle->color
                ];
                $idVehicles[] = $vehiclesModel->saveVehicle($vehiculo);
            }
        }
        $sa->offsetSet('idVehicles', $idVehicles);
        return $idVehicles;
    }

    private function registroUserPlanVehicle($idUserPlan, $idVehicle) {
        $UserPlanVehicleModel = $this->getServiceLocator()->get('UserPlanVehicleModel');
        $data = [
            'user_plan_id' => $idUserPlan,
            'vehicle_id' => $idVehicle
        ];
        return $UserPlanVehicleModel->saveUserPlanVehicle($data);
    }

    public function matchTitle($namePlan) {
        $name = strtolower($namePlan);
        $title = '';

        if (preg_match('/individual 1/', $name)) {
            $title = 'Individual';
        }
        if (preg_match('/familiar 1/', $name)) {
            $title = 'Familiar';
        }
        if (preg_match('/corporativo/', $name)) {
            $title = 'Pre-Pago';
        }

        return $title;
    }

}
