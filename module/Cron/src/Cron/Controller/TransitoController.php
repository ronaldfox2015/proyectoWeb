<?php

namespace Cron\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Request as ConsoleRequest;
use Zend\Mvc\MvcEvent;

class TransitoController extends AbstractActionController {

    public function onDispatch(MvcEvent $e)
    {
//        if (!$this->getRequest() instanceof ConsoleRequest) {
//            throw new \RuntimeException('You can only use this action from a console!');
//        }

        return parent::onDispatch($e);
    }        
    
    /* 
     * @return \Cron\Service\TransitoImportService
     */
    protected function _getTransitoImportService()
    {
        return $this->getServiceLocator()->get('Cron\Service\TransitoImportService');
    }

    public function importAction() 
    {      
        $this->_getTransitoImportService()->import();
        
        exit();
    }

    

}
