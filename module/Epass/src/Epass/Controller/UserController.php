<?php

namespace Epass\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class UserController extends AbstractRestfulController
{
    public function options()
    {
        $response = $this->getResponse();
        $response->getHeaders()
        ->addHeaderLine('Allow', implode(',', array('POST'/*,'DELETE','GET','PUT'*/)));
        return $response;
    }
    public function create($datos)
    {
        $usersModel = $this->getServiceLocator()->get('UsersModel');       
        $datos['password'] = md5($datos['password']);
        $datos['terms_check'] = 1;
        $datos['news_check'] = 0;
        $datos['role_id'] = \Epass\Model\RolesTable::PUBLICO;        
        $users = $usersModel->saveUser($datos);
        return new JsonModel(array(
            'user_id' => $users,
        ));

    }
    public function getList()
    {
        $query = array();
        parse_str($_SERVER['QUERY_STRING'], $query);
        $usersModel = $this->getServiceLocator()->get('UsersModel');       
        $data = $usersModel->getUsers($query);         
        $response = $this->getResponseWithHeader()
                    ->setContent(json_encode($data,JSON_UNESCAPED_UNICODE));
        return $response;
    }    
    public function getResponseWithHeader()
    {
        $response = $this->getResponse();
        $response->getHeaders()
                ->addHeaderLine('Access-Control-Allow-Origin', '*')
                ->addHeaderLine('Access-Control-Allow-Methods','POST')
                ->addHeaders(array('Content-Type' => 'application/json;charset=UTF-8'));
        return $response;

    }

}
