<?php
namespace Epass\Model;

 class Amember
 {
    public $PLATE;
    public $COLOUR;
    public $MAKE;
    public $MODEL;
    public $PAN;
    public $CLASS;
    public $TYPE;
    
    public function exchangeArray($data)
    {
        $this->PLATE    = (!empty($data['PLATE']))  ? $data['PLATE'] : null;
        $this->COLOUR   = (!empty($data['COLOUR'])) ? $data['COLOUR'] : null;
        $this->MAKE     = (!empty($data['MAKE']))   ? $data['MAKE'] : null;
        $this->MODEL    = (!empty($data['MODEL']))  ? $data['MODEL'] : null;
        $this->PAN      = (!empty($data['PAN']))    ? $data['PAN'] : null;
        $this->CLASS    = (!empty($data['CLASS']))    ? $data['CLASS'] : null;
        $this->TYPE     = (!empty($data['TYPE']))    ? $data['TYPE'] : null;
    }
 }