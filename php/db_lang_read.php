<?php 
$CUR_LANG_ID  = $_REQUEST["CUR_LANG_ID"];
$lang_action  = $_REQUEST["lang_action"];
$MAX_LANG_ID  = $_REQUEST["MAX_LANG_ID"];

//Connect to dbase
include("misc.inc");
$conn = new mysqli($hostFix, $userFix, $passwordFix, $databaseFix);
	if ($conn->connect_error) die();
	mysqli_set_charset($conn, "utf8");

	$sql = "SELECT langID, langName FROM t_language";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		//Echo content $num_rows items
		$maxID = 0;
		while( $rs = $result->fetch_array(MYSQLI_ASSOC) ) {
			if($lang_action == "read") {
				echo " <li><a id='textname{$rs['langID']}' onclick='lang_choose({$rs['langID']});' ";
				if($rs['langID'] == $CUR_LANG_ID)
					echo "class='activelang'";
				echo ">{$rs['langName']}</a></li>";
			}
			elseif($lang_action == "change") {
				echo " <li id='langname_li{$rs['langID']}' class='li_lang_edit'>
 							<input id='langname_inp{$rs['langID']}' type='text' value='{$rs['langName']}'>";
				echo "&nbsp;<input type='button' value='X' onclick='db_lang_delete({$rs['langID']});' class='del_button'>";
				echo "</li>";
			}

			if($maxID < $rs['langID'])
				$maxID = $rs['langID'];
		}

		echo "<i id='hidden_maxID' class='display_none'>{$maxID}</i>";

	}else {
		echo "[Place for languages list]";
		echo "<i id='hidden_maxID' class='display_none'>{$MAX_LANG_ID}</i>";
	}

	if($lang_action == "change") {
		echo "<p class='spaceras0'>&nbsp;</p>";
		echo "<li id='input_lang_liID' class='li_lang_edit'>
				<input id='input_lang_nameID' type='text' value='' placeholder='...'>";
		echo "&nbsp;<input type='button' value='Add' onclick='db_lang_create();' class='lang_add_button'> ";
		echo "</li>";
		echo "<p class='spaceras0'>&nbsp;</p>";
	}
$conn->close();

















