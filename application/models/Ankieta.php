<?php

class Application_Model_Ankieta extends Zend_Db_Table
{
    protected $_name = 'ankieta';

    public function getItemsList()
    {
        return $this->fetchAll($this->select());
    }

    public function addUser($login, $pass)
    {
        $this->insert(
                array('login'=>$login, 'password'=>$pass)
                );
    }
}
