<?php
/**
 * @author mateusz
 */
class Application_Model_Question extends Zend_Db_Table_Abstract
{
    protected $_name = 'question';
    protected $_primary = 'id';
    protected $_referenceMap = array(
        'poll' => array(
            'columns' => 'poll_id',
            'refTableClass' => 'Application_Model_Poll',
            'refColumns' => 'id',
            ),
        'option'=> array(
            'columns' => 'id',
            'refTableClass' => 'Application_Model_Option',
            'refColumns' => 'question_id',
            ),
        );
    
    public function addQuestion($poll_id, $class,$content)
    {
        $id = $this->insert(
                array(
                    'poll_id'=>$poll_id,
                    'class'=>$class,
                    'content'=>$content
                    )
                );
        return $id;
    }

    public function getQuestionAndOptionsArray($q_id)
    {
       $ret = array();
       $ret['question'] =
       $this->fetchRow($this->select()
               ->where('id =?', $q_id)
               );
       $ret['options'] = $ret['question']
                ->findDependentRowset('Application_Model_Option')
                ->toArray();
       $ret['question'] = $ret['question']->toArray();
       return $ret;
    }
}
?>
