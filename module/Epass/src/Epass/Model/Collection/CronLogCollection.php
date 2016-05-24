<?php

namespace Epass\Model\Collection;

use Clicks\MongoDB\Collection\Collection as ClicksCollection;

class CronLogCollection extends ClicksCollection
{

    public function save($datos)
    {
        $datos['dateAdd'] = new \MongoDate();
        $id = $this->_guardar($datos);
        return $id;
    }

}
