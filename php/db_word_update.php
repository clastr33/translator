<?php 
$MAX_WORD_ID  = $_REQUEST["MAX_WORD_ID"];
$paramsF  = $_REQUEST["paramsF"];
$numNames = $_REQUEST['numNames'];
$in_action  = $_REQUEST["in_action"];
$MAX_EQUAL  = $_REQUEST["MAX_EQUAL"];
$MAX_EQUAL++;

include("misc.inc");
include("lang_db_functions.php");
$conn = new mysqli($hostFix, $userFix, $passwordFix, $databaseFix);
	if ($conn->connect_error) die();
	mysqli_set_charset($conn, "utf8");

	for($i = 1; $i < $MAX_WORD_ID; $i++) {
		$cNtext = "wordname_inp" . $i;
		$fVtext = "wordname_val" . $i;
		if(isset($_REQUEST[$cNtext])) {
			$childID = (int)$_REQUEST[$cNtext];
			$childVal = $_REQUEST[$fVtext];

			//Anti XSS-injection
			$childVal = htmlspecialchars($childVal, ENT_QUOTES);

			//Anti SQL-injection ???
			$childVal = mysqli_real_escape_string($conn, $childVal);

			if($in_action == "change")
				$sql = "UPDATE t_wordsbase SET wbContent='{$childVal}' WHERE wbID={$childID}";
			elseif($in_action == "addnew") {
				$fVLang = "wordlangname" . $i;
				$childLangVal = $_REQUEST[$fVLang];
				$wordlang_id = TakeLangIDByName($childLangVal);
				$sql = "INSERT INTO t_wordsbase (`wbID`, `wbContent`, `wbEqual`, `wbLangID`) VALUES ({$childID}, '{$childVal}', {$MAX_EQUAL}, {$wordlang_id})";
			}
			$result = $conn->query($sql);
		}
	}

$conn->close();
















