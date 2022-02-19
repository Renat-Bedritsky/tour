<?php require_once 'app/core/Model.php';

class UserModel extends Model
{
    public function __construct()
    {
        $this->fileName = 'users';
        parent::__construct();
    }
    

    // Для получения имени
    public function getName($login)
    {
        return $this->getList('name', ['login' => $login]);
    }


    // Для проверки существования логина
    public function getLogin($login)
    {
        return $this->getList('login', ['login' => $login]);
    }


    // Для проверки существования пароля
    public function getPasswordHash($login)
    {
        return $this->getList('password', ['login' => $login]);
    }


    // Для добавления пользователя
    public function addUser($userData)
    {
        $this->insertList($userData);
    }
}
