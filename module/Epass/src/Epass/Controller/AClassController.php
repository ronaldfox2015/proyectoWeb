<?php

namespace Epass\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;

class AClassController extends AbstractRestfulController
{
    protected $_aClassTable;
    public function getAClassTable() {
        if (!$this->_aClassTable) {
            $sm = $this->getServiceLocator();
            $this->_aClassTable = $sm->get('Epass\Model\AClassTable');
        }
        return $this->_aClassTable;
    }
    public function getList()
    {
        $query = array();
        parse_str($_SERVER['QUERY_STRING'], $query);
        $data = $this-> getAClassTable()->getData($query);
        $response = $this->getResponseWithHeader()
                    ->setContent(json_encode($data,JSON_UNESCAPED_UNICODE));
        return $response;
    }
    public function getResponseWithHeader()
    {
        $response = $this->getResponse();
        $response->getHeaders()  
                 ->addHeaderLine('Access-Control-Allow-Origin','*')
                 //->addHeaderLine('Access-Control-Allow-Methods','POST PUT DELETE GET')
                 ->addHeaderLine('Access-Control-Allow-Methods','GET')
                 ->addHeaders(array('Content-Type'=>'application/json;charset=UTF-8'));
        return $response;
    }
}