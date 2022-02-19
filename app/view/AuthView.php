<?php require_once 'app/core/View.php';

class AuthView extends View
{
    function __construct()
    {
        $this->layout = 'auth';
        parent::__construct($this->template = 'default' ,$this->layout);
    }
}
