<?php

namespace Front\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class EmailController extends AbstractActionController
{
    public function activacioncuentaAction()
    { 
        
        $viewModel = new ViewModel();
        return $viewModel;
    }
    
    public function bienvenidocuentaAction()
    { 
        return new ViewModel();
    }  
    
    public function recuperarpasswordAction()
    { 
              
        return new ViewModel();
    }  
    public function comprobanteplanAction()
    { 
              
        return new ViewModel();
    }  
    public function comprobanteprepagoAction()
    { 
              
        return new ViewModel();
    } 
    
    public function mail1Action()
    { 
           $view = new ViewModel();
        return $view->setTerminal(true);
    } 
    
    public function mail2Action()
    { 
           $view = new ViewModel();
        return $view->setTerminal(true);
    } 

}

