<? if(logged_in() === false){ ?>

<div class="widgets">
	<h2>Widgets</h2>
	<form action="login.php" method="post">
	<ul>
		<li>Username:</li>
		<li><input type="text" name="strUsername"></li>
		<li>Password:</li>
		<li><input type="password" name="strPassword"></li>
		<li><input type="submit" value="Login"></li>
	</ul>
	</form>
	<a href="register.php">Register</a>
</div>

<? }
else{ ?>
	
	<div class="widgets">
		<h2>Widgets</h2>
		Hey yo D Ray wuz gud?
		you is logged in as <? print_r(getUsernameFromUserID($_SESSION['intUserID'])); ?> chyeee boiiii
		<form action="main.php?logout" method="post">
		<input type="submit" value="Logout">
		</form>
		<a href="usersettings.php">Settings</a>

<? } ?>

