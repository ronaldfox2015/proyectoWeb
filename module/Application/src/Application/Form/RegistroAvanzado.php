<?php

namespace Application\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class RegistroAvanzado extends \Zend\Form\Form
{

    protected $_editar = 0;

    public function __construct($name = null, $disable = false)
    {
        $this->_editar = ($name) ? true : false;
        parent::__construct($name);

        $text = array(
            'name' => 'txtRazonSocial',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'txtRazonSocial',
                'data-parsley-pattern' => "/^[a-z-ñáéíóúÑÁÉÍÓÚäëïöü' ]+$/gi"
            )
        );
        $this->add($text);

        $text = array(
            'name' => 'txtNombreTitular',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'txtNombreTitular',
                'data-parsley-pattern' => "/^[a-z-ñáéíóúÑÁÉÍÓÚäëïöü' ]+$/gi"
            )
        );
        $this->add($text);

        $text = array(
            'name' => 'txtApellidosTitular',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'txtApellidosTitular',
                'data-parsley-pattern' => "/^[a-z-ñáéíóúÑÁÉÍÓÚäëïöü' ]+$/gi"
            )
        );
        $this->add($text);

        $select = new Element\Select('tipoDoc');
        $this->add($select);

        $text = array(
            'name' => 'txtNumDocumento',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'txtNumDocumento'
            )
        );
        $this->add($text);

        $atributestxtCorreo = array(
            'id' => 'txtCorreo'
        );
