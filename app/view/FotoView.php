<?php require_once 'app/core/View.php';

class FotoView extends View
{
    function __construct()
    {
        $this->layout = 'foto';
        parent::__construct($this->template = 'default' ,$this->layout);
    }
}
