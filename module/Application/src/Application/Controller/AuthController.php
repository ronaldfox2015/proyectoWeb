<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Form\LoginSesionForm;
use Application\Form\LoginRecargaForm;
use Application\Form\LoginValidator;
use Application\Form\TagValidator;
use Application\Form\PlacaValidator;
use Epass\Model\Authentication;
use Zend\Validator\EmailAddress;
use Zend\Session\Container;
use Zend\Session\SessionManager;

class AuthController extends AbstractActionController
{
    protected $storage;
    protected $authservice;
             
    public function loginAction()
    {
        $auth = $this->getAuthService();
        if ($auth->hasIdentity() ) {
            $data_sesion_user = $auth->getStorage()->read();
            $isxmlhttprq = $this->getRequest()->isXmlHttpRequest();
            if($data_sesion_user->role != 'usuario_recarga'){
                if($isxmlhttprq){
                    $result = array(
                        'status' => 'ok',
                        'messages' => ''
                    );
                    
                    $response = $this->getResponse();
                    $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
                    $response->setContent(json_encode($result));
                    
                    return $response;
                }else{
                    return $this->redirect()->toRoute('home');
                }
            }
        }
                
        $request = $this->getRequest();
        $messages = null;
        if ($request->isPost()) {
            
            $formData = $request->getPost();
            $form_sesion = new LoginSesionForm();                
            $formValidator = new LoginValidator();
            $form_sesion->setInputFilter($formValidator->getInputFilter());
            $form_sesion->setData($formData);
            
            if ($form_sesion->isValid()) {
                $authenticacion = new Authentication($auth, $this->getServiceLocator());
                $authenticacion->VerifyUser($formData);
                if($authenticacion->isOk()){
                    $status = 'ok';
                }else{
                    $messages = $authenticacion->getMessages();
                    if($messages[0]=='UserMpe'){
                        $status = 'UserMpe';
                    }else{
                        $status = 'error';
                        $messages = $authenticacion->getMessages();                    
                    }
                }
            }else{
                $status = 'error';
                $array_response = $form_sesion->getMessages();
                $messages = $this->getValues($array_response);
            }
        }
       
        $result = array(
	    'status' => $status,
	    'messages' => $messages           
        );
        
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
        $response->setContent(json_encode($result));
        
        return $response;
    }
         
    public function recargaAction(){
        
        $auth = $this->getAuthService();
        if ($auth->hasIdentity()) {
            $isxmlhttprq = $this->getRequest()->isXmlHttpRequest();
            if($isxmlhttprq){
                $result = array(
                    'status' => 'ok',
                    'messages' => ''
                );

                $response = $this->getResponse();
                $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
                $response->setContent(json_encode($result));

                return $response;
            }else{
                return $this->redirect()->toRoute('home');
            }
        }
        
        $request = $this->getRequest();
        $messages = array();
        if ($request->isPost()) {
            $formData = $request->getPost();
            $opcion = $formData->type;
            $value = $formData->nroType;
            $plate_validate = 1;
            $form_recarga = new LoginRecargaForm();    
            $formValidator = ($opcion=='tag') ? new TagValidator() : new PlacaValidator();
            $form_recarga->setInputFilter($formValidator->getInputFilter());
            $form_recarga->setData($formData);

            if ($form_recarga->isValid()) {
                if($opcion != 'tag'){
                    $value = str_replace('-', '', $value);
                    $plate_validate = (ctype_alnum($value) && !is_numeric($value)) ? 1 : 0;
                }
                if($plate_validate){
                    $authenticacion = new Authentication($auth, $this->getServiceLocator());
                    $authenticacion->VerifyTagPlaca($formData);
                    if($authenticacion->isOk()){
                        $status = 'ok';
                    }else{
                        $status = 'error';
                        $messages = $authenticacion->getMessages(); 
                    }
                }else{
                    $status = 'error';
                    $messages[] = 'Número de placa inválido';
                }
            }else{
                $status = 'error';
                $array_response = $form_recarga->getMessages();
                $messages = $this->getValues($array_response);
            }
        }
        
        $result = array(
	    'status' => $status,
	    'messages' => $messages           
        );
        
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
        $response->setContent(json_encode($result));
        
        return $response;
    }
    
    public function recuperarAction()
    {
        $request = $this->getRequest();
        $messages = null;
        
        if ($request->isPost()) {
            
            $auth = $this->getAuthService();
            $formData = $request->getPost();
            $email = trim($formData->username);
            $validator = new EmailAddress();
                        
            if ($validator->isValid($email)){
                $authenticacion = new Authentication($auth, $this->getServiceLocator());
                $authenticacion->VerifyEmail($formData);
                if($authenticacion->isOk()){
                    try {
                        $data_encrypt = $this->generateKeysUrl($email);
                        $user_plans = $this->getServiceLocator()->get('UsersModel');
                        $name = $user_plans->getNameUserbyEmail($email);
                        $this->saveKeys($email, $data_encrypt['selector_user'], $data_encrypt['token']);
                        $data = array(
                            'name' => $name,
                            'email' => $email,
                            'url'   => $data_encrypt['url']
                        );
                        if($this->sendMessage('Recuperar contraseña', 'recuperarpassword.phtml', $email, $data)){
                            $status = 'ok';
                            $messages = "Te hemos enviado un mail a tu correo $email con un enlace, por favor haz click en el enlace para restablecer tu contraseña.";
                        }else{
                            $messages = "Ocurrió un error al enviar el correo. Por favor vuelva a intentarlo";
                        }
                    } catch (Exception $ex) {
                        $result = array(
                                'status' => 'error',
                                'messages' => 'Ocurrió un error inesperado. Por favor vuelva a intentarlo'
                        );
                        $response = $this->getResponse();
                        $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
                        $response->setContent(json_encode($result));
                        return $response;
                    }
                }else{
                    $status = 'error';
                    $messages = $authenticacion->getMessages();
                }
            }else{
                $status = 'error';
                $messages = 'Correo inválido';
            }
        }
       
        $result = array(
	    'status' => $status,
	    'messages' => $messages           
        );
        
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
        $response->setContent(json_encode($result));
        
        return $response;
    }
    
