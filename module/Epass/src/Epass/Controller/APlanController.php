<?php

namespace Epass\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Epass\Model\APlanTable;

class APlanController extends AbstractRestfulController
{
    public function getList()
    {
        /*$aPromotionModel = $this->getServiceLocator()->get('APromotionModel');
        $format = $aPromotionModel->getPaquetes();        
        $paquetesIndividuales = array_merge($format[APlanTable::PREPAGO_INDIVIDUAL_1],array_slice($format[APlanTable::PREPAGO_INDIVIDUAL_2],-3));
        $paquetesFamiliares = array_merge($format[APlanTable::PREPAGO_FAMILIAR_1],$format[APlanTable::PREPAGO_FAMILIAR_2]);
        $paquetesPrePagoEmpresa = $format[APlanTable::PREPAGO_CORPORATIVO];*/
        $mpe = $this->getServiceLocator()->get('mpe');
        $paquetes = $mpe->getPaquetesAfiliacion(['individual', 'familiar','corporativo']);
        foreach ($paquetes['individual'] as $key => $value) {
            $value = (array)$value;
            $value['namePlan1'] = \Application\Service\CuentaService::getPlanTitle($value['namePlan']);
            $individual[$key] = $value;
        }
        foreach ($paquetes['familiar'] as $key => $value) {
            $value = (array)$value;
            $value['namePlan1'] = \Application\Service\CuentaService::getPlanTitle($value['namePlan']);
            $familiar[$key] = $value;
        }
        foreach ($paquetes['corporativo'] as $key => $value) {
            $value = (array)$value;
            $value['namePlan1'] = \Application\Service\CuentaService::getPlanTitle($value['namePlan']);
            $corporativo[$key] = $value;
        }
        $data = array((array) $individual,
                    (array) $familiar,(array) $corporativo
        );
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