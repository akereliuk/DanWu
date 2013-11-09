<?php

function add_entry($arrEntryData){
	array_walk($arrEntryData, 'array_sanitize');
	
	$strComma = "";
	$strSQL = "INSERT INTO tblEntry SET ";
	
	foreach($arrEntryData as $fieldTitle => $fieldData){
		$strSQL .= $strComma . $fieldTitle . " = '" . $fieldData . "' ";
		$strComma = ",";
	}
	
	mysql_query($strSQL);
}

function delete_entry($intEntryID){
	$strSQL = "DELETE FROM tblEntry WHERE intEntryID = '" . $intEntryID . "'";
	mysql_query($strSQL);
}