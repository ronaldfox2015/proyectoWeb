<?php

namespace Application\Controller;

use Application\Form\SolicitudForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Epass\Model\User;
use Application\Form\ActualizarAvanzado;
use Application\Form\ActualizarVehiculo;
use Application\Form\BusquedaVehiculos;
use Application\Http\Mpe\Mpe;
use Zend\Session\Container;
use Zend\View\Model\JsonModel;
use Epass\Model\APlanTable;
use Zendesk\API\Debug;

class CuentaController extends AbstractActionController
{

    CONST VACIO = '';
    CONST BOLETA = 'Y';
    CONST RECIBO = 'W';
    CONST FACTURA = 'X';
    CONST NAME_BOLETA = 'Boleta';
    CONST NAME_RECIBO = 'Recibo';
    CONST NAME_FACTURA = 'Factura';
    CONST STATUS_UPLOADED = 'Uploaded';
    CONST STATUS_PENDING = 'Pending';
    CONST STATUS_CANCELLED = 'Cancelled';
    CONST CODE_BOLETA = 03;
    CONST CODE_FACTURA = 01;

    static $_menus = array('Usuario Invitado' => 'Reportes', 'Usuario Invitado' => 'Mis Vehiculos', 'Usuario Invitado' => 'Comprobantes de Pago');

