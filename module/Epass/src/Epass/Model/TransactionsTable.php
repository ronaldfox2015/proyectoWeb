<?php

namespace Epass\Model;

use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Predicate\Expression;
use Clicks\Db\Table\AbstractTable;

class TransactionsTable extends AbstractTable
{

    const TABLE_TRANSACTIONS = 'transactions';
    const TOLL_COMPANY = '99';

    public function getTransactionById($id)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->from(self::TABLE_TRANSACTIONS)
                ->where(array('id' => $id));

        $result = $this->fetchAll($select);
        return $result;

    }

    public function save($data)
    {
        try{
            return $this->_guardar($data);
        } catch (\Exception $ex) {
            return false;
        }
        

    }
    public function getDataByTransaction($id)
    {
        $sql = new Sql($this->getAdapter());

        $select = $sql->select()
                ->columns(array(
                    'nombre' => new Expression('CONCAT_WS(" ",u.name,u.lastname)'),
                    'email' => new Expression('u.email'),
                    'razon' => new Expression('up.razon_social'),
                    'tipo_documento' => new Expression('adt.description'),
                    'numero_documento' => new Expression('up.document_number'),
                    'delivery' => new Expression('up.flagDelivery'),
                    'department_id' => new Expression('up.department_id'),
                    'district_id' => new Expression('up.district_id'),
                    'province_id' => new Expression('up.province_id'),
                    'address'=>new Expression('up.address'),
                    'observations'=>new Expression('up.observations'),
                    'contrato' => new Expression('up.account_id'),
                    'req_BillingDocNumber' => new Expression("(IF(t.tipo_doc='factura',t.document_number,up.document_number))"),
                    'req_BillingDesignation' => new Expression("(IF(t.tipo_doc='factura',t.razon_social,CONCAT_WS(' ' ,u.name,u.lastname)))")
                ))
                ->from(array('t' => self::TABLE_TRANSACTIONS))
                ->join(array('up' => 'user_plans'), 't.user_plan_id = up.id',
                        array())
                ->join(array('adt' => 'adocumenttype'),
                        'adt.TYPE=up.document_type_id', array())
                ->join(array('u' => 'users'), 'up.user_id = u.id', array())
                ->where(array('t.id' => $id));

        $result = $this->fetchRow($select);
        return $result;

    }

    public function getDataByAfiliation($id)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->columns(array(
                    'req_AccountId' => new Expression('up.account_id'),
                    'req_RechargePrepayAmount' => new Expression(
                            '((td.use_balance - (td.cost_tag * IF(ISNULL(td.total_vehicles) ,1, td.total_vehicles) ))*100)'),
                    'req_Date' => new Expression("DATE_FORMAT(t.created_at,'%Y%m%d%H%i%s')"),
                    'req_CrmTicket' => new Expression('up.id'),
                    'req_InternalId' => new Expression('t.id'),
                    'req_ExternalId' => new Expression('t.external_id'),
                    'req_Type' => new Expression('pm.code'),
                    'req_BillingDocNumber' => new Expression("up.billing_doc_number"),
                    'req_BillingDesignation' => new Expression("up.billing_designation"),
                ))
                ->from(array('t' => self::TABLE_TRANSACTIONS))
                ->join(array('td' => 'transaction_detail'),
                        't.transaction_detail_id=td.id', array())
                ->join(array('pm' => 'payment_methods'),
                        't.payment_method_id=pm.id', array())
                ->join(array('up' => 'user_plans'), 't.user_plan_id = up.id',
                        array())
                ->join(array('u' => 'users'), 'up.user_id = u.id', array())
                ->where(array('t.id' => $id));
        $result = $this->fetchRow($select);
        $vehiculos = $this->veiculosTransaction($result['req_CrmTicket']);
        $result['req_RequestTag_List'] = $vehiculos;
        return $result;

    }

    public function veiculosTransaction($id)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->columns(array(
                    'req_Amount' => new Expression('td.cost_tag*100'),
                    'req_VehiclePlate' => new Expression('v.license_plate'),
                    'req_TagReqReason' => new Expression("CONCAT('NewTag')"),
                    'req_TollCompany' => new Expression("CONCAT('01')"),
                    'req_Plaza' => new Expression("CONCAT('00')"),
                ))
                ->from(array('td' => 'transaction_detail'))
                ->join(array('t' => self::TABLE_TRANSACTIONS),
                        't.transaction_detail_id=td.id', array())
                ->join(array('upv' => 'user_plan_vehicle'),
                        't.user_plan_id=upv.user_plan_id', array())
                ->join(array('v' => 'vehicles'), 'upv.vehicle_id=v.id', array())
                ->where(array('upv.user_plan_id' => $id));
        //   ->limit(2);
        $result = $this->fetchAll($select);
        return $result;

    }

    public function getDataTagList()
    {
        
    }

    public function getAllNotMigrated()
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->columns(array(
                    'req_AccountId' => new Expression('up.account_id'),
                    'req_PlanId' => new Expression('up.plan_id'),
                    'req_Amount' => new Expression('(td.use_balance - td.cost_tag)*100'),
                    'req_Date' => new Expression("DATE_FORMAT(t.created_at,'%Y%m%d%H%i%s')"),
                    'req_InternalId' => new Expression('t.id'),
                    'req_ExternalId' => new Expression('t.external_id'),
                    'req_Type' => new Expression('pm.code'),
                    "req_CrmTicket" => new Expression('up.id'),
                    "req_RucNumber" => new Expression("if(up.individual = '" . UserPlansTable::INDIVIDUAL_YES . "', up.document_number,'')"),
                    "req_DocType" => new Expression('up.document_type_id'),
                    "req_DocNumber" => new Expression('up.document_number'),
                    "req_Individual" => new Expression('up.individual'),
                    "req_Title" => new Expression("''"),
                    "req_Forename" => new Expression('u.name'),
                    "req_Surname" => new Expression("if(u.lastname = '', u.name, u.lastname)"),
                    "req_Designation" => new Expression('up.razon_social'),
                    "req_Contact" => new Expression('up.contact'),
                    "req_Street" => new Expression('up.address'),
                    "req_Referencia" => new Expression('up.observations'),
                    "req_CodeDistrito" => new Expression(" (select trim(a.value) from alinkedlist as a where a.index = up.district_id and list=5)"),
                    "req_CodeProvincia" => new Expression(" (select trim(a.value) from alinkedlist as a where a.index = up.province_id and list=4)"),
                    "req_CodeDepartamento" => new Expression(" (select trim(a.value) from alinkedlist as a where a.index = up.department_id and list=3)"),
                    "req_PhoneNum" => new Expression("''"),
                    "req_PhoneNumMobile" => new Expression("''"),
                    "req_PhoneNumWork" => new Expression('up.telephone'),
                    "req_Email" => new Expression('u.email'),
                    "req_ReceiptType" => new Expression('up.billing_receipt_type'),
                    'req_BillingDocNumber' => new Expression('up.billing_doc_number'),
                    'req_BillingDesignation' => new Expression('up.billing_designation'),
                    'req_BillingStreet' => new Expression('up.billing_street'),
                    'req_BillingReferencia' => new Expression('up.billing_referencia'),
                    'req_BillingCodeDistrito' => new Expression(" (select trim(a.value) from alinkedlist as a where a.index = up.billing_code_distrito and list=5)"),
                    'req_BillingCodeProvincia' => new Expression(" (select trim(a.value) from alinkedlist as a where a.index = up.billing_code_provincia and list=4)"),
                    'req_BillingCodeDepartamento' => new Expression(" (select trim(a.value) from alinkedlist as a where a.index = up.billing_code_departamento and list=3)"),
                    'user_id' => new Expression('up.user_id'),
                    'user_plan_id' => new Expression('t.user_plan_id'),
                    'transaction_id' => new Expression('t.id'),
                    'user_plan_migrate' => new Expression('up.migrate'),
                    'transaction_type_id' => new Expression('t.transaction_type_id'),
                ))
                ->from(array('t' => self::TABLE_TRANSACTIONS))
                ->join(array('td' => 'transaction_detail'),
                        't.transaction_detail_id=td.id', array())
                ->join(array('pm' => 'payment_methods'),
                        't.payment_method_id=pm.id', array())
                ->join(array('up' => 'user_plans'), 't.user_plan_id = up.id',
                        array())
                ->join(array('u' => 'users'), 'up.user_id = u.id', array())
                ->where(array('t.migrate' => 0, 't.status' => 3))
                ->where('t.user_plan_id IS NOT NULL');

        $result = $this->fetchAll($select);
        return $result;

    }

    public function getDataByRecarga($id)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->columns(array(
                    'req_AccountId' => new Expression('up.account_id'),
                    'req_Amount' => new Expression('(td.use_balance - td.cost_tag)*100'),
                    'req_Date' => new Expression("DATE_FORMAT(t.created_at,'%Y%m%d%H%i%s')"),
                    'req_InternalId' => new Expression('t.id'),
                    'req_ExternalId' => new Expression('t.external_id'),
                    'req_Type' => new Expression('pm.code'),
                ))
                ->from(array('t' => self::TABLE_TRANSACTIONS))
                ->join(array('td' => 'transaction_detail'),
                        't.transaction_detail_id=td.id', array())
                ->join(array('pm' => 'payment_methods'),
                        't.payment_method_id=pm.id', array())
                ->join(array('up' => 'user_plans'), 't.user_plan_id = up.id',
                        array())
                ->where(array('t.id' => $id));
        $result = $this->fetchRow($select);
        return $result;

    }
    
    public function getMigrateById($id){
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->columns(array('migrado' => new Expression('migrate')))
                ->from(self::TABLE_TRANSACTIONS)
                ->where(array('id' => $id));

        $result = $this->fetchRow($select);
        return (bool)$result['migrado'];
    }
    
    public function getDataCrearUsuarioMPE($idTransaccion)
    {           
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->columns(array(
                    'req_CrmTicket' => new Expression('up.id'),
                    "req_RucNumber" => new Expression("if(up.individual = '" . UserPlansTable::INDIVIDUAL_YES . "', up.document_number,'')"),
                    "req_DocType" => new Expression('up.document_type_id'),
                    "req_DocNumber" => new Expression('up.document_number'),
                    "req_Individual" => new Expression('up.individual'),
                    "req_Title" => new Expression("''"),
                    "req_Forename" => new Expression('u.name'),
                    "req_Surname" => new Expression("if(u.lastname = '', u.name, u.lastname)"),
                    "req_Designation" => new Expression('up.razon_social'),
                    "req_Contact" => new Expression('up.contact'),
                    "req_Street" => new Expression('up.address'),
                    "req_Referencia" => new Expression('up.observations'),
                    "req_CodeDistrito" => new Expression(" (select trim(a.value) from alinkedlist as a where a.index = up.district_id and list=5)"),
                    "req_CodeProvincia" => new Expression(" (select trim(a.value) from alinkedlist as a where a.index = up.province_id and list=4)"),
                    "req_CodeDepartamento" => new Expression(" (select trim(a.value) from alinkedlist as a where a.index = up.department_id and list=3)"),
                    "req_PhoneNum" => new Expression("''"),
                    "req_PhoneNumMobile" => new Expression("''"),
                    "req_PhoneNumWork" => new Expression('up.telephone'),
                    "req_Email" => new Expression('u.email'),
                    "req_ReceiptType" => new Expression('up.billing_receipt_type'),
                    'req_BillingDocNumber' => new Expression('up.billing_doc_number'),
                    'req_BillingDesignation' => new Expression('up.billing_designation'),
                    'req_BillingStreet' => new Expression('up.billing_street'),
                    'req_BillingReferencia' => new Expression('up.billing_referencia'),
                    'req_BillingCodeDistrito' => new Expression(" (select trim(a.value) from alinkedlist as a where a.index = up.billing_code_distrito and list=5)"),
                    'req_BillingCodeProvincia' => new Expression(" (select trim(a.value) from alinkedlist as a where a.index = up.billing_code_provincia and list=4)"),
                    'req_BillingCodeDepartamento' => new Expression(" (select trim(a.value) from alinkedlist as a where a.index = up.billing_code_departamento and list=3)"),
                    'user_id' => new Expression('up.user_id'),
                    'user_plan_id' => new Expression('t.user_plan_id')
                ))
                ->from(array('t' => self::TABLE_TRANSACTIONS))
                ->join(array('up' => 'user_plans'), 't.user_plan_id = up.id',
                        array())
                ->join(array('u' => 'users'), 'up.user_id = u.id', array())
                ->where(array('t.id' => $idTransaccion));
        $result = $this->fetchRow($select);
        foreach ($result as $key => $value) {
            switch ($key):
                case 'req_Individual':
                    $result['req_Individual']=($value=='Y')?true:false;
                    break;
                case 'req_BillingStreet':
                    $result['req_BillingStreet']=(empty($value)?$result['req_Street']:$result['req_BillingStreet']);
                    break;
                case 'req_BillingReferencia':
                    $result['req_BillingReferencia']=(empty($value)?$result['req_Referencia']:$result['req_BillingReferencia']);
                    break;
                case 'req_BillingCodeDistrito':
                    $result['req_BillingCodeDistrito']=(empty($value)?$result['req_CodeDistrito']:$result['req_BillingCodeDistrito']);
                    break;
                case 'req_BillingCodeProvincia':
                    $result['req_BillingCodeProvincia']=(empty($value)?$result['req_CodeProvincia']:$result['req_BillingCodeProvincia']);
                    break;
                case 'req_BillingCodeDepartamento':
                    $result['req_BillingCodeDepartamento']=(empty($value)?$result['req_CodeDepartamento']:$result['req_BillingCodeDepartamento']);
                    break;
            endswitch;
        }
        return $result;

    }
    
    public function getDatacrearPlanMPE($id){
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->columns(array(
                    'req_AccountId' => new Expression('up.account_id'),
                    'req_PlanId' => new Expression('up.plan_id'),
                    'user_plan_id' => new Expression('up.id')
                    ))
                ->from(array('t' => self::TABLE_TRANSACTIONS))
                ->join(array('up' => 'user_plans'),'t.user_plan_id = up.id',array())
                ->where(array('t.id' => $id));

        $result = $this->fetchRow($select);
        return $result;
    }
    
    public function getDataCreateVehicle($id){
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->columns(array(
                    'idVehicle' => new Expression('v.id'),
                    'req_AccountId' => new Expression('up.account_id'),
                    'req_VehClass' => new Expression('v.type'),
                    'req_Plate' => new Expression('v.license_plate'),
                    'req_Make' => new Expression('(select `TEXT` from alinkedlist where LIST=ac.TYPE and `VALUE`=v.brand)'),
                    'req_Model' => new Expression('(select `TEXT` from alinkedlist where LIST=ac.TYPE+1 and depindex=v.brand and `VALUE`=v.model)'),
                    'req_Colour' => new Expression('v.color'),
                    ))
                ->from(array('t' => self::TABLE_TRANSACTIONS))
                ->join(array('up' => 'user_plans'),'t.user_plan_id = up.id',array())
                ->join(array('upv'=>'user_plan_vehicle'),'up.id=upv.user_plan_id',array())
                ->join(array('v'=>'vehicles'),'upv.vehicle_id=v.id',array())
                ->join(array('ac'=>'aclass'),'v.type=ac.CLASS',array())
                ->where(array('ac.tollcompany'=>self::TOLL_COMPANY,'t.id' => $id));

        $result = $this->fetchAll($select);
        return $result;
    }
    
    public function getDataByOperation($id){
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->columns(array(
                    'transaccion' => new Expression('t.transaction_type_id'),
                    'urlFail' => new Expression('t.urlFail'),
                    'idUserPlan' => new Expression('up.id'),
                    'title'=> new Expression("if(up.plan_name like '%individual%','Individual','Pre-pago')"),
                    'plantilla' => new Expression("IF(up.individual='Y','boletaPago.phtml','boletaEmpresa.phtml')")
                    ))
                ->from(array('t' => self::TABLE_TRANSACTIONS))
                ->join(array('up' => 'user_plans'),'t.user_plan_id = up.id',array())
                ->where(array('t.id' => $id));

        $result = $this->fetchRow($select);
        return $result;
    }
    
    public function getDataByEmail($id){
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->columns(array(
                    'idUser' => new Expression('u.id'),
                    'nombre' => new Expression("IF(up.individual='Y',CONCAT_WS(' ',u.name,u.lastname),up.razon_social)"),
                    'correo' => new Expression('u.email'),
                    'activo'=> new Expression("u.email_check")
                    ))
                ->from(array('t' => self::TABLE_TRANSACTIONS))
                ->join(array('up' => 'user_plans'),'t.user_plan_id = up.id',array())
                ->join(array('u'=>'users'),'up.user_id = u.id',array())
                ->where(array('t.id' => $id));

        $result = $this->fetchRow($select);
        return $result;
    }

    public function getTransactionByStatus($status)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->from(self::TABLE_TRANSACTIONS)
                ->where(array('status' => $status));

        $result = $this->fetchAll($select);
        return $result;

    }

    public function getLastTransactionsByEmail($email)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()  
                ->columns(array('id', 'external_id', 'status', 'created_at'))
                ->from(array('t' => self::TABLE_TRANSACTIONS))
                ->join(array('up' => 'user_plans'), 't.user_plan_id = up.id', array())
                ->join(array('u' => 'users'), 'up.user_id = u.id', array())
                ->where(array('u.email' => $email))
                ->where(array('t.status' => 1))
                ->where(array('t.created_at >= ?' => new Expression('SUBDATE(NOW(), INTERVAL 1 HOUR)')))
                ;

        //echo $select->getSqlString();
        $result = $this->fetchAll($select);
        return $result;
    }

}
