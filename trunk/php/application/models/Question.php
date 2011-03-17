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
}
?>
