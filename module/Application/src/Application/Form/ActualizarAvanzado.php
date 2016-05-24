<?php

namespace Application\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Validator\InArray;

class ActualizarAvanzado extends \Zend\Form\Form
{

    protected $getServiceLocator = 0;

    public function __construct($dataFomr = array(), $getServiceLocator = null, $disable = true)
    {
        $this->getServiceLocator = $getServiceLocator;
        $ALinkedListTable = $this->getServiceLocator->get('Epass\Model\ALinkedListTable');
        $document_table = $this->getServiceLocator->get('Epass\Model\ADocumentTypeTable');

        parent::__construct();

        $text = array(
            'name' => 'txtNombreTitular',
            'type' => 'Zend\Form\Element\Text',
            'required' => true,
            'attributes' => array(
                'id' => 'txtNombreTitular',
                'data-parsley-pattern' => "/^[a-z-ñáéíóúÑÁÉÍÓÚäëïöü' ]+$/gi"
            )
        );
        $this->add($text);

        $text = array(
            'name' => 'txtApellidosTitular',
            'type' => 'Zend\Form\Element\Text',
            'required' => true,
            'attributes' => array(
                'id' => 'txtApellidosTitular',
                'data-parsley-pattern' => "/^[a-z-ñáéíóúÑÁÉÍÓÚäëïöü' ]+$/gi"
            )
        );
        $this->add($text);

        $select = new Element\Select('tipoDoc');
        $tipoDoc = array('' => 'Seleccionar') + $document_table->getDatafetchPairs();
        $select->setValueOptions($tipoDoc);
        if ($disable)
            $select->setAttribute('disabled', 'disabled');
        $this->add($select);
        //  $select->setDisableInArrayValidator();

        $atributesNumDocumento = array(
            'id' => 'txtNumDocumento',
            'maxlength' => '11'
        );
        if ($disable)
            $atributesNumDocumento['disabled'] = 'disabled';

        $text = array(
            'name' => 'txtNumDocumento',
            'type' => 'Zend\Form\Element\Text',
            'required' => true,
            'attributes' => $atributesNumDocumento
        );


        $this->add($text);

        $atributesRazonSocial = array(
            'id' => 'txtRazonsocial',
            'data-parsley-pattern' => "/^[a-z-ñáéíóúÑÁÉÍÓÚäëïöü' ]+$/gi"
        );
        if ($disable)
            $atributesRazonSocial['disabled'] = 'disabled';
        $text = array(
            'name' => 'txtRazonsocial',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => $atributesRazonSocial
        );
        $this->add($text);
        $atributestxtCorreo = array(
            'id' => 'txtCorreo'
        );
        if ($disable)
            $atributestxtCorreo['disabled'] = 'disabled';

        $text = array(
            'name' => 'txtCorreo',
            'type' => 'text',
            'required' => true,
            'attributes' => $atributestxtCorreo
        );


        $this->add($text);
        $select = new Element\Select('idDpto');
        $select->setAttributes(array('id' => 'idDpto'));
        $dpto = array();
        $dpto = $ALinkedListTable->getUbigeofetchPairs(array('LIST' => \Epass\Model\ALinkedListTable::DEPARTAMENTOS));
         $dpto[''] = "Seleccionar  Departamento";
        //ksort($dpto);
        $select->setOptions(array(
            //     'empty_option' => 'Seleccionar Departamento',
            'value_options' => $dpto
                )
        );
        $select->setValue('');
        $select->setValueOptions($dpto);

        $this->add($select);

        $select = new Element\Select('idProvin');
        $select->setAttributes(array('id' => 'idProvin'));
        $Provin = array();
        if(!empty($dataFomr['idDpto'])){
            $Provin = $ALinkedListTable->getUbigeofetchPairs(array('LIST' => \Epass\Model\ALinkedListTable::PROVINCIAS, 'DEPINDEX' => $dataFomr['idDpto']));
        }
        
        // if (count($Provin) == 0)
        //$Provin[''] = "Seleccionar  Provincia";
        //ksort($Provin);
        $Provin = array(''=>"Seleccionar  Provincia")+$Provin;
        $select->setValueOptions($Provin);

        $this->add($select);

        $select = new Element\Select('idDistrito');
        $select->setAttributes(array('id' => 'idDistrito'));
        $Distrito = array();
        if(!empty($dataFomr['idProvin'])){
            $Distrito = $ALinkedListTable->getUbigeofetchPairs(array('LIST' => \Epass\Model\ALinkedListTable::DISTRITOS, 'DEPINDEX' => $dataFomr['idProvin']));   
        }  
        /// if (count($Distrito) == 0)
        //$Distrito[''] = "Seleccionar  Distrito";

        //ksort($Distrito);
        $Distrito = array(''=>"Seleccionar  Distrito")+$Distrito;
        $select->setValueOptions($Distrito);

        $this->add($select);

//        $text = array(
//            'name' => 'txtNombVia',
//            'type' => 'Zend\Form\Element\Text',
//            'required' => true,
//            'attributes' => array(
//                'id' => 'txtNombVia',
//                'data-parsley-pattern' => "/^[a-z-ñáéíóúÑÁÉÍÓÚäëïöü' ]+$/gi"
//            )
//        );
//        $this->add($text);
//
//        $text = array(
//            'name' => 'txtNumVia',
//            'type' => 'Zend\Form\Element\Text',
//            'required' => true,
//            'attributes' => array(
//                'id' => 'txtNumVia',
//                'maxlength' => '6'
//            )
//        );
//        $this->add($text);
//
//        $text = array(
//            'name' => 'txtDptoVia',
//            'type' => 'Zend\Form\Element\Text',
//            'required' => true,
//            'attributes' => array(
//                'id' => 'txtDptoVia',
//                'data-parsley-pattern' => "/^[a-z-ñáéíóúÑÁÉÍÓÚäëïöü' ]+$/gi"
//            )
//        );
//        $this->add($text);
//
//        $text = array(
//            'name' => 'txtUrbanizacion',
//            'type' => 'Zend\Form\Element\Text',
//            'required' => true,
//            'attributes' => array(
//                'id' => 'txtUrbanizacion',
//                'data-parsley-pattern' => "/^[a-z-ñáéíóúÑÁÉÍÓÚäëïöü' ]+$/gi"
//            )
//        );
//        $this->add($text);

        $text = array(
            'name' => 'txtDireccion',
            'type' => 'Zend\Form\Element\Text',
            'required' => true,
            'attributes' => array(
                'id' => 'txtDireccion',
                'data-parsley-pattern' => "/^[a-z-ñáéíóúÑÁÉÍÓÚäëïöü' ]+$/gi"
            )
        );
        $this->add($text);


        $text = array(
            'name' => 'txtReferencia',
            'type' => 'Zend\Form\Element\Text',
            'required' => true,
            'attributes' => array(
                'id' => 'txtReferencia',
                'data-parsley-pattern' => "/^[a-z-ñáéíóúÑÁÉÍÓÚäëïöü' ]+$/gi"
            )
        );
        $this->add($text);




        $hidden = array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
            'attributes' => array(
                'id' => 'id'
            )
        );
        $this->add($hidden);

