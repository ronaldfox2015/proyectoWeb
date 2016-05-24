<?php

namespace Application\Form;

use Zend\Form\Element\Select;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Form;

class SolicitudForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct($name);

        $subject = new Text('subject');
        $subject->setAttribute('id', 'subject');

        $body = new Textarea('body');
        $body->setAttribute('id', 'body');

        $fullName = new Text('name');
        $fullName->setAttribute('id', 'name');

        $email = new Text('email');
        $email->setAttribute('id', 'email');

        $theme = new Select('theme');
        $theme->setAttribute('id', 'theme');
        $theme->setValueOptions([
            ''              => 'SELECCIONE TEMA'
        ]);
/*
        $subtheme = new Select('subtheme');
        $subtheme->setValueOptions([
            ''      => 'SELECCIONE SUBTEMA',
        ]);

        $subtheme->setAttribute('id', 'subtheme');
        $subtheme->setDisableInArrayValidator(true);
*/
        $body = new Textarea('body');
        $body->setAttribute('id', 'body');

        $submit = new Submit('submit');
        $submit->setAttribute('id', 'submit');
        $submit->setValue('Enviar');

        $this->add($subject);
        $this->add($body);
        $this->add($fullName);
        $this->add($email);
        $this->add($theme);
        //$this->add($subtheme);
        $this->add($body);
        $this->add($submit);

        $this->setAttribute('action', '/solicitudes');
    }

    public function isValid()
    {
        $this->getInputFilter()->remove('theme');

        return parent::isValid();
    }
}