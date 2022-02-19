<?php 
require_once 'app/core/Controller.php';
require_once 'app/view/RegistrationView.php';

class RegistrationController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        
        if (isset($this->pageData['userData']['login'])) {
            exit(Controller::set404());
        }

        $this->view = new RegistrationView;
    }


    public function actionGet()
    {
        $this->pageData['title'] = 'Регистрация';

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            return $this->checkName($_POST);
        }

        $_POST = $this->pageData;
        
        $this->view->show();
    }


    private function checkName($registData)
    {
        $regName = '/^([А-ЯЁ]{1}[а-яё]{1,29})|([A-Z]{1}[a-z]{1,29})$/u';

        if (!preg_match($regName, $registData['regist_name'])) {
            echo json_encode(array(
                'result_check_name' => 'Некорректное имя',
                'result_check_email' => 'Email',
                'result_check_login' => 'Логин',
                'result_check_password_one' => 'Пароль',
                'result_check_password_two' => 'Ещё раз'
            ));
            return;
        }
        else {
            return $this->checkEmail($registData);
        }
    }


    private function checkEmail($registData)
    {
        $regEmail = '/^(|(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6})$/i';

        if (!preg_match($regEmail, $registData['regist_email'])) {
            echo json_encode(array(
                'result_check_name' => 'Имя',
                'result_check_email' => 'Некорректный email',
                'result_check_login' => 'Логин',
                'result_check_password_one' => 'Пароль',
                'result_check_password_two' => 'Ещё раз'
            ));
            return;
        }
        else {
            return $this->checkLogin($registData);
        } 
    }


    private function checkLogin($registData)
    {
        $this->user = new UserModel;
        $checkLogin = $this->user->getLogin($registData['regist_login']);

        if (!empty($checkLogin)) {
            echo json_encode(array(
                'result_check_name' => 'Имя',
                'result_check_email' => 'Email',
                'result_check_login' => 'Логин существует',
                'result_check_password_one' => 'Пароль',
                'result_check_password_two' => 'Ещё раз'
            ));
            return;
        }
        else if (!preg_match("/^[a-zA-Zа-яА-ЯёЁ0-9]{6,}$/u", $registData['regist_login'])) {
            echo json_encode(array(
                'result_check_name' => 'Имя',
                'result_check_email' => 'Email',
                'result_check_login' => 'Только буквы и/или цифры',
                'result_check_password_one' => 'Пароль',
                'result_check_password_two' => 'Ещё раз'
            ));
            return;
        }
        else {
            return $this->checkPassword($registData);
        }
    }


    private function checkPassword($registData)
    {
        $passwordOne = $registData['regist_password_one'];
        $passwordTwo = $registData['regist_password_two'];

        if (!preg_match("/^(?=.*[0-9])(?=.*[a-zA-Z])[0-9a-zA-Z]{6,}$/", $passwordOne)) {
            echo json_encode(array(
                'result_check_name' => 'Имя',
                'result_check_email' => 'Email',
                'result_check_login' => 'Логин',
                'result_check_password_one' => 'Только буквы и цифры',
                'result_check_password_two' => 'Ещё раз'
            ));
            return;
        }
        else if ($passwordOne !== $passwordTwo) {
            echo json_encode(array(
                'result_check_name' => 'Имя',
                'result_check_email' => 'Email',
                'result_check_login' => 'Логин',
                'result_check_password_one' => 'Пароль',
                'result_check_password_two' => 'Пароли не совпадают'
            ));
            return;
        }
        else {
            return $this->registrationAllowed($registData);
        }
    }
    

    private function registrationAllowed($registData)
    {
        $this->user = new UserModel;

        $salt = 'standart';
        $password = $registData['regist_password_one'];
        $passwordHash = md5($salt.$password);

        $userData = [
            'name' => $registData['regist_name'],
            'email' => $registData['regist_email'],
            'login' => $registData['regist_login'],
            'password' => $passwordHash
        ];
    
        $this->user->addUser($userData);

        echo json_encode(array('admission' => 'approved'));

        $login = mb_strtolower($registData['regist_login']);

        setcookie('login', $registData['regist_login']);
        setcookie('hash', md5($login.$passwordHash));
    }
}