    public function indexAction()
    {
        $auth = $this->getServiceLocator()->get('AuthService');

        if (!$auth->hasIdentity()) {
            return $this->redirect()->toRoute('home');
        }

        $data_sesion_user = $auth->getStorage()->read();
        $Cuentas = $this->getServiceLocator()->get('Application\Service\CuentaService');

        if (isset($data_sesion_user->migratePlans) && $data_sesion_user->migratePlans != 1) {
            $Cuentas->migratePlans($data_sesion_user->id, $data_sesion_user);
        }

        $role = $data_sesion_user->role;

        /// datos user (MySQL)
        $idusuario = $data_sesion_user->id;

        $user_plans = $this->getServiceLocator()->get('UserPlansModel');
        $mpe = $this->getServiceLocator()->get('mpe');
        $Cuentas = $this->getServiceLocator()->get('Application\Service\CuentaService');
        $acid = isset($data_sesion_user->plans['account_id']) ? $data_sesion_user->plans['account_id'] : null;

        if ($role == 'usuario') {
            $data_users_plans = $user_plans->getPlansbyUser($idusuario);
        } else {
            $data_users_plans = $user_plans->getPlansbyUserRecarga($idusuario,
                    trim($data_sesion_user->placa));
        }
        $config = $this->getServiceLocator()->get('config');

        $data_usar_view = array();
        $edit = false;
        $resumen = true;
        $recargadirecta = false;
        // capturo el accountID
        $account_id = isset($data_sesion_user->account_id) ? $data_sesion_user->account_id : $data_users_plans[0]['account_id'];
        $data_sesion_user->account_id = $account_id;
        $mis_vehiculos = $mpe->getMembersByAccount(array('req_AccountId' => $account_id));
        $BusquedaVehiculo = new BusquedaVehiculos();
        $opcionesSelect = $BusquedaVehiculo->get("bslxEstado")->getValueOptions();
        $vehiculos = $this->procesarVehiculos($account_id, $mis_vehiculos,
                $opcionesSelect);

        $saldo = $mpe->getSaldoByAccount(array('req_AccountId' => $account_id));
        //dividir el saldo en 100
        $saldos = 0;
        if ($saldo->status == 'ok') {
            $saldos = $saldo->data->saldo;
        }
        $idPlan = 0;
        $id = 0;

        /* datos de tipo de documento (MySQL) */
        foreach ($data_users_plans as $key => $value) {
            if ($account_id == $value['account_id']) {
                $id = $value['id'];
                $idPlan = $value['plan_id'];
                $namePlan = $value['plan_name'];
            }
        }
        $data_users_plans_Form = $user_plans->getPlansbyUserForm($id);
        $data_cuenta=$mpe->getAccountData(array('req_AccountId'=>$account_id));
        $individual=true;
        if(isset($data_cuenta->data)){
            $arrayData=array('tipoDoc'=>$data_cuenta->data->req_DocType,
            'txtNumDocumento'=>$data_cuenta->data->req_DocNumber,
            'txtNombreTitular'=>$data_cuenta->data->req_Forename,
            'txtApellidosTitular'=>$data_cuenta->data->req_Surname);
            $data_users_plans_Form =  array_merge($data_users_plans_Form,$arrayData);
            $individual=$data_cuenta->data->req_Individual;
        }
        
        $default_account = $data_users_plans_Form;
        $data_sesion_user->plans = $data_users_plans_Form;
        ///  $dataMep=$Cuentas->getDataForm($account_id);

        $id_user_plan = $default_account['id'];
        $vehicles_plan = $this->getServiceLocator()->get('UserPlanVehicleModel');
        $vehicles = $vehicles_plan->getVehiclesbyUserPlan($id_user_plan);
        $saldo_disponible = number_format((float) trim($saldos) / 100, 2, '.',
                '');
        $dataPaquetes = array();
        //creando el arrary de productos de epass
        $dataPaquetes[] = $this->getPaquetesIdPlan($idPlan);
        /* Rol usuario */
        $mis_vehiculos = count($vehicles);
        if ($role == "usuario") {
            /* Consultar ultimas recargas */
            $ultimas_recargas = $this->getUltimarRecargas($mpe, $account_id);
            $solo_recargas = $this->getSoloRecargas($ultimas_recargas);
            $active_lima = '0';
            if ($data_users_plans_Form['idDpto'] == '') {
                $active_lima = '1';
            }
            $default_account = $data_users_plans_Form;
            $id_user_plan = $default_account['id'];
            $vehicles_plan = $this->getServiceLocator()->get('UserPlanVehicleModel');
            $vehicles = $vehicles_plan->getVehiclesbyUserPlan($id_user_plan);
            $document_number = $default_account['txtNumDocumento'];
            $document_type_id = $default_account['tipoDoc'];
            $plan_name = $default_account['plan_name'];
            $sessionAfiliate = new Container('afiliate');
            $request = $this->getRequest();
            $re = false;
            $parameter = $this->getEvent()->getRouteMatch()->getParam('recarga',
                    false);
            $button = true;

            if ($parameter == 'recarga-directa') {
                $recarga = true;
                $button = false;
            } else {
                $recarga = false;
            }
            if ($parameter == 'mis-datos') {
                $mis_datos = true;
            } else {
                $mis_datos = false;
            }

            $formActualizarAvanzado = new ActualizarAvanzado($data_users_plans_Form,
                    $this->getServiceLocator(), true);
            $norequerido = true;
            $formActualizarAvanzado->setData($data_users_plans_Form);
            if ($request->isPost()) {
                $datos = $request->getPost();
                if (isset($datos['id']) && is_numeric($datos['id'])) {
                    $edit = true;
                    $resumen = false;
                    $datos['account_id'] = $account_id;
                    $datos['users_plans'] = $data_sesion_user->plans;
                    $datos['tipoDoc'] = $data_users_plans_Form['tipoDoc'];
                    $datos['txtNumDocumento'] = $data_users_plans_Form['txtNumDocumento'];
                    $datos['txtCorreo'] = $data_users_plans_Form['txtCorreo'];
                    $datos['txtRazonsocial'] = $data_users_plans_Form['txtRazonsocial'];
                    $datos['telephone'] = $data_users_plans_Form['telephone'];
                    $datos['additional_phone'] = $data_users_plans_Form['additional_phone'];
                    $datos['contact'] = $data_users_plans_Form['contact'];
                    $formActualizarAvanzado->setData($datos);
                    if ($formActualizarAvanzado->_isValid($datos)) {
                        if ($Cuentas->editar($datos)) {
                            if (isset($datos['txtNombreTitular'])) {
                                $data_sesion_user->name = $datos['txtNombreTitular'];
                                $data_sesion_user->lastname = $datos['txtApellidosTitular'];
                            }
                            //$this->flashMessenger()->addSuccessMessage('Se actualizo con exito');
                            $formActualizarAvanzado->setData($datos);
                            $user_plans->setRemovePlansbyUserFormCache($id);
                            $this->flashMessenger()->setNamespace('success')->addMessage('Se actualizó con exito');
                            $this->redirect()->toUrl('/mi-cuenta');
                        } else {
                            //$this->flashMessenger()->addErrorMessage('Intente nuevamete');
                            $this->flashMessenger()->setNamespace('error')->addMessage('Intente nuevamete');
                            $formActualizarAvanzado->setData($datos);
                        }
                    } else {
                        //$this->flashMessenger()->addErrorMessage('Intente nuevamete');
                        $this->flashMessenger()->setNamespace('error')->addMessage('Intente nuevamete');
                        $formActualizarAvanzado->setData($datos);
                    }
                }
            }
            // cuenta con el plan_id mas alto
            /* datos de vehiculos por plan (MySQL) */
            $count = 0;
            foreach ($data_users_plans as $key => $value) {
                $data_users_plans[$key]['vehicles'] = 0;
                foreach ($vehicles as $k => $v) {
                    if ($v['user_plan_id'] == $value['id']) {
                        $count = $count + 1;
                        $data_users_plans[$key]['vehicles'] = $count;
                    }
                }
            }
            $document_table = $this->getServiceLocator()->get('Epass\Model\ADocumentTypeTable');
            $document_type_data = $document_table->getData(array('TYPE' => $document_type_id));
            $cuentas_asociadas = count($data_users_plans);
            $document_type = $document_type_data[0]['DESCRIPTION'];
            $username = $data_users_plans_Form['txtCorreo'];
            $firts_name = ucfirst($data_users_plans_Form['txtNombreTitular']);
            $last_name = ucfirst($data_users_plans_Form['txtApellidosTitular']);
            $name = explode(" ", $firts_name);
            $lastname = explode(" ", $last_name);
//            $name_usuario = ucfirst($data_sesion_user->name) . ' ' . ucfirst($data_sesion_user->lastname);
            $name_usuario = $data_users_plans_Form['txtNombreTitular'].' '.$data_users_plans_Form['txtApellidosTitular'];
            $count = 0;

            $planvalidate = $this->getIsvalidPlant($plan_name);
            $data_user_view = array(
                'plans' => $data_sesion_user->plans,
                'saldo_disponible' => $saldo_disponible,
                'mis_vehiculos' => count($vehiculos),
                'cuentas_asociadas' => $cuentas_asociadas,
                'document_type' => $document_type,
                'document_number' => $document_number,
                'name' => $firts_name,
                'lastname' => $last_name,
                'email' => $username,
                'individual' => $individual,
                'plan_name' => \Application\Service\CuentaService::getPlanTitle($plan_name),
                'plan' => $planvalidate,
                'resumen' => $resumen,
                'editCuenta' => $edit,
                'solicitudes' => true,
                'bloqueado' => true,
                'dataPaquetes' => $dataPaquetes,
                'recargadirecta' => $recargadirecta,
                'formActualizar' => $formActualizarAvanzado,
                'ultimas_recargas' => $ultimas_recargas,
                'solo_recargas' => $solo_recargas,
                'accounts' => $data_users_plans,
                'vehicles' => $vehicles,
                'account_id' => substr_replace($account_id, '.', 2, 0),
                'requerido' => false,
                'recarga' => $recarga,
                'mis_datos' => $mis_datos,
                'LisSolicitudes' => $this->getListSolicitudes(),
                'active_lima' => $active_lima
            );
            $this->layout()->setVariable('formSolicitud', new SolicitudForm());
            //  $this->layout()->setVariable('recarga', $recarga);
        } elseif ($role == "usuario_recarga") {
            $sessionAfiliacion = new Container('sesion_usuario_only_recarga');
            $sessionAfiliacion->offsetSet('role', $data_sesion_user->role);
            $sessionAfiliacion->offsetSet('id', $data_sesion_user->id);
            $sessionAfiliacion->offsetSet('tag', $data_sesion_user->tag);
            $sessionAfiliacion->offsetSet('placa', $data_sesion_user->placa);
            $sessionAfiliacion->offsetSet('idPlan', $data_sesion_user->idPlan);
            $button = false;
            $name_usuario = "Usuario Invitado";
            $plan_name = $data_users_plans[0]['plan_name'];
            $planvalidate = $this->getIsvalidPlant($plan_name);

            $data_user_view = array(
                'usuario_invitado' => true,
                'recargadirecta' => true,
                'plan_name' => \Application\Service\CuentaService::getPlanTitle($plan_name),
                'dataPaquetes' => $dataPaquetes,
                'users_plans' => $data_users_plans,
                'account_id' => substr_replace($account_id, '.', 2, 0)
            );
            $this->layout()->setVariable('invitado', true);
        }
        $dataUserHaveAccount = $this->checkHaveAccountWithEmail($default_account);
        $data_sesion_user->planTitle = \Application\Service\CuentaService::getPlanTitle($plan_name);
        // parametros para la session de compra /afiliacion
        $sessionAfiliate = new Container('afiliacion');
        $sessionAfiliate->idPlan = $idPlan;
        $sessionAfiliate->idUserPlan = $id;
        $sessionAfiliate->idUser = $idusuario;
        $sessionAfiliate->offsetSet('flagTipoAfiliacion', 2);
        $sessionAfiliate->offsetSet('idAccount', $account_id);
        $sessionAfiliate->numVehicles = $mis_vehiculos;
        $sessionAfiliate->recarga = true;
        $sessionAfiliate->title = str_replace('Plan ', "",
                \Application\Service\CuentaService::getPlanTitle($plan_name));

        $sessionAfiliate->urlError = '/mi-cuenta/recarga-directa';
        $sessionAfiliate->token = md5(rand());
        //////
        $sessionAfiliate->offsetSet('flagUserCorporativo', $planvalidate);
        $sessionAfiliate->offsetSet('txtRazonSocialC',
                $data_users_plans_Form['txtRazonsocial']);
        $sessionAfiliate->offsetSet('txtNumDocumentoC',
                $data_users_plans_Form['txtNumDocumento']);
        //////
        $data_user_view['sessionAfiliate'] = $sessionAfiliate;
        $data_user_view['token'] = $sessionAfiliate->token;
        $data_user_view['haveAccountWithEmail'] = $dataUserHaveAccount['haveAccountWithEmail'];
        $data_user_view['isCheckEmail'] = $dataUserHaveAccount['isCheckEmail'];
        $this->layout()->setVariable('name_user',
                ($planvalidate) ? $data_users_plans_Form['txtRazonsocial'] : $name_usuario);
        $this->layout()->setVariable('accounts', $data_users_plans);
        $this->layout()->setVariable('cuenta', true);
        $this->layout()->setVariable('button', $button);
        $this->layout()->setVariable('acount_id', $account_id);

        $this->layout()->setVariable('userData', $data_sesion_user);
        $this->layout()->setVariable('usuario_invitado',
                isset($data_user_view['usuario_invitado']) ? true : false);

        return new ViewModel($data_user_view);

    }

    /* Se solicito filtrar por la palabra "Recarga" en red_Description */

    private function getSoloRecargas($ultimas_recargas)
    {
        $soloRecargas = array();
        foreach ($ultimas_recargas as $key => $value):
            if (strpos($value['req_Description'], "Recarga") !== FALSE) {
                $soloRecargas[] = $value;
            }
        endforeach;
        return $soloRecargas; //$this->record_sort($soloRecargas, 'req_Time', false);

    }

    private function getPaquetesIdPlan($idPlan)
    {
        $mpe = $this->getServiceLocator()->get('mpe');
        //$Paquetes = $mpe->getPaquetesAfiliacion(['familiar', 'individual', 'corporativo'],true);

        $paquetes_mpe = $mpe->getAllPromotionsByPlanByProduct(array('req_ProductId' => 1, 'req_PlanId' => $idPlan));
        if ($paquetes_mpe->code == 200 && $paquetes_mpe->status == 'ok') {
            $dataPackages = $this->getDataPackages($paquetes_mpe->data);
            $packages = $this->setDataPackage($dataPackages);
        } else {
            $packages = array();
        }

        //$productosGetAccountID = $this->GetXIDplanbeta($Paquetes, $idPlan);
        return $packages;

    }

