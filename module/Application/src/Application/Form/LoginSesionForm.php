<?php

namespace Application\Form;

use Zend\Form\Form;

class LoginSesionForm extends Form{
    
    public function __construct($name = null){
        
         parent::__construct('loginsesion');

//         $this->add(array(
//             'name' => 'id',
//             'type' => 'Hidden',
//         ));
         
         $this->add(array(
             'name' => 'username',
             'type' => 'Email',
             'options' => array(
                 'label' => 'Correo',
             ),
             'attributes' => array(
                 'placeholder' => 'Correo',
                 'required'=>'required',
                 'class'=> 'form-control'
             )
         ));
         
         $this->add(array(
             'name' => 'password',
             'type' => 'Password',
             'options' => array(
                 'label' => 'Contraseña',
             ),
             'attributes' => array(
                 'placeholder' => 'Contraseña',
                 'required'=>'required',
                 'class'=> 'form-control'
             )
         ));
         
//         $this->add(array(
//             'name' => 'recordarmipass',
//             'type' => 'Checkbox',
//             'options' => array(
//                'use_hidden_element' => false,
//                'checked_value' => '1',
//                'unchecked_value' => '0'
//             ),
//             'attributes' => array(
//                 'value' => '1'
//             )
//         ));
         
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Iniciar Sesión',
                 'id' => 'submitbutton',
                 'class'=> 'btn btn-default'
             ),
         ));
     }
 }