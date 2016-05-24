<?php

namespace Epass\Model;

use Zend\Db\Sql\Sql;
use Clicks\Db\Table\AbstractTable;


class RolesTable extends AbstractTable
{
    
    const TABLA_ROLES = 'roles';
    const PUBLICO = 1;
    const ADMIN = 2;
    const USUARIO = 3;
    const RECARGA = 4;
    
}