    public function sendCheckEmailAction()
    {
        $request = $this->getRequest();
        $messages = null;
        $status = '';
        
        if ($request->isPost()) {
            $data = $request->getPost();
            $email  = $data->email;
            $idUser = $data->iduser;
            try {
                $user_plans = $this->getServiceLocator()->get('UsersModel');
                $name=$user_plans->getNameUserbyId($idUser);
                $config = $this->getServiceLocator()->get('config');
                $datos = array(
                  'name'=>$name , 
                  'correo' => $email, 
                  'url' => $config['urlPath'].$this->url()->fromRoute('verificacion-email',array('token'=>$user_plans->generarToken($idUser, 86400)))
                );
                $email_activacion = $this->sendMessage('Registro Epass', 'activacioncuenta.phtml', $email, $datos);
                if($email_activacion){
                    $status = 'ok';
                    $messages = "Se te ha enviado un mail a tu correo $email con el enlace para que Actives tu Cuenta de Usuario Web en e-pass.";
                }else{
                    $messages = 'Ocurrió un error inesperado. Por favor vuelva a intentarlo';
                }
            } catch (Exception $ex) {
                $result = array(
                        'status' => 'error',
                        'messages' => 'Ocurrió un error inesperado. Por favor vuelva a intentarlo'
                );
                $response = $this->getResponse();
                $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
                $response->setContent(json_encode($result));
                return $response;
            }
                
        }
       
        $result = array(
	    'status' => $status,
	    'messages' => $messages           
        );
        
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
        $response->setContent(json_encode($result));
        
        return $response;
    }
    
    
    
    public function logoutAction()
    {     
        $auth = $this->getAuthService();
        $auth->clearIdentity();
        $sessionManager = new SessionManager();
        $sessionManager->getStorage()->clear();
        return $this->redirect()->toRoute('home');
    }
    
    public function loggedAction()
    {
        $status = 'notlogged';
        $auth = $this->getAuthService();
        if ($auth->hasIdentity() ) {
            $status = 'logged';            
        }
                
        $result = array(
	    'status' => $status
        );
        
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
        $response->setContent(json_encode($result));
        
        return $response;
    }
    
    public function getAuthService()
    {
        if (! $this->authservice) {
            $this->authservice = $this->getServiceLocator()->get('AuthService');
        }
         
        return $this->authservice;
    }
     
    public function getValues($array){
        
        $messages = array();
        
        if(array_key_exists("username", $array)){
            $array["username"] = "Correo inválido";
        }
        $this->getMessages($array, $messages);
        
        return $messages;
    }
    
    public function getMessages($array, &$array_response = null){
        $response = array();
        foreach($array as $key=>$value){
            if (is_array($value)){
                   $this->getMessages($value, $array_response);
            }else{
                  $response[] = $value;
            }
        }
        if(!empty($response)){
            foreach ($response as $key=>$value){
                $array_response[] = $value;
            }
        }
    }
       
    public function generateKeysUrl(){
        $config = $this->getServiceLocator()->get('config');

        $controller = $config['urlPath']."/change-password/recuperar/";
        
        $selector_user = random_bytes(8);
        $token = random_bytes(32);
        
        $url = $controller.bin2hex($selector_user)."$".bin2hex($token);
        $data = array(
            'selector_user' => $selector_user,
            'token'    => $token,
            'url'      => $url,
        );
        
        return $data;
    }
    
    public function saveKeys($email, $selector, $token){
        $usersModel = $this->getServiceLocator()->get('UsersModel');
        $config = $this->getServiceLocator()->get('config');
        $interval_time_expiration = $config['recoverpassword']['expiracion'];
        $expiration = new \DateTime('NOW');
        $expiration->add(new \DateInterval($interval_time_expiration));
        $expiration_date = $expiration->format('Y-m-d H:i:s');
        $usersModel->updateUserRecoverPassword($email, bin2hex($selector), hash('sha256',$token), $expiration_date);
    }
    
    public function sendMessage($asunto, $plantilla, $email, $datos = NULL){
        try {
            $dataMail = array(
                'asunto'   => $asunto,
                'email' => $email,
                'tipo' => \Epass\Enum\EmailType::WITH_TEMPLATE,
                'template' => EMAIL_PATH.$plantilla,
                'data' => $datos,
            );
            $response = $this->getEventManager()->trigger(\Epass\Event\Listener::MAIL_EVENT, $this, $dataMail);
            return $response[0];
        } catch (Exception $e) {
            return false;
        }
    }
}