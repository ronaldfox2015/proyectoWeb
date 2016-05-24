<?php

namespace Application\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Validator\InArray;

class Reportes extends \Zend\Form\Form
{
    /*public static $_medioPago = array(
        'BC' => 'Banco de Crédito del Perú',
        'MC' => 'Pago a través de MasterCard',
        'VS' => 'Pago a través de VISA',
        'AE' => 'Pago a través de American Express',
        'DC' => 'Pago a través de Diners Club',
        'CA' => 'Pago en efectivo',
        'CC' => 'Cargo en cuenta',
        'NO' => 'Sin Pago'
    );*/
    
    public static $_medioPago= array(
        'A' => 'Ajuste de Saldo',
        'P' => 'Cargo por característica de Plan',
        'Q' => 'Cargo por característica de Promoción',
        'J' => 'Pago BCP',
        'H' => 'Pago en efectivo',
        'L' => 'Pago por banco',
        'I' => 'Pago por POS',
        'G' => 'Pago por web',
        'C' => 'Tasa de facturación a empresas'
    );
    
    public static $_tipoSelect = array(
        'G' => 'Recarga por web',
        'H' => 'Recarga en efectivo',
        'C' => 'Tasa de facturación a empresas',
        'I' => 'Recarga por POS',
        'J' => 'Recarga BCP',
        'L' => 'Recarga por banco',
        'P' => 'Tasa recarga',
        'Q' => 'Cargo por característica de Promoción'
    );
    public static $_tipoSelection = array(
        'Recarga por web' => 'Recarga por web',
        'Recarga en efectivo' => 'Recarga en efectivo',
        'Recarga por POS' => 'Tasa de facturación a empresas',
        'Recarga por POS' => 'Recarga por POS',
        'Recarga BCP' => 'Recarga BCP',
        'Recarga por banco' => 'Recarga por banco',
        'Cargo por característica de Plan' => 'Cargo por característica de Plan',
        'Cargo por característica de Promoción' => 'Cargo por característica de Promoción'
    );
    public static   $_meses = array(
            '01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre'
        );
    public static $_tipo = array('G', 'H', 'C', 'I', 'J', 'L', 'P', 'Q');
    protected $getServiceLocator = 0;

    public function __construct($dataFomr = array(), $getServiceLocator = null)
    {
        $this->getServiceLocator = $getServiceLocator;
        $document_table = $this->getServiceLocator->get('Epass\Model\ADocumentTypeTable');
        $datatipo = $document_table->getDatafetchPairs();
        parent::__construct();


        $select = new Element\Select('tipo');
        $select->setAttributes(array('id' => 'tipo'));

        self::$_tipoSelection[''] = "Seleccione";
        ksort(self::$_tipoSelection);
        $select->setValueOptions(self::$_tipoSelect);
        $this->add($select);



        $select = new Element\Select('periodo');
        $select->setAttributes(array('id' => 'periodo'));


        //  $select->setDisableInArrayValidator(true);
        $select->setValueOptions($this->SelectPeriodo());
      //  $select->setValue(date('m/Y'));

        $this->add($select);

        $select = new Element\Select('mediopago');
        $select->setAttributes(array('id' => 'medio_pago'));
        //sort(self::$_medioPago);
        self::$_medioPago = array(''=>"Todos")+self::$_medioPago;      
        $select->setValueOptions(self::$_medioPago);
        $this->add($select);

        $select = new Element\Select('mes');
        $select->setAttributes(array('id' => 'mes'));
        self::$_meses[''] = "Todos";
        ksort(self::$_meses);
        $select->setValueOptions(self::$_meses);
//        $select->setDisableInArrayValidator(true);

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

    private function SelecttipoDoc($dataFomr)
    {
        $tipodoc = array();
        foreach ($dataFomr as $key => $value) {
            foreach ($value as $k => $v) {
                $tipodoc[$v["req_PaymentType"]] = $v["tipo"];
            }
        }
        $tipodoc['A'] = "Seleccione";
        ksort($tipodoc);
        return $tipodoc;

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
        $date = date("Y-m-01");
        for ($i = 0; $i <= 11; $i++) {
            $mes = date("m", strtotime("-$i month", strtotime($date)));
            $Y = date("Y", strtotime("-$i month", strtotime($date)));
            $periodo[$mes.'/'.$Y] = $meses[$mes].$Y;
        }
        return $periodo;

    }

}
