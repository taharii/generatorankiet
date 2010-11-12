<?php

class IndexController extends Application_Plugin_GAController
{
    public function indexAction()
    {
     
    }

    public function logoutAction()
    {
        $this->_helper->layout()->disableLayout();
        //$this->_helper->viewRenderer->setNoRender(true);
        Zend_Session::namespaceUnset('user');
        $this->_redirect('index');
    }
}