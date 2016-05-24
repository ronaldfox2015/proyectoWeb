<?php
namespace Epass\Model;

 use Zend\Db\TableGateway\TableGateway;

 class APlanTable
 {
     protected $tableGateway;
     const PEAJE_PREPAGO = 3;
     const PREPAGO_INDIVIDUAL_1 = 39;
     const COSTO_PREPAGO_INDIVIDUAL_1 = 50;
     const PREPAGO_INDIVIDUAL_2 = 46;
     const PREPAGO_FAMILIAR_1 = 38;
     const PREPAGO_FAMILIAR_2 = 40;
     const PREPAGO_EXPRESS_2 = 43;
     const PREPAGO_CORPORATIVO = 48;
     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }
     public function getData()
     {
        $resultSet = $this->tableGateway->select();
        $array = array();
        foreach ($resultSet as $rs)
        {
            $item = array();
            $item['ID'] = $rs->ID;
            $item['NAME'] = $rs->NAME;
            $array[] = $item;
        }
        return $array;
     }
     
     public function getPaquetes()
     {
        $sqlSelect = $this->tableGateway->getSql()->select();
        $sqlSelect->columns(array('NAME'));
        //$sqlSelect->join(array('apf'=>'APLANFEATURE'), 'ap.ID=apf.PLANID', array('VALUE'), 'left');
        $sqlSelect->join(array('apf'=>'APLANFEATURE'), 'APLAN.ID=apf.PLANID',array('VALUE','DESCRIPTION'));
        $sqlSelect->join(array('apromo'=>'APROMOTION'), 'apf.PLANID = apromo.PLANID',array('nombrePromo'=>'NAME'));
        $sqlSelect->join(array('apromof'=>'APROMOTIONFEATURE'), 'apromo.ID=apromof.PROMOTIONID',
                array('promofeaturedesc'=>'DESCRIPTION','valorPromoF'=>'VALUE'));
        $sqlSelect->join(array('r'=>'ARECHARGEFEERULE'), 'apromo.ID=r.PROMOTIONID',
                array('montoRecarga'=>'AMOUNTINI','tasa'=>'VALUE'));
        $sqlSelect->where(array('PRODUCTID'=>1,'ACCOUNTPAYMODE'=>0,'APLAN.STATUS'=>'O'));
        //var_dump($sqlSelect->getSqlString());die();
        $statement = $this->tableGateway->getSql()->prepareStatementForSqlObject($sqlSelect);        
/*        $adapter = $this->tableGateway->getAdapter();         
        $sql = "select ap.NAME,apf.VALUE,apf.DESCRIPTION, apromo.NAME as nombrePromo,
apromof.DESCRIPTION as promofeaturedesc,apromof.VALUE valorPromoF,
r.AMOUNTINI as montoRecarga, r.VALUE as tasa
from APLAN ap
inner join aplanfeature apf on ap.id=apf.PLANID
inner join apromotion apromo on apf.PLANID = apromo.PLANID
inner join apromotionfeature apromof on apromo.ID=apromof.PROMOTIONID
inner join dbo.ARECHARGEFEERULE r on apromo.ID=r.PROMOTIONID
where ap.productid =1 and ap.accountpaymode=0 and ap.status='O';";
        $statement = $adapter->query($sql); */
        $resultSet = $statement->execute();
        $array = array();
        foreach ($resultSet as $rs)
        {   
            $rs['DESCRIPTION'] = utf8_encode($rs['DESCRIPTION']);
            $array[] = $rs;      
        }
        return $array;
     }     
 }
