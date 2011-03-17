<?php

class Application_Plugin_GAController extends Zend_Controller_Action
{
    public function init()
    {
        $this->poll_data = new Application_Model_Poll();
        $this->view->placeholder('menu')->setPrefix('<div class="menu_element">')
                         ->setSeparator("</div>\n<div class=\"menu_element\">")
                         ->setIndent(4)
                         ->setPostfix("</div>\n");
        $login_form = new Application_Form_Login();
        $this->session = new Zend_Session_Namespace('user');
        if(isset($this->session->user))
        {
            $this->view->placeholder('menu')
                    ->append('<a href="/poll/create">Dodaj ankietę</a>');
            $this->view->placeholder('menu')
                    ->append('<a href="/user/">Moje ankiety</a>');
             $this->view->placeholder('menu')
                    ->append('<a href="/index/">Wszystkie ankiety</a>');
            $this->view->placeholder('menu')
                    ->append('<a href="/index/logout">Wyloguj</a>');
        }
        else
        {
            $this->view->placeholder('menu')->append($login_form);
            $req = $this->getRequest();
            if($req->controller != 'index' && $req->action != 'index')
            {
                $this->_helper->actionStack('index','index');
            }
        }
    }
}