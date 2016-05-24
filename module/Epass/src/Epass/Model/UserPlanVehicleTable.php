<?php

namespace Epass\Model;

use Zend\Db\Sql\Sql;
use Clicks\Db\Table\AbstractTable;


class UserPlanVehicleTable extends AbstractTable
{
    
    const TABLA_USER_PLAN_VEHICLE= 'user_plan_vehicle';

    public function saveUserPlanVehicle($data)
    {
        return $this->_guardar($data);
    }
    
    public function getVehiclesbyUserPlan($idPlanUser)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->from(self::TABLA_USER_PLAN_VEHICLE)
                ->where(array('user_plan_id' => $idPlanUser));
        
        $result = $this->fetchAll($select);
        return $result;
    } 
}
