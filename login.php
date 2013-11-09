<?php
include 'header.php';

if (empty($_POST) === false){
	$strUsername = $_POST['strUsername'];
	$strPassword = $_POST['strPassword'];
	if (empty($strUsername) === true || empty($strPassword) === true) {
		 $arrErrors[] = "You need to enter a username and password";
	 } else if (user_exists($strUsername) === false) {
		 $arrErrors[] = "that username doesn't exist";
	}
	// } else if (user_active($strUsername) === false) {
		// $arrErrors[] = 'havent activated';
	// } else {		

	$blnLogin = login($strUsername, $strPassword);
	
	if($blnLogin === false) {
		$arrErrors[] = 'incorrect login';
	} else {
		$_SESSION['intUserID'] = get_user_id($strUsername);
		$_SESSION['blnAdmin'] = get_blnAdmin($_SESSION['intUserID']);
		header('Location: main.php');
		exit();
	}
	if(empty($arrErrors) === false){
		output_errors($arrErrors);
	}
}


include 'footer.php';
?>

