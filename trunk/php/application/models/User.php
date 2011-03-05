<?php

class Application_Model_User extends Zend_Db_Table_Abstract
{
    protected $_name = 'user';

    public function getUsersList()
    {
        return $this->fetchAll($this->select());
    }

    public function addUser($login, $pass)
    {
        $this->insert(
                array('login'=>$login, 'password'=>$pass)
                );
    }

    public function findUser($login, $pass)
    {
         return $this->fetchRow($this->select()
                 ->where('login =?', $login)
                 ->where('password =?', $pass)
                 );
    }

    public function increment($user)
    {
        $this->update(
                array('id' =>new Zend_Db_Expr("id + 1")),
                array('login =?'=> $user)
                );
    }
}
