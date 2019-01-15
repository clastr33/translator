<?php
//Connect to dbase
include("misc.inc");
$in_cur_wordID  = (int)$_REQUEST["in_cur_wordID"];
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

    $sql = "DELETE FROM t_wordsbase WHERE wbID={$in_cur_wordID}";
    $result = $conn->query($sql);
    $conn->close();
}

echo $identified;
