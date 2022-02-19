<?php
require_once 'app/models/UserModel.php';

class Controller
{
    public $user, $pageData = [];


    function __construct()
    {
        $this->user = new UserModel;
        $this->pageData['userData'] = $this->CheckCookieLogin();

        if (!empty($this->pageData['userData'])) {
            session_save_path('app/sessions');
            session_start();
            $_SESSION['name'] = $this->pageData['userData']['login'];
            $_SESSION['enter'] = date("Y-m-d H:i:s");

            $this->pageData['greeting'] = 'Hello '.$this->pageData['userData']['name'];
        }
        else {
            $this->pageData['greeting'] = 'Welcome';
        }
    }


    public function set404()
    {
        include_once 'app/core/View.php';
        (new View('other'))->show();
    }


    private function checkCookieLogin()
    {
        if (isset($_COOKIE['login']) && isset($_COOKIE['hash'])) {
            return $this->checkLogin($_COOKIE['login'], $_COOKIE['hash']);
        }
        else {
            return 0;
        }
    }


    private function checkLogin($login, $cookiePassword)
    {
        $checkLogin = $this->user->getLogin($login);

        if (!empty($checkLogin)) {
            return $this->checkPassword($login, $cookiePassword);
        }
        else {
            return false;
        }
    }


    private function checkPassword($login, $cookiePassword)
    {
        $checkPassword = $this->user->getPasswordHash($login);

        $loginForHash = mb_strtolower($login);

        foreach ($checkPassword as $key => $value) {
            $passwordHash = md5($loginForHash.$checkPassword[$key]['password']);
        }

        if (!empty($checkPassword) && $cookiePassword === $passwordHash) {
            return $this->createUserData($login);
        }
        else {
            return false;
        }
    }


    private function createUserData($login)
    {

        $userName = $this->user->getName($login);

        foreach ($userName as $key => $value) {
            $name = $userName[$key]['name'];
        }

        $access = 'allowed';
        $userData = [
            'name' => $name,
            'login' => $login,
            'access' => $access
        ];
        
        return $userData;
    }
}
