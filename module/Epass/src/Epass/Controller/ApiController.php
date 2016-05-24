<?php

namespace Epass\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Epass\Model\Authentication;
use Firebase\JWT\JWT;
use Application\Form\ActualizarAvanzado;
use Application\Form\BusquedaVehiculos;
use Zend\Validator\EmailAddress;
use Zend\Session\Container;
use Application\Form\LoginRecargaForm;
use Application\Form\TagValidator;
use Application\Form\PlacaValidator;

class ApiController extends AbstractActionController {

    public function setResponseWithHeader($data) {
        $response = $this->getResponse();
        $response->getHeaders()
                ->addHeaderLine('Access-Control-Allow-Origin', '*')
                //->addHeaderLine('Access-Control-Allow-Methods','POST PUT DELETE GET')
                ->addHeaders(array('Content-Type' => 'application/json;charset=UTF-8'));
        $response->setContent(json_encode($data, JSON_UNESCAPED_UNICODE));
        return $response;
    }

    public function loginAction() {
        $data = [
            'code' => 200,
            'flag' => 0,
            'mensaje' => 'Error, no es peticion post'
        ];
        if ($this->getRequest()->isPost()) {
            try {
                $post = json_decode(file_get_contents('php://input'));
                /* $post = new \stdClass();
                  $post->username = 'ab@gmail.com';
                  $post->password = '1234'; */
                if (isset($post->username) && isset($post->password)) {
                    $validator = new EmailAddress();
                    if ($validator->isValid($post->username)) {
                        $auth = $this->getServiceLocator()->get('AuthService');
                        $authenticacion = new Authentication($auth, $this->getServiceLocator());
                        $authenticacion->VerifyUser($post);
                        if ($authenticacion->isOk()) {
                            $config = $this->getServiceLocator()->get('Config');
                            $data['flag'] = 1;
                            $user = $auth->getStorage()->read();
                            $datos = array(
                                "sub" => $post->username,
                                "iat" => time(),
                                //"exp" => time() + $config['api']['exp'],
                                "user" => $user
                            );
                            $key = $config['api']['secret'];
                            $jwt = JWT::encode($datos, $key);
                            $datos = $this->getMisDatos($user->id);
                            $planes = $this->getMisPlanes($user->id);
                            $data['mensaje'] = array(
                                'token' => $jwt,
                                'user' => $user,
                                'datos' => $datos,
                                'planes' => $planes
                            );
                        } else {
                            $data['flag'] = 2;
                            $data['mensaje'] = $authenticacion->getMessages();
                        }
                    } else {
                        $data['flag'] = 5;
                        $data['mensaje'] = 'Correo inválido';
                    }
                } else {
                    $data['flag'] = 3;
                    $data['mensaje'] = 'Datos no valido';
                }
            } catch (\Exception $e) {
                $data['flag'] = 4;
                $data['mensaje'] = $e->getMessage();
            }
        }
        return $this->setResponseWithHeader($data);
    }

    public function paquetesRecargaAction() {
        try {
            $mpe = $this->getServiceLocator()->get('mpe');
            $paquetes = $mpe->getPaquetesRecarga(['individual', 'familiar', 'corporativo']);
            foreach ($paquetes['individual'] as $key => $value) {
                $value = (array)$value;
                $value['namePlan1'] = \Application\Service\CuentaService::getPlanTitle($value['namePlan']);
                $individual[$key] = $value;
            }
            foreach ($paquetes['familiar'] as $key => $value) {
                $value = (array)$value;
                $value['namePlan1'] = \Application\Service\CuentaService::getPlanTitle($value['namePlan']);
                $familiar[$key] = $value;
            }
            foreach ($paquetes['corporativo'] as $key => $value) {
                $value = (array)$value;
                $value['namePlan1'] = \Application\Service\CuentaService::getPlanTitle($value['namePlan']);
                $corporativo[$key] = $value;
            }
            $datos = array((array) $individual,
                (array) $familiar,
                (array) $corporativo
            );
            $data['flag'] = 1;
            $data['mensaje'] = $datos;
        } catch (\Exception $e) {
            $data['flag'] = 4;
            $data['mensaje'] = $e->getMessage();
        }
        return $this->setResponseWithHeader($data);
    }

