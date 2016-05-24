<?php
namespace Epass\Model;

 class Vehicles
 {
    public $license_plate;
    public $color;
    public $type;
    public $brand;
    public $model;
    public $tag;
    public $migrate;
      
    public function exchangeArray($array){
        $this->license_plate = array_key_exists('license_plate',$array) ? $array['license_plate'] : null;
        $this->color         =  array_key_exists('color', $array) ? $array['color'] : null;
        $this->type          =  array_key_exists('type',$array) ? $array['type'] : null;
        $this->brand         =  array_key_exists('brand', $array) ? $array['brand'] : null;
        $this->model         =  array_key_exists('model',$array) ? $array['model'] : null;
        $this->tag           =  array_key_exists('tag', $array) ? $array['tag'] : null;
        $this->migrate       =  array_key_exists('migrate', $array) ? $array['migrate'] : null;
    }

}