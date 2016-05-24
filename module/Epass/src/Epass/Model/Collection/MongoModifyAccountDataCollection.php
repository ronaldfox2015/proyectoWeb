<?php

namespace Epass\Model\Collection;

use Clicks\MongoDB\Collection\Collection as ClicksCollection;

class MongoModifyAccountDataCollection extends ClicksCollection
{

    public function saveWebServicesLog($datos)
    {
        $id = $this->_guardar($datos);

        return $id;
    }

}