<?php

namespace Epass\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Epass\Model\APromotionTable;

class APromotionController extends AbstractRestfulController
{
    public function getList()
    {
        $aPromotionModel = $this->getServiceLocator()->get('APromotionModel');
        $data = $aPromotionModel->getRecarga();
        $response = $this->getResponseWithHeader()
                    ->setContent(json_encode($data,JSON_UNESCAPED_UNICODE));
        return $response;
    }
    public function getResponseWithHeader()
    {
        $response = $this->getResponse();
        $response->getHeaders()  
                 //->addHeaderLine('Access-Control-Allow-Origin','*')
                 //->addHeaderLine('Access-Control-Allow-Methods','POST PUT DELETE GET')
                 ->addHeaderLine('Access-Control-Allow-Methods','GET')
                 ->addHeaders(array('Content-Type'=>'application/json;charset=UTF-8'));
        return $response;
    }
}