    public function procesar($post, $functionName) {
        $data = [
            'code' => 200,
            'flag' => 0,
            'mensaje' => 'Error, no es peticion post'
        ];
        if ($this->getRequest()->isPost()) {
            try {
                if (isset($post['token'])) {
                    $config = $this->getServiceLocator()->get('Config');
                    $key = $config['api']['secret'];
                    $decoded = JWT::decode($post['token'], $key, array('HS256'));
                    $data = $this->{$functionName}($decoded, $post);
                } else {
                    $data['flag'] = 69;
                    $data['mensaje'] = "Empty token";
                }
            } catch (\Exception $ex) {
                $data['flag'] = 69;
                $data['mensaje'] = $ex->getMessage();
            }
        }
        return $data;
    }

    public function misDatosAction() {
        $post = json_decode(file_get_contents('php://input'), true);
        $data = $this->procesar($post, "misDatos");
        return $this->setResponseWithHeader($data);
    }

    private function misDatos($decoded, $post = array()) {
        $data = array();
        $data['flag'] = 1;
        $data['mensaje'] = $this->getMisDatos($decoded->user->id);
        return $data;
    }

    private function getMisDatos($id) {
        $user_plans = $this->getServiceLocator()->get('UserPlansModel');
        $data_users_plans = $user_plans->getPlansbyUser($id);
        $user_plans->setRemovePlansbyUserFormCache($data_users_plans[0]['id']);
        return $user_plans->getPlansbyUserForm($data_users_plans[0]['id']);
    }

    public function editarMisDatosAction() {
        $post = json_decode(file_get_contents('php://input'), true);
        $data = $this->procesar($post, "editarMisDatos");
        return $this->setResponseWithHeader($data);
    }

    private function editarMisDatos($decoded, $post = array()) {
        $data_sesion_user = $decoded->user;
        $data = array();
        $data['flag'] = 2;
        $data['mensaje'] = 'Error inesperado';
        $datos = $post['data'];
        $idusuario = $datos['idUser'];
        $user_plans = $this->getServiceLocator()->get('UserPlansModel');
        $data_users_plans = $user_plans->getPlan($datos['account_id']);
        $account_id = $data_users_plans[0]['account_id'];
        if (isset($datos['id']) && is_numeric($datos['id'])) {
            $edit = true;
            $resumen = false;
            $formActualizarAvanzado = new ActualizarAvanzado($datos, $this->getServiceLocator());
            $datos['account_id'] = $account_id;
            $datos['users_plans'] = $data_users_plans[0];
            $Cuentas = $this->getServiceLocator()->get('Application\Service\CuentaService');
            if ($formActualizarAvanzado->_isValid($datos) && $Cuentas->editar($datos)) {
                $user_plans->setRemovePlansbyUserFormCache($datos['id']);
                $data['flag'] = 1;
                $data['mensaje'] = 'Se actualizó con éxito';
            } else {
                $data['flag'] = 2;
                $data['mensaje'] = 'Intente nuevamente';
            }
        }
        return $data;
    }

    public function cambiarClaveAction() {
        $post = json_decode(file_get_contents('php://input'), true);
        $data = $this->procesar($post, "cambiarClave");
        return $this->setResponseWithHeader($data);
    }

    private function cambiarClave($decoded, $post = array()) {
        $data_sesion_user = $decoded->user;
        $data = array();
        $data['flag'] = 2;
        $data['mensaje'] = 'Error inesperado';
        $datos = $post['data'];
        $userModel = $this->getServiceLocator()->get('UsersModel');
        if (isset($datos['idUser']) && !empty($datos['clave']) && !empty($datos['nuevaclave'])) {
            $user = $userModel->getUser($datos['idUser']);
            if ($user['password'] == md5($datos['clave'])) {
                $dataUser = [
                    'id' => $datos['idUser'],
                    'password' => md5($datos['nuevaclave']),
                ];
                if ($userModel->saveUser($dataUser)) {
                    $data['flag'] = 1;
                    $data['mensaje'] = 'Se actualizó con éxito';
                } else {
                    $data['flag'] = 2;
                    $data['mensaje'] = 'Intente nuevamente';
                }
            } else {
                $data['flag'] = 2;
                $data['mensaje'] = 'La contraseña es incorrecta';
            }
        } else {
            $data['flag'] = 2;
            $data['mensaje'] = 'Datos invalidos';
        }
        return $data;
    }

    public function misPlanesAction() {
        $post = json_decode(file_get_contents('php://input'), true);
        $data = $this->procesar($post, "misPlanes");
        return $this->setResponseWithHeader($data);
    }

    private function misPlanes($decoded, $post = array()) {
        $data = array();
        $data['flag'] = 1;
        $data['mensaje'] = $this->getMisPlanes($decoded->user->id);
        return $data;
    }

