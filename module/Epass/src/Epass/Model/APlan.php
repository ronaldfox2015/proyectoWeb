<?php
namespace Epass\Model;

 class APlan
 {
     public $ID;
     public $NAME;
     public $PRODUCTID;
     public $STATUS;
     public $ACCOUNTPAYMODE;
     public $CONDITIONS;
     public $MULTITAG;
     public $FIXEDRECHARGE;

     public function exchangeArray($data)
     {
         $this->ID     = (!empty($data['ID'])) ? $data['ID'] : null;
         $this->NAME    = (!empty($data['NAME'])) ? $data['NAME'] : null;
         $this->PRODUCTID    = (!empty($data['PRODUCTID'])) ? $data['PRODUCTID'] : null;
         $this->STATUS   = (!empty($data['STATUS'])) ? $data['STATUS'] : null;
         $this->ACCOUNTPAYMODE   = (!empty($data['ACCOUNTPAYMODE'])) ? $data['ACCOUNTPAYMODE'] : null;
         $this->CONDITIONS    = (!empty($data['CONDITIONS'])) ? $data['CONDITIONS'] : null;
         $this->MULTITAG    = (!empty($data['MULTITAG'])) ? $data['MULTITAG'] : null;
         $this->FIXEDRECHARGE    = (!empty($data['FIXEDRECHARGE'])) ? $data['FIXEDRECHARGE'] : null;
     }
 }