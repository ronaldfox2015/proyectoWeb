<?php

namespace Application\InputFilter;

use Zend\InputFilter\Factory;
use Zend\InputFilter\InputFilter;

class ContactanosInputFilter extends InputFilter
{
    public function __construct()
    {        
        $factory = new Factory();
        $inputFilter = $factory->createInputFilter([
            /*'id' => [
                'name' => ' id',
                'required' => true,
            ],*/
            'nombre' => [
                'name' => ' nombre',
                'required' => true,
                'validators' => [
                    [
                        'name' => 'string_length',
                        'options' => [
                            'min' => 3,
                            'max' => 50
                        ]
                    ]
                ]
            ],
            'apellidos' => [
                'name' => 'apellidos',
                'required' => true,
                'validators' => [
                    [
                        'name' => 'string_length',
                        'options' => [
                            'min' => 3,
                            'max' => 50
                        ]
                    ]
                ]
            ],
            'telefono_contacto' => [
                'name' => 'telefono_contacto',
                'required' => true,
            ],
            'telefono_adicional' => [
                'name' => 'telefono_adicional',
                'required' => true,
            ],
            'correo' => [
                'name' => 'correo',
                'required' => true,
                'validators' => [
                    [
                        'name' => 'string_length',
                        'options' => [
                            'min' => 3
                        ]
                    ]
                ]
            ],
            'asunto' => [
                'name' => 'asunto',
                'required' => true,
                'validators' => [
                    [
                        'name' => 'string_length',
                        'options' => [
                            'min' => 4
                        ]
                    ]
                ]
            ],
            'mensaje' => [
                'name' => 'mensaje',
                'required' => true,
            ]/*,
            'no_robot' => [
                'name' => 'no_robot',
                'required' => true,
            ]*/
        ]);

        $this->merge($inputFilter);
    }
}
