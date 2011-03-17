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
    protected $_primary = 'id';
    protected $_referenceMap = array(
        'user' => array(
            'columns' => 'user_id',
            'refTableClass' => 'Application_Model_User',
            'refColumns' => 'id',
            ),
        'question' => array(
            'columns' => 'id',
            'refTableClass' => 'Application_Model_Question',
            'refColumns' => 'question_id',
            ),
        );

    public function addPoll($title, $description, $user_id)
    {
        $id = $this->insert(
                array(
                    'title'=>$title,
                    'description'=>$description,
                    'user_id'=>$user_id
                    )
                );
        return $id;
    }

    public function getPollList($page,$user='all')
    {
        if($user == 'all')
        {
            $select = $this->select(Zend_Db_Table::SELECT_WITH_FROM_PART);
            $select->setIntegrityCheck(false)
                ->join('user', 'user.id = poll.user_id');
            return $this->fetchAll($select);
        }
        else
        {
            $select = $this->select(Zend_Db_Table::SELECT_WITH_FROM_PART);
            $select->setIntegrityCheck(false)
                ->join('user', 'user.id = poll.user_id')
                ->where('user_id = ?', $user);
            return $this->fetchAll($select);
        }
    }

    public function getPoll($id)
    {
       return $this->fetchRow(
               $this->select()
               ->where('id = ?',$id)
               );
    }
}
?>
