<?php
class PollController extends Application_Plugin_GAController
{
    public function indexAction()
    {
        $poll_data = new Application_Model_Poll();
        $poll = $poll_data->getPoll(1);
        $questions = $poll->findDependentRowset('Application_Model_Question');
        $list = $questions->toArray();
        $row = $list[0];
        $radio = new $row['class']();
        $radio->render();
    }

    public function createAction()
    {
        $this->view->form = new Application_Form_PollName();
        if($this->getRequest()->isPost())
        {
            if($this->view->form->isValid($_POST))
            {
                $poll = new Application_Model_Poll();
                $poll_id = $poll->addPoll(
                        $_POST['title'],
                        $_POST['description'],
                        $this->session->user_id
                        );
                $this->_redirect('/poll/question/p_id/'.$poll_id.'/q_id/1');
            }
        }
    }
    
    public function questionAction()
    {
        $poll_t = new Application_Model_Poll();
        $req = $this->getRequest();
        $p_id = $req->getParam('p_id');
        $poll_r = $poll_t->getPoll($p_id);
        $questions = $poll_r->findDependentRowset('Application_Model_Question');
        $q_size = $questions->count();
        $this->_helper->viewRenderer->setNoRender(true);
        $this->view->form = new Application_Form_PollQuestion();
        if($req->isPost())
        {
            if($this->view->form->isValid($_POST))
            {
                $questions = new Application_Model_Question();
                $options = new Application_Model_Option();
                $q_id = $questions->addQuestion(
                        $req->getParam('p_id'),
                        $_POST['class'],
                        $_POST['question']
                        );
                foreach($_POST['option'] as $content)
                {
                    $options->addOption($q_id, $content, 1);
                }
                $this->_redirect('/poll/question/p_id/'.$p_id.'/q_nr/'.($q_size+1));
            }
        }
        else
        {
            if($req->getParam('q_nr')<=$q_size)
            {
                $this->view->form->fillForm('bardzo','radio',array('lol','bol'));
            }
            echo $this->view->form;
        }
    }

}