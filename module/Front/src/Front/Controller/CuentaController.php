<?php

namespace Front\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CuentaController extends AbstractActionController
{
    public function indexAction()
    { 
        $this->layout()->setVariable('cuenta', true);
        
        $viewModel = new ViewModel();
        $viewModel->setVariable('cuenta', true);
        return $viewModel;
    }
    
    public function reportesAction()
    { 
        $this->layout()->setVariable('cuenta', true);
        return new ViewModel();
    }  
    
    public function vehiculosAction()
    { 
        $this->layout()->setVariable('cuenta', true);
        
        return new ViewModel();
    }  
    public function comprobantesAction()
    { 
        $this->layout()->setVariable('cuenta', true);
        
        return new ViewModel();
    }
    public function paqueteseleccionadoAction()
    {
        $this->layout()->setVariable('cuenta', true);        
        return new ViewModel();
    }
    public function afiliacionpasounoAction()
    {
        $this->layout()->setVariable('cuenta', true);        
        return new ViewModel();
    }
    public function pasopagoAction()
    {
        $this->layout()->setVariable('cuenta', true);        
        return new ViewModel();
    }
    public function familiarpasounoAction()
    {
        $this->layout()->setVariable('cuenta', true);        
        return new ViewModel();
    }
    public function familiarpasodosAction()
    {
        $this->layout()->setVariable('cuenta', true);        
        return new ViewModel();
    }
    public function cuentasasociadasAction(){
        $this->layout()->setVariable('cuenta', true);        
        return new ViewModel();
    }
}

