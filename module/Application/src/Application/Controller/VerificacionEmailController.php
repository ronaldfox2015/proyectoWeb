<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class VerificacionEmailController extends AbstractActionController
{
   
    public function indexAction()
    {
        $token = $this->params('token');
                
        $usersModel = $this->getServiceLocator()->get('UsersModel');
        $data_user  = $usersModel->getUserForTokenEmailCheck($token);
        $time_expiration_ok = $usersModel->isOkTimeExpirationCheckEmail($token);
        
        $service    = $this->getServiceLocator()->get('Popup');
        if(!empty($data_user)){
            if(!$data_user['email_check']){
                if(!empty($time_expiration_ok)){
                    $update = $usersModel->updateEmailCheck($data_user['email']);
                    if($update){
                        $data = array(
                          'email'=> $data_user['email']
                        );
                        $service->addParams($data);
                        $service->setTemplate('renders/modal_check_email');
                    }else{
                        $data = array(
                          'message'=> 'Ocurrió un problema por favor vuelva a intentarlo'
                        );
                        $service->addParams($data);
                        $service->setTemplate('renders/modal_check_email_messages');
                    }
                }else{
                    $data = array(
                          'email'=> $data_user['email'],
                          'iduser'=> $data_user['id']
                    );
                    $service->addParams($data);
                    $service->setTemplate('renders/modal_re_check_email');
                }
            }else{
                $data = array(
                    'message'=> 'Ya realizó anteriormente la verificación de su email.'
                );
                $service->addParams($data);
                $service->setTemplate('renders/modal_check_email_messages');
            }
        }else{
            $data = array(
                'message'=> 'El enlace no es correcto. Por favor contáctese con nosotros.'
            );
            $service->addParams($data);
            $service->setTemplate('renders/modal_check_email_messages');
        }
        
        $this->redirect()->toUrl("/");
        
    }

}