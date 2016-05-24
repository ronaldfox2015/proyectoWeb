<?php

namespace Application\Form;

use Zend\Form\Form;

class LoginRecargaForm extends Form{
    
    public function __construct($name = null){
        
         parent::__construct('loginrecarga');

//         $this->add(array(
//             'name' => 'id',
//             'type' => 'Hidden',
//         ));
         
//         $this->add(array(
//             'name' => 'checktagplaca',
//             'type' => 'Radio',
//             'options' => array(
//                'value_options' => array(
//                    'tag' => 'Número de Tag',
//                    'placa' => 'Número de Placa',
//                ),
//                'label_attributes' => array(
//                    'class'  => 'radio-inline'
//                ),
//             ),
//             'attributes' => array(
//                 'required'=> true
//             )
//         ));
         
         $this->add(array(
             'name' => 'nroType',
             'type' => 'Text',
             'attributes' => array(
                 'placeholder' => '8 dígitos de su Tag o número de su placa',
                 'required'=> true,
                 'class'=> 'form-control'
             )
         ));
         
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Recargar',
                 'id' => 'submitbutton',
                 'class'=> 'btn btn-default'
             ),
         ));
     }
 }