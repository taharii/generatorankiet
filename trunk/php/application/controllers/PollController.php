<?php
class PollController extends Application_Plugin_GAController
{
    public function indexAction()
    {
        $poll_t = new Application_Model_Poll();
        $poll = $poll_t->getPoll($this->getRequest()->getParam('id'));
        $questions = $poll->findDependentRowset('Application_Model_Question');
        $this->view->poll = $poll->toArray();
        $this->view->questions = $questions->toArray();
        $this->view->options = array();
        $i = 0;
        foreach($questions as $row)
        {
            $this->view->options[$i] =
                    $row->findDependentRowset('Application_Model_Option')
                        ->toArray();
            $i++;
        }
    }

    public function createAction()
    {
        $this->view->form = new Application_Form_PollName();
        if($this->getRequest()->isPost())
        {
            if($this->view->form->isValid($_POST))
            {
                $poll_t = new Application_Model_Poll();
                $poll_id = $poll_t->addPoll(
                        $_POST['title'],
                        $_POST['description'],
                        $this->session->user_id
                        );
                $this->_redirect('/poll/question/p_id/'.$poll_id.'/q_nr/1');
            }
        }
    }
    
    public function questionAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $form = new Application_Form_PollQuestion();

        $poll_t = new Application_Model_Poll();
        $req = $this->getRequest();
        $p_id = $req->getParam('p_id');
        $poll_r = $poll_t->getPoll($p_id);
        $questions_rowset = $poll_r->findDependentRowset('Application_Model_Question');
        $q_size = $questions_rowset->count();
        $questions = new Application_Model_Question();
        if($req->isPost())
        {
            if($form->isValid($_POST))
            {
                $option_t = new Application_Model_Option();
                $question_t = new Application_Model_question();
                $q_id = $question_t->addQuestion(
                        $req->getParam('p_id'),
                        $_POST['class'],
                        $_POST['question']
                        );
                foreach($_POST['option'] as $content)
                {
                    $option_t->addOption($q_id, $content, 1);
                }
                $this->_redirect('/poll/question/p_id/'.$p_id.'/q_nr/'.($q_size+2));
            }
        }
        else
        {
            if($req->getParam('q_nr')<=$q_size)
            {
                $questions_array =  $questions_rowset->toArray();
                $q_id = $questions_array[$req->getParam('q_nr')-1]['id'];
                $question = $question_t->getQuestionAndOptionsArray($q_id);
                $q = $question['question'];
                $opts = $question['options'];
                $form->fillForm($q['content'],$q['class'],$opts);
            }
        }
        echo $form;
    }

}