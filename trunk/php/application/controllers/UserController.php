<?php

class UserController extends Application_Plugin_GAController
{
    public function indexAction()
    {
        if(isset($this->session->user))
        {
            $this->view->data = $this->poll_data->getPollList(0,$this->session->user_id);
        }
        else
        {
            $this->_redirect('/user/add/');
        }
    }

    public function addAction()
    {
        $this->view->form = new Application_Form_AddUser();
        if($this->getRequest()->isPost())
        {
            if($this->view->form->isValid($_POST))
            {
                $user = new Application_Model_User();
                $user->addUser($_POST['login'], $_POST['password']);
                $this->_redirect('index');
            }
        }
    }
}