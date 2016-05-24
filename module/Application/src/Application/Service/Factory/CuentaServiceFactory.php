<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Description of EmpresaServiceFactory
 *
 * @author ronald
 */
class CuentaServiceFactory implements FactoryInterface
{

    //put your code here
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Application\Service\MpeService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $modelServicio = new \Application\Service\CuentaService($config);
        $mpe = $serviceLocator->get('mpe');
        $ALinkedListTable = $serviceLocator->get('Epass\Model\ALinkedListTable');
        
        $userPlansModel = $serviceLocator->get('UserPlansModel');
        $userModel = $serviceLocator->get('UsersModel');
        $WebServiceMongoModel = $serviceLocator->get('MongoModifyAccountDataCollection');
        $modelServicio->setMpe($mpe);
        $modelServicio->ALinkedListTable($ALinkedListTable);
        $modelServicio->userPlansModel($userPlansModel);
        $modelServicio->userModel($userModel);
        $modelServicio->WebServicemodifyAccount($WebServiceMongoModel);
        $modelServicio->setServiceLocator($serviceLocator);

        return $modelServicio;

    }

}
