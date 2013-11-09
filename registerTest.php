<?
	include "User.class";
	
	function createUser($strUserName, $strPassword){
		$objUser = new User($strUserName);
		if (!$objUser->exists()){
			$objUser->setPassword($strPassword);
			$objUser->setDateCreated(now());
			if ($objUser->load()){
				return "User registed.";
			}
			else{
				return "Error registering user.";
			}
		}
		else{
			return "The user " . $strUserName . " already exists.";
		}
	}
?>