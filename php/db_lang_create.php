<?php
include("../mvcphp/misc.inc");
include("lang_db_functions.php");
$input_lang_name = $_REQUEST["input_lang_name"];
$input_lang_name = AntiInjections($input_lang_name);
$MAX_LANG_ID  = (int)$_REQUEST["MAX_LANG_ID"];
$scrf_token_page  = (int)$_REQUEST["scrf_token"];

include("functions.php");
$par_arr = checkidentity();
$identified = $par_arr[0];
$csrf_token_by_key = $par_arr[1];
if($scrf_token_page != $csrf_token_by_key)
    $identified = "Access denied. Page CSRF-Token Failed!";

if($identified == "Access granted") {
    //Out to screen.
    echo "<i id='temp_request1'>
            <li id='langname_li{$MAX_LANG_ID}' class='li_lang_edit'>
                <input id='langname_inp{$MAX_LANG_ID}' type='text' value='{$input_lang_name}'>
                &nbsp;<input type='button' value='X' onclick='db_lang_delete({$MAX_LANG_ID});' class='del_button'>	
            </li>
          </i>
        ";

    //Save to dbases.
    $conn = new mysqli($hostFix, $userFix, $passwordFix, $databaseFix);
        if ($conn->connect_error) die();
        mysqli_set_charset($conn, "utf8");
        $sql = "INSERT INTO t_language (`langID`, `langName`) VALUES ({$MAX_LANG_ID}, '{$input_lang_name}')";
        $result = $conn->query($sql);
    $conn->close();
}

echo "<i id='temp_request2'>$identified</i>";



