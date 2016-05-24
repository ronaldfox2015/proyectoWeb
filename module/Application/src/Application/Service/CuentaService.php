<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Service;

use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Description of EmpresaService
 *
 * @author ronald
 */
class CuentaService
{

    //put your code here
    public $nombre = 'ronald';
    public $config = 'ronald';
    
    /**
     * Get service locator
     *
     * @return \Zend\ServiceManager\ServiceLocatorInterface;
     */
    public $serviceLocator;
    protected $mpe;
    protected $ALinkedListTable;
    protected $userPlansModel;
    protected $userModel;
    protected $MomgoModifyAccount;

    public function __construct($config)
    {

        $this->config = $config;

    }

    public function WebServicemodifyAccount($WebServicemodifyAccount)
    {
        $this->MomgoModifyAccount = $WebServicemodifyAccount;

    }

    public function userModel($userModel)
    {
        $this->userModel = $userModel;

    }

    public function userPlansModel($userPlansModel)
    {
        $this->userPlansModel = $userPlansModel;

    }

    public function ALinkedListTable($ALinkedListTable)
    {
        $this->ALinkedListTable = $ALinkedListTable;

    }

    public function setMpe($mpe)
    {
        $this->mpe = $mpe;

    }

    public function setServiceLocator($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;

    }

    /**
     * Get service locator
     *
     * @return \Zend\ServiceManager\ServiceLocatorInterface;
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }  
    
    public function editar($datosform)
    { 
        $mpe = false;
        $individual = true;
        $planname = $this->getPlant(strtolower($datosform['users_plans']["plan_name"]));
        $corporativo = preg_match('/corporativo/', $planname);
        $Designation = trim($datosform['txtNombreTitular']) . ' ' . trim($datosform['txtApellidosTitular']);
        $ruc = '';
        if ($corporativo) {
            $individual = false;
            $Designation = $datosform['txtRazonsocial'];
            $ruc = trim($datosform['txtNumDocumento']);
        }

        if (empty($datosform['account_id'])) {
            return false;
        }
        $data = array(
            'req_AccountId' => $datosform['account_id'],
            'req_RucNumber' => $ruc,
            'req_DocType' => $datosform['tipoDoc'],
            'req_DocNumber' => trim($datosform['txtNumDocumento']),
            'req_Individual' => $individual,
            'req_Title' => '',
            'req_Designation' => $Designation,
            'req_Contact' => trim($datosform['txtNombreTitular']),
            'req_Street' => $datosform['txtDireccion'],
            'req_Referencia' => $datosform['txtReferencia'],
            'req_CodeDistrito' => !empty($datosform['idDistrito']) ? $this->ALinkedListTable->getUbigeoxId(array('LIST' => \Epass\Model\ALinkedListTable::DISTRITOS, 'INDEX' => $datosform['idDistrito'])) : '01',
            'req_CodeProvincia' => !empty($datosform['idProvin']) ? $this->ALinkedListTable->getUbigeoxId(array('LIST' => \Epass\Model\ALinkedListTable::PROVINCIAS, 'INDEX' => $datosform['idProvin'])) : '01',
            'req_CodeDepartamento' => !empty($datosform['idDpto']) ? $this->ALinkedListTable->getUbigeoxId(array('LIST' => \Epass\Model\ALinkedListTable::DEPARTAMENTOS, 'INDEX' => $datosform['idDpto'])) : '15',
            'req_PhoneNum' => !empty($datosform['telephone']) ? $datosform['telephone'] : '',
            'req_PhoneNumMobile' => !empty($datosform['telephone']) ? $datosform['telephone'] : '',
            'req_PhoneNumWork' => !empty($datosform['additional_phone']) ? $datosform['additional_phone'] : '',
            'req_Email' => $datosform['txtCorreo'],
            "req_ReceiptType" => ($individual) ? 'B' : 'F',
            'req_Forename' => trim($datosform['txtNombreTitular']),
            'req_Surname' => trim($datosform['txtApellidosTitular'])
        );
        /*if(!$corporativo){
            $dataUser=['req_Forename' => trim($datosform['txtNombreTitular']),
            'req_Surname' => trim($datosform['txtApellidosTitular'])];
            $data=  array_merge($data,$dataUser);
        }*/