        $hidden = array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'idUser',
            'attributes' => array(
                'id' => 'idUser'
            )
        );
        $this->add($hidden);

        $pass = array(
            'type' => 'Zend\Form\Element\Password',
            'name' => 'txtContrasenia',
            'required' => true,
            'options' => array('label' => 'Clave'),
            'attributes' => array(
                'id' => 'txtContrasenia',
                'placeholder' => "Contraseña"
            )
        );
        $this->add($pass);

        $rePass = array(
            'type' => 'Zend\Form\Element\Password',
            'name' => 'txtConfirmaContrasenia',
            'required' => true,
            'options' => array('label' => 'Clave'),
            'attributes' => array(
                'id' => 'txtConfirmaContrasenia',
                'placeholder' => "Repita Contraseña"
            )
        );
        $this->add($rePass);

        $btnGuardar = new Element\Button('btnSgtPaso');
        $btnGuardar->setAttribute('type', 'submit');
        $btnGuardar->setAttribute('value', 1);

        $btnGuardar->setOptions(array('label' => 'Actualizar'));
        $this->add($btnGuardar);

        //no cambiar de type porque se usa para llamar un ajax
        $btnCancelar = new Element\Button('btnCancelar');
        $btnCancelar->setAttribute('type', 'button');
        $btnCancelar->setOptions(array('label' => 'Cancelar'));
        $this->add($btnCancelar);

    }

    public function _isValid($data)
    {

        if (empty($data['idDpto']))
            $data['idDpto'] = '15';
        if (empty($data['idProvin']))
            $data['idProvin'] = '128';
        if (empty($data['idDistrito']))
            $data['idDistrito'] = '1252';

        $ALinkedListTable = $this->getServiceLocator->get('Epass\Model\ALinkedListTable');
        $Provin = $ALinkedListTable->getUbigeofetchPairs(array('LIST' => \Epass\Model\ALinkedListTable::PROVINCIAS, 'DEPINDEX' => $data['idDpto']));
        $Distrito = $ALinkedListTable->getUbigeofetchPairs(array('LIST' => \Epass\Model\ALinkedListTable::DISTRITOS, 'DEPINDEX' => $data['idProvin']));

        if ($data['idProvin']) {
            // $Provin[''] = "Seleccionar  Provincia";

            $this->get('idProvin')->setValueOptions($Provin);
        }
        if ($data['idDistrito']) {
            //$Distrito[''] = "Seleccionar  Distrito";
            $this->get('idDistrito')->setValueOptions($Distrito);
        }

        $this->setData($data);


        return $this->isValid();

    }

}
