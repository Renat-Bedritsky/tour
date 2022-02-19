<?php 
require_once 'app/core/Controller.php';
require_once 'app/view/AuthView.php';

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        
        if (isset($this->pageData['userData']['login'])) {
            exit(Controller::set404());
        }

        $this->view = new AuthView;
    }


    public function actionGet()
    {
        $this->pageData['title'] = 'Авторизация';

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            return $this->checkLogin($_POST);
        }

        $_POST = $this->pageData;

        $this->view->show();
    }


    private function checkLogin($authData)
    {
        $this->user = new UserModel;
        $checkLogin = $this->user->getLogin($authData['auth_login']);

        if (empty($checkLogin)) {
            echo json_encode(array(
                'result_check_login' => 'Пользователь не найден',
                'result_check_password' => 'Пароль'
            ));
            return;
        }
        else {
            return $this->checkPassword($authData);
        }
    }
    

    private function checkPassword($authData)
    {
        $this->user = new UserModel;

        $salt = 'standart';
        $passwordHash = md5($salt.$authData['auth_password']);
        $checkPassword = $this->user->getPasswordHash($authData['auth_login']);

        foreach ($checkPassword as $key => $value) {
            $checkPassword = $checkPassword[$key]['password'];
        }

        if (empty($checkPassword) || $passwordHash !== $checkPassword) {
            echo json_encode(array(
                'result_check_login' => 'Логин',
                'result_check_password' => 'Пароль не верный'
            ));
            return;
        }
        else {
            return $this->authorizationAllowed($authData, $passwordHash);
        }
    }


    private function authorizationAllowed($authData, $passwordHash)
    {
        echo json_encode(array('admission' => 'approved'));

        $login = mb_strtolower($authData['auth_login']);

        setcookie('login', $authData['auth_login']);
        setcookie('hash', md5($login.$passwordHash));
    }
}
