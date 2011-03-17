<?php
class Application_Form_AddUser extends Zend_Form
{
    public function init()
    {
	//$this->setElementDecorators( array( 'ViewHelper') );
        $this->setMethod('post');
        $this->addElement(
                'text',
                'login',
                array(
                    'required'=> true,
                    'label'=>'Login'
                     )
                );

	$this->addElement('password', 'password',
                array(
                    'required'=> true,
                    'label'=>'Hasło'
                    )
                );

        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label' => 'Załóż konto'
            )
           );
    }
}