        try {
            $update = $this->mpe->modifyAccountData($data);

            if ($update->status == 'ok') {
                $mpe = true;
                $datos = [
                    'Services' => 'modifyAccountData',
                    'idUser' => $datosform['idUser'],
                    'data' => $data,
                    'status' => $update->status,
                    'message' => $update->data,
                ];
                $this->MomgoModifyAccount->saveWebServicesLog($datos);
            } else {
                $datos = [
                    'Services' => 'modifyAccountData',
                    'idUser' => $datosform['idUser'],
                    'data' => $data,
                    'status' => $update->status,
                    'message' => $update->message,
                ];
                $this->MomgoModifyAccount->saveWebServicesLog($datos);
            }
            if ($mpe) {
                 $dataUser = [
                    'id' => $datosform['idUser'],
                    'name' => $datosform['txtNombreTitular'],
                    'lastname' => $datosform['txtApellidosTitular'],
                ];
                 
                if($corporativo){
                     $dataUser = [
                        'id' => $datosform['idUser']
                     ];
                }
               
                if (isset($datosform['txtContrasenia']) && !empty($datosform['txtContrasenia'])) {
                    $dataUser['password'] = md5($datosform['txtContrasenia']);
                    $dataUser['psw_desencriptado'] = $datosform['txtContrasenia'];
                }
                if (isset($datosform['txtCorreo']) && !empty($datosform['txtCorreo'])) {
                    $dataUser['email'] = $datosform['txtCorreo'];
                }
                if (isset($datosform['rol'])) {
                    $dataUser['rol'] = $datosform['rol'];
                }
                $user = $this->userModel->saveUser($dataUser);

                $dataUserPlans = [
                    'user_id' => $datosform['idUser'],
                    'id' => $datosform['id'],
                    'document_type_id' => $datosform['tipoDoc'],
                    'document_number' => $datosform['txtNumDocumento'],
                    'department_id' => $datosform['idDpto'],
                    'province_id' => $datosform['idProvin'],
                    'district_id' => $datosform['idDistrito'],
                    'address' => $datosform['txtDireccion'],
                    'enable' => 1,
//                    'address_number' => $datosform['txtNumVia'],
//                    'inside_address' => $datosform['txtDptoVia'],
//                    'urbanization' => $datosform['txtUrbanizacion'],
                    'observations' => $datosform['txtReferencia']
                ];

                $this->userPlansModel->saveUserPlans($dataUserPlans);
                return true;
            }
            return false;
        } catch (Exception $ex) {
                      

            $datos = [
                'Services' => 'modifyAccountData',
                'idUser' => $datosform['idUser'],
                'data' => $data,
                'status' => 'Error',
                'message' => $ex->getMessages(),
            ];
            $this->MomgoModifyAccount->saveWebServicesLog($datos);
            return false;
        }

    }

    public function getDataForm($account_id)
    {
        $dataForm = $this->mpe->getAccountData(array('req_AccountId' => $account_id));
        if (isset($dataForm->status) && $dataForm->status == 'ok') {
            $ubigueo = $this->ALinkedListTable->getUbigeoBxCodeWS(
                    $dataForm->data->req_BillingCodeDepartamento,
                    $dataForm->data->req_BillingCodeProvincia,
                    $dataForm->data->req_BillingCodeDistrito
            );
            return array(
                'tipoDoc' => $dataForm->data->req_DocType,
                'txtNumDocumento' => $dataForm->data->req_BillingCodeDepartamento,
                'idDpto' => $ubigueo['dep'],
                'idProvin' =>  $ubigueo['prov'],
                'idDistrito' =>  $ubigueo['dist'],
                'txtDireccion' => $dataForm->data->req_Street,
                'txtRazonsocial' => $dataForm->data->req_Designation,
              //  'txtPlanName' => $dataForm->data->req_BillingCodeDepartamento,
                'txtReferencia' => $dataForm->data->req_Referencia,
                'account_id' => $account_id,
             //   'plan_name' => $dataForm->data->req_BillingCodeDepartamento,
                'txtNombreTitular' => $dataForm->data->req_Forename,
                'txtApellidosTitular' => $dataForm->data->req_Surname
            );
        }

    }

    public function migratePlans($idUser, $data_sesion_user)
    {
        $plans = $this->userPlansModel->getPlansbyUser($idUser);
        $import = false;

        foreach ($plans as $plan) {

            $plansImport = $this->mpe->getPlansByAccount([
                'req_AccountId' => $plan['account_id']
            ]);

            if (isset($plansImport->data->plansByAccountDefinition->req_PlanId)) {
                $import = true;

                $dataPlan['id'] = $plan['id'];
                $dataPlan['plan_id'] = $plansImport->data->plansByAccountDefinition->req_PlanId;
                $dataPlan['plan_name'] = $plansImport->data->plansByAccountDefinition->req_Name;

                $this->userPlansModel->saveUserPlans($dataPlan);
            }
        }

        if ($import) {
            $dataUser['id'] = $idUser;
            $dataUser['migrate'] = 1;
            //$dataUser['migratePlans'] = 1;
            $this->userModel->saveUser($dataUser);

            /*             * update session*********** */
            $data_sesion_user->migratePlans = 1;
        }

    }

    public function getaccount_idWS($datosform)
    {
        if (isset($datosform['account_id']) && !empty($datosform['account_id'])) {
            return $datosform['account_id'];
        }

//        var_dump( $datosform['req_TagPlate']);exit;
        $account_id = $this->mpe->getValidateTagPlate(array('req_TagPlate' => $datosform['placa']));

    }

    private function getPlant($plan)
    {
        $corporativo = preg_match('/corporativo/', strtolower($plan));
        $individual = preg_match('/individual/', strtolower($plan));
        $familiar = preg_match('/familiar/', strtolower($plan));
        if ($corporativo) {
            return 'corporativo';
        }
        if ($individual) {
            return 'individual';
        }
        if ($familiar) {
            return 'individual';
        }
        return $plan;

    }
    
    public static function getPlanTitle($planName)
    {
        $planName = strtolower($planName);
        
        $vip = preg_match('/prepago vip/', $planName);
        $corporativo = preg_match('/corporativo/', $planName);

        $individual = preg_match('/individual 1/', $planName);
        $individual2 = preg_match('/individual 2/', $planName);

        $familiar = preg_match('/familiar 1/', $planName);
        $familiar2 = preg_match('/familiar 2/', $planName);
        
        $postpago = preg_match('/post pago/', $planName);

        if ($corporativo) {
            return 'Pre Pago Corporativo';
        }
        if ($individual) {
            return 'Pre Pago Persona';
        }
        if ($individual2) {
            return 'Pre Pago Persona';
        }
        if ($familiar) {
            return 'Pre Pago Persona';
        }
        if ($familiar2) {
            return 'Pre Pago Persona';
        }
        if ($vip) {
            return 'Pre Pago Corporativo';
        }
        if ($postpago) {
            return 'Post Pago Corporativo';
        }
        return $planName;

    }
    
    public function sendMessageRegistro($idUser)
    {
        try {
            $urlHelper = $this->getServiceLocator()->get('ViewHelperManager')->get('url');
            $eventManager = $this->getServiceLocator()->get('EventManager');
            
            $user = $this->userModel->getUser($idUser);
            $token = $this->userModel->generarToken($idUser,3600);

            $email = $user['email'];
            $url = $$this->config['urlPath'] . $urlHelper('verificacion-email', array('token' => $token));            
            $name = $this->userModel->getNameUserbyId($idUser);
            
            $dataMail = array(
                'asunto' => 'Registro Epass',
                'email' => $email,
                'tipo' => \Epass\Enum\EmailType::WITH_TEMPLATE,
                'template' => EMAIL_PATH . "/activacioncuenta.phtml",
                'data' => array('name'=> $name, 'correo' => $email, 'url' => $url, 'user' => $user),
            );

            
            $envio = $eventManager->trigger(\Epass\Event\Listener::MAIL_EVENT, $this, $dataMail);
            return true;
        } catch (\Exception $e) {
            return false;
        }

    }  
    
    public function sendMessageRecoverPassword($idUser) 
    {
        try {      
            $eventManager = $this->getServiceLocator()->get('EventManager');
            
            $user = $this->userModel->getUser($idUser);
            $email = $user['email'];
            $url = $this->_generateUrlToRecoverPassword($email);
            $name = $this->userModel->getNameUserbyId($idUser);
       
            $dataMail = array(
                'asunto'   => 'Recuperar contraseña',
                'email' => $email,
                'tipo' => \Epass\Enum\EmailType::WITH_TEMPLATE,
                'template' => EMAIL_PATH . 'recuperarpassword.phtml',
                'data' => array('name'=>$name, 'email' => $email, 'url' => $url) ,
            );
            $eventManager->trigger(\Epass\Event\Listener::MAIL_EVENT, $this, $dataMail);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }   
    
    private function _generateUrlToRecoverPassword($email)
    {
       // $urlHelper = $this->getServiceLocator()->get('ViewHelperManager')->get('url');
        $controller = $this->config['urlPath']."/change-password/recuperar/";
        
        $selector = random_bytes(8);
        $token = random_bytes(32);
       // $url = $this->config['urlPath'] . $urlHelper('recuperar', array('key' => $token));        
        $url = $controller.bin2hex($selector)."$".bin2hex($token);        

        $interval_time_expiration = $this->config['recoverpassword']['expiracion'];
        $expiration = new \DateTime('NOW');
        $expiration->add(new \DateInterval($interval_time_expiration));
        $expiration_date = $expiration->format('Y-m-d H:i:s');
        
        $this->userModel->updateUserRecoverPassword($email, bin2hex($selector), hash('sha256',$token), $expiration_date);        
        
        return $url;
    }
}
