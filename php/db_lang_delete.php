<?php 
$in_cur_langID  = (int)$_REQUEST["in_cur_langID"];

//Connect to dbase
include("misc.inc");
$conn = new mysqli($hostFix, $userFix, $passwordFix, $databaseFix);
	if ($conn->connect_error) die();

	$sql = "DELETE FROM t_language WHERE langID={$in_cur_langID}";
	$result = $conn->query($sql);

	$sql = "DELETE FROM t_wordsbase WHERE wbLangID={$in_cur_langID}";
	$result = $conn->query($sql);
$conn->close();



