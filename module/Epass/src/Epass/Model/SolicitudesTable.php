<?php

namespace Epass\Model;


use Clicks\Db\Table\AbstractTable;
use Zend\Db\Sql\Sql;

class SolicitudesTable extends AbstractTable
{
    const TABLE_SOLICITUDES = 'solicitudes';

    public function save($data)
    {
        $this->_guardar($data);
    }

    public function getAllByUser($userId)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
            ->columns(['ticket_id'])
            ->from('solicitudes')
            //->join('users', 'solicitudes.user_id = users.id')
            ->where(['user_id' => $userId]);

        return $this->fetchAll($select);
    }

    public function getTemas()
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()->from('solicitudes_theme');

        return $this->fetchAll($select);
    }


    public function getSubTemas($idTema)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
            ->columns(['id', 'name'])
            ->from('solicitudes_subtheme')
            ->where(['solicitudes_theme_id' => $idTema]) ;

        return $this->fetchAll($select);
    }

    public function getAll()
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()->from(self::TABLE_SOLICITUDES);

        return $this->fetchAll($select);
    }

}