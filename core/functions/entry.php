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

function getEntryDetails($intEntryID){
	$arrReturn = array();
	$strSQL = "SELECT strFirstName, strLastName, strEmail, strBookName, strAuthor, strPublisher, dtmDate, dblPrice
						FROM tblEntry
							INNER JOIN tblUser ON tblEntry.intUserID = tblUser.intUserID
								WHERE intEntryID = '" . $intEntryID . "'";
	$rsResult = mysql_query($strSQL);
	while($row = mysql_fetch_array($rsResult)){
		$arrReturn['strBookName'] = $row['strBookName'];
		$arrReturn['strAuthor'] = $row['strAuthor'];
		$arrReturn['strPublisher'] = $row['strPublisher'];
		$arrReturn['dblPrice'] = $row['dblPrice'];
		$arrReturn['strFirstName'] = $row['strFirstName'];
		$arrReturn['strLastName'] = $row['strLastName'];
		$arrReturn['strEmail'] = $row['strEmail'];
	}
	return $arrReturn;
}

function searchEntries($strSearchField, $strSearchHeader){
	 $arrReturn = array();
	 $strSQL = "SELECT intEntryID
							FROM tblEntry
								WHERE 1";
	
}