    private function getMisPlanes($id) {
        $user_plans = $this->getServiceLocator()->get('UserPlansModel');
        $mpe = $this->getServiceLocator()->get('mpe');
        $data_users_plans = $user_plans->getPlansbyUser($id);
        $res = array();
        foreach ($data_users_plans as $value) {
            $mpe->RemoveCacheGetSaldoByAccount($value["account_id"]);
            $saldo = $mpe->getSaldoByAccount(array('req_AccountId' => $value["account_id"]));
            $saldos = 0;
            if ($saldo->status == 'ok') {
                $saldos = $saldo->data->saldo;
            }
            $mis_vehiculos = $mpe->getMembersByAccount(array('req_AccountId' => $value["account_id"]));
            $BusquedaVehiculo = new BusquedaVehiculos();
            $opcionesSelect = $BusquedaVehiculo->get("bslxEstado")->getValueOptions();
            $vehiculos = $this->procesarVehiculos($value["account_id"], $mis_vehiculos,
                    $opcionesSelect);            
            $value['saldo'] = number_format($saldos / 100, 2);
            $value['plan_name'] = \Application\Service\CuentaService::getPlanTitle($value['plan_name']);
            $value['vehiculos'] = $vehiculos;
            $data_users_plans_Form = $user_plans->getPlansbyUserForm($value["id"]);
            $data_cuenta=$mpe->getAccountData(array('req_AccountId'=>$value["account_id"]));
            $individual=true;
            if(isset($data_cuenta->data)){
                $arrayData=array('tipoDoc'=>$data_cuenta->data->req_DocType,
                'txtNumDocumento'=>$data_cuenta->data->req_DocNumber,
                'txtNombreTitular'=>$data_cuenta->data->req_Forename,
                'txtApellidosTitular'=>$data_cuenta->data->req_Surname);
                $data_users_plans_Form =  array_merge($data_users_plans_Form,$arrayData);
                $individual=$data_cuenta->data->req_Individual;
            }
            $value['data'] = $data_users_plans_Form;
            $value['individual'] = $individual;
            $res[$value['id']] = $value;
        }
        return $res;
    }

    private function getMisPlanesbyUserRecarga($id, $placa) {
        $user_plans = $this->getServiceLocator()->get('UserPlansModel');
        $mpe = $this->getServiceLocator()->get('mpe');
        $data_users_plans = $user_plans->getPlansbyUserRecarga($id, trim($placa));
        $res = array();
        foreach ($data_users_plans as $value) {
            $saldo = $mpe->getSaldoByAccount(array('req_AccountId' => $value["account_id"]));
            $saldos = 0;
            if ($saldo->status == 'ok') {
                $saldos = $saldo->data->saldo;
            }
            $value['saldo'] = number_format($saldos / 100, 2);
            $value['plan_name'] = \Application\Service\CuentaService::getPlanTitle($value['plan_name']);
            $res[$value['id']] = $value;
        }
        return $res;
    }

    public function misVehiculosAction() {
        $post = json_decode(file_get_contents('php://input'), true);
        $data = $this->procesar($post, "misVehiculos");
        return $this->setResponseWithHeader($data);
    }

    private function misVehiculos($decoded, $post = array()) {
        $datos = $post['data'];
        $account_id = $datos['account_id'];
        if (isset($account_id) && !empty($account_id)) {
            $mpe = $this->getServiceLocator()->get('mpe');
            $BusquedaVehiculo = new BusquedaVehiculos();
            $opcionesSelect = $BusquedaVehiculo->get("bslxEstado")->getValueOptions();
            $mis_vehiculos = $mpe->getMembersByAccount(array('req_AccountId' => $account_id));
            $vehiculos = $this->procesarVehiculos($account_id, $mis_vehiculos, $opcionesSelect);
        } else {
            $vehiculos = array();
        }
        $data['flag'] = 1;
        $data['mensaje'] = $vehiculos;
        return $data;
    }

