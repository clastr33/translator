<?php 
session_start();
include("functions.php");
$csrf_token = "";

if (empty($_SESSION['key']))
    $_SESSION['key'] = genpass(32);
if (!empty($_SESSION['key']))
    $csrf_token = hash_hmac('sha256', 'this is some string: login', $_SESSION['key']);

$_SESSION['inittoken'] = $csrf_token;
echo $csrf_token;