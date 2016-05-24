<?php

namespace Epass\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;

class ADocumentTypeController extends AbstractRestfulController
{
    protected $_aDocumentTypeTable;
    public function getADocumentTypeTable() {
        if (!$this->_aDocumentTypeTable) {
            $sm = $this->getServiceLocator();
            $this->_aDocumentTypeTable = $sm->get('Epass\Model\ADocumentTypeTable');
        }
        return $this->_aDocumentTypeTable;
    }
    public function getList()
    {
        $data = $this-> getADocumentTypeTable()->getData();
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