    public function procesarVehiculos($account_id, $mis_vehiculos, $opcionesSelect) {
        $vehiculos = array();
        if (isset($mis_vehiculos->data) && count($mis_vehiculos->data) > 0) {
            if (count($mis_vehiculos->data) <= 1) {
                $data = array(
                    'vehiculo_id' => $mis_vehiculos->data->req_MemVeh . $mis_vehiculos->data->req_Member,
                    'cuenta' => $account_id,
                    'placa' => $mis_vehiculos->data->req_Plate,
                    'tag' => $mis_vehiculos->data->req_Pan,
                    'estado_actual' => $opcionesSelect[$mis_vehiculos->data->req_Status],
                    'marca' => $mis_vehiculos->data->req_Make,
                    'modelo' => $mis_vehiculos->data->req_Model,
                    'color' => $mis_vehiculos->data->req_Colour,
                    'tipo' => $mis_vehiculos->data->req_Class,
                );
                $vehiculos[] = $data;
            } else {
                foreach ($mis_vehiculos->data as $vehiculo):
                    $data = array(
                        'vehiculo_id' => $vehiculo->req_MemVeh . $vehiculo->req_Member,
                        'cuenta' => $account_id,
                        'placa' => $vehiculo->req_Plate,
                        'tag' => $vehiculo->req_Pan,
                        'estado_actual' => $opcionesSelect[$vehiculo->req_Status],
                        'marca' => $vehiculo->req_Make,
                        'modelo' => $vehiculo->req_Model,
                        'color' => $vehiculo->req_Colour,
                        'tipo' => $vehiculo->req_Class,
                    );
                    $vehiculos[] = $data;
                endforeach;
            }
        }
        return $vehiculos;
    }

    public function recuperarAction() {
        $data = [
            'code' => 200,
            'flag' => 0,
            'mensaje' => 'Error, no es peticion post'
        ];
        if ($this->getRequest()->isPost()) {
            try {
                $post = json_decode(file_get_contents('php://input'), true);
                $auth = $this->getServiceLocator()->get('AuthService');
                
                $email = trim($post['username']);
                $validator = new EmailAddress();
                if ($validator->isValid($email)) {
                    $authenticacion = new Authentication($auth, $this->getServiceLocator());
                    $authenticacion->VerifyEmail($post);
                    if ($authenticacion->isOk()) {
                        $user_plans = $this->getServiceLocator()->get('UsersModel');
                        $name = $user_plans->getNameUserbyEmail($email);
                        $data_encrypt = $this->generateKeysUrl($email);
                        $this->saveKeys($email, $data_encrypt['selector_user'], $data_encrypt['token']);
                        $data = array(
                            'name'=>$name,
                            'email' => $email,
                            'url' => $data_encrypt['url']
                        );
                        if ($this->sendMessage('Recuperar contraseña', 'recuperarpassword.phtml', $email, $data)) {
                            $data['flag'] = 1;
                            $data['mensaje'] = "Hemos enviado un mail a tu correo $email con un enlace. Por favor, haz click para restablecer tu contraseña.";
                        } else {
                            $data['flag'] = 4;
                            $data['mensaje'] = "Ocurrió un error inesperado. Por favor vuelva a intentarlo";
                        }
                    } else {
                        $data['flag'] = 4;
                        $data['mensaje'] = $authenticacion->getMessages();
                    }
                } else {
                    $data['flag'] = 4;
                    $data['mensaje'] = 'Correo inválido';
                }
            } catch (\Exception $e) {
                $data['flag'] = 4;
                $data['mensaje'] = $e->getMessage();
            }
        }
        return $this->setResponseWithHeader($data);
    }

    public function generateKeysUrl() {
        $config = $this->getServiceLocator()->get('config');
        $controller = $config['urlPath'] . "/change-password/recuperar/";

        $selector_user = random_bytes(8);
        $token = random_bytes(32);

        $url = $controller . bin2hex($selector_user) . "$" . bin2hex($token);
        $data = array(
            'selector_user' => $selector_user,
            'token' => $token,
            'url' => $url,
        );

        return $data;
    }

    public function saveKeys($email, $selector, $token) {
        $usersModel = $this->getServiceLocator()->get('UsersModel');
        $config = $this->getServiceLocator()->get('config');
        $interval_time_expiration = $config['recoverpassword']['expiracion'];
        $expiration = new \DateTime('NOW');
        $expiration->add(new \DateInterval($interval_time_expiration));
        $expiration_date = $expiration->format('Y-m-d H:i:s');
        $usersModel->updateUserRecoverPassword($email, bin2hex($selector), hash('sha256', $token), $expiration_date);
    }

    public function sendMessage($asunto, $plantilla, $email, $datos = NULL) {
        try {
            $dataMail = array(
                'asunto' => $asunto,
                'email' => $email,
                'tipo' => \Epass\Enum\EmailType::WITH_TEMPLATE,
                'template' => EMAIL_PATH . $plantilla,
                'data' => $datos,
            );
            $response = $this->getEventManager()->trigger(\Epass\Event\Listener::MAIL_EVENT, $this, $dataMail);
            return $response[0];
        } catch (Exception $e) {
            return false;
        }
    }

