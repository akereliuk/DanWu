
<?php
include "header.php";

$set = null;
if(isset($_POST['set'])){
	$set = $_POST['set'];
}
if ($set == 'set'){
		$arrEntryData = array(
			'strBookName' => $_POST['strBookName'],
			'strAuthor' => $_POST['strAuthor'],
			'strPublisher' => $_POST['strPublisher'],
			'intUserID' => $intSessionUserID,
			'dblPrice'  => $_POST['dblPrice'],
			'dtmDate' => date("Y-m-d H:i:s")
		);
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $arrEntryData) === true) {
			$arrErrors[] = 'fields not filled out properly';
			break 1;
		}
	}
	if (empty($arrErrors) === true) {	
		if(is_float(floatval($_POST['dblPrice'])) === false){
			$arrErrors[] = 'price must be a number';
		}
	}
		if (empty($arrErrors) === true) {
			add_entry($arrEntryData);
			header('Location: sellbooks.php?success=true');
			exit();
		} else if (empty($arrErrors) === false) {
			echo output_errors($arrErrors);
	}
	}else{
	if (isset($_GET['success'])) {
		echo 'entry successful';
	}
	else{
	
			
		

?>





<? if(logged_in() === true){ ?>
<div class="content">
	<form action="" method="post">
	<ul>
	<li>Book Name:</li>
		<li><input type="text" id="booknameTextField" name="strBookName"></li>
		<li>Author Name:</li>
		<li><input type="text" id="authorTextField" name="strAuthor"></li>
		<li>Publisher</li>
		<li><input type="text" id="publisherTextField" name="strPublisher"></li>
		<li>Price</li>
		<li><input type="text" id="priceTextField" name="dblPrice"></li>
		<input type="hidden" name="set" value="set">
		<li><input type="submit" value="Submit"></li>
	</ul>
	</form>
</div>
<? }
else{ ?>
<div class="content">
	you need to be logged in to use this feature
</div>
<? 
}
}
}
include "footer.php";
?>