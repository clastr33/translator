<?php 
//0 Take old and new language Names. Detect their's ID.
//1 Load initial text from db.
//2 Take words for language IDs.
//3 Replace in text words.


$old_langName  = $_REQUEST["old_langName"];
$new_langName  = $_REQUEST["new_langName"];

include("../mvcphp/misc.inc");
$conn = new mysqli($hostFix, $userFix, $passwordFix, $databaseFix);
	if ($conn->connect_error) die();
	mysqli_set_charset($conn, "utf8");


	//0 Take old and new language Names. Detect their's ID.
	$oldLangID = 1;
	$newLangID = 1;

	$sql = "SELECT langID, langName FROM t_language WHERE langName='{$old_langName}'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$rs = $result->fetch_array(MYSQLI_ASSOC);
		$oldLangID = $rs['langID'];
	}
	$sql = "SELECT langID, langName FROM t_language WHERE langName='{$new_langName}'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$rs = $result->fetch_array(MYSQLI_ASSOC);
		$newLangID = $rs['langID'];
	}


	//1 Load initial text from db.
	$InitText = "";

	$sql = "SELECT textID, textContent FROM t_text";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$rs = $result->fetch_array(MYSQLI_ASSOC);
		$InitText = $rs['textContent'];
	}

	//2 Take words for language IDs.
	$oldWordsArr = array();
	$newWordsArr = array();

	$sql = "SELECT wbID, wbContent, wbEqual, wbLangID FROM t_wordsbase WHERE wbLangID={$oldLangID}";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while( $rs = $result->fetch_array(MYSQLI_ASSOC) ) {
			$index = $rs['wbEqual'];
			$oldWordsArr[$index] = $rs['wbContent'];
		}
	}

	$sql = "SELECT wbID, wbContent, wbEqual, wbLangID FROM t_wordsbase WHERE wbLangID={$newLangID}";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while( $rs = $result->fetch_array(MYSQLI_ASSOC) ) {
			$index = $rs['wbEqual'];
			$newWordsArr[$index] = "<i class='color_red'>" . $rs['wbContent'] . "</i>";
		}
	}


	//3 Replace in text words.
	$NewText = $InitText;

	foreach ($oldWordsArr as $key => $value) {
		if($newWordsArr[$key] != "")
			$NewText = str_replace($value, $newWordsArr[$key], $NewText);
	}

$conn->close();

echo $NewText;