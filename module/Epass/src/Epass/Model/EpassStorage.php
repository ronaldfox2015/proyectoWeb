<?php

namespace Epass\Model;

use Zend\Authentication\Storage;
 
class EpassStorage extends Storage\Session
{
    public function forgetMe()
    {
        $this->session->getManager()->forgetMe();
    }
    
    public function setRememberMe($rememberMe = 0, $time = 1209600)
    {
         if ($rememberMe == 1) {
             $this->session->getManager()->rememberMe($time);
         }
    }
}