//        if ($disable)
//            $atributestxtCorreo['readonly'] = 'readonly';
        $text = array(
            'name' => 'txtCorreo',
            'type' => 'text',
            'attributes' => $atributestxtCorreo
        );
        $this->add($text);

        $text = array(
            'name' => 'txtTelefono',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'txtTelefono'
            )
        );
        $this->add($text);

        $pass = array(
            'type' => 'Zend\Form\Element\Password',
            'name' => 'txtContrasenia',
            'options' => array('label' => 'Clave'),
            'attributes' => array(
                'id' => 'txtContrasenia',
                'placeholder' => "Contraseña",
                'maxlength' => 12
            )
        );
        $this->add($pass);

        $rePass = array(
            'type' => 'Zend\Form\Element\Password',
            'name' => 'txtConfirmaContrasenia',
            'options' => array('label' => 'Clave'),
            'attributes' => array(
                'id' => 'txtConfirmaContrasenia',
                'placeholder' => "Repita Contraseña",
                'maxlength' => 12
            )
        );
        $this->add($rePass);

        $select = new Element\Select('idTipoVehiculo');
        $select->setAttributes(array('id' => 'idTipoVehiculo'));
        $this->add($select);

        $radio = new Element\Radio('radTipo');
        $options = array(
            1 => array(
                'id' => 'radTipo',
                'value' => '0',
                'label' => 'Retiro en punto de Venta',
                'label_attributes' => array('class' => 'bloqueInput col-xs-12 col-sm-6 col-md-6 form-group spanEpass'),
                'attributes' => array('class' => 'imputEpass radioEnvioRetiro'),
            ),
            2 => array(
                'id' => 'radTipo',
                'value' => '1',
                'label' => 'Envío a Domicilio',
                'label_attributes' => array('class' => 'bloqueInput col-xs-12 col-sm-6 col-md-6 form-group spanEpass'),
                'attributes' => array('class' => 'imputEpass radioEnvioRetiro'),
            )
        );
        $radio->setAttributes(array('id' => 'radReason'
            , 'value' => '0'
        ));
        $radio->setValueOptions($options);
        $this->add($radio);

        $select = new Element\Select('idMarca');
        $select->setAttributes(array('id' => 'idMarca'));
        $this->add($select);

        $select = new Element\Select('idModelo');
        $select->setAttributes(array('id' => 'idModelo'));
        $this->add($select);

        $text = array(
            'name' => 'txtPlaca',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'txtPlaca',
                'maxlength' => 10,
                'data-parsley-pattern' => "/^[a-z-ñáéíóúÑÁÉÍÓÚäëïöü' ]+$/gi"
            )
        );
        $this->add($text);
        
        $text = new Element\Text('txtColor');
        $text->setAttributes(array('id' => 'txtColor'));
        $this->add($text);

        //tipo vehiculo dos
        $select = new Element\Select('idTipoVehiculo2');
        $select->setAttributes(array('id' => 'idTipoVehiculo2'));
        $this->add($select);

        $select = new Element\Select('idMarca2');
        $select->setAttributes(array('id' => 'idMarca2'));
        $this->add($select);

        $select = new Element\Select('idModelo2');
        $select->setAttributes(array('id' => 'idModelo2'));
        $this->add($select);

        $text = array(
            'name' => 'txtPlaca2',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'txtPlaca2',
                'data-parsley-pattern' => "/^[a-z-ñáéíóúÑÁÉÍÓÚäëïöü' ]+$/gi"
            )
        );
        $this->add($text);
        
        $text = new Element\Text('txtColor2');
        $text->setAttributes(array('id' => 'txtColor2'));
        $this->add($text);

        // tipo vehiculo 3
        $select = new Element\Select('idTipoVehiculo3');
        $select->setAttributes(array('id' => 'idTipoVehiculo3'));
        $this->add($select);

        $select = new Element\Select('idMarca3');
        $select->setAttributes(array('id' => 'idMarca3'));
        $this->add($select);

        $select = new Element\Select('idModelo3');
        $select->setAttributes(array('id' => 'idModelo3'));
        $this->add($select);

        $text = array(
            'name' => 'txtPlaca3',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'txtPlaca3',
                'data-parsley-pattern' => "/^[a-z-ñáéíóúÑÁÉÍÓÚäëïöü' ]+$/gi"
            )
        );
        $this->add($text);
        $text = new Element\Text('txtColor3');
        $text->setAttributes(array('id' => 'txtColor3'));
        $this->add($text);

        // tipo vehiculo 4
        $select = new Element\Select('idTipoVehiculo4');
        $select->setAttributes(array('id' => 'idTipoVehiculo4'));
        $this->add($select);

        $select = new Element\Select('idMarca4');
        $select->setAttributes(array('id' => 'idMarca4'));
        $this->add($select);

        $select = new Element\Select('idModelo4');
        $select->setAttributes(array('id' => 'idModelo4'));
        $this->add($select);

        $text = array(
            'name' => 'txtPlaca4',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'txtPlaca4',
                'data-parsley-pattern' => "/^[a-z-ñáéíóúÑÁÉÍÓÚäëïöü' ]+$/gi"
            )
        );
        $this->add($text);
        
        $text = new Element\Text('txtColor4');
        $text->setAttributes(array('id' => 'txtColor4'));
        $this->add($text);

        // tipo vehiculo 5
        $select = new Element\Select('idTipoVehiculo5');
        $select->setAttributes(array('id' => 'idTipoVehiculo5'));
        $this->add($select);

        $select = new Element\Select('idMarca5');
        $select->setAttributes(array('id' => 'idMarca5'));
        $this->add($select);

        $select = new Element\Select('idModelo5');
        $select->setAttributes(array('id' => 'idModelo5'));
        $this->add($select);

        $text = array(
            'name' => 'txtPlaca5',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'txtPlaca5',
                'data-parsley-pattern' => "/^[a-z-ñáéíóúÑÁÉÍÓÚäëïöü' ]+$/gi"
            )
        );
        $this->add($text);
        
        $text = new Element\Text('txtColor5');
        $text->setAttributes(array('id' => 'txtColor5'));
        $this->add($text);

        // tipo vehiculo 6
        $select = new Element\Select('idTipoVehiculo6');
        $select->setAttributes(array('id' => 'idTipoVehiculo6'));
        $this->add($select);

        $select = new Element\Select('idMarca6');
        $select->setAttributes(array('id' => 'idMarca6'));
        $this->add($select);

        $select = new Element\Select('idModelo6');
        $select->setAttributes(array('id' => 'idModelo6'));
        $this->add($select);

        $text = array(
            'name' => 'txtPlaca6',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'txtPlaca6',
                'data-parsley-pattern' => "/^[a-z-ñáéíóúÑÁÉÍÓÚäëïöü' ]+$/gi"
            )
        );
        $this->add($text);
        
        $text = new Element\Text('txtColor6');
        $text->setAttributes(array('id' => 'txtColor6'));
        $this->add($text);

        // tipo vehiculo 7
        $select = new Element\Select('idTipoVehiculo7');
        $select->setAttributes(array('id' => 'idTipoVehiculo7'));
        $this->add($select);

        $select = new Element\Select('idMarca7');
        $select->setAttributes(array('id' => 'idMarca7'));
        $this->add($select);

        $select = new Element\Select('idModelo7');
        $select->setAttributes(array('id' => 'idModelo7'));
        $this->add($select);

        $text = array(
            'name' => 'txtPlaca7',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'txtPlaca7',
                'data-parsley-pattern' => "/^[a-z-ñáéíóúÑÁÉÍÓÚäëïöü' ]+$/gi"
            )
        );
        $this->add($text);
        
        $text = new Element\Text('txtColor7');
        $text->setAttributes(array('id' => 'txtColor7'));
        $this->add($text);

        // tipo vehiculo 8
        $select = new Element\Select('idTipoVehiculo8');
        $select->setAttributes(array('id' => 'idTipoVehiculo8'));
        $this->add($select);

        $select = new Element\Select('idMarca8');
        $select->setAttributes(array('id' => 'idMarca8'));
        $this->add($select);

        $select = new Element\Select('idModelo8');
        $select->setAttributes(array('id' => 'idModelo8'));
        $this->add($select);

        $text = array(
            'name' => 'txtPlaca8',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'txtPlaca8',
                'data-parsley-pattern' => "/^[a-z-ñáéíóúÑÁÉÍÓÚäëïöü' ]+$/gi"
            )
        );
        $this->add($text);
        
        $text = new Element\Text('txtColor8');
        $text->setAttributes(array('id' => 'txtColor8'));
        $this->add($text);

        // tipo vehiculo 9
        $select = new Element\Select('idTipoVehiculo9');
        $select->setAttributes(array('id' => 'idTipoVehiculo9'));
        $this->add($select);

        $select = new Element\Select('idMarca9');
        $select->setAttributes(array('id' => 'idMarca9'));
        $this->add($select);

        $select = new Element\Select('idModelo9');
        $select->setAttributes(array('id' => 'idModelo9'));
        $this->add($select);

        $text = array(
            'name' => 'txtPlaca9',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'txtPlaca9',
                'data-parsley-pattern' => "/^[a-z-ñáéíóúÑÁÉÍÓÚäëïöü' ]+$/gi"
            )
        );
        $this->add($text);
        
        $text = new Element\Text('txtColor9');
        $text->setAttributes(array('id' => 'txtColor9'));
        $this->add($text);

        // tipo vehiculo 10
        $select = new Element\Select('idTipoVehiculo10');
        $select->setAttributes(array('id' => 'idTipoVehiculo10'));
        $this->add($select);

        $select = new Element\Select('idMarca10');
        $select->setAttributes(array('id' => 'idMarca10'));
        $this->add($select);

        $select = new Element\Select('idModelo10');
        $select->setAttributes(array('id' => 'idModelo10'));
        $this->add($select);

        $text = array(
            'name' => 'txtPlaca10',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'txtPlaca10',
                'data-parsley-pattern' => "/^[a-z-ñáéíóúÑÁÉÍÓÚäëïöü' ]+$/gi"
            )
        );
        $this->add($text);
        
        $text = new Element\Text('txtColor10');
        $text->setAttributes(array('id' => 'txtColor10'));
        $this->add($text);
        
        //ubigeo

        $select = new Element\Select('idDpto');
        $select->setAttributes(array('id' => 'idDpto'));
        $this->add($select);

        $select = new Element\Select('idProvin');
        $select->setAttributes(array('id' => 'idProvin'));
        $this->add($select);

        $select = new Element\Select('idDistrito');
        $select->setAttributes(array('id' => 'idDistrito'));
        $this->add($select);

