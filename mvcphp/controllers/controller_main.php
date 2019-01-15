<?php
class Controller_Main extends Controller
{
    function action_index()
    {
//        include("php/functions.php");
//        $par_arr = checkidentity();
//        $data["csrf_token"] = $par_arr[1];
        $data['test'] = "test";

        $this->view->generate('view_main.php', 'view_template.php', $data);
    }
}