    private function getDataPackages($data)
    {
        $response = array();
        foreach ($data as $key => $value) {
            if ($key == "req_PromotionFeeRecharge" && !is_numeric($key)) {
                return $value;
            } else {
                if (is_array($value) || is_object($value)) {
                    $response = $this->getDataPackages($value);
                    if (!empty($response)) {
                        return $response;
                    }
                }
            }
        }
        return $response;

    }

    private function setDataPackage($packages)
    {

        foreach ($packages as $package) {
            $package->total = $package->req_AmountIni / 100;
            $package->tasaRecarga = $package->req_Value / 100;
            $package->saldoUso = $package->total - $package->tasaRecarga;
        }
        return $packages;

    }

    private function getUltimarRecargas($mpe, $account_id)
    {
        $Date = date("Ymd");
        $idplanUser = 0;
        $req_EndDate = date("Ymd", strtotime('1 days', strtotime($Date)));
        $req_StartDate = date("Ymd",
                strtotime('-15 months', strtotime($req_EndDate)));
        $ultimas_recargas = $this->UltimarRecargas($mpe->getMovementsByAccount(
                        array(
                            'req_AccountId' => $account_id,
                            'req_StartDate' => $req_StartDate,
                            'req_EndDate' => $req_EndDate,
                ))
        );
        return $ultimas_recargas;

    }

    private function getUsuarioSession($data_users_plans_Form)
    {
        $auth = $this->getServiceLocator()->get('AuthService');

        if (!$auth->hasIdentity()) {
            return $this->redirect()->toRoute('home');
        }
        $this->layout()->setVariable('recarga', true);

        $data_sesion_user = $auth->getStorage()->read();
        $name_usuario = ucfirst($data_sesion_user->name) . ' ' . ucfirst($data_sesion_user->lastname);
        $planvalidate = $this->getIsvalidPlant($data_users_plans_Form['txtPlanName']);
        $this->layout()->setVariable('name_user',
                ($planvalidate) ? $data_users_plans_Form['txtRazonsocial'] : $name_usuario);

    }

    public function checkHaveAccountWithEmail($account)
    {
//        $user_plans = $this->getServiceLocator()->get('UsersModel');
//        $account = $user_plans->getUser($idusuario);
        $haveAccountWithEmail = false;
        $isCheckEmail = false;

        if ($account['password'] != '') {
            $haveAccountWithEmail = true;
        }
        if ($account['email_check']) {
            $isCheckEmail = true;
        }
        if (empty($account['txtCorreo'])) {
            $haveAccountWithEmail = false;
        }
        if (filter_var($account['txtCorreo'], FILTER_VALIDATE_EMAIL) === false) {
            $haveAccountWithEmail = false;
        }

        $data = array(
            'haveAccountWithEmail' => $haveAccountWithEmail,
            'isCheckEmail' => $isCheckEmail,
        );
        return $data;

    }

    public function cambiarCuentaAction()
    {
        $idPlan = $this->get('idPlan');
        $this->_cambiarCuenta($idPlan);

    }

    private function _cambiarCuenta($idPlan)
    {
        $auth = $this->getServiceLocator()->get('AuthService');
        $user_plans = $this->getServiceLocator()->get('UserPlansModel');
        $data_sesion_user = $auth->getStorage()->read();
        $plan = $user_plans->getPlan($idPlan);
        $data_sesion_user->plan = $plan;
        $data_sesion_user->idPlan = $plan['plan_id'];
        $data_sesion_user->account_id = $plan['account_id'];

    }

    public function reportesAction()
    {
        $auth = $this->getServiceLocator()->get('AuthService');

        if (!$auth->hasIdentity()) {
            return $this->redirect()->toRoute('home');
        }

        $data_sesion_user = $auth->getStorage()->read();
        $recarga = new Container('recarga');
        $user_plans = $this->getServiceLocator()->get('UserPlansModel');
        $transitoModel = $this->getServiceLocator()->get('TransitosModel');
        $data_users_plans = $user_plans->getPlansbyUser($data_sesion_user->id);
        $plan_name = $data_users_plans[0]['plan_name'];
        foreach ($data_users_plans as $key => $value) {
            if ($data_sesion_user->account_id == $value['account_id']) {
                $name_usuario = ucfirst($data_sesion_user->name) . ' ' . ucfirst($data_sesion_user->lastname);
                if ($this->getIsvalidPlant($value['plan_name'])) {
                    $name_usuario = ($value['razon_social']);
                }
                $id = $value['id'];
                $idPlan = $value['plan_id'];
                $idPlan = $value['plan_id'];
            }
        }
        $planvalidate = $this->getIsvalidPlant($plan_name);


        $mpe = $this->getServiceLocator()->get('mpe');

        $Reportes = true;
        $Transacciones = false;
        $reportesTransito = array();

        //$req_EndDate = date("Ymd");
        $req_EndDate = date("Ymd", strtotime("+1 day"));
        $req_StartDate = date("Ymd",
                strtotime('-1 months', strtotime($req_EndDate)));
        $reportesMovimiento = $this->Movimientos($mpe->getMovementsByAccount(
                        array(
                            'req_AccountId' => $data_sesion_user->account_id,
                            'req_StartDate' => $req_StartDate,
                            'req_EndDate' => $req_EndDate,
        )));
        $reportesTransito = $transitoModel->getTransitosByAccount((int) $data_sesion_user->account_id);
        $transitoProcesado[] = $this->procesarTransitos($reportesTransito);

        $formReportes = new \Application\Form\Reportes($reportesMovimiento,
                $this->getServiceLocator());
        $formTransitos = new \Application\Form\Transitos($transitoProcesado,
                $this->getServiceLocator());


        $data_user_view = array(
            'movimiento' => $reportesMovimiento,
            'transito' => $transitoProcesado,
            'formReportes' => $formReportes,
            'formTransitos' => $formTransitos,
            'Reportes' => $Reportes,
            'Transacciones' => $Transacciones,
        );

        $this->layout()->setVariable('name_user', $name_usuario);

        $this->layout()->setVariable('accounts', $data_users_plans);
        $this->layout()->setVariable('cuenta', true);
        $recarga->recarga = true;
        $this->layout()->setVariable('recarga', $recarga->recarga);
        $this->layout()->setVariable('button', true);

        return new ViewModel($data_user_view);

    }

    private function procesarTransitos($transitos)
    {
        $result = array();
        if (count($transitos) > 0) {
            foreach ($transitos as $key => $value) {
                $value['AMOUNT'] = number_format($value['AMOUNT'] / 100, 2, '.',
                        '');
                $result[] = $value;
            }
        }
        return $result;

    }

    private function getnameUser()
    {
        
    }

    public function ajaxMisDatosAction()
    {
        $data = array();
        if ($this->getRequest()->isPost()) {
            $post = $this->getRequest()->getPost();
            $user_plans = $this->getServiceLocator()->get('UserPlansModel');
            $data = $user_plans->getPlansbyUserForm($post['id_cuenta_ajax']);
        }
        return new JsonModel($data);

    }

