<?php require_once 'app/core/View.php';

class ContactsView extends View
{
    function __construct()
    {
        $this->layout = 'contacts';
        parent::__construct($this->template = 'default' ,$this->layout);
    }
}
