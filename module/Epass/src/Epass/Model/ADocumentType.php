<?php
namespace Epass\Model;

 class ADocumentType
 {
     public $TYPE;
     public $DESCRIPTION;
     public $LENGTH;
     public $FORMAT;

     public function exchangeArray($data)
     {
         $this->TYPE     = (!empty($data['TYPE'])) ? $data['TYPE'] : null;
         $this->DESCRIPTION    = (!empty($data['DESCRIPTION'])) ? trim($data['DESCRIPTION']) : null;
         $this->LENGTH    = (!empty($data['LENGTH'])) ? trim($data['LENGTH']) : null;
         $this->FORMAT    = (!empty($data['FORMAT'])) ? $data['FORMAT'] : null;
     }
 }