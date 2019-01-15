<?php 
$input_wordlang_name  = $_REQUEST["input_wordlang_name"];
$input_word_name  = $_REQUEST["input_word_name"];
$MAX_WORD_ID  = (int)$_REQUEST["MAX_WORD_ID"];
$CUR_EQUAL  = $_REQUEST["CUR_EQUAL"];

//Out to screen.
echo "<b id='wordlangname{$MAX_WORD_ID}'>{$input_wordlang_name}</b>";
echo "<li id='wordname_li{$MAX_WORD_ID}' class='li_lang_edit'>";
echo "<input id='wordname_inp{$MAX_WORD_ID}' type='text' value='{$input_word_name}'>";
echo "&nbsp;<input type='button' value='X' onclick='db_word_delete({$MAX_WORD_ID});' class='del_button'>";
echo "</li>";
echo "<p class='spaceras0'>&nbsp;</p>";

//Save to dbases.
include("misc.inc");
include("lang_db_functions.php");
$wordlang_id = TakeLangIDByName($input_wordlang_name);
$conn = new mysqli($hostFix, $userFix, $passwordFix, $databaseFix);
	if ($conn->connect_error) die();
	mysqli_set_charset($conn, "utf8");
	$sql = "INSERT INTO t_wordsbase (`wbID`, `wbContent`, `wbEqual`, `wbLangID`) VALUES ({$MAX_WORD_ID}, '{$input_word_name}', {$CUR_EQUAL}, {$wordlang_id})";
	$result = $conn->query($sql);
$conn->close();


