<?php 
require_once 'app/core/Controller.php';
require_once 'app/view/ContactsView.php';

class ContactsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->view = new ContactsView;
    }
    

    public function actionGet()
    {
        $this->pageData['title'] = 'Контакты';

        $_POST = $this->pageData;

        $this->view->show();
    }
}
