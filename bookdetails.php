<?php include "header.php";
	$arrEntryDetails = getEntryDetails($_GET['intEntryID']); ?>
	<div class="totalBox">
		<div class="pictureBox">
			picture goes here
		</div>
		<div class="descriptionBox">
			<form action="" method="post">
				<? if(isset($_POST['strEmailBody'])){
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$to  = $arrEntryDetails['strEmail'];
						$subject = "Dan Wu Books - Book Request";
						$message = $_POST['strEmailBody'];
						if(mail($to, $subject, $message, $headers)){
							?> Successfully sent your email! <?
						}else{
							?> Error: mail could not be sent. <?
						}
					}
					else{
				?>
				<textarea rows="21" cols="51" name="strEmailBody">Hi, <?=$arrEntryDetails['strFirstName']?>. I would like to purchase your book, <?=$arrEntryDetails['strBookName']?>. Please reply back.<?if(logged_in()){ print_r(' - ' . getFirstNameFromUserID($intSessionUserID)) ;}?></textarea>
				<center><input type='submit' value='Send Email'></input></center>
				<? } ?>
			</form>
		</div>
		<div class="infoBox">
			<ul class="infoUL">
				<li>Book Name: <?=$arrEntryDetails['strBookName']?></li>
				<li>Author: <?=$arrEntryDetails['strAuthor']?></li>
				<li>Publisher: <?=$arrEntryDetails['strPublisher']?></li>
				<li>Price: $<?=$arrEntryDetails['dblPrice']?></li>
				<li>First Name: <?=$arrEntryDetails['strFirstName']?></li>
				<li>Last Name: <?=$arrEntryDetails['strLastName']?></li>
				<li>Email: <?=$arrEntryDetails['strEmail']?></li>
			</ul>
		</div>
	</div>
<?php include "footer.php"; ?>