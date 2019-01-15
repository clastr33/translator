<?php
class Controller_Contact extends Controller
{
    function action_index()
    {
        $this->view->generate('view_contact.php', 'view_template.php');
    }
}
