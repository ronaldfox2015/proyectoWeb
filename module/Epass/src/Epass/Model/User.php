<?php
namespace Epass\Model;

 class User
 {
    public $id;
    public $name;
    public $lastname;
    public $email;
    public $terms_check;
    public $news_check;
    public $enable;
    public $zendesk_id;
    public $role_id;
    public $migrate;
    public $ismigrate;
    public $email_check;
      
    public function exchangeArray($array){
        $this->id               =  array_key_exists('id',$array) ? $array['id'] : null;
        $this->name             =  array_key_exists('name', $array) ? $array['name'] : null;
        $this->lastname         =  array_key_exists('lastname',$array) ? $array['lastname'] : null;        
        $this->email            =  array_key_exists('email', $array) ? $array['email'] : null;
        $this->terms_check      =  array_key_exists('terms_check', $array) ? $array['terms_check'] : null;
        $this->news_check       =  array_key_exists('terms_check', $array) ? $array['terms_check'] : null;
        $this->enable           =  array_key_exists('enable', $array) ? $array['enable'] : null;
        $this->zendesk_id       =  array_key_exists('zendesk_id', $array) ? $array['zendesk_id'] : null;
        $this->role_id          =  array_key_exists('role_id', $array) ? $array['role_id'] : null;
        $this->migrate          =  array_key_exists('migrate', $array) ? $array['migrate'] : null;
        $this->ismigrate          =  array_key_exists('ismigrate', $array) ? $array['ismigrate'] : null;
        $this->email_check      =  array_key_exists('email_check', $array) ? $array['email_check'] : null;
    }

}