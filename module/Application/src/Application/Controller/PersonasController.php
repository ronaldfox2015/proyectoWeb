<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Epass\Model\APlanTable;
use Zendesk\API\Debug;

class PersonasController extends AbstractActionController
{
    public function indexAction()
    {
        $mpe = $this->getServiceLocator()->get('mpe');
        $paquetes = $mpe->getPaquetesAfiliacion(['individual', 'familiar']);
        foreach ($paquetes['individual'] as $key => $value) {
            $individual[$key] = (array)$value;
        }
        foreach ($paquetes['familiar'] as $key => $value) {
            $familiar[$key] = (array)$value;
        }
        return new ViewModel(array('pqtI' => (array) $individual, 'pqtF' => (array) $familiar));
    }

    public function recargaAction()
    {
        $mpe = $this->getServiceLocator()->get('mpe');
        $Paquetes = $mpe->getPaquetesRecarga(['individual', 'familiar']);

        return new ViewModel([
            'paquetes' => $Paquetes
        ]);
    }

}
