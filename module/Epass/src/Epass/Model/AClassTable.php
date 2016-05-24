<?php
namespace Epass\Model;

 use Zend\Db\TableGateway\TableGateway;

 class AClassTable
 {
     protected $tableGateway;
     CONST TOLLCOMPANY = 99;
     
     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }
     
     public function getData($query)
     {
        //$resultSet = $this->tableGateway->select($query);
        $resultSet = $this->tableGateway->select(function($select) use($query){
            $select->where($query);
            $select->order('DESCRIPTION');
        });
        $array = array();
        foreach ($resultSet as $rs)
        {
            $item = array();
            $item['CLASS'] = $rs->CLASS;
            $item['TYPE'] = $rs->TYPE;
            $item['DESCRIPTION'] = $rs->DESCRIPTION;
            $array[] = $item;
        }
        return $array;
     }     
 }