<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class RecuperarPasswordController extends AbstractActionController
{
   
    public function recoverPasswordAction()
    {
        $key = $this->params('key');
        $data = explode('$', $key);
        $selector_user = $data[0];
        $token = $data[1];
        
        $usersModel         = $this->getServiceLocator()->get('UsersModel');
        $data_recover       = $usersModel->getDataFromRecover($selector_user);
        $time_expiration_ok = $usersModel->isOkTimeExpiration($selector_user);
        $service            = $this->getServiceLocator()->get('Popup');

        if(!empty($data_recover)){
            if(!empty($time_expiration_ok)){
                $calc = hash('sha256', hex2bin($token));
                if (hash_equals($calc, $data_recover['recover_token'])){
                    $data = array(
                        'email'=> $data_recover['email']
                    );
                    $service->addParams($data);
                    $service->setTemplate('renders/modal_recuperar_contra');
                }else{
                    $data = array( 
                        'message'=> 'El enlace es incorrecto. Por favor vuelva a generar pedido recuperacion de contraseña',
                        'button'=> 'Reenviar email',
                        'email' => $data_recover['email']
                    );

                    $service->addParams($data);
                    $service->setTemplate('renders/modal_mensaje_recuperar_contra');
                }
            }else{
                $data = array(
                    'message'=> 'El enlace ha expirado, por favor vuelva a generarlo',
                    'button'=> 'Reenviar email',
                    'email' => $data_recover['email']
                );
                $service->addParams($data);
                $service->setTemplate('renders/modal_mensaje_recuperar_contra');
            }
        }else{
                $data = array(
                    'message'=> 'El enlace ha expirado, puedes generar un nuevo enlace desde el Login.',
                    'button'=> 'Ir al Login',
                );
                $service->addParams($data);
                $service->setTemplate('renders/modal_mensaje_recuperar_contra');
        }
                
        $this->redirect()->toUrl("/");
    }
     
    public function changePasswordAction(){
        $request = $this->getRequest();
        $messages = null;
        
        if ($request->isPost()) {
            
            $formData = $request->getPost();
            $new_password = $formData->new_password;
            $repeat_password = $formData->repeat_password;
            $email = $formData->email;
            if ($new_password == $repeat_password){
                    try {
                        $usersModel = $this->getServiceLocator()->get('UsersModel');
                        $usersModel->changePassword($email, $new_password);
                        $status   = 'ok';
                        $messages = '';
                    } catch (Exception $ex) {
                        $result = array(
                                'status' => 'error',
                                'messages' => 'Ocurrió un problema por favor vuelva a intentarlo'
                        );
                        $response = $this->getResponse();
                        $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
                        $response->setContent(json_encode($result));
                        return $response;
                    }
            }else{
                $status = 'error';
                $messages = 'Las contraseñas deben coincidir';
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
}