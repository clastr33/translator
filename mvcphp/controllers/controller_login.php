<?php
class Controller_Login extends Controller
{	
	function action_index()
	{
        session_start();

        include("php/functions.php");
        //set CSRF token. Create a key for HASH HMAC function
        if (empty($_SESSION['key'])) {
            $_SESSION['key'] = genpass(32);		//$_SESSION['key'] = bin2hex(random_bytes(32));  //Only from PHP7
            //echo "<br>Generated new SESSION['key']";
        }

        //count CSRF token by key in hash_hmac function. It will be stored in   <input type="hidden" name="csrf" ...
        if (!empty($_SESSION['key'])) {
            //echo "<br>Exists SESSION['key']";
            $csrf_token = hash_hmac('sha256', 'this is some string: login', $_SESSION['key']);
            $data["csrf_token"] = $csrf_token;
            //echo "<br>Counted CSRF token";
        }


		if( isset($_POST['submit']) ) {
            //echo "<br>Submit pressed";
            /*
             * It's just simple example. Login and password should be kept in DB.
            */
            $login_savedDB = "admin";
            $pass_savedDB = "123";
            $login_entered = $_POST['username'];
            $pass_entered = $_POST['password'];

            //Validate user name and token
            if (hash_equals($login_entered, $login_savedDB) && hash_equals($pass_entered, $pass_savedDB)) {
                if( hash_equals($csrf_token, $_POST['csrf']) ) {
                    $data["login_status"] = "access_granted";
                    $_SESSION['logged_user'] = $login_entered;
                    header('Location:/admin');
                } else {
                    $data["login_status"] = "access_denied2";
                }
            } else {
                $data["login_status"] = "access_denied1";
            }

		} else {
			$data["login_status"] = "not_tried";
		}


		$this->view->generate('view_login.php', 'view_template.php', $data);
	}

}
