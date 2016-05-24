<?php

namespace Epass\Model;


class ALinkedList 
{

    public $LIST;
    public $INDEX;
    public $VALUE;
    public $TEXT;
    public $DEPLIST;
    public $DEPINDEX;
    public $EDITABLE;

    //public $ROW_VERSION;

    public function exchangeArray($data)
    {
        $this->LIST = (!empty($data['LIST'])) ? $data['LIST'] : null;
        $this->INDEX = (!empty($data['INDEX'])) ? $data['INDEX'] : null;
        $this->VALUE = (!empty($data['VALUE'])) ? trim($data['VALUE']) : null;
        $this->TEXT = (!empty($data['TEXT'])) ? $data['TEXT'] : null;
        $this->DEPLIST = (!empty($data['DEPLIST'])) ? $data['DEPLIST'] : null;
        $this->DEPINDEX = (!empty($data['DEPINDEX'])) ? $data['DEPINDEX'] : null;
        $this->EDITABLE = (!empty($data['EDITABLE'])) ? $data['EDITABLE'] : null;
        //$this->ROW_VERSION    = (!empty($data['ROW_VERSION'])) ? $data['ROW_VERSION'] : null;

    }

}
