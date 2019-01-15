<?php 
$MAX_LANG_ID  = $_REQUEST["MAX_LANG_ID"];
$paramsF  = $_REQUEST["paramsF"];
$numNames = $_REQUEST['numNames'];

include("misc.inc");
$conn = new mysqli($hostFix, $userFix, $passwordFix, $databaseFix);
	if ($conn->connect_error) die();
	mysqli_set_charset($conn, "utf8");

	for($i = 1; $i < $MAX_LANG_ID; $i++) {
		$cNtext = "langname_inp" . $i;
		$fVtext = "langname_val" . $i;
		if(isset($_REQUEST[$cNtext])) {
			$childID = (int)$_REQUEST[$cNtext];
			$childVal = $_REQUEST[$fVtext];
			$sql = "UPDATE t_language SET langName='{$childVal}' WHERE langID={$childID}";
			$result = $conn->query($sql);
		}
	}
$conn->close();

















