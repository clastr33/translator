<?php
//Connect to dbase
include("../mvcphp/misc.inc");
$in_cur_langID  = (int)$_REQUEST["in_cur_langID"];
$scrf_token_page  = (int)$_REQUEST["scrf_token"];

include("functions.php");
$par_arr = checkidentity();
$identified = $par_arr[0];
$csrf_token_by_key = $par_arr[1];
if($scrf_token_page != $csrf_token_by_key)
    $identified = "Access denied. Page CSRF-Token Failed!";

if($identified == "Access granted") {
    $conn = new mysqli($hostFix, $userFix, $passwordFix, $databaseFix);
    if ($conn->connect_error) die();

    $sql = "DELETE FROM t_language WHERE langID={$in_cur_langID}";
    $result = $conn->query($sql);

    $sql = "DELETE FROM t_wordsbase WHERE wbLangID={$in_cur_langID}";
    $result = $conn->query($sql);
    $conn->close();
}

echo $identified;


