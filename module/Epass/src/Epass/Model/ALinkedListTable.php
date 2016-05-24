<?php

namespace Epass\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Cache\Storage\StorageInterface;

class ALinkedListTable
{

    protected $tableGateway;
    protected $_memchache;
    protected $cache;

    const DEPARTAMENTOS = 3;
    const PROVINCIAS = 4;
    const DISTRITOS = 5;
    const MARCAS_VEHICULOS_LIGEROS = 6;
    const MODELOS_VEHICULOS_LIGEROS = 7;
    const MARCAS_BUSES = 8;
    const MODELOS_BUSES = 9;
    const MARCAS_CAMIONES = 10;
    const MODELOS_CAMIONES = 11;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;

    }

    public function setCache($cache)
    {
        $this->cache = $cache;

    }

    public function getData($query)
    {
        $cacheId = $this->cache->keyGenerate(__FUNCTION__, implode("_", $query));
        $array=   array('LIST' => \Epass\Model\ALinkedListTable::DEPARTAMENTOS);
        if (($array = $this->cache->getItem($cacheId)) == FALSE) {

            if(isset($query['LIST']) && $query['LIST'] == 3 && !isset($query['INDEX'])) {
                $query['INDEX'][] = 15;
                $query['INDEX'][] = 7;
            }
            $resultSet = $this->tableGateway->select(function($select) use($query){
                $select->where($query);
                $select->order('TEXT');
            });
            
            foreach ($resultSet as $rs) {
                $item = array();
                $item['INDEX'] = $rs->INDEX;
                $item['VALUE'] = $rs->VALUE;
                $item['TEXT'] = $rs->TEXT;
                //$item['ROW_VERSION'] = utf8_encode($item['ROW_VERSION']);
                $array[] = $item;
            }

            $this->cache->setItem($cacheId, $array, 36000);
        }


        return $array;

    }

    public function getUbigeofetchPairs($query)
    {        
//        if(isset($query['LIST']) && $query['LIST'] == 3 && !isset($query['INDEX'])) {
//            $query['INDEX'][] = 15;
//            $query['INDEX'][] = 7;
//            $cacheId = $this->cache->keyGenerate(__FUNCTION__, "3_15_7");
//
//        } else {
//            $cacheId = $this->cache->keyGenerate(__FUNCTION__, implode("_", $query));
//        }
        $cacheId = $this->cache->keyGenerate(__FUNCTION__, implode("_", $query));

        $array = array();
        if (($array = $this->cache->getItem($cacheId)) == FALSE) {
            $resultSet = $this->tableGateway->select(function($select) use($query){
                $select->where($query);
                $select->order('TEXT');
            });
            foreach ($resultSet as $rs) {
                //$array[$rs->INDEX] = utf8_encode($rs->TEXT);
                $array[$rs->INDEX] = $rs->TEXT;
            }
            $this->cache->setItem($cacheId, $array, 36000);
        }
        return $array;

    }

    public function getUbigeoxId($query)
    {
        $array = array();
       // $cacheId = $this->cache->keyGenerate(__FUNCTION__, implode("_", $query));
        //if (($array = $this->cache->getItem($cacheId)) == FALSE) {
            $resultSet = $this->tableGateway->select($query);
            foreach ($resultSet as $rs) {
                           // var_dump($rs);

                $array = $rs->VALUE;
            }
          //  $this->cache->setItem($cacheId, $array, 36000);
        //}
        return $array;

    }
    
    public function getUbigeoBxCodeWS($code_dep, $code_prov, $code_dist)
    {
        $code_dep  = ($code_dep  == '' || $code_dep  == null) ? '15' : $code_dep;
        $code_prov = ($code_prov == '' || $code_prov == null) ? '01' : $code_prov;
        $code_dist = ($code_dist == '' || $code_dist == null) ? '01' : $code_dist;
        
        $array = array();
        $array['dep'] = $code_dep;
        $query = array('DEPLIST'=>NULL, 'DEPINDEX'=>NULL, 'VALUE'=>$code_dep, 'EDITABLE'=>0);
        $data_dep  = $this->tableGateway->select($query)->current();
        
        $data_prov = $this->tableGateway->select(
                    array(
                            'DEPLIST'=>$data_dep->LIST, 
                            'DEPINDEX'=>$data_dep->INDEX, 
                            'VALUE'=>$code_prov
                    ))->current();
        
        $array['prov'] = $data_prov->INDEX;
        
        $data_dist = $this->tableGateway->select(
                    array(
                            'DEPLIST'=>$data_prov->LIST, 
                            'DEPINDEX'=>$data_prov->INDEX, 
                            'VALUE'=>$code_dist
                    ))->current();
        
        $array['dist'] = $data_dist->INDEX;
        
        return $array;
    }

    public function getMarcaById($id)
    {
      
    }

    public function getModeloById($id)
    {

    }

}
