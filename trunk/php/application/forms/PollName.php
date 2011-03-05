<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PollName
 *
 * @author mateusz
 */
class Application_Form_PollName extends Zend_Form
{
    public function Init()
    {
        $this->setMethod('post');
        $this->addElement(
                'text',
                'title',
                array(
                    'required'=>true,
                    'label'=>'Tytuł ankiety'
                    ,'size'=>81,
                    'maxlength'=>256
                    )
                );
        $this->addElement(
                'textarea',
                'description',
                array(
                    'required'=>true,
                    'label'=>'Wstęp'
                    )
                );
        $this->addElement(
                'submit',
                'submit',
                array('label'=>'Przejdź do pytań')
                );
    }
}
?>