//        $text = array(
//            'name' => 'txtNombVia',
//            'type' => 'Zend\Form\Element\Text',
//            'attributes' => array(
//                'id' => 'txtNombVia',
//                'data-parsley-pattern' => "/^[a-z-ñáéíóúÑÁÉÍÓÚäëïöü' ]+$/gi",
//                'maxlength'=>40
//            )
//        );
//        $this->add($text);
//        $text = array(
//            'name' => 'txtNumVia',
//            'type' => 'Zend\Form\Element\Text',
//            'attributes' => array(
//                'id' => 'txtNumVia',
//                'maxlength' => 10
//            )
//        );
//        $this->add($text);
//        $text = array(
//            'name' => 'txtDptoVia',
//            'type' => 'Zend\Form\Element\Text',
//            'attributes' => array(
//                'id' => 'txtDptoVia',
//                'data-parsley-pattern' => "/^[a-z-ñáéíóúÑÁÉÍÓÚäëïöü' ]+$/gi",
//                'maxlength'=>10
//            )
//        );
//        $this->add($text);

        $text = array(
            'name' => 'txtDireccion',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'txtUrbanizacion',
                'data-parsley-pattern' => "/^[a-z-ñáéíóúÑÁÉÍÓÚäëïöü' ]+$/gi",
                'maxlength' => 140
            )
        );
        $this->add($text);


        $text = array(
            'name' => 'txtReferencia',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'txtReferencia',
                'data-parsley-pattern' => "/^[a-z-ñáéíóúÑÁÉÍÓÚäëïöü' ]+$/gi"
            )
        );
        $this->add($text);

        $checkbox = array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'CkTerminos',
            'options' => array(
                'label' => 'Acepto los términos y condiciones del servicio',
                'use_hidden_element' => true,
                'checked_value' => 1,
                'unchecked_value' => 0
            ),
            'attributes' => array(
                'id' => 'CkTerminos'
            )
        );
        $this->add($checkbox);

        $checkbox = array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'CkNovedades',
            'options' => array(
                'label' => 'Quiero recibir novedades de e-pass',
                'use_hidden_element' => true,
                'checked_value' => 1,
                'unchecked_value' => 0
            ),
            'attributes' => array(
                'id' => 'CkNovedades'
            )
        );
        $this->add($checkbox);

        $hidden = array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'idPlan',
            'attributes' => array(
                'id' => 'idPlan'
            )
        );
        $this->add($hidden);

        $hidden = array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'txtMonto',
            'attributes' => array(
                'id' => 'txtMonto'
            )
        );
        $this->add($hidden);
        
        $hidden = array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id_plan',
            'attributes' => array(
                'id' => 'id_plan'
            )
        );
        $this->add($hidden);
        
        $hidden = array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id_user_trunco',
            'attributes' => array(
                'id' => 'id_user_trunco'
            )
        );
        $this->add($hidden);

        $hidden = array(
                'type' => 'Zend\Form\Element\Hidden',
                'name' => 'isUserSessionActive',
                'attributes' => array(
                    'id' => 'isUserSessionActive',
                    'value' => 0
                )
        );
        $this->add($hidden);
            
        $btnGuardar = new Element\Button('btnSgtPaso');
        $btnGuardar->setAttribute('type', 'submit');
        $btnGuardar->setOptions(array('label' => 'Siguiente Paso'));
        $this->add($btnGuardar);

    }

}
