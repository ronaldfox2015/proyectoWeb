<?php

namespace Epass\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class ALinkedListController extends AbstractRestfulController
{
    protected $_aLinkedListTable;
    public function getALinkedListTable() {
        if (!$this->_aLinkedListTable) {
            $sm = $this->getServiceLocator();
            $this->_aLinkedListTable = $sm->get('Epass\Model\ALinkedListTable');
        }
        return $this->_aLinkedListTable;
    }
    public function getList()
    {
        $query = array();
        parse_str($_SERVER['QUERY_STRING'], $query);
        $data = $this->getALinkedListTable()->getData($query);
        $response = $this->getResponseWithHeader()
                    ->setContent(json_encode($data,JSON_UNESCAPED_UNICODE));
        return $response;
        //return new JsonModel($data);
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