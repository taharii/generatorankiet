<?php
/**
 * Description of Option
 *
 * @author mateusz
 */

class Application_Model_Option extends Zend_Db_Table_Abstract
{
    protected $_name = 'option';
    protected $_primary = 'id';
    protected $_referenceMap = array(
        'question' => array(
            'columns' => 'question_id',
            'refTableClass' => 'Application_Model_Question',
            'refColumns' => 'id',
            ),
        );
    
    public function addOption($question_id, $content, $scale)
    {
        $id = $this->insert(
                array(
                    'question_id'=>$question_id,
                    'scale'=>$scale,
                    'content'=>$content
                    )
                );
        return $id;
    }
}
?>
