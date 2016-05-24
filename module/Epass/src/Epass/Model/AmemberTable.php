<?php
namespace Epass\Model;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

class AmemberTable 
{    
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway) 
    {
         $this->tableGateway = $tableGateway;
    }
    
    public function querySimple($query)
    {
        $resultSet = $this->tableGateway->select($query);
        return $this->getData($resultSet);
    }
    
    public function getMember($parameter, $value)
    {
        $resultSet = $this->tableGateway->select( function (Select $select) use ($parameter, $value){
                    $select->join(array('class' => 'ACLASS')," class.CLASS = AMEMBER.CLASS");
                    $select->where->like($parameter, $value);
        });
        
        $result = $resultSet->current();
        return $this->getData($result);
    }
    
    public function getData($resultSet){
        $array = array();
        
        if(!empty($resultSet)){
            if(count($resultSet) > 1){
                foreach ($resultSet as $rs)
                {
                    $item = array();
                    $item['PLATE'] = $rs->PLATE;
                    $item['COLOUR'] = $rs->COLOUR;
                    $item['MAKE'] = $rs->MAKE;
                    $item['MODEL'] = $rs->MODEL;
                    $item['PAN'] = $rs->PAN;
                    $item['CLASS'] = $rs->CLASS;
                    $item['TYPE'] = $rs->TYPE;
                    $array[] = $item;
                }
            }else{
                $item = array();
                $item['PLATE'] = $resultSet->PLATE;
                $item['COLOUR'] = $resultSet->COLOUR;
                $item['MAKE'] = $resultSet->MAKE;
                $item['MODEL'] = $resultSet->MODEL;
                $item['PAN'] = $resultSet->PAN;
                $item['CLASS'] = $resultSet->CLASS;
                $item['TYPE'] = $resultSet->TYPE;
                $array = $item;
            }
        }
        return $array;
    }
    
}