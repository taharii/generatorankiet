<?php
class Application_Form_Login extends Zend_Form
{
    public function init()
    {
	//$this->setElementDecorators( array( 'ViewHelper') );
        $this->setMethod('post');

        $this->addElement('text', 'login', array(
            'required'   => true,
        ));

	$this->addElement('password', 'pass', array(
            'required'     => true,
        ));

        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
        ));

	$viewScript = new Zend_Form_Decorator_ViewScript();
	$viewScript->setViewScript('forms/Login.phtml');
	$this->clearDecorators();
	$this->addDecorator($viewScript);
    }
}

