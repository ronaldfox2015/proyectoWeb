<?php

namespace Epass\Model;

use Zend\ServiceManager\ServiceLocatorInterface;
use Epass\Model\User;
use Application\Http\Mpe\Mpe;
use Zend\Session\Container;

class Authentication
{
    public $data_user;
    public $ok;
    public $messages;
    protected $authService;
    protected $serviceLocator;
        
    public function __construct($authService,ServiceLocatorInterface $servicelocator) {
        $this->data_user = null;
        $this->ok = false;
        $this->messages = array();
        $this->authService = $authService;
        $this->serviceLocator = $servicelocator;
    }
    
    public function VerifyUser($data){
        
        $auth = $this->getAuthService();
        $auth->getAdapter()
             ->setIdentity($data->username)
             ->setCredential($data->password);
                                        
        $result = $auth->authenticate();
        if ($result->isValid()) {
            $dbAdapter = $this->getServiceLocator()->get('adapter');  
            $data_user = $auth->getAdapter()->getResultRowObject(null,'password');
            $data_array = get_object_vars($data_user);
            $user = new User();
            $user->exchangeArray($data_array);
            $statement = $dbAdapter->query("SELECT count(*) as hasaccount FROM user_plans WHERE user_id = $user->id AND account_id IS NOT NULL AND enable = 1");
            $users_plans = $statement->execute()->current();
            
            if($user->enable){
                if((int)$users_plans['hasaccount']){
                    if($user->email_check){
                        $statement = $dbAdapter->query('SELECT name FROM roles WHERE id = '.$user->role_id);
                        $results = $statement->execute()->current();
                        $data_user->role = $results['name'];                 
                        $auth->getStorage()->write(
                            $data_user
                        );
                        $this->ok = true;
                    }else{
                        $session_only_recarga = new Container('sesion_usuario_only_recarga');
                        if ($session_only_recarga->offsetExists('role')) {
                            $data = array(
                                    'role'      => $session_only_recarga->role,
                                    'id'        => $session_only_recarga->id,
                                    'tag'       => $session_only_recarga->tag,
                                    'placa'     => $session_only_recarga->placa,
                                    'idPlan'    => $session_only_recarga->idPlan 
                            );
                            
                            $auth->getStorage()->write((object)$data);
                            $this->messages[] = "Cuenta no activada. Verifica las instrucciones en tu correo";
                        }else{
                            $auth->getStorage()->write(null);
                            $this->messages[] = "Cuenta no activada. Verifica las instrucciones en tu correo";
                        }
                    }
                }else{
                    $session_only_recarga = new Container('sesion_usuario_only_recarga');
                    if ($session_only_recarga->offsetExists('role')) {
                        $data = array(
                                'role'      => $session_only_recarga->role,
                                'id'        => $session_only_recarga->id,
                                'tag'       => $session_only_recarga->tag,
                                'placa'     => $session_only_recarga->placa,
                                'idPlan'    => $session_only_recarga->idPlan 
                        );

                        $auth->getStorage()->write((object)$data);
                        $this->messages[] = "Usuario no afiliado en el Portal";
                    }else{
                        $auth->getStorage()->write(null);
                        $this->messages[] = "Usuario no afiliado en el Portal";
                    }
                }
            }else{
                $session_only_recarga = new Container('sesion_usuario_only_recarga');
                if ($session_only_recarga->offsetExists('role')) {
                    $data = array(
                            'role'      => $session_only_recarga->role,
                            'id'        => $session_only_recarga->id,
                            'tag'       => $session_only_recarga->tag,
                            'placa'     => $session_only_recarga->placa,
                            'idPlan'    => $session_only_recarga->idPlan 
                    );

                    $auth->getStorage()->write((object)$data);
                    $this->messages[] = "Su cuenta aún no está activada";
                }else{
                    $auth->getStorage()->write(null);
                    $this->messages[] = "Su cuenta aún no está activada";
                }
            }
        }else{
            $dbAdapter = $this->getServiceLocator()->get('adapter');
            $statement = $dbAdapter->query("SELECT count(*) as isUserFromMpe FROM users WHERE email LIKE '$data->username' AND ismigrate = 1 AND (password IS NULL OR password = '')");
            $user = $statement->execute()->current();
            if($user['isUserFromMpe']){
                $this->messages[] = "UserMpe";
            }else{
                $this->messages[] = "Credenciales incorrectas";
            }
        }
        
    } 
    
