<?php

namespace Epass\Model;

use Clicks\Db\Table\AbstractTable;

class ContactanosTable extends AbstractTable {
    
    const TABLE_CONTACTANOS = 'contactanos';
    
    public function save($data)
    {
        return $this->_guardar($data);
    }
}
