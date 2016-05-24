<?php
namespace Epass\Model;

use Zend\Db\Sql\Sql;
use Clicks\Db\Table\AbstractTable;

class TransactionDetailTable extends AbstractTable
{
  const TABLE_TRANSACTION_DETAIL= 'transaction_detail';

  public function getDetailbyTransaction($idTransaction)
  {
      $sql = new Sql($this->getAdapter());
      $select = $sql->select()
              ->from(self::TABLE_TRANSACTION_DETAIL)
              ->where(array('user_id' => $idTransaction));

      $result = $this->fetchAll($select);
      return $result;
  }

  public function save($data)
  {
      return $this->_guardar($data);
  }

}