    public function VerifyTagPlaca($data){
        
        $auth = $this->getAuthService();
        $opcion = $data->type;
        $value = str_replace('-', '', $data->nroType);
        $idPlan = empty($data->idPlan) ? "" : $data->idPlan;
        $parameter = 'PAN';
        $parameter_mysql = 'tag';
        $statement_where_mysql = "$parameter_mysql like '%$value'";
        
        if($opcion!='tag'){
            $parameter = 'PLATE';
            $parameter_mysql = 'license_plate';
            $statement_where_mysql = "$parameter_mysql = '$value'";
        }
        
        $sm = $this->getServiceLocator();
        
        ///// Check mysql
        $dbAdapter = $sm->get('adapter');
        $query = "SELECT 
                       u.id AS user_id, tag, license_plate, plan_id, up.enable, up.account_id
                  FROM 
                       user_plans up
                       JOIN user_plan_vehicle upv ON (up.id = upv.user_plan_id)
                       JOIN users u ON (up.user_id = u.id)
                       JOIN vehicles v ON (upv.vehicle_id = v.id) WHERE $statement_where_mysql";
        
        $statement = $dbAdapter->query($query);
        $member = $statement->execute()->current();
//        print_r($member);exit;
        if(empty($member)){
            ///// Check for WS        
            $mpe = $this->getServiceLocator()->get('mpe');
            $result = $mpe->getValidateTagPlate(array('req_TagPlate'=>$value));
            if ($result->code != 200) {
                $this->flashMessenger()->addErrorMessage('Los servicios de e-pass no estan disponibles en este momento.');
                $this->redirect()->toRoute('home');
            }
                
            if($result->status!='fail'){
                /// Replicar en mysql
                    $member = $this->saveDataUserRecarga($result->data, $value);
                    if(array_key_exists('error_message', $member)){
                        $this->messages[] = $member['error_message'];
                    }else{
                        $this->ok = true;
                    }
            }else{
                $this->messages[] = "Tus datos no están registrados";
            }
        }else{
            if($member['enable']){
                if($member['account_id']!=''){
                    $this->ok = true;
                }else{
                 $this->messages[] = "No tienes una cuenta asociada, por favor comunicate con nosotros.";
                }
            }else{
                $this->messages[] = "Su cuenta aún no está activada";
            }
        }
        
        if($this->isOk()){
                $data = array(
                        'role'      => 'usuario_recarga',
                        'anonimo'      => '1',
                        'id'        => $member['user_id'],
                        'tag'       => substr($member['tag'], -8),
                        'placa'     => $member['license_plate'],
                        'idPlan'    => ($idPlan!="") ? $idPlan : $member['plan_id'] 
                );
                $data_user = (object)$data;
                $auth->getStorage()->write(
                        $data_user
                );
        }
    }
    
    public function VerifyEmail($data){
        $username   = $data['username'];
        $dbAdapter  = $this->getServiceLocator()->get('adapter');  
        $statement  = $dbAdapter->query("SELECT * FROM users WHERE email LIKE '$username'");
        $user_data  = $statement->execute()->current();
        $user = new User();
        $user->exchangeArray((array)$user_data);
        if($user->ismigrate){
            $this->ok = true;
        }else{
            if(!empty($user_data)){
                if($user->enable){
                    if($user->email_check){
                        $this->ok = true;
                    }else{
                        $this->messages = "Por favor confirme su correo electrónico";
                    }
                }else{
                    $this->messages = "Su cuenta aún no está activada";
                }
            }else{
                $this->messages = "El correo que ingresaste no está registrado en e-pass";
            }
        }
    }
    
