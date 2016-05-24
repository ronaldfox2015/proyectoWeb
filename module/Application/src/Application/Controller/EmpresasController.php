<?php

namespace Application\Controller;

use Zend\Debug\Debug;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Epass\Model\APlanTable;

class EmpresasController extends AbstractActionController
{
    public function indexAction()
    {
        $mpe = $this->getServiceLocator()->get('mpe');
        $paquetes = $mpe->getPaquetesAfiliacion(['corporativo']);

        foreach ($paquetes['corporativo'] as $key => $value) {
            $corporativo[$key] = (array)$value;
        }

        return new ViewModel(array('pqt1'=>$corporativo));
    }

    public function recargaAction()
    {
        $mpe = $this->serviceLocator->get('mpe');
        $packages = $mpe->getPaquetesRecarga(['corporativo']);

        return new ViewModel([
            'paquetes' => $packages
        ]);
    }
}

