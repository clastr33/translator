<?php 
$input_lang_name = $_REQUEST["input_lang_name"];
$MAX_LANG_ID  = (int)$_REQUEST["MAX_LANG_ID"];

//Out to screen.
echo "<li id='langname_li{$MAX_LANG_ID}' class='li_lang_edit'>
 			<input id='langname_inp{$MAX_LANG_ID}' type='text' value='{$input_lang_name}'>
			&nbsp;<input type='button' value='X' onclick='db_lang_delete({$MAX_LANG_ID});' class='del_button'>	
	  </li>
	";

//Save to dbases.
include("misc.inc");
$conn = new mysqli($hostFix, $userFix, $passwordFix, $databaseFix);
	if ($conn->connect_error) die();
	mysqli_set_charset($conn, "utf8");
	$sql = "INSERT INTO t_language (`langID`, `langName`) VALUES ({$MAX_LANG_ID}, '{$input_lang_name}')";
	$result = $conn->query($sql);
$conn->close();



