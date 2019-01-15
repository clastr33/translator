<?php
session_start();

echo "<b>Sessions DESTROYER <small>(by clAStr)</small></b> <br>";
//======== Delete all vars in Session. ================================================
session_unset();
session_destroy();
echo "Session destroyed<br>";
$_SESSION = array();
		
?>