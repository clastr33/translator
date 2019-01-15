<?php
class Model_Allwordslist extends Model
{
	public function get_data()
	{
		$PairsArr = array();
		include("php/misc.inc");
		include("php/lang_db_functions.php");
		$conn = new mysqli($hostFix, $userFix, $passwordFix, $databaseFix);
			if ($conn->connect_error) die();
			mysqli_set_charset($conn, "utf8");

			$sql =  "SELECT wbID, wbContent, wbEqual, wbLangID ";
			$sql .=	"FROM t_wordsbase ";
			$sql .=	"ORDER BY wbEqual, wbLangID";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				$curEqual = 0;
				while( $rs = $result->fetch_array(MYSQLI_ASSOC) ) {
					//Make space between words.
					if($rs['wbEqual'] != $curEqual) {
						$curEqual = $rs['wbEqual'];
						$index = $rs['wbContent'] . "---";
						$PairsArr[$index] = "===";
					}

					//Out words into array.
					$langName2 = TakeLangNameByID($rs['wbLangID'] );
					$index = $rs['wbContent'] . " [id=" . $rs['wbID'] . "]";
					$PairsArr[$index] = $langName2;
				}
			}
		$conn->close();

		return $PairsArr;
	}
}