<?php

namespace Epass\Model;

use Clicks\Db\Table\AbstractTable;
use Zend\Db\Sql\Sql;

class TransitoVersionTable extends AbstractTable
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
                    ->from('transito_version');
                    //->order('id DESC')
                    //->limit(1);
            // var_dump($select->getSqlString(),$this->fetchRow($select));exit;
            return $this->fetchCol($select);

        }
}