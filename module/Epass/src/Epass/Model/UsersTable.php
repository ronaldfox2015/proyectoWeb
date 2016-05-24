<?php

namespace Epass\Model;

use Zend\Db\Sql\Sql;
use Clicks\Db\Table\AbstractTable;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Expression;

class UsersTable extends AbstractTable
{

    const TABLA_USERS = 'users';
    const TABLA_USER_PLANS = 'user_plans';

    public function getUsers($where = array())
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->from(self::TABLA_USERS);
        $select->where($where);
        return $this->fetchAll($select);
    }

    public function findUsersByCorreo($correo)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->columns(array('id'))
                ->from(self::TABLA_USERS)
                ->where(array('email' => $correo));
        return $this->fetchRow($select);
    }
    
    public function getUsersByCorreo($correo)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->columns(array('*'))
                ->from(self::TABLA_USERS)
                ->where(array('email' => $correo));
        return $this->fetchRow($select);
    }

    public function findUsersByCorreoExist($correo, $id = 0)
    {
        $sql = new Sql($this->getAdapter());
        $where = new Where();
        $where->EqualTo('email', $correo);
        $where->notEqualTo('id', $id);
        $select = $sql->select()
                ->columns(array('id', 'email'))
                ->from(self::TABLA_USERS)
                ->where($where);
        // var_dump($select->getSqlString(),$this->fetchRow($select));exit;
        return $this->fetchRow($select);

    }

    public function getUser($id)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->from(self::TABLA_USERS)
                ->where(array('id' => $id));
        return $this->fetchRow($select);

    }

    public function saveUser($data)
    {
        try {
            return $this->_guardar($data);
        } catch (\Exception $ex) {
            flog('error guardado',$ex->getMessage());
            return false;
        }
        

    }

    public function findUsersPlanByCorreo($correo, $idPlan)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->from(array('u' => self::TABLA_USERS))
                ->columns(array('id'))
                ->join(
                        array('up' => 'user_plans'), 'u.id = up.user_id',
                        array("plan_id")
                )
                ->where(array('u.email' => $correo, 'up.plan_id' => $idPlan));
        $result = $this->fetchRow($select);
        return $result;

    }
    
    public function findUsersPlanByEmail($correo, $idPlan)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->from(array('u' => self::TABLA_USERS))
                ->columns(array('id'))
                ->join(
                        array('up' => 'user_plans'), 'u.id = up.user_id',
                        array("plan_id")
                )
                ->where(array('u.email' => $correo, 'up.plan_id' => $idPlan, 'up.enable' => '1'))->order('up.id DESC')->limit(1);
        $result = $this->fetchRow($select);
        return $result;

    }
    
    ////////////////////
    public function findUsersPlanTruncoByEmail($correo, $idPlan)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->from(array('u' => self::TABLA_USERS))
                ->columns(array('id'))
                ->join(
                        array('up' => 'user_plans'), 'u.id = up.user_id',
                        array("plan_id")
                )
                ->where(array('u.email' => $correo, 'up.plan_id' => $idPlan, 'up.enable' => '0'))->order('up.id DESC')->limit(1);
        $result = $this->fetchRow($select);
        return $result;
    }
    
    public function findPlansByEmail($correo)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->from(array('u' => self::TABLA_USERS))
                ->columns(array('id'))
                ->join(
                        array('up' => 'user_plans'), 'u.id = up.user_id',
                        array("plan_id")
                )
                ->where(array('u.email' => $correo, 'up.enable' => '1'))->order('up.id DESC')->limit(1);
        $result = $this->fetchRow($select);
        return $result;
    }
    ////////////////////
    
    public function updateUserRecoverPassword($email, $selector, $token, $expiration)
    {
        $data = array(
            'recover_expiration' => $expiration,
            'recover_token' => $token,
            'recover_selector' => $selector,
        );
        $sql = new Sql($this->getAdapter());
        $update = $sql->update();
        $update->table(self::TABLA_USERS);
        $update->set($data);
        $update->where(array('email' => $email));
        $statement = $sql->prepareStatementForSqlObject($update);
        $result = $statement->execute();
        return $result;

    }

    public function getDataFromRecover($selector)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->from(self::TABLA_USERS)
                ->where(array('recover_selector' => $selector));
        return $this->fetchRow($select);

    }

    public function isOkTimeExpiration($selector)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->from(self::TABLA_USERS)
                ->where(array('recover_selector' => $selector));
        $select->where(new \Zend\Db\Sql\Predicate\Expression("recover_expiration >= NOW()"));
        return $this->fetchRow($select);

    }
    
    public function isOkTimeExpirationCheckEmail($token)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->from(self::TABLA_USERS)
                ->where(array('email_check_token' => $token));
        $select->where(new \Zend\Db\Sql\Predicate\Expression("email_check_expiration >= NOW()"));
        return $this->fetchRow($select);
    }

    public function getUserForTokenEmailCheck($token)
    {
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->from(self::TABLA_USERS)
                ->where(array('email_check_token' => $token));

        return $this->fetchRow($select);

    }

    public function updateEmailCheck($email)
    {
        $data = array(
            'email_check' => 1,
            'role_id' => 3
        );
        $sql = new Sql($this->getAdapter());
        $update = $sql->update();
        $update->table(self::TABLA_USERS);
        $update->set($data);
        $update->where(array('email' => $email));
        $statement = $sql->prepareStatementForSqlObject($update);
        $result = $statement->execute();
        return $result;

    }

    public function changePassword($email, $new_password)
    {
        $data = array(
            'email_check' => 1,
            'password' => md5($new_password),
            'psw_desencriptado' => $new_password,
            'ismigrate' => 0
        );

        $sql = new Sql($this->getAdapter());
        $update = $sql->update();
        $update->table(self::TABLA_USERS);
        $update->set($data);
        $update->where(array('email' => $email));
        $statement = $sql->prepareStatementForSqlObject($update);
        $result = $statement->execute();
        return $result;

    }

    public function generarToken($idUser, $lifetime)
    {
        $sql = new Sql($this->getAdapter());

        $sql = $sql->select()
                ->from(self::TABLA_USERS)
                ->where(array('id' => $idUser))
                ->limit(1);

        $userId = $this->fetchOne($sql);
        $token = sha1(uniqid(rand(), $userId));
        if ($userId == null) {
            return false;
        }
        $data = array(
            'email_check_token' => $token,
            'email_check_expiration' => date('Y-m-d H:i:s', time() + $lifetime)
        );
        $sql2 = new Sql($this->getAdapter());
        $update = $sql2->update();
        $update->table(self::TABLA_USERS);
        $update->set($data);
        $update->where(array('id' => $userId));
        $statement = $sql2->prepareStatementForSqlObject($update);
        $result = $statement->execute();
        return $token;

    }
    
    public function getNameUserbyId($id){
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->columns(array('name'=>new Expression("IF(up.individual='Y',CONCAT_WS(' ',u.name,u.lastname),up.razon_social)")))
                ->from(array('u'=>self::TABLA_USERS))
                ->join(array('up'=>self::TABLA_USER_PLANS),'up.user_id=u.id',array())
                ->where(array('u.id' => $id));
        $result = $this->fetchRow($select);
        return $result['name'];
    }
    
    public function getNameUserbyEmail($email){
        $sql = new Sql($this->getAdapter());
        $select = $sql->select()
                ->columns(array('name'=>new Expression("IF(up.individual='Y',CONCAT_WS(' ',u.name,u.lastname),up.razon_social)")))
                ->from(array('u'=>self::TABLA_USERS))
                ->join(array('up'=>self::TABLA_USER_PLANS),'up.user_id=u.id',array())
                ->where(array('u.email' => $email));
        $result = $this->fetchRow($select);
        return $result['name'];
    }

}
