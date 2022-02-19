<?php 
require_once 'app/core/Controller.php';
require_once 'app/view/FotoView.php';

class FotoController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->view = new FotoView;
    }
    

    public function actionGet()
    {
        $this->pageData['title'] = 'Фотографии';

        $_POST = $this->pageData;

        $this->view->show();
    }
}