    public function vehiculosAction()
    {
        $auth = $this->getServiceLocator()->get('AuthService');
        if (!$auth->hasIdentity()) {
            return $this->redirect()->toRoute('home');
        }
        $recarga = new Container('recarga');

        $mpe = $this->getServiceLocator()->get('mpe');

        $data_sesion_user = $auth->getStorage()->read();
        $plan_name = $this->getIsvalidPlant($data_sesion_user->plans['txtPlanName']);
        $planvalidate = $this->getIsvalidPlant($plan_name);
        $name_usuario = ucfirst($data_sesion_user->name) . ' ' . ucfirst($data_sesion_user->lastname);
        if (isset($data_sesion_user->id)) {
            $idusuario = $data_sesion_user->id;
        } else {
            $idusuario = $data_sesion_user->user_id;
        }

        $user_plans = $this->getServiceLocator()->get('UserPlansModel');

        //$data_users_plans = $user_plans->getPlansbyUser($data_sesion_user->id);
        $data_users_plans = $user_plans->getPlansbyUser($idusuario);
        $data_users_plans_Form = $user_plans->getPlansbyUserForm($data_sesion_user->id);

        $default_account = $data_users_plans_Form;
        //$account_id = isset($data_sesion_user->account_id) ? $data_sesion_user->account_id : $default_account['account_id'];
        $account_id = isset($data_sesion_user->account_id) ? $data_sesion_user->account_id : $data_users_plans[0]['account_id'];

        $ActualizarVehiculo = new ActualizarVehiculo();

        $BusquedaVehiculo = new BusquedaVehiculos();
        $opcionesSelect = $BusquedaVehiculo->get("bslxEstado")->getValueOptions();

        $request = $this->getRequest();

        if ($request->isPost()) {
            $datos = $request->getPost();
            if (isset($datos['txtCuenta']) && $datos['txtCuenta'] != '' && $datos['txtColor'] != '' &&
                    $datos['slxTipo'] != '0' && $datos['slxMarca'] != '0' && $datos['slxModelo'] != '0') {

                $mpe->modifyVehicleData(array(
                    'req_AccountId' => $datos['txtCuenta'],
                    'req_VehicleId' => $datos['vehiculo_id'],
                    'req_VehClass' => $datos['slxTipo'],
                    'req_Plate' => $datos['txtPlaca'],
                    'req_Make' => $datos['texto_marca'],
                    'req_Model' => $datos['texto_modelo'],
                    'req_Colour' => $datos['txtColor']));
                $mpe->getMembersByAccount(array('req_AccountId' => $account_id),
                        TRUE);
                $vehicleModel = $this->getServiceLocator()->get('VehiclesModel');
                $vehicleModel->updateVehicle($datos);
                $this->flashMessenger()->addSuccessMessage('Vehículo actualizado.');
                $this->redirect()->toRoute('vehiculos');
            } else {
                $this->flashMessenger()->addSuccessMessage('Intentelo más tarde.');
                $this->redirect()->toRoute('vehiculos');
            }
        }
        if (isset($account_id) && !is_null($account_id)) {
            $mis_vehiculos = $mpe->getMembersByAccount(array('req_AccountId' => $account_id));
            $vehiculos = $this->procesarVehiculos($account_id, $mis_vehiculos,
                    $opcionesSelect);
        } else {
            $vehiculos = array();
        }

        //creacion de select con data obtenida del webservice
        /*         * ******************************************************************* */
        $dataCuenta['']['value'] = '';
        $dataCuenta['']['label'] = 'Todos';

        $dataPlaca['']['value'] = '';
        $dataPlaca['']['label'] = 'Todos';

        $dataTag['']['value'] = '';
        $dataTag['']['label'] = 'Todos';

        $dataMarca['']['value'] = '';
        $dataMarca['']['label'] = 'Todos';

        $dataModelo['']['value'] = '';
        $dataModelo['']['label'] = 'Todos';

        if (count($vehiculos) > 0) {
            foreach ($vehiculos as $key => $value):
                if (array_search($value["cuenta"],
                                array_column($dataCuenta, 'label')) == FALSE) {
                    $dataCuenta[$key]['value'] = $value["cuenta"];
                    $dataCuenta[$key]['label'] = $value["cuenta"];
                }

                $dataPlaca[$key]['value'] = $value["placa"];
                $dataPlaca[$key]['label'] = $value["placa"];

                if ($value["tag"] != '') {
                    $dataTag[$key]['value'] = $value["tag"];
                    $dataTag[$key]['label'] = $value["tag"];
                }

                $dataMarca[$key]['value'] = strtoupper($value["marca"]);
                $dataMarca[$key]['label'] = strtoupper($value["marca"]);

                $dataModelo[$key]['value'] = $value["modelo"];
                $dataModelo[$key]['label'] = $value["modelo"];
            endforeach;
        }
        $BusquedaVehiculo->get('bslxCuenta')->setValueOptions($dataCuenta);
        $BusquedaVehiculo->get('bslxPlaca')->setValueOptions($dataPlaca);
        $BusquedaVehiculo->get('bslxTag')->setValueOptions($dataTag);
        $BusquedaVehiculo->get('bslxMarca')->setValueOptions($this->valuesUniqueArray($dataMarca));
        $BusquedaVehiculo->get('bslxModelo')->setValueOptions($this->valuesUniqueArray($dataModelo));
        /*         * ******************************************************************* */

        $ac = $this->getServiceLocator()->get('Epass\Model\AClassTable');
        $tipoVehiculo = $ac->getData(array('TOLLCOMPANY' => \Epass\Model\AClassTable::TOLLCOMPANY));

        $dataTipo['']['value'] = '0';
        $dataTipo['']['label'] = 'Seleccionar Tipo';
        $dataTipo['']['attributes'] = array('data-type' => '0');

        foreach ($tipoVehiculo as $key => $rowVehiculo) {
            $dataTipo[$key]['value'] = $rowVehiculo['CLASS'];
            $dataTipo[$key]['label'] = $rowVehiculo['DESCRIPTION'];
            $dataTipo[$key]['attributes'] = array('data-type' => $rowVehiculo['TYPE']);
        }

        $ActualizarVehiculo->get('slxTipo')->setValueOptions($dataTipo);
        $ActualizarVehiculo->get('slxMarca')->setValueOptions(array('' => 'Seleccionar Marca'));
        $ActualizarVehiculo->get('slxModelo')->setValueOptions(array('' => 'Seleccionar Modelo'));

        $recarga->recarga = true;
        $datos = array(
            'vehiculos' => $vehiculos,
            'formActualizarVehiculo' => $ActualizarVehiculo,
            'formBuscarVehiculo' => $BusquedaVehiculo);
        $this->getUsuarioSession($data_sesion_user->plans);
        $user_plans = $this->getServiceLocator()->get('UserPlansModel');
        $this->layout()->setVariable('button', true);

        $this->layout()->setVariable('recarga', $recarga->recarga);
        $name_usuario = ucfirst($data_sesion_user->name) . ' ' . ucfirst($data_sesion_user->lastname);

        $this->layout()->setVariable('accounts', $data_users_plans);

        return new ViewModel($datos);

    }
    
    public function valuesUniqueArray($array){
        $data_unique = array_map("unserialize", array_unique(array_map("serialize", $array)));
        return $data_unique;
    }

    public function vehiculoAction()
    {
        $data = [
            'code' => 200,
            'flag' => 0,
            'mensaje' => 'Error, no es peticion post'
        ];
        if ($this->getRequest()->isPost()) {
            $post = $this->getRequest()->getPost();
            if (isset($post['id_vehiculo']) && isset($post['account_id'])) {

                $BusquedaVehiculo = new BusquedaVehiculos();
                $opcionesSelect = $BusquedaVehiculo->get("bslxEstado")->getValueOptions();
                try {
                    $mpe = $this->getServiceLocator()->get('mpe');
                    $mis_vehiculos = $mpe->getMembersByAccount(array('req_AccountId' => $post['account_id']));
                    $vehiculos = $this->procesarVehiculos($post['account_id'],
                            $mis_vehiculos, $opcionesSelect);
                    $key = array_search($post['id_vehiculo'],
                            array_column($vehiculos, 'placa'));
                    $data['mensaje'] = $vehiculos[$key];
                } catch (Exception $ex) {
                    $data['mensaje'] = array('cuenta' => '');
                }
            } else {
                $data['flag'] = 3;
                $data['mensaje'] = 'Datos no valido';
            }
        }

        return new JsonModel($data);

    }

