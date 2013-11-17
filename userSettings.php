<?php
include "header.php";
echo toJavaScript();

function toJavaScript(){
	ob_start();
	?>
	<script>
		function deleteUser(intUserID){
			$.ajax({
					url: 'userSettings.php',
					async: true,
					type: 'post',
					contentType: "application/x-www-form-urlencoded;charset=ISO-8859-15",
					data: {
						intUserID: intUserID
					},
					beforeSend: function(){
						$('#userRow' + intUserID).remove();
					},
					success: function(data){
						alert('User deleted');
					},
					error: function(textStatus, errorThrown){
						alert(textStatus);
					}
			});
		}
		
		function editUser(intUserID){
			strUsername = $('#usernameCol' + intUserID).text();
			strEmail = $('#emailCol' + intUserID).text();
			strPassword = $('#passwordCol' + intUserID).text();
			blnAdmin = $('#adminCol' + intUserID).text();
			$('#usernameCol' + intUserID).html("<input id='usernameedit" + intUserID + "' type='text' name='strUsername' value='" + strUsername + "'>");
			$('#emailCol' + intUserID).html("<input id='emailedit" + intUserID + "' type='text' name='strEmail' value='" + strEmail + "'>");
			$('#passwordCol' + intUserID).html("<input id='passwordedit" + intUserID + "' type='text' name='strPassword' value='" + strPassword + "'>");
			$('#adminCol' + intUserID).html("<input id='adminedit" + intUserID + "' type='text' name='blnAdmin' value='" + blnAdmin + "'>");
		}
	</script>
	<?
		$strJS = ob_get_contents();
		ob_end_clean();
		
		return $strJS;
}

if (empty($_POST) === false) {
	if(empty($_POST['strFirstName']) === false){
		$blnFirstname = true;
		
	}
	
	if(empty($_POST['strLastName']) === false){
		$blnLastname = true;
		
	}
	
	
	if(empty($_POST['strEmail'])=== false){	
		if (filter_var($_POST['strEmail'], FILTER_VALIDATE_EMAIL) === false) {
				$arrErrors[] = 'not valid email'; 
				}
		else if(email_exists($_POST['strEmail']) === true){
			$arrErrors[] = 'email already in use';
		}
		$blnEmail = true;
		}
	
	 
	
			
	else if(empty($_POST['strUsername']) === false){
		if (user_exists($_POST['strUsername']) === true) {
			$arrErrors[] = 'sorry username exists';
		}
		$blnUsername = true;
	}
	
		
	  
	if((empty($_POST['strPassword']) || empty($_POST['strRepeatPassword'])) === false){
		if (strlen($_POST['strPassword']) < 6 && strlen($_POST['strPassword'])>1) {
			$arrErrors[] = 'password must be 7';
			}
		
			$blnPassword = true;
		}
		
	if(empty($arrErrors) === true){
	if($blnFirstname = true){
		changeFirstname($_POST['strFirstName']);
		}
	if($blnLastname = true){
		changeLastname($_POST['strLastName']);
		}
	if($blnUsername = true){
		changeUsername($_POST['strUsername']);
		}
	if($blnEmail = true){
		changeEmail($_POST['strEmail']);
		}
	if($blnPassword = true){
		changePassword($_POST['strPassword']);
		}
	
		echo "<h3>Changes saved</h3><br>";
		
		
	}
	
	
	else {
	echo output_errors($arrErrors);
	}
		
		
}
else {
		if (is_admin() === true){
				$result = mysql_query("SELECT intUserID, strUsername, strEmail, strPassword, blnAdmin FROM tblUser");
				if (!$result) {
					$arrErrors[] = 'invalid query';
					}
					
				echo "<table border='1'>
			<tr>
			<th>UserID</th>
			<th>UserName</th>
			<th>Email</th>
			<th>Password</th>
			<th>Admin</th>
			</tr>";

		while($row = mysql_fetch_array($result))
		{
		  echo "<tr id='userRow" . $row['intUserID'] . "'>";
		  echo "<td id='userIDCol" . $row['intUserID'] . "'>" . $row['intUserID'] . "</td>";
		  echo "<td id='usernameCol" . $row['intUserID'] . "'>" . $row['strUsername'] . "</td>";
		  echo "<td id='emailCol" . $row['intUserID'] . "'>" . $row['strEmail'] . "</td>";
		  echo "<td id='passwordCol" . $row['intUserID'] . "'>" . $row['strPassword'] . "</td>";
		  echo "<td id='adminCol" . $row['intUserID'] . "'>" . $row['blnAdmin'] . "</td>";
		 
		  echo "<td><input type='button' id='deleteButton" . $row['intUserID'] . "' value='delete' onclick='deleteUser(" . $row['intUserID'] . ")'></td>";
		  echo "<td><input type='button' id='editButton" . $row['intUserID'] . "' value='edit' onclick='editUser(" . $row['intUserID'] . ")'></td>";
			
			echo "</tr>";
		  }
		echo "</table>";
		}
		else{
 
?>
<form action="" method="post">
<ul>
	<h2>User Settings</h2>
	<li>Change First Name:</li>
	<li><input type="text" id="firstnameTextField" name="strFirstName" value="<?=getFirstnameFromUserID($_SESSION['intUserID']) ?>"></li>
	<li>Change Last Name:</li>
	<li><input type="text" id="lastnameTextField" name="strLastName" value="<?=getLastnameFromUserID($_SESSION['intUserID']) ?>"></li>
	<li>Change Email:</li>
	<li><input type="text" id="emailTextField" name="strEmail" value="<?=getEmailFromUserID($_SESSION['intUserID']) ?>"></li>
	<li>Change Username:</li>
	<li><input type="text" id="usernameTextField" name="strUsername" value="<?=getUsernameFromUserID($_SESSION['intUserID']) ?>"></li>
	<li>Change Password:</li>
	<li><input type="password" name="strPassword"></li>
	<li>Confirm New Password:</li>
	<li><input type="password" name="strRepeatPassword"></li>
	<li></li>
	<input type="hidden" name="set" value="set">
	<li><input type="submit" value="Save"></li>
</ul>
</form>
<?
}
}
if(isset($_POST['intUserID']) && !empty($_POST['intUserID'])){
	$intUserID = $_POST['intUserID'];
	deleteUser($intUserID);
}

if(isset($_POST['strNewUsername']) && !empty($_POST['strNewUsername'])){
	print_r($_POST['strNewUsername']);
}

include "footer.php";

	
?>