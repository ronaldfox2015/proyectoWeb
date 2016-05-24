<?php

namespace Epass\Model;

use Clicks\Db\Table\AbstractTable;
use Zend\Db\Sql\Predicate\Expression;
use Zend\Db\Sql\Sql;

class VehiclesTable extends AbstractTable
{
    const TABLA_VEHICLES = 'vehicles';
    const TABLA_LINKEDLIST = 'alinkedlist';
    const TABLA_ACLASS = 'aclass';
    const TOLL_COMPANY = '99';

    public function saveVehicle($data)
    {
        try {
            return $this->_guardar($data);
        } catch (\Exception $ex) {
            return false;
        }

    }

    public function getVehicle($placa) {
        try {
            $rowset = $this->select(array('license_plate' => $placa));
            $row = $rowset->current();
            return $row;
        } catch (\Exception $ex) {
            return FALSE;
        }
    }

    public function updateVehicle($datos_vehiculo) {
        $result = $this->getVehicle($datos_vehiculo['txtPlaca']);
        if($result == FALSE ) {
            $data = array(
                'license_plate' => $datos_vehiculo['txtPlaca'],
                'color' => $datos_vehiculo['txtColor'],
                'type' => $datos_vehiculo['slxTipo'],
                'brand' => $datos_vehiculo['slxMarca'],
                'model' => $datos_vehiculo['slxModelo'],
                'tag' => $datos_vehiculo['txtTag'],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'migrate' => '0');
            $update =$this->insert($data);
        }else {
            $data = array(
                'color' => $datos_vehiculo['txtColor'],
                'type' => $datos_vehiculo['slxTipo'],
                'brand' => $datos_vehiculo['slxMarca'],
                'model' => $datos_vehiculo['slxModelo'],
                'updated_at' => date("Y-m-d H:i:s"));
            $where = array('license_plate' => $datos_vehiculo['txtPlaca']);
            $update = $this->update($data, $where);
        }
    }

    public function getVehicleBrandById($type,$brand)
    {
      $sql = new Sql($this->getAdapter());
      $select = $sql->select()
              ->columns(array('name'=>new Expression('alk.text')))
              ->from(array('ac'=>self::TABLA_ACLASS))
              ->join(array('alk'=>  self::TABLA_LINKEDLIST),'ac.TYPE=alk.LIST',array())
              ->where(array('ac.class' => $type,
                  'ac.tollcompany'=>self::TOLL_COMPANY,
                  'alk.value'=>$brand));

      $result = $this->fetchRow($select);
      return $result['name'];
    }
    
    public function getIdVehicleBrand($type,$brand)
    {
      $sql = new Sql($this->getAdapter());      
      $select = $sql->select()
              ->columns(array('id'=>new Expression('alk.value')))
              ->from(array('ac'=>self::TABLA_ACLASS))
              ->join(array('alk'=>  self::TABLA_LINKEDLIST),'ac.TYPE=alk.LIST',array())
              ->where(array('ac.class' => $type,
                  'ac.tollcompany'=>self::TOLL_COMPANY,
                  "alk.text like '%{$brand}%'"));
              
      $result = $this->fetchRow($select);
      if(empty($result)){
        $select = $sql->select()
              ->columns(array('id'=>new Expression('alk.value')))
              ->from(array('ac'=>self::TABLA_ACLASS))
              ->join(array('alk'=>  self::TABLA_LINKEDLIST),'ac.TYPE=alk.LIST',array())
              ->where(array('ac.class' => $type,
                  'ac.tollcompany'=>self::TOLL_COMPANY,
                  "alk.text like 'Otros'"));
        $result = $this->fetchRow($select);
      }
      
      return $result['id'];
    }

    public function getVechicleModelById($type,$marca,$model)
    {
      $sql = new Sql($this->getAdapter());
      $select = $sql->select()
              ->columns(array('name'=>new Expression('alk.text')))
              ->from(array('ac'=>self::TABLA_ACLASS))
              ->join(array('alk'=>  self::TABLA_LINKEDLIST),new Expression("ac.TYPE+1=alk.LIST"),array())
              ->where(array('ac.class' => $type,
                  'ac.tollcompany'=>self::TOLL_COMPANY,
                  'alk.depindex'=>$marca,
                  'alk.value'=>$model));
      $result = $this->fetchRow($select);      
      return $result['name'];
    }
    
    public function getIdVehicleModel($type,$marca,$model)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->columns(array('id'=>new Expression('alk.value')))
                ->from(array('ac'=>self::TABLA_ACLASS))
                ->join(array('alk'=>  self::TABLA_LINKEDLIST),new Expression("ac.TYPE+1=alk.LIST"),array())
                ->where(array('ac.class' => $type,
                    'ac.tollcompany'=>self::TOLL_COMPANY,
                    'alk.depindex'=>$marca,
                    "alk.text LIKE COALESCE((	SELECT 
                                                    DISTINCT
                                                    IF(`TEXT` <> 'Otros', '%{$model}%', NULL)
                                                FROM 
                                                    `aclass` AS `ac` 
                                                    INNER JOIN `alinkedlist` alk ON (`ac`.`TYPE` = `alk`.`LIST`)
                                                WHERE 
                                                    `value` = $marca 
                                                    AND `ac`.`class` = '$type'
                                                    AND `ac`.`tollcompany` = ".self::TOLL_COMPANY."),'Otros')"));
                                                    
        $result = $this->fetchRow($select);
        return $result['id'];
    }
    
    public function getIdOtros($type)
    {
       $sql = new Sql($this->getAdapter());      
       $select = $sql->select()
              ->columns(array('model'=>new Expression('alk.value'), 'brand'=>new Expression('alk.depindex')))
              ->from(array('ac'=>self::TABLA_ACLASS))
              ->join(array('alk'=>  self::TABLA_LINKEDLIST),new Expression("ac.TYPE+1=alk.LIST"),array())
              ->where(array('ac.class' => $type,
                  'ac.tollcompany'=>self::TOLL_COMPANY,
                  "alk.text LIKE '%otros%'"));
      $result = $this->fetchRow($select);
      return $result;
    }
    
    public function getVehiclesByIdUserPlan($idUserPlan) 
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->columns(array('*'))
                ->from(array('v'=> $this->getTable()))
                ->join(array('upv'=>  'user_plan_vehicle'), "upv.vehicle_id=v.id" ,array())
                ->where(array('upv.user_plan_id' => $idUserPlan, 'v.migrate' => 0));
        $result = $this->fetchAll($select);
        
        return $result;
    }
}
