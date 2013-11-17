<?php include "header.php" ?>
	<? $arrEntryDetails = getEntryDetails($_GET['intEntryID']); ?>
	<div class="totalBox">
		<div class="pictureBox">
			picture goes here
		</div>
		<div class="descriptionBox">
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