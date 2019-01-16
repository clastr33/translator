<?php 
$CUR_LANG_ID  = $_REQUEST["CUR_LANG_ID"];

$word_action  = $_REQUEST["word_action"];
$CUR_WORD_ID  = $_REQUEST["CUR_WORD_ID"];
$MAX_WORD_ID  = $_REQUEST["MAX_WORD_ID"];

$CUR_EQUAL  = $_REQUEST["CUR_EQUAL"];
$MAX_EQUAL  = $_REQUEST["MAX_EQUAL"];

//Connect to dbase
include("../mvcphp/misc.inc");
include("lang_db_functions.php");
$conn = new mysqli($hostFix, $userFix, $passwordFix, $databaseFix);
	if ($conn->connect_error) die();
	mysqli_set_charset($conn, "utf8");

	if($word_action != "addnew") {
		$sql = "SELECT wbID, wbContent, wbEqual, wbLangID FROM t_wordsbase";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$maxID = 0;
			$maxEqual = 0;
			while( $rs = $result->fetch_array(MYSQLI_ASSOC) ) {
				if($word_action == "read") {
					if($rs['wbLangID'] == $CUR_LANG_ID) {
						echo " <li><a onclick='word_choose({$rs['wbID']}, {$rs['wbEqual']});' ";
						if($rs['wbID'] == $CUR_WORD_ID)
							echo "class='activelang'";
						echo ">{$rs['wbContent']}</a></li>";
					}
				}
				elseif($word_action == "change") {
					if($rs['wbEqual'] == $CUR_EQUAL) {
						$langName2 = TakeLangNameByID($rs['wbLangID'] );
						echo "<b id='wordlangname{$rs['wbID']}'>{$langName2}</b>";
						echo "<li id='wordname_li{$rs['wbID']}' class='li_lang_edit'>";
						echo "<input id='wordname_inp{$rs['wbID']}' type='text' value='{$rs['wbContent']}'>";
						echo "&nbsp;<input type='button' value='X' onclick='db_word_delete({$rs['wbID']});' class='del_button'>";
						echo "</li>";
						echo "<p class='spaceras0'>&nbsp;</p>";
					}
				}

				if($maxID < $rs['wbID'])
					$maxID = $rs['wbID'];
				if($maxEqual < $rs['wbEqual'])
					$maxEqual = $rs['wbEqual'];
			}

			echo "<i id='hidden_maxWordID' class='display_none'>{$maxID}</i>";
			echo "<i id='hidden_maxEqual' class='display_none'>{$maxEqual}</i>";
		}else{
			echo "[Place for word list]";
			echo "<i id='hidden_maxWordID' class='display_none'>{$MAX_WORD_ID}</i>";
			echo "<i id='hidden_maxEqual' class='display_none'>{$MAX_EQUAL}</i>";
		}

		if($word_action == "change") {
			echo "<p class='spaceras0'>&nbsp;</p>";
			echo "<li id='input_wordlang_liID' class='li_lang_edit'>";
			echo 	"<input id='input_wordlang_nameID' type='text' value='' placeholder='Language...'>";
			echo "<p class='spaceras0'>&nbsp;</p>";

/*
					<select>
					  <option>Russian</option>
					  <option>English</option>
					</select>
*/
			echo 	"<input id='input_word_nameID' type='text' value='' placeholder='Word...'>";
			echo 	"&nbsp;<input type='button' value='Add' onclick='db_word_create();' class='lang_add_button'> ";
			echo 	"<p class='spaceras0'>&nbsp;</p>";
			echo "</li>";
		}
	}
	elseif($word_action == "addnew") {
		$sql2 = "SELECT langID, langName FROM t_language";
		$result2 = $conn->query($sql2);
		if ($result2->num_rows > 0)	{
			$curWordId = $MAX_WORD_ID;
			while( $rs2 = $result2->fetch_array(MYSQLI_ASSOC) )	{
				echo "<b id='wordlangname{$curWordId}'>{$rs2['langName']}</b>";
				echo "<li id='wordname_li{$curWordId}' class='li_lang_edit'>";
				echo 	"<input id='wordname_inp{$curWordId}' type='text' value=''>";
				echo 	"&nbsp;<input type='button' value='X' onclick='db_word_delete({$curWordId});' class='del_button'>";
				echo "</li>";
				echo "<p class='spaceras0'>&nbsp;</p>";
				$curWordId++;
			}
			$MAX_WORD_ID = $curWordId-1;
		}
		echo "<i id='hidden_maxWordID' class='display_none'>{$MAX_WORD_ID}</i>";
		echo "<i id='hidden_maxEqual' class='display_none'>{$MAX_EQUAL}</i>";
	}

$conn->close();
