    public function getPlant($plan) {
        $corporativo = preg_match('/corporativo/', strtolower($plan));
        $individual = preg_match('/individual/', strtolower($plan));
        $familiar = preg_match('/familiar/', strtolower($plan));
        if ($corporativo) {
            return 'Cuenta Empresa Prepago';
        }
        if ($individual) {
            return 'Cuenta Individual';
        }
        if ($familiar) {
            return 'Cuenta Compartida';
        }
        return $plan;
    }

    public function detalleCuentaAction() {
        $post = json_decode(file_get_contents('php://input'), true);
        $data = $this->procesar($post, "detalleCuenta");
        return $this->setResponseWithHeader($data);
    }

    private function detalleCuenta($decoded, $post = array()) {
        $data = array();
        $datos = $post['data'];
        try {
            if (!empty($datos['account_id'])) {
                $mpe = $this->getServiceLocator()->get('mpe');
                $transitoModel = $this->getServiceLocator()->get('TransitosModel');
                $req_EndDate = date("Ymd");
                $req_StartDate = date("Ymd", strtotime('-1 months', strtotime($req_EndDate)));
                $reportesMovimiento = $this->Movimientos($mpe->getMovementsByAccount(
                                array(
                                    'req_AccountId' => $datos["account_id"],
                                    'req_StartDate' => $req_StartDate,
                                    'req_EndDate' => $req_EndDate,
                )));
                $reportesTransito = $transitoModel->getTransitosByAccount((int) $datos["account_id"]);
                $rt = array();
                foreach ($reportesTransito as $v) {
                    $fecha = date_create_from_format('YmdHisu', $v["PASSAGETIME"]);
                    $v['fecha'] = date_format($fecha, 'Y-m-d');
                    $rt[] = $v;
                }
                $data['flag'] = 1;
                $data['mensaje'] = array(
                    'movimientos' => $reportesMovimiento,
                    'transacciones' => $rt
                );
            } else {
                $data['flag'] = 2;
                $data['mensaje'] = 'Datos invalidos';
            }
        } catch (\Exception $e) {
            $data['flag'] = 2;
            $data['mensaje'] = $e->getMessage();
        }
        return $data;
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
        return $this->record_sort($result, 'strotime', true);

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

    public function loginRecargaAction() {
        $data = [
            'code' => 200,
            'flag' => 0,
            'mensaje' => 'Error, no es peticion post'
        ];
        if ($this->getRequest()->isPost()) {
            try {
                $auth = $this->getServiceLocator()->get('AuthService');
                $post = json_decode(file_get_contents('php://input'));
                $formData->type = ($post->type == '1') ? 'tag' : 'placa';
                $formData->nroType = $post->nroType;
                $opcion = $formData->type;
                $value = $formData->nroType;
                $plate_validate = 1;
                $form_recarga = new LoginRecargaForm();
                $formValidator = ($opcion == 'tag') ? new TagValidator() : new PlacaValidator();
                $form_recarga->setInputFilter($formValidator->getInputFilter());
                $form_recarga->setData((array) $formData);

                if ($form_recarga->isValid()) {
                    if ($opcion != 'tag') {
                        $value = str_replace('-', '', $value);
                        $plate_validate = (ctype_alnum($value) && !is_numeric($value)) ? 1 : 0;
                    }
                    if ($plate_validate) {
                        $authenticacion = new Authentication($auth, $this->getServiceLocator());
                        $authenticacion->VerifyTagPlaca($formData);
                        if ($authenticacion->isOk()) {
                            $config = $this->getServiceLocator()->get('Config');
                            $data['flag'] = 1;
                            $user = $auth->getStorage()->read();
                            $datos = array(
                                "sub" => $formData->nroType,
                                "iat" => time(),
                                //"exp" => time() + $config['api']['exp'],
                                "user" => $user
                            );
                            $key = $config['api']['secret'];
                            $jwt = JWT::encode($datos, $key);
                            $planes = $this->getMisPlanesbyUserRecarga($user->id, $user->placa);
                            $data['mensaje'] = array(
                                'token' => $jwt,
                                'user' => $user,
                                'planes' => $planes
                            );
                        } else {
                            $data['flag'] = 2;
                            $data['mensaje'] = $authenticacion->getMessages();
                        }
                    } else {
                        $data['flag'] = 2;
                        $data['mensaje'] = 'Número de placa inválido';
                    }
                } else {
                    $array_response = $form_recarga->getMessages();
                    $messages = $this->getValues($array_response);
                    $data['flag'] = 3;
                    $data['mensaje'] = $messages;
                }
            } catch (\Exception $e) {
                $data['flag'] = 4;
                $data['mensaje'] = 'Error en el servidor';
            }
        }
        return $this->setResponseWithHeader($data);
    }

    public function getValues($array) {

        $messages = array();

        if (array_key_exists("username", $array)) {
            $array["username"] = "Correo inválido";
        }
        $this->getMessages($array, $messages);

        return $messages;
    }

    public function getSaldoAction() {
        $data = [
            'code' => 200,
            'flag' => 0,
            'mensaje' => 'Error, no es peticion post'
        ];
        if ($this->getRequest()->isPost()) {
            try {
                $post = json_decode(file_get_contents('php://input'), true);
                $account_id = $post['plan']['account_id'];
                $mpe = $this->getServiceLocator()->get('mpe');
                $saldo = $mpe->getSaldoByAccount(array('req_AccountId' => $account_id));
                $saldos = 0;
                if ($saldo->status == 'ok') {
                    $saldos = $saldo->data->saldo;
                }
                $data['flag'] = 1;
                $data['mensaje'] = $saldos;
            } catch (\Exception $e) {
                $data['flag'] = 4;
                $data['mensaje'] = $e->getMessage();
            }
        }
        return $this->setResponseWithHeader($data);
    }

    public function getPlansbyEmailAction() {
        $data = [
            'code' => 200,
            'flag' => 0,
            'mensaje' => 'Error, no es peticion post'
        ];
        if ($this->getRequest()->isPost()) {
            try {
                $post = json_decode(file_get_contents('php://input'), true);
                $email = $post['user']['txtCorreo'];
                $userPlansModel = $this->getServiceLocator()->get('UserPlansModel');
                $planes = $userPlansModel->getPlansbyEmail($email);
                $data['flag'] = 1;
                $data['mensaje'] = count($planes);
            } catch (\Exception $e) {
                $data['flag'] = 4;
                $data['mensaje'] = $e->getMessage();
            }
        }
        return $this->setResponseWithHeader($data);
    }
    public function ajaxVehiclesAction()
    {
        $data = [
            'code' => 200,
            'flag' => 0,
            'mensaje' => 'No eres Post xD'
        ];
        if ($this->getRequest()->isPost()) {
            $post = json_decode(file_get_contents('php://input'), true);
            if ($this->findVehicles($post['txtPlaca'])) {
                $data['mensaje'] = 'registrado';
                $data['flag'] = 1;
            } else {
                $data['flag'] = 2;
                $data['mensaje'] = 'no registrado';
            }
        }
        return $this->setResponseWithHeader($data);

    }
    private function findVehicles($placa)
    {
        $mpe = $this->getServiceLocator()->get('mpe');
        $rs = FALSE;
        $params = array(
            "req_TagPlate" => $placa
        );
        $rq = $mpe->getValidateTagPlate($params);
        if ($rq->status === 'ok') {
            $rs = TRUE;
        }
        return $rs;

    }
    public function aplanAction() {
        try {
            $mpe = $this->getServiceLocator()->get('mpe');
            $paquetes = $mpe->getPaquetesAfiliacion(['individual', 'familiar', 'corporativo']);
            foreach ($paquetes['individual'] as $key => $value) {
                $value = (array)$value;
                $value['namePlan1'] = \Application\Service\CuentaService::getPlanTitle($value['namePlan']);
                $individual[$key] = $value;
            }
            foreach ($paquetes['familiar'] as $key => $value) {
                $value = (array)$value;
                $value['namePlan1'] = \Application\Service\CuentaService::getPlanTitle($value['namePlan']);
                $familiar[$key] = $value;
            }
            foreach ($paquetes['corporativo'] as $key => $value) {
                $value = (array)$value;
                $value['namePlan1'] = \Application\Service\CuentaService::getPlanTitle($value['namePlan']);
                $corporativo[$key] = $value;
            }
            $datos = array((array) $individual,
                (array) $familiar,
                (array) $corporativo
            );
            $data['flag'] = 1;
            $data['mensaje'] = $datos;
        } catch (\Exception $e) {
            $data['flag'] = 4;
            $data['mensaje'] = $e->getMessage();
        }
        return $this->setResponseWithHeader($data);
    }
    
}
