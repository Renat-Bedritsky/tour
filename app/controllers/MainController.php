<?php 
require_once 'app/core/Controller.php';
require_once 'app/view/MainView.php';

class MainController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->view = new MainView;
    }


    public function actionGet()
    {
        $this->pageData['title'] = 'Главная';

        $_POST = $this->pageData;

        $this->view->show();
    }


    public function actionExit()
    {
        $_SESSION['exit'] = date("Y-m-d H:i:s");
        setcookie('PHPSESSID', 'clear', time()-10);
        setcookie('login', 'clear', time()-10);
        setcookie('hash', 'clear', time()-10);
        header("location: /");
    }
}
