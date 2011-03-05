<?php
/*
 * Wszyskie kontrolery dziedziczą po klasie GAController, ktory dziedziczy
 * po Zend_Controller. Dodanie dodatkowej klasy (GAController) w łańcuchu
 * dziedziczenia umozliwia łatwe dodawanie akcji/metod które mają występować
 * w karzdym z kontrolerów np. _GA_checkAuth(), metoda sprawdzająca czy
 * użytkownik jest zalogowany
 */
class IndexController extends Application_Plugin_GAController
{
    public function indexAction()
    {
        $poll_data = new Application_Model_Poll();
        $this->view->data = $poll_data->getPoll(0);
    }

    public function createAction()
    {
        $this->view->form = new Application_Form_PollName();
        if($this->getRequest()->isPost() && !isset($_POST['login']))
        {
            if($this->view->form->isValid($_POST))
            {
                $poll = new Application_Model_Poll();
                $poll->addPoll(
                        $_POST['title'],
                        $_POST['description'],
                        $this->session->user_id
                        );
                $this->_redirect('index');
            }
        }
    }

    public function logoutAction()
    {
        $this->_helper->layout()->disableLayout();
        //$this->_helper->viewRenderer->setNoRender(true);
        Zend_Session::namespaceUnset('user');
        $this->_redirect('index');
    }
}