    public function procesarVehiculos($account_id, $mis_vehiculos, $opcionesSelect)
    {
        $vehiculos = array();
        if (isset($mis_vehiculos->data) && count($mis_vehiculos->data) > 0) {
            if (count($mis_vehiculos->data) <= 1) {
                $data = array(
                    'vehiculo_id' => trim($mis_vehiculos->data->req_MemVeh) . trim($mis_vehiculos->data->req_Member),
                    'cuenta' => trim($account_id),
                    'placa' => trim($mis_vehiculos->data->req_Plate),
                    'tag' => trim($mis_vehiculos->data->req_Pan),
                    'estado_actual' => $opcionesSelect[trim($mis_vehiculos->data->req_Status)],
                    'marca' => trim($mis_vehiculos->data->req_Make),
                    'modelo' => trim($mis_vehiculos->data->req_Model),
                    'color' => trim($mis_vehiculos->data->req_Colour),
                    'tipo' => trim($mis_vehiculos->data->req_Class),
                );
                $vehiculos[] = $data;
            } else {
                foreach ($mis_vehiculos->data as $vehiculo):
                    $data = array(
                        'vehiculo_id' => trim($vehiculo->req_MemVeh) . trim($vehiculo->req_Member),
                        'cuenta' => trim($account_id),
                        'placa' => trim($vehiculo->req_Plate),
                        'tag' => trim($vehiculo->req_Pan),
                        'estado_actual' => $opcionesSelect[trim($vehiculo->req_Status)],
                        'marca' => trim($vehiculo->req_Make),
                        'modelo' => trim($vehiculo->req_Model),
                        'color' => trim($vehiculo->req_Colour),
                        'tipo' => trim($vehiculo->req_Class),
                    );
                    $vehiculos[] = $data;
                endforeach;
            }
        }
        return $vehiculos;

    }

    public function cuentasAsociadasAction()
    {
        $auth = $this->getServiceLocator()->get('AuthService');
        if (!$auth->hasIdentity()) {
            return $this->redirect()->toRoute('home');
        }
        $data_sesion_user = $auth->getStorage()->read();
        if (isset($data_sesion_user->id)) {
            $idusuario = $data_sesion_user->id;
        } else {
            $idusuario = $data_sesion_user->user_id;
        }
        $user_plans = $this->getServiceLocator()->get('UserPlansModel');
        $data_users_plans = $user_plans->getPlansbyUser($idusuario);
        if (isset($data_sesion_user->idPlan)) {
            $idPlan = $data_sesion_user->idPlan;
        } else {
            $idPlan = $data_users_plans[0]['plan_id'];
        }
        if ($data_sesion_user->role == "usuario") {
            $name_usuario = ucfirst($data_sesion_user->name) . " " . ucfirst($data_sesion_user->lastname);
        } else {
            
        }


        $this->layout()->setVariable('name_user', $name_usuario);
        $this->layout()->setVariable('accounts', $data_users_plans);
        $this->layout()->setVariable('cuenta', true);

        return new ViewModel();

    }

    public function comprobantesAction()
    {
        $recarga = new Container('recarga');
        $recarga->recarga = true;

        $auth = $this->getServiceLocator()->get('AuthService');
        $data_sesion_user = $auth->getStorage()->read();
        $name_usuario = ucfirst($data_sesion_user->name) . ' ' . ucfirst($data_sesion_user->lastname);
        $user_plans = $this->getServiceLocator()->get('UserPlansModel');

        $comprobante = $this->ListComprobantes($data_sesion_user->account_id);
        $form = new \Application\Form\Reportes($comprobante,
                $this->getServiceLocator());
        $view = array(
            'movimientos' => $comprobante,
            'formSelec' => $form
        );
        $data_users_plans = $user_plans->getPlansbyUser($data_sesion_user->id);

        $this->getUsuarioSession($data_sesion_user->plans);
        $this->layout()->setVariable('accounts', $data_users_plans);
        $this->layout()->setVariable('button', true);
        $this->layout()->setVariable('recarga', $recarga->recarga);

        return new ViewModel($view);

    }

    public function ListComprobantes($account_id)
    {
        $auth = $this->getServiceLocator()->get('AuthService');
        $config = $this->getServiceLocator()->get('config');
        $data_sesion_user = $auth->getStorage()->read();
        $razonSocial = $config['list-comprobantes']['razon-social-odebrecht'];

        $req_EndDate = date("Ymd", strtotime("+1 day"));
        $req_StartDate = date("Ymd",
                strtotime('-6 months', strtotime($req_EndDate)));
        $mpe = $this->getServiceLocator()->get('mpe');
        $movimientos = $mpe->getMovementsByAccount(
                array(
                    'req_AccountId' => $account_id,
                    'req_StartDate' => $req_StartDate,
                    'req_EndDate' => $req_EndDate,
        ));
        
        $movimientosRDLAccount = $mpe->getbillingRDLByAccount(
                array(
                    'req_AccountId' => $account_id,
                    'req_StartDate' => $req_StartDate,
                    'req_EndDate' => $req_EndDate,
                )
        );
        
        if ($movimientosRDLAccount->status == 'ok') {
            $movimientosRDL = $movimientosRDLAccount->data->billingRDLByAccountDefinition;
        } else {
            $movimientosRDL = array();
        }

        $result = array();
        if (isset($movimientos->data->movementsByAccountDefinition)) {
            foreach ($movimientos->data->movementsByAccountDefinition as $key => $value) {
                if ($value->req_PaymentType == 'A') {
                    continue;
                }
                $ano = substr($value->req_Time, 0, 4);
                $mes = substr($value->req_Time, 4, 2);
                $dia = substr($value->req_Time, 6, 2);
                $h = substr($value->req_Time, 8, 2);
                $m = substr($value->req_Time, 10, 2);
                $s = substr($value->req_Time, 12, 2);
                $value->datetime = "$ano-$mes-$dia $h:$m:$s";
                if (isset($value->req_ReceiptTime)) {
                    $value->datetime = $value->req_ReceiptTime;
                }
                $value->req_Amount = $value->req_Amount / 100;
                $value->medio_pago = \Application\Form\Reportes::$_medioPago[$value->req_PaymentType];
                //$value->medio_pago = \Application\Form\Reportes::$_medioPago[$value->req_PaymentMeans];
                $value->tipo = isset(\Application\Form\Reportes::$_tipoSelect [$value->req_PaymentType]) ? \Application\Form\Reportes::$_tipoSelect [$value->req_PaymentType] : '';
                $value->date = "$dia-$mes-$ano $h:$m:$s";

                if (isset($value->req_ReceiptSerieCorrelativo)) {
                    $cut = explode('-', $value->req_ReceiptSerieCorrelativo);
                    $value->serie = $cut[0];
                    $value->correlativo = $cut[1];
                }

                $comprobante = $this->validarComprobante(isset($value->req_ReceiptComprovante) ? $value->req_ReceiptComprovante : self::VACIO);

                $result[$key]['FECHAEMISION'] = $value->date;
                $result[$key]['COMPROBANTE'] = $comprobante;
                $result[$key]['EMP'] = $razonSocial;
                $result[$key]['MONTO'] = $value->req_Amount;
                $result[$key]['SERIE'] = isset($value->serie) ? $value->serie : self::VACIO;
                $result[$key]['CORRELATIVO'] = isset($value->correlativo) ? $value->correlativo : self::VACIO;
                $result[$key]['SERIE-CORRELATIVO'] = isset($value->req_ReceiptSerieCorrelativo) ? $value->req_ReceiptSerieCorrelativo : self::VACIO;
                $result[$key]['MES'] = \Application\Form\Reportes::$_meses[$mes] . ' - ' . $ano;
                $result[$key]['PERIODO'] = self::VACIO;
                $result[$key]['DESCRIPCION'] = $value->req_Description;
                $result[$key]['TYPE'] = isset($value->req_ReceiptType) ? $value->req_ReceiptType : self::VACIO;
                $result[$key]['TIME'] = $value->datetime;

                if (isset($value->req_ReceiptSerieCorrelativo)) {
                    $newData[$value->req_ReceiptSerieCorrelativo][] = $value->req_Amount;
                }

                if ($comprobante == self::NAME_RECIBO) {
                    $result[$key]['URL'] = self::VACIO;
                    if (isset($value->req_ReceiptBillingFile)) {
                        $flag = 2;
                        $result[$key]['URL'] = "data-flag={$flag} data-url={$value->req_ReceiptBillingFile}";
                    }
                } else {
                    if (isset($value->req_ReceiptStatus)) {
                        $result[$key]['STATUS'] = $value->req_ReceiptStatus;
                    } else {
                        $result[$key]['STATUS'] = self::STATUS_PENDING;
                    }
                }
            }
        }

        if (!empty($newData)) {
            foreach ($newData as $key => $value) {
                $valor[$key] = array_sum($value);
            }
        }

        foreach ($result as $key => $value) {
            if (array_key_exists($value['SERIE-CORRELATIVO'], $valor)) {
                $result[$key]['MONTOTOTAL'] = $valor[$value['SERIE-CORRELATIVO']];
            }
        }

        $result = $this->urlComprobante($result);

        if (!empty($movimientosRDL)) {
            $resultRDL = $this->comprobantesRDL($movimientosRDL);
            $result = array_merge($result,$resultRDL);
            usort($result, array($this,"ordArrayByFechas"));
        }
        return $result;
    }
    
