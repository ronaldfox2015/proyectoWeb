<?php

namespace Front\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ReclamacionesController extends AbstractActionController
{
    public function indexAction()
    { 
        $this->layout()->setVariable('reclamaciones', true);
        
        $viewModel = new ViewModel();
        $viewModel->setVariable('reclamaciones', true);
        return $viewModel;
    }
 
  

}

