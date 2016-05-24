<?php
namespace Clicks\Form;
use Zend\Form\Form;

class AppForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->add(array(
            'type'=>'Zend\Form\Element\Csrf',
            'name'=>'csrf'
        ));
    }
}
