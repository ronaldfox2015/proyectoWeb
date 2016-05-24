<?php
namespace Epass\Model;

use Zend\Db\Sql\Sql;
use Clicks\Db\Table\AbstractTable;
use Zend\Db\Sql\Where;

 class APlazaTable extends AbstractTable
 {
     const TABLA_APLAZA = 'aplaza';
     CONST TOLLCOMPANY = 01;


     public function getAllPlaza()
     {
         $sql = new Sql($this->getAdapter());
         $select = $sql->select()
             ->from(self::TABLA_APLAZA)
             ->where(array('TOLLCOMPANY' => self::TOLLCOMPANY))
             ->order('NAME ASC');
         return $this->fetchAll($select);
     }
 }