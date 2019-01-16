<?php
//Redirect 301 for http://transme.ml/?i=1 hosting bag.
if ($_SERVER['REQUEST_URI'] == '/?i=1') {
	header('HTTP/1.1 301 Moved Permanently');
    header('Location: /');	exit;
}

//Start of program.
ini_set('display_errors', 1);

require_once 'mvcphp/bootstrapas.php';
