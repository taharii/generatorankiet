<?php
/*
 * Wszyskie kontrolery dziedziczą po klasie GAController, ktory dziedziczy
 * po Zend_Controller. Dodanie dodatkowej klasy (GAController) w łańcuchu
 * dziedziczenia umozliwia łatwe dodawanie akcji/metod które mają występować
 * w karzdym z kontrolerów.
 */
class IndexController extends Application_Plugin_GAController
{
    public function indexAction()
    {
        $this->view->data = $this->poll_data->getPollList(0);
    }

    public function loginAction()
    {
        //$this->getHelper('viewRenderer')->setNoRender();
        if($this->getRequest()->isPost() && isset($_POST['login']))
        {
            $login_form = new Application_Form_Login();
            if($login_form->isValid($_POST))
            {
                $user = new Application_Model_User();
                $user = $user->findUser($_POST['login'], $_POST['pass']);
                if(!empty($user))
                {
                    $this->session->user = $user->login;
                    $this->session->user_id = $user->id;
                }
            }
        }
        $this->_redirect('index');
    }

    public function logoutAction()
    {
        $this->_helper->layout()->disableLayout();
        //$this->_helper->viewRenderer->setNoRender(true);
        Zend_Session::namespaceUnset('user');
        $this->_redirect('index');
    }
}