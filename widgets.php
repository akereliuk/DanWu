<? if(isset($_GET['logout'])){
			logout();
	} ?>

<? if(logged_in() === false){ ?>

<div class="widgets">
	<form action="login.php" method="post">
	<ul class="loginUL">
		<li>Username:</li>
		<li><input type="text" name="strUsername"></li>
		<li>Password:</li>
		<li><input type="password" name="strPassword"></li>
		<li><input type="submit" value="Login"></li>
	</ul>
	</form>
</div>

<? }
else{ ?>
	
	<div class="widgets">
		Hello, <? print_r(getUsernameFromUserID($_SESSION['intUserID'])); ?>!<br><br>
		<a href="usersettings.php">Settings</a>
		<form action="main.php" method="get">
			<button name="logout" type="submit" value="true">Logout</button>
		</form>
	</div>
<? } ?>

