<?php

namespace Epass\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class MpeController extends AbstractActionController
{
    public function getAllPlansWithPromotionsAction()
    {
        $mpe = $this->serviceLocator->get('mpe');
        $response = $mpe->getAllPlansWithPromotions();

        return new JsonModel([
            $response
        ]);
    }
}