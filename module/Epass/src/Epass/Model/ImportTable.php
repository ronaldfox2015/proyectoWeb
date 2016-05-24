<?php

namespace Epass\Model;

use Clicks\Db\Table\AbstractTable;
use Zend\Db\Sql\Sql;

class ImportTable extends AbstractTable
{
    public function save($data)
    {		
        return $this->_guardar($data);
    }

    public function executeSql($sql)
    {
    return $this->query($sql);		
    }
    public function getLast()
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->columns(array('version'))
                ->from('import');
        return $this->fetchCol($select);

    }
    
    public function getNotImport($filesServer)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->columns(array('version'))
                ->from('import')
                ->where("version not in (". implode(',', $filesServer).")");
        var_dump($select);exit;
        return $this->fetchCol($select);
    }
}