<?php

namespace Application\Form;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class PlacaValidator implements InputFilterAwareInterface
 
{
    protected $inputFilter;
 
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }
 
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();
 
            $inputFilter->add(
                $factory->createInput(
                    array(
                        'name' => 'nroType',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 6,
                                    'max' => 10,
                                    'messages' => array(
                                        \Zend\Validator\StringLength::TOO_SHORT => "La placa debe constar de almenos 6 caracteres",
                                        \Zend\Validator\StringLength::TOO_LONG  => "La placa debe constar de maximo 10 caracteres",
                                    )
                                ),
                            ),
                        ),
                    )
                )
            );
 
            return $inputFilter;
        }
 
        return false;
    }
}