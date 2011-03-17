<?php
/**
 * @author mateusz
 */
class Application_Form_PollQuestion extends Zend_Form
{
    public function Init()
    {
        $this->setMethod('post');
        $this->addElement(
                'text',
                'question',
                array(
                    'required'=>true,
                    'label'=>'Treść pytania'
                    ,'size'=>81,
                    'maxlength'=>256
                    )
                );
        $this->addElement(
                'select',
                'class',
                array(
                    'required'=>true,
                    'label'=>'Typ',
                    'MultiOptions' =>array('text'=>'text','radio'=>'radio','checkbox'=>'checkbox'),
                    )
                );
        $this->addElement(
                'button',
                'add',
                array(
                    'required'=>false,
                    'onClick'=>'dodaj_element(\'options\');',
                    'label'=>'Dodaj opcję odpowiedzi'
                    )
                );
        $this->addElement(
                'text',
                'option[]',
                array(
                    'required'=>false,
                    )
                );
        $this->addElement(
                'submit',
                'submit',
                array('label'=>'Zapisz pytanie')
                );
        $view_script = new Zend_Form_Decorator_ViewScript();
	$view_script->setViewScript('forms/Question.phtml');
	$this->clearDecorators();
	$this->addDecorator($view_script);
    }

    public function fillForm($question, $class, $options)
    {
        /*
        $this->getElement('question')->setValue($question);
        $this->getElement('class')->setValue($class);
        for($i = 0; $i< count($options); $i++)
        {
            $this->addElement(
                'text',
                "option[]",
                array(
                    'required'=>false,
                    )
                );
        }
         */
    }
}
?>
