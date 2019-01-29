<?php
session_start();

function checkidentity()
{
    $identified = "not";

    if (empty($_SESSION['key']))
        $_SESSION['key'] = genpass(32);
    if (!empty($_SESSION['key']))
        $csrf_token = hash_hmac('sha256', 'this is some string: login', $_SESSION['key']);

    //It's just simple example. Login and password should be kept in DB.
    $login_savedDB = "admin";

    if ( isset($_SESSION['logged_user']) && hash_equals($_SESSION['logged_user'], $login_savedDB) ) {
        if ( isset($_SESSION['inittoken']) && hash_equals($_SESSION['inittoken'], $csrf_token) )
            $identified = "Access granted";
        else
            $identified = "Access denied. CSRF-Token Failed!";
    } else
        $identified = "Access denied. Name or password Failed!";

    return array($identified, $csrf_token);
}

function genpass($max)
{
    $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890";
    $size = StrLen($chars)-1;
    $password = null;
    while($max--)
    $password .= $chars[rand(0, $size)];

    return $password;
}