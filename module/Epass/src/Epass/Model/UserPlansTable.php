<?php

namespace Epass\Model;

use Zend\Db\Sql\Sql;
use Clicks\Db\Table\AbstractTable;

class UserPlansTable extends AbstractTable
{

    protected $memcache;

    const getPlansbyUserForm = 'getPlansbyUserForm';
    const TABLA_USER_PLANS = 'user_plans';
    const INDIVIDUAL_YES = 'Y';
    const INDIVIDUAL_NOT = 'N';

    public function setCache($cache)
    {
        $this->memcache = $cache;

    }

    public function setRemovePlansbyUserFormCache($id)
    {
        $cacheId = $this->memcache->keyGenerate(self::getPlansbyUserForm, $id);
        if ($this->memcache->getItem($cacheId))
            $this->memcache->removecache($cacheId);

    }

    public function saveUserPlans($data)
    {
        flog('dataModel', $data);
        return $this->_guardar($data);

    }

    public function UpdateUserPlans($data)
    {
        return $this->update($data, $where);

    }

    public function getPlansbyUser($idUser)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->from(self::TABLA_USER_PLANS)
                ->where(array('user_id' => $idUser))
                ->where(array('enable' => 1))
                ->order('plan_id DESC');

        $result = $this->fetchAll($select);
        return $result;

    }

    public function finUserPlan($account_id, $idUser)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->from(self::TABLA_USER_PLANS)
                ->where(array('user_id' => $idUser))
                ->where(array('account_id' => $account_id))
                ->where(array('enable' => 1));

        $result = $this->fetchRow($select);
        return $result;

    }

    public function getPlansbyUserRecarga($idUser, $placa)
    {
        $sql1 = new Sql($this->getAdapter());
        $select1 = $sql1->select()
                ->from(array('upv' => 'user_plan_vehicle'))
                ->join(array('v' => 'vehicles'), 'upv.vehicle_id = v.id')
                ->where(array('license_plate' => $placa));
        $result1 = $this->fetchAll($select1);

        $user_plan_id = $result1[0]['user_plan_id'];

        $sql2 = new Sql($this->getAdapter());
        $select2 = $sql2->select()
                ->from(array('up' => self::TABLA_USER_PLANS))
                ->where(array('user_id' => $idUser))
                ->where(array('enable' => 1))
                ->where(array('id' => $user_plan_id));

        $result = $this->fetchAll($select2);

        return $result;

    }

    public function getDataByIdUser($idUser)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->from(array('up' => self::TABLA_USER_PLANS))
                ->columns(array(
                    'idPlan' => new \Zend\Db\Sql\Expression("CONVERT(SUBSTRING_INDEX(plan_id,'-',-1),UNSIGNED INTEGER)"),
                    'document_type_id',
                    'document_number',
                    'telephone',
                    'razon_social'
                ))
                ->join(
                        array('d' => 'adocumenttype'),
                        'd.TYPE = up.document_type_id',
                        array('description' => 'DESCRIPTION'))
                ->where(array('user_id' => $idUser))
                ->where(array('enable' => 1))
                ->order('idPlan DESC');

        $result = $this->fetchAll($select);

        return $result[0];

    }

    public function isPlansFromUser($idUser, $idPlan)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->from(self::TABLA_USER_PLANS)
                ->where(array('user_id' => $idUser))
                ->where(array('plan_id' => $idPlan))
                ->where(array('enable' => 1));
        $result = $this->fetchAll($select);
        return $result;

    }

    public function getPlan($id)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->from(self::TABLA_USER_PLANS)
                ->where(array('account_id' => $id))
                ->order('plan_id DESC');

        $result = $this->fetchAll($select);
        return $result;

    }

    public function getPlansbyUserForm($id = 0)
    {
        $cacheId = $this->memcache->keyGenerate(__FUNCTION__, $id);
        if (($result = $this->memcache->getItem($cacheId)) == FALSE) {
            $sql = new Sql($this->getAdapter());
            $select = $sql->select()
                    ->from(array('up' => self::TABLA_USER_PLANS))
                    ->columns(array(
                        'id' => 'id',

                        'tipoDoc' => 'document_type_id',
                        'txtNumDocumento' => 'document_number',
                        'idDpto' => 'department_id',
                        'idProvin' => 'province_id',
                        'idDistrito' => 'district_id',
                        'txtDireccion' => 'address',
                        'txtRazonsocial' => 'razon_social',
                        'txtPlanName' => 'plan_name',
                        'telephone' => 'telephone',
                        'additional_phone' => 'additional_phone',
                        'contact' => 'contact',
//                        'txtDptoVia' => 'inside_address',
//                        'txtUrbanizacion' => 'urbanization',
                        'txtReferencia' => 'observations',
                        'account_id', 'plan_name','plan_id'
                    ))
                    ->join(array('u' => 'users'), 'u.id = up.user_id',
                            array(
                        'idUser' => 'id',
                        'txtNombreTitular' => 'name',
                        'txtApellidosTitular' => 'lastname',
                        'txtCorreo' => 'email',
                        'role_id' => 'role_id','password','email_check'
                    ))
                    ->where(array('up.id' => $id))
                    ->order('up.plan_id DESC');

            $result = $this->fetchRow($select);
            $this->memcache->setItem($cacheId, $result, 36000);
        }
        return $result;

    }

    public function getByAccount($idAccount)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->from(self::TABLA_USER_PLANS)
                ->where(array('account_id' => $idAccount))
                ->where(array('enable' => 1));

        $result = $this->fetchRow($select);
        return $result;

    }

    public function save($data)
    {
        return $this->_guardar($data);

    }

    public function getPlansbyEmail($email)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->from(array('up' => self::TABLA_USER_PLANS))
                ->join(array('u' => 'users'), 'up.user_id = u.id')
                ->where(array('u.email' => $email))
                ->where(array('up.enable' => 1, 'up.migrate' => 1))
                ->order('up.plan_id DESC');

        $result = $this->fetchAll($select);
        return $result;

    }

}
