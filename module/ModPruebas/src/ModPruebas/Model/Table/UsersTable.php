<?php

namespace ModPruebas\Model\Table;

use Zend\Db\Sql\Sql;
use Clicks\Db\Table\AbstractTable;

class UsersTable extends AbstractTable
{
    const TABLA_USERS = 'wp_users';
    
    public function getUsers()
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->from(self::TABLA_USERS);
        return $this->fetchAll($select);
    }
}

