<?php

namespace Epass\Model\Collection;

use Clicks\MongoDB\Collection\Collection as ClicksCollection;

class WebServicesCollection extends ClicksCollection
{

    public function saveWebServicesLog($datos)
    {
        $id = $this->_guardar($datos);

        return $id;
    }

}