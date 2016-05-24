<?php

namespace Epass\Model;

use Zend\Db\TableGateway\TableGateway;

class ADocumentTypeTable
{

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;

    }

    public function getData($query = array())
    {
        $resultSet = $this->tableGateway->select($query);
        $array = array();
        foreach ($resultSet as $rs) {
            $item = array();
            $item['TYPE'] = $rs->TYPE;
            $item['DESCRIPTION'] = $rs->DESCRIPTION;
            $item['LENGTH'] = $rs->LENGTH;
            $item['FORMAT'] = $rs->FORMAT;
            $array[] = $item;
        }
        return $array;

    }

    public function getDatafetchPairs($query = array())
    {
        $resultSet = $this->tableGateway->select($query);
        $array = array();
        foreach ($resultSet as $rs) {
            $array[$rs->TYPE] = $rs->DESCRIPTION;
        }
        return $array;

    }

}
