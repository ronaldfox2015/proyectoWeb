<?php

namespace Application\Form;

use Zend\Debug\Debug;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Validator\InArray;

class Transitos extends \Zend\Form\Form
{
    protected $getServiceLocator = 0;

    public function __construct($dataFomr = array(), $getServiceLocator = null)
    {
        $this->getServiceLocator = $getServiceLocator;
        $document_table = $this->getServiceLocator->get('Epass\Model\ADocumentTypeTable');
        $plaza_table = $this->getServiceLocator->get('APlazaModel');
        parent::__construct();
        $select = new Element\Select('periodo-transaccion');
        $select->setAttributes(array('id' => 'periodo-transaccion'));
        $select->setValueOptions($this->SelectPeriodo());
        $select->setValue(date('m/Y'));
        $this->add($select);

        $select = new Element\Select('plaza');
        $select->setAttributes(array('id' => 'plaza'));
        $select->setValueOptions($this->SelectPlaza($plaza_table));
        $this->add($select);
    }

    public function _isValid($data)
    {
//        var_dump($data);exit;
//        if ($data['idDpto']) {
//            $this->get('idDpto')->setDisableInArrayValidator(true);
//        }
//
//        if ($data['idProvin']) {
//            $this->get('idProvin')->setDisableInArrayValidator(true);
//        }
        $this->setData($data);
        return $this->isValid();

    }

    private function SelectPeriodo()
    {
        $meses = array(
            '01' => 'Enero - ',
            '02' => 'Febrero - ',
            '03' => 'Marzo - ',
            '04' => 'Abril - ',
            '05' => 'Mayo - ',
            '06' => 'Junio - ',
            '07' => 'Julio - ',
            '08' => 'Agosto - ',
            '09' => 'Septiembre - ',
            '10' => 'Octubre - ',
            '11' => 'Noviembre - ',
            '12' => 'Diciembre - '
        );
        $periodo[''] = "Todos";
        //$date = date("Y-m-d");
        $date = date("Y-m-01");
        for ($i = 0; $i <= 11; $i++) {
            $mes = date("m", strtotime("-$i month", strtotime($date)));
            $Y = date("Y", strtotime("-$i month", strtotime($date)));
            $periodo[$mes.'/'.$Y] = $meses[$mes].$Y;
        }
        return $periodo;

    }

    private function SelectPlaza($plaza_table)
    {
        $all = $plaza_table->getAllPlaza();
        foreach ($all as $k => $value ) {
            $plaza[''] = 'Todos';
            $plaza[$k]['value'] = $value['PLAZA'];
            $plaza[$k]['label'] = $value['NAME'];
        }
        return $plaza;
    }

}
