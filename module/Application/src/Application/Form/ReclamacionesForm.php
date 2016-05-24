<?php

namespace Application\Form;

use Application\InputFilter\ReclamacionInputFilter;
use Zend\Form\Element\Checkbox;
use Zend\Form\Element\Radio;
use Zend\Form\Element\Select;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Form;
use Zend\Hydrator\ClassMethods;

class ReclamacionesForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct($name);

        foreach ($this->setFieldsPersonalData() as $field) {
            $this->add($field);
        }

        foreach ($this->setFieldsClaimData() as $field) {
            $this->add($field);
        }
    }

    private function setFieldsPersonalData()
    {
        $fields = array();

        $consumerType = new Radio('consumer_type');
        $consumerType->setAttribute('id', 'consumer_type');
        //$consumerType->setAttribute('class', 'radioSelectedCliente');
        $consumerType->setValueOptions([
            'natural' => 'Persona Natural',
            'juridica' => 'Persona Jurídica'
        ]);
        $consumerType->setValue('natural');

        // Natural Person

        $firstName = new Text('first_name');
        $firstName->setAttribute('id', 'first_name');

        $lastName = new Text('last_name');
        $lastName->setAttribute('id', 'last_name');

        $documentType = new Select('document_type');
        $documentType->setAttribute('id', 'document_type');
        $documentType->setValueOptions([
            ''    => 'Seleccionar Documento',
            'dni' => 'DNI',
            'carnet_extranjeria' => 'CARNET EXTRANJERIA',
        ]);
        $documentType->setDisableInArrayValidator(true);

        $documentNumber = new Text('document_number');
        $documentNumber->setAttribute('id', 'document_number');

        $homePhone = new Text('home_phone');
        $homePhone->setAttribute('id', 'home_phone');
        $homePhone->setAttribute('maxlength', 15);

        $mobilePhone = new Text('mobile_phone');
        $mobilePhone->setAttribute('id', 'mobile_phone');
        $mobilePhone->setAttribute('maxlength', 15);

        $email = new Text('email');
        $email->setAttribute('id', 'email');
        $email->setAttribute('placeholder', 'Ingrese correo');

        // Departamento
        $address1 = new Select('address_1');
        $address1->setAttribute('id', 'address_1');
        $address1->setValueOptions([
            'Seleccionar Departamento'
        ]);
        $address1->setDisableInArrayValidator(true);

        // Provincia
        $address2 = new Select('address_2');
        $address2->setAttribute('id', 'address_2');
        $address2->setValueOptions([
            'Seleccionar Provincia'
        ]);
        //$address2->setDisableInArrayValidator(true);

        // Distrito
        $address3 = new Select('address_3');
        $address3->setAttribute('id', 'address_3');
        $address3->setValueOptions([
            'Seleccionar Distrito'
        ]);
        //$address3->setDisableInArrayValidator(true);

        // Direccion
        $address4 = new Text('address_4');
        $address4->setAttribute('id', 'address_4');

        // Referencia
        $address5 = new Text('address_5');
        $address5->setAttribute('id', 'address_5');


        array_push($fields,
            $consumerType, $firstName, $lastName, $documentType, $documentNumber, $homePhone,
            $mobilePhone, $email, $address1, $address2, $address3, $address4,
            $address5);

        // Company

        $company = new Text('company');
        $company->setAttribute('id', 'company');

        $businessName = new Text('business_name');
        $businessName->setAttribute('id', 'business_name');

        $ruc = new Text('ruc');
        $ruc->setAttribute('id', 'ruc');
        $ruc->setAttribute('maxlength', 11);

        array_push($fields, $company, $businessName, $ruc );

        return $fields;
    }

    private function setFieldsClaimData()
    {
        $fields = array();

        $type = new Radio('type');
        $type->setLabel('Tipo');
        $type->setAttribute('id', 'type');
        $type->setValueOptions([
            'reclamo' => 'Reclamo (Disconformidad sobre un producto o servicio prestado).',
            'queja'   => 'Queja (Malestar o descontento respecto a la atención al público).'
        ]);

        $description = new Textarea('description');
        $description->setAttribute('id', 'description');
        $description->setAttribute('rows', 4);
        $description->setAttribute('placeholder', 'Ingrese una descripción');

        $detail = new Textarea('detail');
        $detail->setLabel('Detalle del reclamo o queja');
        $detail->setAttribute('id', 'detail');
        $detail->setAttribute('rows', 4);
        $detail->setAttribute('placeholder', 'Ingrese el detalle del reclamo o queja');

        $acceptTerms = new Checkbox('accept_terms');
        $acceptTerms->setAttribute('id', 'accept_terms');
        $acceptTerms->setCheckedValue('1');
        $acceptTerms->setUncheckedValue('0');

        $submit = new Submit('submit');
        $submit->setValue('Enviar');

        array_push($fields, $type, $description, $detail, $acceptTerms, $submit);

        return $fields;
    }

    public function isValid(){
        $this->getInputFilter()->remove('document_type');
        $this->getInputFilter()->remove('address_1');
        $this->getInputFilter()->remove('address_2');
        $this->getInputFilter()->remove('address_3');

        return parent::isValid();
    }

    public function setAddressValues($key, $arr)
    {
        $this->get($key)->setValueOptions($arr);
    }
}