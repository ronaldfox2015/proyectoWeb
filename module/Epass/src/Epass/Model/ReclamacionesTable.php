<?php

namespace Epass\Model;

use Zend\Db\Sql\Sql;
use Clicks\Db\Table\AbstractTable;


class ReclamacionesTable extends AbstractTable
{
    
    const TABLE_RECLAMACIONES = 'claims';
    
    public function getAll()
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->from(self::TABLE_RECLAMACIONES);
        return $this->fetchAll($select);
    }
    
    public function save($data)
    {
        return $this->_guardar($data);
    }
}
