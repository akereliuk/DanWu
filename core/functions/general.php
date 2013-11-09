<?php
function sanitize($strData) {
	return mysql_real_escape_string($strData);
}

// function array_sanitize($array){
	// $array = mysql_real_escape_string($item);
// }

function output_errors($arrErrors) {
	echo "<h3>Errors:</h3><br>";
	foreach($arrErrors as $strErrorMsg){
		print_r('<li>' . $strErrorMsg . '</li>');
	}
}

?>