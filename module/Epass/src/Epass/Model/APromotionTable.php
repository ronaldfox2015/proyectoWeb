<?php

namespace Epass\Model;

use Zend\Db\Sql\Sql;
use Clicks\Db\Table\AbstractTable;
use Application\Model\Mpe;

class APromotionTable extends AbstractTable
{    
    const TABLA_APROMOTION = 'APROMOTION';
    const COSTO_TAG = 2;
    const PREPAGO_INDIVIDUAL_1_TASA_RECARGA = 104;
    const PREPAGO_VIP_TASA_RECARGA = 101;
    const PREPAGO_INDIVIDUAL_2_TASA_RECARGA = 106;
    const PREPAGO_FAMILIAR_1_TASA_RECARGA = 108;
    const PREPAGO_FAMILIAR_2_TASA_RECARGA = 110;
    const PREPAGO_CORPORATIVO_TASA_RECARGA = 112;
    const PREPAGO_CORPORATIVO_2_TASA_RECARGA = 114;
    const PREPAGO_INDIVIDUAL_1_COSTO_PROMOCIONAL_TAG = 103;
    const PREPAGO_VIP_COSTO_PROMOCIONAL_TAG = 102;
    const PREPAGO_INDIVIDUAL_2_COSTO_PROMOCIONAL_TAG = 105;
    const PREPAGO_FAMILIAR_1_COSTO_PROMOCIONAL_TAG = 107;
    const PREPAGO_FAMILIAR_2_COSTO_PROMOCIONAL_TAG = 109;
    const PREPAGO_CORPORATIVO_COSTO_PROMOCIONAL_TAG = 115;
    const PREPAGO_CORPORATIVO_2_COSTO_PROMOCIONAL_TAG = 113;

