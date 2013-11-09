<?php
function add_book($arrBookData){
	array_walk($arrBookData, 'array_sanitize');
	
	$strComma = "";
	$strSQL = "INSERT INTO tblBook SET ";
	
	foreach($arrBookData as $fieldTitle => $fieldData){
		$strSQL .= $strComma . $fieldTitle . " = '" . $fieldData . "' ";
		$strComma = ",";
	}
	
	mysql_query($strSQL);
	return mysql_insert_id();

}

function book_exists($strBookName){
	$strSQL = "SELECT COUNT (intBookID) FROM tblBook WHERE strBookName = '" . $strBookName . "'";
	$rsResult = mysql_query($strSQL);
	$row = mysql_fetch_row($rsResult);
	return ($row[0] > 0) ? true : false;
}

function getBookIDFromBookName($strBookName){
	$strSQL = "SELECT intBookID FROM tblBook WHERE strBookName = '" . $strBookName . "'";
	$rsResult = mysql_query($strSQL);
	$row = mysql_fetch_row($rsResult);
	return $row[0];
}

function getBookNameFromBookID($intBookID){
	$strSQL = "SELECT strBookName FROM tblBook WHERE intBookID = '" . $intBookID . "'";
	$rsResult = mysql_query($strSQL);
	$row = mysql_fetch_row($rsResult);
	return $row[0];
}

?>