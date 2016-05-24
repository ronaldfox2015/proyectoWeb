<?php

namespace Application\Form;
use Application\InputFilter\ContactanosInputFilter;
use Zend\Form\Element\Checkbox;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Form;
use Zend\Hydrator\ClassMethods;

class ContactanosForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct($name);

        $this->setInputFilter(new ContactanosInputFilter());
        $this->setHydrator(new ClassMethods());

        foreach ($this->setFieldsDatosContacto() as $field) {
            $this->add($field);
        }
    }
    
    private function setFieldsDatosContacto()
    {
        $fields = array();

        // Datos Contacto
        
        $nombre = new Text('nombre');
        $nombre->setAttribute('id', 'nombre');
        
        $apellidos = new Text('apellidos');
        $apellidos->setAttribute('id', 'apellidos');
        
        $telefono1 = new Text('telefono_contacto');
        $telefono1->setAttribute('id', 'telefono_contacto');

        $telefono2 = new Text('telefono_adicional');
        $telefono2->setAttribute('id', 'telefono_adicional');

        $email = new Text('correo');
        $email->setAttribute('id', 'correo');
        $email->setAttribute('placeholder', 'Ingrese su correo');
        
        $asunto = new Text('asunto');
        $asunto->setAttribute('id', 'asunto');
        
        $mensaje = new Textarea('mensaje');
        $mensaje->setAttribute('id', 'mensaje');
        $mensaje->setAttribute('rows', 4);
        $mensaje->setAttribute('placeholder', 'Ingrese mensaje');
        
        /*$isNotRobot = new Checkbox('no_robot');
        $isNotRobot->setCheckedValue('1');
        $isNotRobot->setUncheckedValue('0');*/
        
        $submit = new Submit('submit');
        $submit->setValue('Enviar');
        
        array_push(
                $fields,
                $nombre, $apellidos, $telefono1, $telefono2, $email, $asunto, $mensaje, /*$isNotRobot,*/ $submit);
        return $fields;
    }

}