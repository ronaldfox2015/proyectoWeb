<?php

namespace Epass\Model;

use Zend\Db\Sql\Sql;
use Clicks\Db\Table\AbstractTable;
use Zend\Debug\Debug;


class TransactionTypesTable extends AbstractTable
{
    
    const TABLA_TRANSACTION_TYPE= 'transaction_types';
    CONST FLAG_TYPE_AFILIACION_RECARGA = 1;
    CONST FLAG_TYPE_RECARGA= 2;
    
    public function getTransactionTypesByID($id)
    {

        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->from(self::TABLA_TRANSACTION_TYPE)
                ->where(array('id' => $id));

        $result = $this->fetchRow($select);
        return $result;
    } 
}
