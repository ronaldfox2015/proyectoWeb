<?php

namespace ModPruebas\Model\Collection;

use Clicks\MongoDB\Collection\Collection as ClicksCollection;

class UsuariosCollection extends ClicksCollection
{

    public function getUsuarios()
    {
        return $this->select();
    }
    
}