    public function getData()
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->from(self::TABLA_APROMOTION);
        $res = $this->fetchAll($select);
        $re = array();
        foreach($res as $r)
        {
            $r['ROW_VERSION'] = utf8_encode($r['ROW_VERSION']);
            $re[] = $r;
        }
        return $re;
    }
    public function getRecarga()
    {
        $sql = new Sql($this->getAdapter());
        $where = new \Zend\Db\Sql\Where();
        //$where->in('apromo.ID',$array);
        $select = $sql->select()
                ->columns(array())
                ->from(array('apromo'=>self::TABLA_APROMOTION))
                ->join('APLAN','APLAN.ID=apromo.PLANID',
                        array('idPlan'=>'ID','nombrePlan'=>'NAME'))
                ->join(array('r'=>'ARECHARGEFEERULE'),'apromo.ID=r.PROMOTIONID',
                        array('montoRecarga'=>'AMOUNTINI','tasaRecarga'=>'VALUE'))
                //->where($where)
                ->where(array('APLAN.PRODUCTID'=>1,'APLAN.ACCOUNTPAYMODE'=>0,'APLAN.STATUS'=>'O'));
                ;   
        //var_dump($select->getSqlString());die();    
        return $this->fetchAll($select);
    }    
    public function getCostoTag()
    {
        $sql = new Sql($this->getAdapter());
        $where = new \Zend\Db\Sql\Where();
        //$where->in('apromo.ID',$array);
        $select = $sql->select()
                ->columns(array())
                ->from(array('apromo'=>self::TABLA_APROMOTION))
                ->join('APLAN','APLAN.ID=apromo.PLANID',
                        array('idPlan'=>'ID','nombrePlan'=>'NAME'))
                ->join(array('apf'=>'APLANFEATURE'),'apromo.PLANID = apf.PLANID',
                        array('costoTag'=>'VALUE'))
                ->join(array('apromof'=>'APROMOTIONFEATURE'),'apromo.ID=apromof.PROMOTIONID',
                        array('costoPromocionalTag'=>'VALUE'))                
                //->where($where)
                ->where(array('apf.BILLINGFEATUREID'=>  self::COSTO_TAG))
                ->where(array('apromof.BILLINGFEATUREID'=>  self::COSTO_TAG))
                ->where(array('APLAN.PRODUCTID'=>1,'APLAN.ACCOUNTPAYMODE'=>0,'APLAN.STATUS'=>'O'));
                ;   
                //var_dump($select->getSqlString());die();    
        return $this->fetchAssoc($select);
    }  
    public function getPaquetes()
    {
        $req_ProductId = 1;
        $data = array(
          'req_ProductId'=>$req_ProductId,
        );        
        $mpeConnect = new Mpe();
        $result1 = $mpeConnect->sendData('getAllPlansByProduct',$data);
        $planes = array();
        foreach($result1->res->allPlansByProductDefinition as $res)
        {
            $data1 = array(
                'req_ProductId'=>$req_ProductId,
                'req_PlanId'=>$res->req_PlanId
              );
            $detalle = array();
            $detalle['nombrePlan'] = $res->req_Name;
            $features = (array)$res->req_PlanFeatures;
            $detalle['costoTag'] = 0;
            if(isset($features[0]->req_PlanFeatureValue))
                $detalle['costoTag'] = $features[0]->req_PlanFeatureValue;
            $result = $mpeConnect->sendData('getAllPromotionsByPlanByProduct',$data1);
            if(isset($result->res->allPromotionsByPlanByProductDefinition))
            {
                foreach($result->res->allPromotionsByPlanByProductDefinition as $res1)
                {   
                    if(isset($res1->req_PromotionFeatures->req_BillingFeature))
                    {
                        $costoPromocionalTag = $features[0]->req_PlanFeatureValue;
                        if($res1->req_PromotionFeatures->req_BillingFeature==2)
                        {
                            $costoPromocionalTag = $res1->req_PromotionFeatures->req_PromotionFeatureValue;
                        }
                        if($res1->req_PromotionFeatures->req_BillingFeature==105)
                        {
                            $recargas = array();
                            foreach($res1->req_PromotionFeatures->req_PromotionFeeRecharge as $res2)
                            {
                                $recargas[] = array(
                                    'montoRecarga' => $res2->req_AmountIni,
                                    'tasaRecarga' => $res2->req_Value
                                        );
                            }                        
                        }
                        $detalle['promociones'] = array(
                            'costoPromocionalTag'=>$costoPromocionalTag,
                            'recargas'=> $recargas
                        );
                    }
                }
            }
            $planes[$res->req_PlanId] = $detalle;
        }
        $format = array();
        foreach($planes as $k=>$v)
        {
            $costoTag = $v['costoTag'];
            $nombrePlan = $v['nombrePlan'];
            if(isset($v['promociones']))
            {
                $costoPromocionalTag = $v['promociones']['costoPromocionalTag'];
                $recargas = $v['promociones']['recargas'];
                foreach($recargas as $rr)
                {
                    $temp = array();
                    $temp['saldoUso'] = number_format(($rr['montoRecarga'] - $rr['tasaRecarga'])/100,2);
                    $temp['tasaRecarga'] = number_format($rr['tasaRecarga']/100,2);
                    $temp['costoTag'] = number_format($costoTag/100,2);
                    $temp['costoPromocionalTag'] = number_format($costoPromocionalTag/100,2);
                    $temp['costoTotal'] = number_format(($rr['montoRecarga'] + $costoPromocionalTag)/100,2);
                    $temp['nombrePlan'] = $nombrePlan;
                    $temp['idPlan'] = $k;
                    $format[$k][] = $temp;             
                }                
            }            
        }
        return $format;
    }
    public function getDataPlan($id)
    {
        $req_ProductId = 1;
        $data = array(
            'req_ProductId'=>$req_ProductId,
        );
        $mpeConnect = new Mpe();
        $result1 = $mpeConnect->sendData('getAllPlansByProduct',$data);
        $planes = array();
        foreach($result1->res->allPlansByProductDefinition as $res)
        {
            $data1 = array(
                'req_ProductId'=>$req_ProductId,
                'req_PlanId'=>$res->req_PlanId
            );
            $detalle = array();
            $detalle['nombrePlan'] = $res->req_Name;
            $features = (array)$res->req_PlanFeatures;
            $detalle['costoTag'] = 0;
            if(isset($features[0]->req_PlanFeatureValue))
                $detalle['costoTag'] = $features[0]->req_PlanFeatureValue;
            $result = $mpeConnect->sendData('getAllPromotionsByPlanByProduct',$data1);
            if(isset($result->res->allPromotionsByPlanByProductDefinition))
            {
                foreach($result->res->allPromotionsByPlanByProductDefinition as $res1)
                {
                    if(isset($res1->req_PromotionFeatures->req_BillingFeature))
                    {
                        $costoPromocionalTag = $features[0]->req_PlanFeatureValue;
                        if($res1->req_PromotionFeatures->req_BillingFeature==2)
                        {
                            $costoPromocionalTag = $res1->req_PromotionFeatures->req_PromotionFeatureValue;
                        }
                        if($res1->req_PromotionFeatures->req_BillingFeature==105)
                        {
                            $recargas = array();
                            foreach($res1->req_PromotionFeatures->req_PromotionFeeRecharge as $res2)
                            {
                                $recargas[] = array(
                                    'montoRecarga' => $res2->req_AmountIni,
                                    'tasaRecarga' => $res2->req_Value
                                );
                            }
                        }
                        $detalle['promociones'] = array(
                            'costoPromocionalTag'=>$costoPromocionalTag,
                            'recargas'=> $recargas
                        );
                    }
                }
            }
            $planes[$res->req_PlanId] = $detalle;
        }
        $format = array();
        foreach($planes as $k=>$v)
        {
            $costoTag = $v['costoTag'];
            $nombrePlan = $v['nombrePlan'];
            if(isset($v['promociones']))
            {
                $costoPromocionalTag = $v['promociones']['costoPromocionalTag'];
                $recargas = $v['promociones']['recargas'];
                foreach($recargas as $rr)
                {
                    $temp = array();
                    $temp['saldoUso'] = number_format(($rr['montoRecarga'] - $rr['tasaRecarga'])/100,2);
                    $temp['tasaRecarga'] = number_format($rr['tasaRecarga']/100,2);
                    $temp['costoTag'] = number_format($costoTag/100,2);
                    $temp['costoPromocionalTag'] = number_format($costoPromocionalTag/100,2);
                    $temp['costoTotal'] = number_format(($rr['montoRecarga'] + $costoPromocionalTag)/100,2);
                    $temp['nombrePlan'] = $nombrePlan;
                    $temp['idPlan'] = $k;
                    $format[$k][] = $temp;
                }
            }
        }
        $data = array();
        if (array_key_exists($id, $format)) {
            $data = $format[$id];
        }
        return $data;
    }
}
