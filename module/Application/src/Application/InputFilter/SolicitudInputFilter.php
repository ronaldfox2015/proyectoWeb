<?php

namespace Application\InputFilter;


use Zend\InputFilter\Factory;
use Zend\InputFilter\InputFilter;

class SolicitudInputFilter extends InputFilter
{

    public function __construct()
    {
        $factory = new Factory();
        $inputFilter = $factory->createInputFilter([

        ]);

        $this->merge($inputFilter);
    }

}