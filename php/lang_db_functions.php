<?php 
function TakeLangNameByID($inLangID)
{
	$langName2 = "";
	include("misc.inc");
	$conn2 = new mysqli($hostFix, $userFix, $passwordFix, $databaseFix);
		if ($conn2->connect_error) die();	
		mysqli_set_charset($conn2, "utf8");	
		
		$sql2 = "SELECT langID, langName FROM t_language WHERE langID={$inLangID}";
		$result2 = $conn2->query($sql2);
		if ($result2->num_rows > 0)	{
			$rs2 = $result2->fetch_array(MYSQLI_ASSOC);
			$langName2 = $rs2['langName'];
		}
	$conn2->close();
	
	return $langName2;
}


function TakeLangIDByName($inLangName)
{
	$langID2 = 0;
	include("misc.inc");
	$conn2 = new mysqli($hostFix, $userFix, $passwordFix, $databaseFix);
		if ($conn2->connect_error) die();	
		mysqli_set_charset($conn2, "utf8");	
		
		$sql2 = "SELECT langID, langName FROM t_language WHERE langName='{$inLangName}'";
		$result2 = $conn2->query($sql2);
		if ($result2->num_rows > 0)	{
			$rs2 = $result2->fetch_array(MYSQLI_ASSOC);
			$langID2 = $rs2['langID'];
		}
	$conn2->close();
	
	return $langID2;
}

function AntiInjections($inText)
{
    //Anti SQL-injection 2.
    //Replace special symbols '=' on 'EQ' and so on.
    $initPatterns = array("=", ";", ":", "?", "/", "\\");
    $newPatterns = array("EQ", "DC", "DD", "QQ", "SU", "SD");
    $inText = str_replace($initPatterns, $newPatterns, $inText);

    //Anti XSS-injection
    $inText = htmlspecialchars($inText, ENT_QUOTES);

    //Anti SQL-injection 1.
    //$inText = mysqli_real_escape_string($conn, $inText);

    return $inText;
}
