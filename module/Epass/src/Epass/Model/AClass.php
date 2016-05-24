<?php
namespace Epass\Model;

 class AClass
 {
     public $TOLLCOMPANY;
     public $CLASS;
     public $TYPE;
     public $DESCRIPTION;
     public $CLASSINDEX;

     public function exchangeArray($data)
     {
         $this->TOLLCOMPANY     = (!empty($data['TOLLCOMPANY'])) ? $data['TOLLCOMPANY'] : null;
         $this->CLASS    = (!empty($data['CLASS'])) ? $data['CLASS'] : null;
         $this->TYPE    = (!empty($data['TYPE']) || $data['TYPE']==='0') ? $data['TYPE'] : null;
         $this->DESCRIPTION    = (!empty($data['DESCRIPTION'])) ? trim($data['DESCRIPTION']) : null;
         $this->CLASSINDEX    = (!empty($data['CLASSINDEX'])) ? $data['CLASSINDEX'] : null;
     }
 }