<?php

namespace Epass\Model\Collection;

use Clicks\MongoDB\Collection\Collection as ClicksCollection;

class EmailLogCollection extends ClicksCollection
{

    public function save($datos)
    {
        $id = $this->_guardar($datos);
        return $id;
    }

}