    public function saveDataUserRecarga($data, $value){
        
        $account_id = $data->accountId;
        $mpe        = $this->getServiceLocator()->get('mpe');
                
        $account = $mpe->getAccountData(array('req_AccountId' => $account_id));
        if ($account->code != 200) {
            $this->flashMessenger()->addErrorMessage('Los servicios de e-pass no estan disponibles en este momento.');
            $this->redirect()->toRoute('home');
        }
        
        $plans      = $mpe->getPlansByAccount(array('req_AccountId' => $account_id));
        if ($plans->code != 200) {
            $this->flashMessenger()->addErrorMessage('Los servicios de e-pass no estan disponibles en este momento.');
            $this->redirect()->toRoute('home');
        }
        
        $members    = $mpe->getMembersByAccount(array('req_AccountId' => $account_id));
        if ($members->code != 200) {
            $this->flashMessenger()->addErrorMessage('Los servicios de e-pass no estan disponibles en este momento.');
            $this->redirect()->toRoute('home');
        }
        
        if($account->status != 'ok'){
             return array(
                'error_message'  => 'No tienes una cuenta asociada.'
            );
        }
        if($plans->status != 'ok'){
             return array(
                'error_message'  => 'No tienes un plan activo.'
            );
        }
        if($members->status != 'ok'){
             return array(
                'error_message'  => 'No tienes asociado ningun vehiculo.'
            );
        }
        
        if($account->data == null || $account->data=="" || empty($account->data)){
            return array(
                'error_message'  => 'No tienes datos en tu cuenta. Por favor contactanos.'
            );
        }
        
        $data_account   = $account->data;
        $data_plan      = $plans->data;
        $data_members   = $members->data;
        
        if(     $data_plan->plansByAccountDefinition->req_PlanId == null 
            ||  $data_plan->plansByAccountDefinition->req_PlanId == "" 
            ||  empty($data_plan->plansByAccountDefinition->req_PlanId)){
            return array(
                'error_message'  => 'No tienes asociado un plan.'
            );  
        }

        $users_model        = $this->getServiceLocator()->get('UsersModel');
        $users_plan_model   = $this->getServiceLocator()->get('UserPlansModel');
        $vehicles_model     = $this->getServiceLocator()->get('VehiclesModel');
        $users_plan_vehicles_model = $this->getServiceLocator()->get('UserPlanVehicleModel');
        $aclass_model       = $this->getServiceLocator()->get('Epass\Model\AClassTable');
        $ubigeo             = $this->getServiceLocator()->get('Epass\Model\ALinkedListTable');       
        $plan_id    = trim($data_plan->plansByAccountDefinition->req_PlanId);
        $plan_name  = trim($data_plan->plansByAccountDefinition->req_Name);
                
        $sm = $this->getServiceLocator();
        $dbAdapter = $sm->get('adapter');
        $dbAdapter->getDriver()->getConnection()->beginTransaction();
        
        try{
            $identificador_email = ((trim($data_account->req_Email)=='') ? $account_id : trim($data_account->req_Email));
            $user_in_db = $users_model->findUsersByCorreo($identificador_email);
            // save users
            if(empty($user_in_db)){
                $data_user = [
                    'name'      => trim($data_account->req_Forename),
                    'lastname'  => trim($data_account->req_Surname),
                    'email'     => $identificador_email,
                    'role_id'   => 4,
                ];

                $id_user_response = $users_model->saveUser($data_user);
            }else{
                $id_user_response = $user_in_db['id'];
            }
            
            $user_plan_in_db = $users_plan_model->finUserPlan($account_id, $user_in_db);
            // save user_plans
            if(empty($user_plan_in_db)){
                $data_ubigeo = $ubigeo->getUbigeoBxCodeWS(trim($data_account->req_CodeDepartamento), trim($data_account->req_CodeProvincia), trim($data_account->req_CodeDistrito));
                $data_users_plan  = [
                    'account_id'        => $account_id,
                    'user_id'           => $id_user_response,
                    'plan_id'           => $plan_id,
                    'plan_name'         => $plan_name,
                    'document_type_id'  => trim($data_account->req_DocType),
                    'document_number'   => trim($data_account->req_DocNumber),
                    'telephone'         => trim($data_account->req_PhoneNum),
                    'additional_phone'  => trim($data_account->req_PhoneNumMobile),
                    'address'           => trim($data_account->req_Street),
                    'district_id'       => $data_ubigeo['dist'],
                    'province_id'       => $data_ubigeo['prov'],
                    'department_id'     => $data_ubigeo['dep'],
                    'contact'           => trim($data_account->req_Contact),
                    'razon_social'      => trim($data_account->req_Designation),
                    'observations'      => trim($data_account->req_Referencia),
                    'enable'            => 1,
                    'migrate'           => 1,
                ];
                $id_users_plan_response = $users_plan_model->saveUserPlans($data_users_plan);
            }else{
                $id_users_plan_response = $user_plan_in_db['id'];
            }
            
            if(count($data_members) == 1){
                $data_members_vehicles[] = $data_members;
            }else{
                $data_members_vehicles   = $data_members;
            }
            
            foreach ($data_members_vehicles as $vehiculo){

                if(trim($vehiculo->req_Plate) == $value || substr(trim($vehiculo->req_Pan), -8) == $value){
                    $tag = $vehiculo->req_Pan;
                    $license_plate = $vehiculo->req_Plate;
                    $data_aclass = $aclass_model->getData(array('CLASS' => $vehiculo->req_Class));
                    // save vehicle
                    $vehicleTable=$this->getServiceLocator()->get('VehiclesTable');
                    $brand=$vehicleTable->getIdVehicleBrand($data_aclass[0]['CLASS'],trim($vehiculo->req_Make));
                    $model=$vehicleTable->getIdVehicleModel($data_aclass[0]['CLASS'],$brand,trim($vehiculo->req_Model));
                    if(empty($model) || empty($brand)){
                        $data_otros = $vehicleTable->getIdOtros($data_aclass[0]['CLASS']);
                        $brand = $data_otros['brand'];
                        $model = $data_otros['model'];
                    }
                    // data de vehiculos
                    $data_vehicle   = [
                        'license_plate' => trim($vehiculo->req_Plate),
                        'color'         => trim($vehiculo->req_Colour),
                        'type'          => $data_aclass[0]['CLASS'],
                        'brand'         => $brand,
                        'model'         => $model,
                        'tag'           => trim($vehiculo->req_Pan),
                        'migrate'       => 1
                    ];
                    $id_vehicle_response = $vehicles_model->saveVehicle($data_vehicle);  

                    // save user_plan_vehicles
                    $data_users_plan_vehicles  = [
                        'user_plan_id'  => $id_users_plan_response,
                        'vehicle_id'    => $id_vehicle_response,
                    ];

                    $id_users_plan_vehicles_response = $users_plan_vehicles_model->saveUserPlanVehicle($data_users_plan_vehicles);

                    if($id_vehicle_response == null || $id_users_plan_vehicles_response == null){
                        $dbAdapter->getDriver()->getConnection()->rollback();
                        return array(
                            'error_message'  => 'Se ha producido un error inesperado. Inténtelo de nuevo más tarde.'
                        );
                    }
                }
            }
            
            if($id_user_response == null || $id_users_plan_response == null){
                $dbAdapter->getDriver()->getConnection()->rollback();
                return array(
                    'error_message'  => 'Se ha producido un error inesperado. Inténtelo de nuevo más tarde.'
                );
            }
            
            if(!empty($data_members_vehicles) && $id_vehicle_response == null){
                $dbAdapter->getDriver()->getConnection()->rollback();
                return array(
                    'error_message'  => 'Se ha producido un error inesperado al extraer los datos de tus vehículos. Inténtelo de nuevo más tarde.'
                );
            }
            
            $dbAdapter->getDriver()->getConnection()->commit();
        }  catch (Exception $ex) {
            $dbAdapter->getDriver()->getConnection()->rollback();
            return array(
                'error_message'  => 'Se ha producido un error inesperado. Inténtelo de nuevo más tarde.'
            ); 
        }

        return array(
                'user_id'       => $id_user_response, 
                'tag'           => $tag, 
                'license_plate' => $license_plate,
                'plan_id'       => $plan_id
        );
    }
    
    private function getPlans($plans){
        $plans_data   = array();
        foreach($plans as $plan){
            $string = $plan->req_Name;
            if(stripos($string, 'individual') !== false){
                $plans_data[$plan->req_PlanId] = 'individual';
            }  elseif (stripos($string, 'familiar') !== false) {
                $plans_data[$plan->req_PlanId]   = 'familiar';
            }  elseif (stripos($string, 'corporativo') !== false){
                $plans_data[$plan->req_PlanId] = 'corporativo';
            } else{
                $plans_data[$plan->req_PlanId] = 'recarga';
            }
        }        
        return $plans_data;
    }
    
    public function isOk(){
        return $this->ok;
    }
    
    public function getMessages(){
        return $this->messages;
    }
          
    public function getAuthService(){
        return $this->authService;
    }
    
    public function getServiceLocator(){
        return $this->serviceLocator;
    }
            
}

