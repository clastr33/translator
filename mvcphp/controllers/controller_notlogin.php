<?php
class Controller_Notlogin extends Controller
{	
	function action_index()
	{
		$this->view->generate('view_notlogin.php', 'view_template.php');
	}
}
