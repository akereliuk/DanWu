<?php
function user_exists($strUsername) {
	$strUsername = sanitize($strUsername);
	$strSQL = mysql_query("SELECT COUNT(intUserID) FROM tblUser WHERE strUsername = '" . $strUsername . "'");
	return (mysql_result($strSQL, 0) == 1) ? true : false;
}

function email_exists($strEmail) {
	$strEmail = sanitize($strEmail);
	$strSQL = mysql_query("SELECT COUNT(intUserID) FROM tblUser WHERE strEmail = '" . $strEmail . "'");
	return (mysql_result($strSQL, 0) == 1) ? true : false;
}

function active($strUsername) {
	$strUsername = sanitize($strUsername);
	$strSQL = mysql_query("SELECT COUNT(intUserID) FROM tblUser WHERE strUsername = '" . $strUsername . "' AND blnActive = true");
	return (mysql_result($strSQL, 0) == 1) ? true : false;
}

function logged_in() {
	return (isset($_SESSION['intUserID'])) ? true : false;
}

function get_user_id($strUsername) {
	$strUsername = sanitize($strUsername);
	return mysql_result(mysql_query("SELECT intUserID FROM tblUser WHERE strUsername = '" . $strUsername . "'"), 0, 'intUserID');
}

function login($strUsername, $strPassword) {
	$strPassword = md5($strPassword);
	$strSQL = "SELECT intUserID FROM tblUser WHERE strUsername = '" . $strUsername . "' AND strPassword = '" . $strPassword . "'";
	$rsResult = mysql_query($strSQL);
	$arrRow = mysql_fetch_row($rsResult);
	return isset($arrRow[0]) ? true : false;
}

function user_data($intUserID) {
	$arrUserData = array();
	$intUserID = (int)$intUserID;

	$func_num_args = func_num_args();
	$func_get_args = func_get_args();

	if ($func_num_args > 1) {
		unset($func_get_args[0]);

		$arrUserFields = '`' . implode('`,`', $func_get_args) . '`';
		$arrUserData = mysql_fetch_assoc(mysql_query("SELECT '" . $arrUserFields . "' FROM tblusers WHERE intUserID = '" . $intUserID . "'"));
		return $arrUserData;
	}
}

function getUsernameFromUserID($intUserID){
	$strSQL = "SELECT strUsername FROM tblUser WHERE intUserID = '" . $intUserID . "'";
	$rsResult = mysql_query($strSQL);
	$arrRow = mysql_fetch_row($rsResult);
	return $arrRow[0];
}

function getEmailFromUserID($intUserID){
	$strSQL = "SELECT strEmail FROM tblUser WHERE intUserID = '" . $intUserID . "'";
	$rsResult = mysql_query($strSQL);
	$arrRow = mysql_fetch_row($rsResult);
	return $arrRow[0];
}

function logout() {
	unset($_SESSION['intUserID']);
}

function register_user($arrRegisterData) {
	array_walk($arrRegisterData, 'array_sanitize');
	$arrRegisterData['strPassword'] = md5($arrRegisterData['strPassword']);
	
	$strComma = "";
	$strSQL = "INSERT INTO tblUser SET ";
	
	foreach($arrRegisterData as $strFieldTitle => $strFieldData){
		$strSQL .= $strComma . $strFieldTitle . " = '" . $strFieldData . "' ";
		$strComma = ",";
	}
	
	mysql_query($strSQL);
}
function getFirstnameFromUserID($intUserID){
	$strSQL = "SELECT strFirstName FROM tblUser WHERE intUserID = '" . $intUserID . "'";
	$rsResult = mysql_query($strSQL);
	$arrRow = mysql_fetch_row($rsResult);
	return $arrRow[0];
}

function getLastnameFromUserID($intUserID){
	$strSQL = "SELECT strLastName FROM tblUser WHERE intUserID = '" . $intUserID . "'";
	$rsResult = mysql_query($strSQL);
	$arrRow = mysql_fetch_row($rsResult);
	return $arrRow[0];
}

function changePassword($strNewPassword){
	$strNewPassword = md5($strNewPassword);
	mysql_query("UPDATE tblUser SET strPassword = '" . $strNewPassword . "' WHERE intUserID = '" . $_SESSION['intUserID'] . "'");
}

function changeFirstname($strFirstname){

	mysql_query("UPDATE tblUser SET strFirstName = '" . $strFirstname . "' WHERE intUserID = '" . $_SESSION['intUserID'] . "'");
}

function changeLastname($strNewLast){
	mysql_query("UPDATE tblUser SET strLastName = '" . $strNewLast . "' WHERE intUserID = '" . $_SESSION['intUserID'] . "'");
}
 
function changeEmail($strNewEmail){
	mysql_query("UPDATE tblUser SET strEmail = '" . $strNewEmail . "' WHERE intUserID = '" . $_SESSION['intUserID'] . "'");
}

function changeUsername($strNewUsername){
	mysql_query("UPDATE tblUser SET strUsername = '" . $strNewUsername . "' WHERE intUderID = '" . $_SESSION['intUserID'] . "'");
}

function get_blnAdmin($intUserID){
	$strSQL = "SELECT blnAdmin FROM tblUser WHERE intUserID = '" . $intUserID . "'";
	$rsResult = mysql_query($strSQL);
	$arrRow = mysql_fetch_row($rsResult);
	return $arrRow[0];
	}
	
function is_admin(){
return (($_SESSION['blnAdmin']) == 1) ? true : false;
}

function deleteUser($intUserID){
	$strSQL = "DELETE FROM tblUser WHERE intUserID = '" . $intUserID . "'";
	mysql_query($strSQL);
}
?>