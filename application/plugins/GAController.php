<?php

class Application_Plugin_GAController extends Zend_Controller_Action
{
    protected function _GA_init()
    {
        $this->login_form =  new Application_Form_Login();
        $this->session = new Zend_Session_Namespace('user');
        if( $this->_GA_checkAuth())
        {
            $this->view->placeholder('menu')->append('<a href="index/logout">Wyloguj</a>');
        }
        else
        {
            $this->view->placeholder('menu')->append($this->login_form);
        }
    }

    protected function _GA_checkAuth()
    {
        $session = false;
        if(isset($this->session->user)) return true;
        if($this->getRequest()->isPost())
        {
            if($this->login_form->isValid($_POST))
            {
                $user = new Application_Model_Users();
                $user = $user->findUser($_POST['login'], md5($_POST['pass']));
                if(!empty($user))
                {
                    $this->session->user = $user->login;
                    $session = true;
                }
            }
        }
        return $session;
    }

    public function init()
    {
        $this->_GA_init();
    }
}
?>
