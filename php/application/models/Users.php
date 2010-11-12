<?php

class Application_Model_Users extends Zend_Db_Table
{
    protected $_name = 'users';

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
}