    public function ordArrayByFechas($a, $b)
    {
        return strtotime($b["FECHAEMISION"]) - strtotime($a["FECHAEMISION"]);     
    }

    private function comprobantesRDL($data)
    {
        $config = $this->getServiceLocator()->get('config');
        $razonSocial = $config['list-comprobantes']['razon-social-rdl'];
        $ruc = $config['list-comprobantes']['ruc-rdl'];
        foreach ($data as $key => $value) {
            $value = (array) $value;
            if (isset($value['req_ReceiptSerieCorrelativo'])) {
                $cut = explode('-', $value['req_ReceiptSerieCorrelativo']);
                $serie = $cut[0];
                $correlativo = $cut[1];
            }

            if (preg_match('/F/', $serie)) {
                $comprobante = self::NAME_FACTURA;
                $type = self::CODE_FACTURA;
            }
            if (preg_match('/B/', $serie)) {
                $comprobante = self::NAME_BOLETA;
                $type = self::CODE_BOLETA;
            }
            if (!isset($comprobante)) {
                continue;
            }

            $ano = substr($value["req_ReceiptTime"], 0, 4);
            $mes = substr($value["req_ReceiptTime"], 4, 2);
            $dia = substr($value["req_ReceiptTime"], 6, 2);
            
            $monto =  $value["req_ReceiptAmount"] / 100;

            $result[$key]['FECHAEMISION'] = "$dia-$mes-$ano 00:00:00";
            $result[$key]['COMPROBANTE'] = $comprobante;
            $result[$key]['EMP'] = $razonSocial;
            $result[$key]['MONTO'] = $monto;
            $result[$key]['SERIE'] = isset($serie) ? $serie : self::VACIO;
            $result[$key]['CORRELATIVO'] = isset($correlativo) ? $correlativo : self::VACIO;
            $result[$key]['SERIE-CORRELATIVO'] = isset($value["req_ReceiptSerieCorrelativo"]) ? $value["req_ReceiptSerieCorrelativo"] : self::VACIO;
            $result[$key]['MES'] = \Application\Form\Reportes::$_meses[$mes] . ' - ' . $ano;
            $result[$key]['PERIODO'] = self::VACIO;

            $fecha = "$ano-$mes-$dia";
            $flag = 1;
            $params = "data-flag={$flag} data-ruc = {$ruc} data-folio={$correlativo} data-tipo={$type} "
                    . " data-serie={$serie} data-fecha={$fecha} data-monto={$monto} ";
            $result[$key]['URL'] = $params;
        }
        return $result;
    }

    private function validarComprobante($comprobante)
    {
        switch ($comprobante) {
            case self::RECIBO:
                $name = self::NAME_RECIBO;
                break;
            case self::FACTURA:
                $name = self::NAME_FACTURA;
                break;
            case self::BOLETA:
                $name = self::NAME_BOLETA;
                break;
            default :
                $name = self::VACIO;
                break;
        }
        return $name;

    }

    private function urlComprobante($result)
    {
        $config = $this->getServiceLocator()->get('config');
        $ruc = $config['list-comprobantes']['ruc-odebrecht'];
        $serieCorrelativo = $config['list-comprobantes']['serie-correlativo'];

        foreach ($result as $key => $value) {
            if ((!empty($value['COMPROBANTE']) && $value['COMPROBANTE'] !== self::NAME_RECIBO)) {
                if ($value['SERIE-CORRELATIVO'] !== $serieCorrelativo) {
                    if ($value['STATUS'] == self::STATUS_UPLOADED) {
                        if ($value['STATUS'] !== self::STATUS_CANCELLED) {
                            $fecha = date("Y-m-d", strtotime($value['TIME']));
                            $flag = 1;
                            $params = "data-flag={$flag} data-ruc = {$ruc} data-folio={$value['CORRELATIVO']} data-tipo={$value['TYPE']} "
                                    . " data-serie={$value['SERIE']} data-fecha={$fecha} data-monto={$value['MONTOTOTAL']} ";
                            $result[$key]['URL'] = $params;
                        } else {
                            $result[$key]['URL'] = self::VACIO;
                        }
                    } else {
                        $result[$key]['URL'] = self::VACIO;
                    }
                } else {
                    $result[$key]['URL'] = self::VACIO;
                }
            }
        }
        return $result;

    }

    public function generarComprobantesAction()
    {
        $data = [
            'code' => 200,
            'flag' => 0,
            'mensaje' => 'No eres Post xD'
        ];

        if ($this->getRequest()->isPost()) {
            $post = $this->getRequest()->getPost();
            $comprobante = $this->getServiceLocator()->get('comprobante');
            $params = [
                '_ruttEmpr' => $post['_ruttEmpr'],
                '_folioDTE' => $post['_folioDTE'],
                '_tipoDTE' => $post['_tipoDTE'],
                '_serieInte' => $post['_serieInte'],
                '_fechaDTE' => $post['_fechaDTE'],
                '_monTotal' => $post['_monTotal']
            ];
            $dataComprobante = $comprobante->getDocumentoPDF($params);
            if ($dataComprobante->status == 'ok') {
                $data['mensaje'] = 'Comprobante generado';
                $data['flag'] = 1;
                $data['url'] = $this->desencriptarPdf($dataComprobante->data,
                        $dataComprobante->name);
            } else {
                $data['mensaje'] = 'Comprobante no generado';
                $data['flag'] = 2;
                $msg = $dataComprobante->message;
                $data['URL'] = self::VACIO;
                $account = $this->getServiceLocator()->get('WebServicesCollection');
                $datos = [
                    'Services' => 'ComprobanteService',
                    'params' => $params,
                    'data' => $dataComprobante
                ];
                $account->saveWebServicesLog($datos);
            }
        }
        return new JsonModel($data);

    }

    private function desencriptarPdf($string, $name)
    {
        $g = $this->getServiceLocator()->get('google');
        $pdf_descriptado = base64_decode($string);
        $ruta_web = '/download/' . $name;
        $ruta_file = PUBLIC_PATH . $ruta_web;
        $pdf = file_put_contents($ruta_file, $pdf_descriptado);
        $ruta_web = '';
        if ($pdf !== 0) {
            $ruta_web = $g->upload($name);
            unlink($ruta_file);
        }
        return $ruta_web;

    }

    public function generarReciboAction()
    {
        $data = [
            'code' => 200,
            'flag' => 0,
            'mensaje' => 'No eres Post xD'
        ];
        if ($this->getRequest()->isPost()) {
            $post = $this->getRequest()->getPost();
            if (isset($post['txtRecibo'])) {
                $config = $this->getServiceLocator()->get('config');
                $g = $this->getServiceLocator()->get('google');
                $cut = explode('\\', $post['txtRecibo']);
                $url = str_replace('<parte-uno>', $cut[0],
                        $config['list-comprobantes']['url-recibo']);
                $url_remoto = str_replace('<parte-dos>', $cut[1], $url);
                $server = $config['list-comprobantes']['ftp']['server'];
                $user = $config['list-comprobantes']['ftp']['user'];
                $pass = $config['list-comprobantes']['ftp']['pass'];
                $port = $config['list-comprobantes']['ftp']['port'];
                $cid = ftp_connect($server, $port);
                $resultado = ftp_login($cid, $user, $pass);
                $data['mensaje'] = 'Recibo no generado';
                $data['flag'] = 2;
                if (!$cid || !$resultado) {
                    $data['mensaje'] = 'Sin Conexión FTP';
                    $data['flag'] = 3;
                }
                $ruta_file = PUBLIC_PATH . '/download/' . $cut[1];

                ftp_pasv($cid, true);
                if (ftp_get($cid, $ruta_file, $url_remoto, FTP_BINARY)) {
                    $data['mensaje'] = 'Recibo generado';
                    $data['flag'] = 1;
                    $data['url'] = $g->upload($cut[1]);
                    unlink($ruta_file);
                }
                ftp_close($cid);
            } else {
                $data = [
                    'code' => 200,
                    'flag' => 4,
                    'mensaje' => "no envias nada =("
                ];
            }
        }
        return new JsonModel($data);

    }

