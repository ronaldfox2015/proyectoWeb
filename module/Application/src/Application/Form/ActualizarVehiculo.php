<?php

namespace Application\Form;

use Zend\Form\Element;

class ActualizarVehiculo extends \Zend\Form\Form
{
    public function __construct()
    {
        parent::__construct();
        
        $text = array(
            'name' => 'txtCuenta',
            'type' => 'Zend\Form\Element\Text',
            'required' => true,
            'attributes' => array(
                'id' => 'txtCuenta'
            )
        );
        $this->add($text);
        
        $text = array(
            'name' => 'txtPlaca',
            'type' => 'Zend\Form\Element\Text',
            'required' => true,
            'attributes' => array(
                'id' => 'txtPlaca'
            )
        );
        $this->add($text);
        
        $text = array(
            'name' => 'txtTag',
            'type' => 'Zend\Form\Element\Text',
            'required' => true,
            'attributes' => array(
                'id' => 'txtTag'
            )
        );
        $this->add($text);
        
        $text = array(
            'name' => 'txtEstado',
            'type' => 'Zend\Form\Element\Text',
            'required' => true,
            'attributes' => array(
                'id' => 'txtEstado'
            )
        );
        $this->add($text);
        
        $text = array(
            'name' => 'txtColor',
            'type' => 'Zend\Form\Element\Text',
            'required' => true,
            'attributes' => array(
                'id' => 'txtColor'
            )
        );
        $this->add($text);
        
        $select = new Element\Select('slxTipo');
        $select->setAttributes(array('id' => 'slxTipo'));
        $this->add($select);
        
        $select = new Element\Select('slxModelo');
        $select->setAttributes(array('id' => 'slxModelo'));
        $this->add($select);
        
        $select = new Element\Select('slxMarca');
        $select->setAttributes(array('id' => 'slxMarca'));
        $this->add($select);
        
        $hidden = array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'texto_marca',
            'attributes' => array(
                'id' => 'texto_marca'
            )
        );
        $this->add($hidden);
        
        $hidden = array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'texto_modelo',
            'attributes' => array(
                'id' => 'texto_modelo'
            )
        );
        $this->add($hidden);
        
        $hidden = array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'vehiculo_id',
            'attributes' => array(
                'id' => 'vehiculo_id'
            )
        );
        $this->add($hidden);
        
        /*$select = new Element\Select('slxColor');
        $select->setAttributes(array('id' => 'slxColor'));
        $this->add($select);*/
    }
}
