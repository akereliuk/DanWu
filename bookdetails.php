<?php include "header.php";
	$arrEntryDetails = getEntryDetails($_GET['intEntryID']); ?>
	<div class="totalBox">
		<div class="pictureBox">
			picture goes here
		</div>
		<div class="descriptionBox">
				<? if(isset($_POST['strEmailBody'])){
						// $headers = 'From: yougotitchief@gmail.com' . "\r\n" .
													// 'Reply-To: yougotitchief@gmail.com' . "\r\n" .
													// 'X-Mailer: PHP/' . phpversion();
						// $to  = $arrEntryDetails['strEmail'];
						// $subject = "Dan Wu Books - Book Request";
						// $message = $_POST['strEmailBody'];
						// if(mail($to, $subject, $message, $headers)){
							// 
						// }else{
							// 
						// }
						
						 $to  = $arrEntryDetails['strEmail'];
                                                $subject = "Dan Wu Books - Book Request";
                                                $message = $_POST['strEmailBody'];
                                                $headers = 'From: yougotitchief@gmail.com' . "\r\n" .
													'Reply-To: yougotitchief@gmail.com' . "\r\n" .
													'X-Mailer: PHP/' . phpversion();

													mail($to, $subject, $message, $headers);
					}
					else{
				?>
			<form action="" method="post">
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