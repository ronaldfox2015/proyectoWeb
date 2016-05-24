<?php
namespace Epass\Model;

 class APromotion
 {
     public $ID;
     public $NAME;
     public $PLANID;
     public $STARTDATE;
     public $ENDDATE;
     public $STATUS;
     public $NUMMONTHS;
     public $CONDITIONS;

     public function exchangeArray($data)
     {
         $this->ID     = (!empty($data['ID'])) ? $data['ID'] : null;
         $this->NAME    = (!empty($data['NAME'])) ? $data['NAME'] : null;
         $this->PLANID    = (!empty($data['PLANID'])) ? $data['PLANID'] : null;
         $this->STARTDATE   = (!empty($data['STARTDATE'])) ? $data['STARTDATE'] : null;
         $this->ENDDATE   = (!empty($data['ENDDATE'])) ? $data['ENDDATE'] : null;
         $this->STATUS    = (!empty($data['STATUS'])) ? $data['STATUS'] : null;
         $this->NUMMONTHS    = (!empty($data['NUMMONTHS'])) ? $data['NUMMONTHS'] : null;
         $this->CONDITIONS    = (!empty($data['CONDITIONS'])) ? $data['CONDITIONS'] : null;
     }
 }