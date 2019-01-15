<?php 
$in_cur_wordID  = (int)$_REQUEST["in_cur_wordID"];

//Connect to dbase
include("misc.inc");
$conn = new mysqli($hostFix, $userFix, $passwordFix, $databaseFix);
	if ($conn->connect_error) die();

	$sql = "DELETE FROM t_wordsbase WHERE wbID={$in_cur_wordID}";
	$result = $conn->query($sql);
$conn->close();

