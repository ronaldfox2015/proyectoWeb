<?php

namespace Application\Form;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\EmailAddress;

class LoginValidator implements InputFilterAwareInterface
 
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
                        'name' => 'username',
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
                                    'min' => 1,
                                    'max' => 100,
                                    'messages' => array(
                                        \Zend\Validator\StringLength::TOO_SHORT => "Email muy corto",
                                        \Zend\Validator\StringLength::TOO_LONG  => "Email muy largo",
                                    )
                                ),
                            ),
                            new EmailAddress(),
                        ),
                    )
                )
            );
             
            $inputFilter->add(
                $factory->createInput(
                    array(
                        'name' => 'password',
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => '4',
                                    'messages' => array(
                                        \Zend\Validator\StringLength::TOO_SHORT => "Contraseña muy corta",
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