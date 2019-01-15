<?php
include("misc.inc");
include("lang_db_functions.php");
$MAX_LANG_ID  = $_REQUEST["MAX_LANG_ID"];
$paramsF  = $_REQUEST["paramsF"];
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
    mysqli_set_charset($conn, "utf8");

    for ($i = 1; $i < $MAX_LANG_ID; $i++) {
        $cNtext = "langname_inp" . $i;
        $fVtext = "langname_val" . $i;
        if (isset($_REQUEST[$cNtext])) {
            $childID = (int)$_REQUEST[$cNtext];
            $childVal = $_REQUEST[$fVtext];
            $childVal = AntiInjections($childVal);
            $sql = "UPDATE t_language SET langName='{$childVal}' WHERE langID={$childID}";
            $result = $conn->query($sql);
        }
    }
    $conn->close();
}

echo $identified;

















