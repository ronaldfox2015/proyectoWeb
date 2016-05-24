<?php

namespace Front\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    public function indexAction()
    { 
        return new ViewModel();
    }
    
    public function homeAction()
    { 
        return new ViewModel();
    }  
    
    public function queesAction()
    { 
        return new ViewModel();
    } 
    
    public function beneficiosAction()
    { 
        return new ViewModel();
    }  
    
    public function dondeAction()
    { 
        return new ViewModel();
    }  
    
    public function comoAction()
    { 
        return new ViewModel();
    }   
    
    public function preguntasAction()
    { 
        return new ViewModel();
    }   

    public function personaAction()
    {
    	return new ViewModel();
    }
    public function empresaAction()
    {
        return new ViewModel();
    }
    public function afiliateAction()
    {
        return new ViewModel();
    }

    public function reclamacionesAction()
    {
        return new ViewModel();   
    }
    public function contactanosAction()
    {
        return new ViewModel();
    }
    public function afiliatepagoAction()
    {
        return new ViewModel();
    }
    public function empresarecargaAction()
    {
        return new ViewModel();
    }
    public function afiliacionempresaprepagoAction()
    {
        return new ViewModel();
    }

}

