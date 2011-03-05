<?php

class Application_Plugin_GAController extends Zend_Controller_Action
{
    protected function _GA_init()
    {
        /*/
        $this->view->placeholder('menu')->setPrefix("<span>")
                         ->setSeparator("</span>\n<span>")
                         ->setIndent(4)
                         ->setPostfix("</span>\n");
        //*/
        $this->login_form =  new Application_Form_Login();
        $this->session = new Zend_Session_Namespace('user');
        if( $this->_GA_checkAuth())
        {
            $this->view->placeholder('menu')->append('<a href="index/logout">Wyloguj</a>');
        }
        else
        {
            $this->view->placeholder('menu')->append($this->login_form);
            $req = $this->getRequest();
            if($req->controller != 'index' && $req->action != 'index')
            {
                $this->_helper->actionStack('index','index');
            }
        }
    }

    protected function _GA_checkAuth()
    {
        $session = false;
        if(isset($this->session->user)) return true;
        if($this->getRequest()->isPost() && isset($_POST['login']))
        {
            if($this->login_form->isValid($_POST))
            {
                $user = new Application_Model_User();
                $user = $user->findUser($_POST['login'], md5($_POST['pass']));
                if(!empty($user))
                {
                    $this->session->user = $user->login;
                    $this->session->user_id = $user->id;
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