    private function elementosRepetidos($array)
    {
        $cantRep = 0;
        for ($a = 0; $a <= count($array) - 1; $a++) {
            for ($b = $a + 1; $b <= count($array) - 1; $b++) {
                if ($array[$a]['CORRELATIVO'] == $array[$b]['CORRELATIVO']) {
                    $cantRep++;
                    $array[$b]['borrar'] = true;
                }
            }
        }
        foreach ($array as $key => $value) {
            if (isset($value['borrar'])) {
                if ($value['borrar'] == true) {
                    unset($array[$key]);
                }
            }
        }

        return $array;

    }

    public function registroAction()
    {
        $auth = $this->getServiceLocator()->get('AuthService');
        $formdisable = array();
        if (!$auth->hasIdentity()) {
            return $this->redirect()->toRoute('home');
        }

        $data_sesion_user = $auth->getStorage()->read();
        $role = $data_sesion_user->role;
        $Cuentas = $this->getServiceLocator()->get('Application\Service\CuentaService');
        if ($data_sesion_user->role == 'usuario') {
            return $this->redirect()->toRoute('home');
        }
        $user_plans = $this->getServiceLocator()->get('UserPlansModel');

        $data_users_plans = $user_plans->getPlansbyUser($data_sesion_user->id);

        if (isset($data_sesion_user->idPlan)) {
            $idPlan = $data_sesion_user->idPlan;
        } else {
            $idPlan = $data_users_plans[0]['plan_id'];
        }
        $data_users_plans_Form = $user_plans->getPlansbyUserForm($data_users_plans[0]['id']);
        $formActualizarAvanzado = new ActualizarAvanzado($data_users_plans_Form,
                $this->getServiceLocator(), false);
        $tipoDocArray = $formActualizarAvanzado->get('tipoDoc')->getValueOptions();

        $formActualizarAvanzado->get('id')->setValue($data_users_plans_Form['id']);
        $formActualizarAvanzado->get('idUser')->setValue($data_users_plans_Form['idUser']);

        if ($role == "usuario_recarga" && $data_sesion_user->plans['tipoDoc'] == '00') {
            $indice = 'tipoDoc';
            $plan = true;
        } else {
            $indice = 'document_type_id';
            $plan = false;
            unset($tipoDocArray['00']);
        }

        $formActualizarAvanzado->get('tipoDoc')->setValueOptions($tipoDocArray);
        $bloqueado = false;
        $formActualizarAvanzado->get('tipoDoc')->setValueOptions($tipoDocArray);

        $dataform['idUser'] = $data_sesion_user->id;
        if ($this->getIsvalidPlant($data_sesion_user->plans['plan_name'])) {
            $dataform['tipoDoc'] = $data_sesion_user->plans[$indice];
//            $bloqueado = true;
        }
        $dataform['id'] = $data_sesion_user->plans['id'];

//        //// Mostrar datos cuando no es usuario anonimo
//        if(   $data_users_plans_Form['idDpto']!=''
//           && $data_users_plans_Form['idProvin']!=''
//           &&$data_users_plans_Form['idDistrito']!=''){
//            $dataform = $data_users_plans_Form;
//            if( trim($data_users_plans_Form['txtNombreTitular'])!=""){
//                $formdisable['txtNombreTitular']=false;
//            }
//            if( trim($data_users_plans_Form['txtApellidosTitular'])!=""){
//                $formdisable['txtApellidosTitular']=false;
//            }
//            if( trim($data_users_plans_Form['txtRazonsocial'])!=""){
//                $formdisable['txtRazonsocial']=true;
//            }
//            if( trim($data_users_plans_Form['tipoDoc'])!=""){
//                $formdisable['tipoDoc']=true;
//            }
//            if( trim($data_users_plans_Form['txtNumDocumento'])!=""){
//                $formdisable['txtNumDocumento']=true;
//            }
//            if( trim($data_users_plans_Form['txtCorreo'])!=""){
//                $formdisable['txtCorreo']=true;
//            }
//            if( trim($data_users_plans_Form['txtDireccion'])!=""){
//                $formdisable['txtDireccion']=true;
//            }
//            if( trim($data_users_plans_Form['txtReferencia'])!=""){
//                $formdisable['txtReferencia']=true;
//            }
//        }
        //  $formActualizarAvanzado->setData($dataform);
        $request = $this->getRequest();
        $config = $this->getServiceLocator()->get('config');

        if ($request->isPost()) {
            $datos = $request->getPost();
            if (isset($datos['id']) && is_numeric($datos['id'])) {
                $edit = true;
                $resumen = false;
                $formActualizarAvanzado->setData($datos);
                $datos['account_id'] = $data_users_plans[0]['account_id'];
                $datos['users_plans'] = $data_users_plans[0];
                //usuario
                $isvalidCorreo = $this->findUsers($datos['txtCorreo'],
                        $data_sesion_user->id);
                $datos['placa'] = $data_sesion_user->placa;

                if (!$isvalidCorreo) {
                    if ($formActualizarAvanzado->_isValid($datos) &&
                            $Cuentas->editar($datos)
                    ) {
                        $user = $this->getServiceLocator()->get('UsersModel');
                        $datos['url'] = $config['urlPath'] . $this->url()->fromRoute('verificacion-email',
                                        array('token' => $user->generarToken($datos['idUser'],
                                            3600)));
                        $data_sesion_user->name = $datos['txtNombreTitular'];
                        $data_sesion_user->lastname = $datos['txtApellidosTitular'];
                        $user_plans->setRemovePlansbyUserFormCache($data_users_plans[0]['id']);
                        $this->sendMessageRegistro('Registro Epass',
                                $datos['txtCorreo'], 'activacioncuenta.phtml',
                                $datos);

                        $this->flashMessenger()->addSuccessMessage('Se actualizo con exito');
                        $formActualizarAvanzado->setData($datos);
                        $this->redirect()->toRoute('cuenta');
                    } else {
                        $this->flashMessenger()->addErrorMessage('Intente nuevamete');
                        $formActualizarAvanzado->setData($datos);
                    }
                } else {
                    $this->flashMessenger()->addErrorMessage('El correo ya existe intente con otra cuenta de correo');
                    $formActualizarAvanzado->setData($datos);
                }
            }
        }
        $name_usuario = "Usuario Invitado";

        $data_user_view = array(
            'formActualizar' => $formActualizarAvanzado,
            'bloqueado' => $bloqueado,
            'registrar' => true,
            'requerido' => true,
            'plan' => $plan,
            'formdisable' => $formdisable,
            'active_lima' => 0
        );


        $this->layout()->setVariable('invitado', true);
        $this->layout()->setVariable('name_user', $name_usuario);
        $this->layout()->setVariable('accounts', array());
        $this->layout()->setVariable('cuenta', true);
        $this->layout()->setVariable('usuario_invitado', true);
        return new ViewModel($data_user_view);

    }

    public function getPlant($plan)
    {
        $vip = preg_match('/prepago vip/', strtolower($plan));
        $corporativo = preg_match('/corporativo/', strtolower($plan));

        $individual = preg_match('/individual 1/', strtolower($plan));
        $individual2 = preg_match('/individual 2/', strtolower($plan));

        $familiar = preg_match('/familiar 1/', strtolower($plan));
        $familiar2 = preg_match('/familiar 2/', strtolower($plan));

        if ($corporativo) {
            return 'CORPORATIVO';
        }
        if ($individual) {
            return 'INDIVIDUAL 1';
        }
        if ($individual2) {
            return 'INDIVIDUAL 2';
        }
        if ($familiar) {
            return 'FAMILIAR 1';
        }
        if ($familiar2) {
            return 'FAMILIAR 2';
        }
        if ($vip) {
            return 'VIP';
        }
        return $plan;

    }

