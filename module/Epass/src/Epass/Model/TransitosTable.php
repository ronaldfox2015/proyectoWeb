<?php

namespace Epass\Model;

use Clicks\Db\Table\AbstractTable;
use Zend\Db\Sql\Sql;
use Zend\Debug\Debug;

class TransitosTable extends AbstractTable
{
	public function save($data)
	{		
    	return $this->_guardar($data);
	}

	public function executeSql($sql)
	{
    	return $this->query($sql);		
	}
        public function getTransitosByAccount($account)
        {
            $sql = new Sql($this->getAdapter());
            $select = $sql->select()
                    ->from(array('t' => 'transito'))
                    ->join(
                        array('p' => 'aplaza'), 't.PLAZA = p.PLAZA',
                        array("NAME")
                    )
                    ->where(array('t.ACCOUNT'=>$account,'p.TOLLCOMPANY' => '01'))
                    ->order("PASSAGETIME desc");
            return $this->fetchAll($select);
        }

}