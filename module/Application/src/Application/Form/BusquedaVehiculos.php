<?php

namespace Application\Form;

use Zend\Form\Element;

class BusquedaVehiculos extends \Zend\Form\Form {
    
    /*Debe estar ordenado por la descripcion*/
    public static $_estateSelect  = array(
        'C'=> 'Creado pero sin TAG',
        'O'=> 'Ok',
        'W'=> 'Pendiente de Activación',
        'G'=> 'Pendiente de pago',
        'S'=> 'Suspendido',
        'U'=> 'TAG no distribuido'
    );
    
    public function __construct()
    {
        parent::__construct();
        
        
        $select = new Element\Select('bslxCuenta');
        $select->setAttributes(array('id' => 'bslxCuenta'));
        $this->add($select);
        
        $select = new Element\Select('bslxPlaca');
        $select->setAttributes(array('id' => 'bslxPlaca'));
        $this->add($select);
        

        $select = new Element\Select('bslxMarca');
        $select->setAttributes(array('id' => 'bslxMarca'));
        $this->add($select);
        
        $select = new Element\Select('bslxTag');
        $select->setAttributes(array('id' => 'bslxTag'));
        $this->add($select);
        
        $select = new Element\Select('bslxModelo');
        $select->setAttributes(array('id' => 'bslxModelo'));
        $this->add($select);
        
        $select = new Element\Select('bslxEstado');
        $select->setAttributes(array('id' => 'estado'));
        
        //sort(self::$_estateSelect);
        self::$_estateSelect = array('' => 'Todos') + self::$_estateSelect;
        $select->setValueOptions(self::$_estateSelect);
        $this->add($select);
    }
}
