<?php
class Controller_Admin extends Controller
{
	function action_index()
	{
        include("php/functions.php");
        $par_arr = checkidentity();
        $identified = $par_arr[0];
        $data["csrf_token"] = $par_arr[1];

        if($identified == "Access granted")
            $this->view->generate('view_admin.php', 'view_template.php', $data);
        else {
            $data["login_status"] = $identified;
            $this->view->generate('view_notlogin.php', 'view_template.php', $data);
        }
	}



	function action_logout()
	{
		session_start();
		session_destroy();
		header('Location:/');
	}

}
