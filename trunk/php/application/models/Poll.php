<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Poll
 *
 * @author mateusz
 */
class Application_Model_Poll extends Zend_Db_Table_Abstract
{
    protected $_name = 'poll';
    protected $_referenceMap = array(
        'user' => array(
            'columns' => 'id',
            'refTableClass' => 'Application_Model_User',
            'refColumns' => 'user_id',
            ),
        );

    public function addPoll($title, $description, $user_id)
    {
        $this->insert(
                array(
                    'title'=>$title,
                    'description'=>$description
                    )
                );
    }

    public function getPoll($page,$user='all')
    {
        if($user == 'all')
        {
            return $this->fetchAll(
                    $this->select()
                    //->limitPage(25,$page)
                    );
        }
    }
}
?>
