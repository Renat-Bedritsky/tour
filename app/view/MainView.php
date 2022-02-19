<?php require_once 'app/core/View.php';

class MainView extends View
{
    function __construct()
    {
        $this->layout = 'main';
        parent::__construct($this->template = 'default' ,$this->layout);
    }
}
