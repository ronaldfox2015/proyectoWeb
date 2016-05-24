<?php

namespace Application\InputFilter;

use Zend\InputFilter\Factory;
use Zend\InputFilter\InputFilter;

class ReclamacionInputFilter extends InputFilter
{
    public function __construct()
    {
        $factory = new Factory();
        $inputFilter = $factory->createInputFilter([
            'consumer_type' => [
                'name' => 'consumer_type',
                'required' => true,
            ],
            'first_name' => [
                'name' => 'first_name',
                'required' => false,
                'validators' => [
                    [
                        'name' => 'string_length',
                        'options' => [
                            'min' => 2,
                            'max' => 45
                        ]
                    ]
                ]
            ],
            'last_name' => [
                'name' => 'last_name',
                'required' => false,
                'validators' => [
                    [
                        'name' => 'string_length',
                        'options' => [
                            'min' => 2,
                            'max' => 45
                        ]
                    ]
                ]
            ],
            'document_type' => [
                'name' => 'document_type',
                'required' => false,
            ],
            'document_number' => [
                'name' => 'document_number',
                'required' => false,
            ],
            'business_name' => [
                'name' => 'business_name',
                'required' => false,

            ],
            'company' => [
                'name' => 'company',
                'required' => false,
            ],
            'ruc' => [
                'name' => 'ruc',
                'required' => false,
            ],
            'home_phone' => [
                'name' => 'home_phone',
                'required' => true,
            ],
            'mobile_phone' => [
                'name' => 'mobile_phone',
                'required' => true,
            ],
            'email' => [
                'name' => 'email',
                'required' => true,
            ],
            'address_1' => [
                'name' => 'address_1',
                'required' => true,
            ],
            'address_2' => [
                'name' => 'address_2',
                'required' => true,
            ],
            'address_3' => [
                'name' => 'address_3',
                'required' => true,
            ],
            'address_4' => [
                'name' => 'address_4',
                'required' => true,
            ],
            'address_5' => [
                'name' => 'address_5',
                'required' => true,
            ],
            'type' => [
                'name' => 'type',
                'required' => true,
            ],
            'description' => [
                'name' => 'description',
                'required' => true,
            ],
            'detail' => [
                'name' => 'detail',
                'required' => true,
            ],
            'accept_terms' => [
                'name' => 'accept_terms',
                'required' => true,
            ],

        ]);

        $this->merge($inputFilter);
    }
}