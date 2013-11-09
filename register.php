<?php
include "header.php";

$set = null;
if(isset($_POST['set'])){
	$set = $_POST['set'];
}
if ($set == 'set'){
	if (empty($_POST) === false) {
	
		$arrUserFields = array('strUsername','strPassword','strRepeatPassword','strFirstName','strLastName','strEmail');
		foreach($_POST as $key=>$value) {
			if (empty($value) && in_array($key, $arrUserFields) === true) {
				$arrErrors[] = 'fields not filled out properly';
				break 1;
			}
		}
		
		if (empty($arrErrors) === true) {
			if (user_exists($_POST['strUsername']) === true) {
				$arrErrors[] = 'sorry username exists';
			}
			
			if (strlen($_POST['strPassword']) < 6) {
				$arrErrors[] = 'password must be 7';
			}
			
			if ($_POST['strPassword'] !== $_POST['strRepeatPassword']) {
				$arrErrors[] = 'passwords dont match';
			}
			
			if (filter_var($_POST['strEmail'], FILTER_VALIDATE_EMAIL) === false) {
				$arrErrors[] = 'need valid email';
			}
			
			if (email_exists($_POST['strEmail']) === true) {
				$arrErrors[] = 'email already in use';
			}
		}
	}

	if (empty($arrErrors) === true) {
		$arrRegisterData = array(
			'strUsername' => $_POST['strUsername'],
			'strPassword' => $_POST['strPassword'],
			'strFirstName' => $_POST['strFirstName'],
			'strLastName' => $_POST['strLastName'],
			'strEmail' => $_POST['strEmail']
		);
		register_user($arrRegisterData);
		header('Location: register.php?success=true');
		exit();
	} else if (empty($arrErrors) === false) {
		echo output_errors($arrErrors);
	}
	
}else{
	if (isset($_GET['success'])) {
		echo 'registered successfully';
	}
	else{
?>

<div class="content">
	<form action="" method="post">
	<ul>
		<li>First Name:</li>
		<li><input type="text" id="firstnameTextField" name="strFirstName"></li>
		<li>Last Name:</li>
		<li><input type="text" id="lastnameTextField" name="strLastName"></li>
		<li>Email:</li>
		<li><input type="text" id="emailTextField" name="strEmail"></li>
		<li>Username:</li>
		<li><input type="text" id="usernameTextField" name="strUsername"></li>
		<li>Password:</li>
		<li><input type="password" name="strPassword"></li>
		<li>Confirm Password:</li>
		<li><input type="password" name="strRepeatPassword"></li>
		<li></li>
		<input type="hidden" name="set" value="set">
		<li><input type="submit" value="Submit"></li>
	</ul>
	</form>
</div>
<?
	}
}

	
include "footer.php";
?>