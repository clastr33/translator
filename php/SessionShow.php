<?php

session_start();

echo "<b>Sessions Viewer <small>(by clAStr)</small></b> <br>";

foreach($_SESSION as $field => $value)
	if( isset($_SESSION[$field]) ) {
		if(gettype($value) == "array") {
			$probels = "---";
			ShowSessionArray($value,$probels);
		} else
			echo "<br>" . $probels . "<b>".$field.":</b> ".$value;
	}
		
		
		
		
function ShowSessionArray($value, $probels) {
	foreach($value as $fiel => $val) {
		if(gettype($val) == "array") {
			$probels .= "---";
			ShowSessionArray($val,$probels);			
		} else
			echo "<br>" . $probels . "<b>".$fiel.":</b> ".$val;
	}		
}
		
