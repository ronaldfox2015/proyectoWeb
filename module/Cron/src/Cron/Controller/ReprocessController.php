<?php

namespace Cron\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class ReprocessController extends AbstractActionController
{        
    public function indexAction()
    {     
        echo 'test - index';
        echo 'exito ' . date("Y-m-d") . " \n ";
        exit;
    }
    
    public function transactionsAction()
    {     
        $this->_getTransactionService()->reprocess();
        echo 'exito ' . date("Y-m-d") . " \n ";
        exit;
    }
    
    /**
     * 
     * @return \Epass\Service\TransactionService
     */
    protected function _getTransactionService()
    {
        return $this->getServiceLocator()->get('Epass\Service\TransactionService');
    }
    
}