    public function getIsvalidPlant($plan)
    {
        $corporativo = preg_match('/corporativo/', strtolower($plan));
        $individual = preg_match('/individual/', strtolower($plan));
        $familiar = preg_match('/familiar/', strtolower($plan));
        if ($corporativo) {
            return true;
        }
        if ($individual) {
            return false;
        }
        if ($familiar) {
            return false;
        }
        return false;

    }

    private function UpdateUserPlans($datos)
    {
        $userPlansModel = $this->getServiceLocator()->get('UserPlansModel');
        $data = [
            'user_id' => $datos['idUser'],
            'id' => $datos['id'],
            'document_type_id' => $datos['tipoDoc'],
            'document_number' => $datos['txtNumDocumento'],
            'department_id' => $datos['idDpto'],
            'province_id' => $datos['idProvin'],
            'district_id' => $datos['idDistrito'],
            'address' => $datos['txtNombVia'],
            'address_number' => $datos['txtNumVia'],
            'inside_address' => $datos['txtDptoVia'],
            'urbanization' => $datos['txtUrbanizacion'],
            'observations' => $datos['txtReferencia']
        ];
        $idUserPlan = $userPlansModel->saveUserPlans($data);
        return $idUserPlan;

    }

    private function UpdateUsers($datos)
    {
        $usersModel = $this->getServiceLocator()->get('UsersModel');
        $data = [
            'id' => $datos['idUser'],
            'name' => $datos['txtNombreTitular'],
            'lastname' => $datos['txtApellidosTitular'],
            //'email' => $datos['txtCorreo'],
            'password' => md5($datos['txtContrasenia']),
        ];
        $users = $usersModel->saveUser($data);
        return $users;

    }

    private function UltimarRecargas($datos)
    {
        $result = array();
        $dataSoap = isset($datos->data->movementsByAccountDefinition) ? $datos->data->movementsByAccountDefinition : array();
        $permitidos = array('G', 'H', 'I', 'J', 'L');
        foreach ($dataSoap as $key => $value) {
            if (in_array($value->req_PaymentType, $permitidos)) {
                $ano = substr($value->req_Time, 0, 4);
                $mes = substr($value->req_Time, 4, 2);
                $dia = substr($value->req_Time, 6, 2);
                $h = substr($value->req_Time, 8, 2);
                $m = substr($value->req_Time, 10, 2);
                $s = substr($value->req_Time, 12, 2);
                $value->datetime = "$ano-$mes-$dia $h:$m:$s";
                $value->req_Amount = $value->req_Amount / 100;
                $value->date = "$dia/$mes/$ano $h:$m:$s";
                $result[] = (array) $value;
            }
        }
        return $result;

    }

    private function Movimientos($datos)
    {

        if (isset($datos->code) && $datos->code == 0) {
            return array();
        }

        if (isset($datos->status) && $datos->status == 'fail') {
            return array();
        }

        $result = array();
        $dataSoap = (array) $datos->data->movementsByAccountDefinition;
        foreach ($dataSoap as $key => $value) {
            $ano = substr($value->req_Time, 0, 4);
            $mes = substr($value->req_Time, 4, 2);
            $dia = substr($value->req_Time, 6, 2);
            $h = substr($value->req_Time, 8, 2);
            $m = substr($value->req_Time, 10, 2);
            $s = substr($value->req_Time, 12, 2);
            $value->datetime = "$ano/$mes/$dia $h:$m:$s";
            $value->datetimeFormat = "$dia/$mes/$ano $h:$m:$s";
            $value->strotime = strtotime($value->datetimeFormat);
            $value->date = "$dia/$mes/$ano";
            //$value->req_Amount = $value->req_Amount / 100;
            $value->req_Amount = number_format($value->req_Amount / 100, 2, '.',
                    '');
            $value->tipo = $value->req_Description;
            $value->medio_pago = isset(\Application\Form\Reportes::$_medioPago[$value->req_PaymentType]) ? \Application\Form\Reportes::$_medioPago [$value->req_PaymentType] : '';

            $result[] = (array) $value;
            ;
        }
        return $this->record_sort($result, 'datetime', true);

    }

    private function record_sort($records, $field, $reverse = false)
    {
        $hash = array();

        foreach ($records as $key => $record) {
            $hash[$record[$field] . $key] = $record;
        }

        ($reverse) ? krsort($hash) : ksort($hash);

        $records = array();

        foreach ($hash as $record) {
            $records [] = $record;
        }

        return $records;

    }

    private function ordenarFecha($result)
    {
        
    }

    private function GetXIDplan($datos, $id)
    {
        $dataPlant = array();
        foreach ($datos as $key => $plan) {
            foreach ($plan as $key => $value) {
                if ((int) $value["idPlan"] == (int) $id) {
                    $dataPlant[] = $value;
                }
            }
        }
        return $dataPlant;

    }

    private function GetXIDplanbeta($datos, $planName)
    {
        $dataPlant = array();
        $planName = \Application\Service\CuentaService::getPlanTitle($planName);
        foreach ($datos as $key => $plan) {
            foreach ($plan as $key => $value) {
                $plannamemep = \Application\Service\CuentaService::getPlanTitle($value->namePlan);

                if ($plannamemep == $planName) {
                    $dataPlant[] = $value;
                }
            }
        }
        return $dataPlant;

    }

    private function getpagetePromociones()
    {

        $aPromotionModel = $this->getServiceLocator()->get('APromotionModel');
        $format = $aPromotionModel->getPaquetes();
        $paquetesIndividuales = array_merge($format[APlanTable::PREPAGO_INDIVIDUAL_1],
                array_slice($format[APlanTable::PREPAGO_INDIVIDUAL_2], -3));
        $paquetesFamiliares = array_merge($format[APlanTable::PREPAGO_FAMILIAR_1],
                $format[APlanTable::PREPAGO_FAMILIAR_2]);
        $paquetesPrePagoEmpresa = $format[APlanTable::PREPAGO_CORPORATIVO];
        $data = array($paquetesIndividuales,
            $paquetesFamiliares,
            $paquetesPrePagoEmpresa
        );
        return $data;

    }

    private function findUsers($correo, $id)
    {
        $usersModel = $this->getServiceLocator()->get('UsersModel');
        $id = $usersModel->findUsersByCorreoExist($correo, $id);
        return $id;

    }

    public function sendMessageRegistro($asunto, $email, $plantilla, $datos)
    {
        try {
            $usersModel = $this->getServiceLocator()->get('UsersModel');
            flog('sendMessageRegistro-idUser',$datos['idUser']);
            $name = $usersModel->getNameUserbyId($datos['idUser']);
            flog('sendMessageRegistro-name',$name);
            $dataMail = array(
                'asunto' => $asunto,
                'email' => $email,
                'tipo' => \Epass\Enum\EmailType::WITH_TEMPLATE,
                'template' => EMAIL_PATH . "/activacioncuenta.phtml",
                'data' => array('name'=>$name,'correo' => $email, 'url' => $datos['url']),
            );
            $envio = $this->getEventManager()->trigger(\Epass\Event\Listener::MAIL_EVENT,
                    $this, $dataMail);
            flog('sendMessageRegistro-envio',$envio);
            return true;
        } catch (Exception $e) {
            return false;
        }

    }

    /**
     * Tickets creados en Zendesk por usuario
     *
     * @return array
     */
    public function getListSolicitudes()
    {
        try {
            $authService = $this->getServiceLocator()->get('AuthService');
            $zendesk = $this->getServiceLocator()->get('zendesk');
            $table = $this->serviceLocator->get('SolicitudesModel');

            $user = $authService->getStorage()->read();
            $solicitudes = $table->getAllByUser($user->id);

            $ids = [];
            foreach ($solicitudes as $solicitud) {
                array_push($ids, $solicitud['ticket_id']);
            }

            $tickets = $zendesk->getTickets($ids);

            return $tickets;
        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }

    }

}
