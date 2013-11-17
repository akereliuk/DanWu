<?php include "header.php";

echo toJavaScript();

function toJavaScript(){
	ob_start();
	?>
	<script>
		$(document).ready(function(){
			$("#entryTable").tablesorter();
		});
	</script>
	<?
		$strJS = ob_get_contents();
		ob_end_clean();
		
		return $strJS;
}

$arrSearchData = searchEntries($_POST['strSearchField'], $_POST['strSearchHeader']);

?>

<?=count($arrSearchData) ?> search results returned for "<?=$_POST['strSearchField'] ?>" over header "<?=$_POST['strSearchHeader'] ?>"

<form method='post' action='searchentries.php'>
<input type='text' name='strSearchField' id='searchField'></input>
<select name='strSearchHeader' id='searchDropDown'>
	<option>Book Name</option>
	<option>Author Name</option>
	<option>Publisher</option>
	<option>Username</option>
</select>
<input type='submit' id='searchButton' value='Search Entries'></input>
</form>

<?

echo "<table id='entryTable' border='1'>
<thead>
<tr id='headingRow'>
<th id='userCol'>User</th>
<th id='bookCol'>Book</th>
<th id='priceCol'>Price</th>
<th id='emailCol'>Email</th>
<th id='dateCol'>Date</th>
</tr>
</thead>";

echo "<tbody>";
	foreach($arrSearchData as $intEntryID => $arrValues){
		echo "<tr>";
		foreach($arrValues as $key => $value){
			echo "<td>" . $value . "</td>";
		}
		echo "<td><a href='bookdetails.php?intEntryID=" . $intEntryID . "'>Details</a></td>";
		if(logged_in() && is_admin()){
			echo "<td><input type='button' id='deleteButton" . $row['intEntryID'] . "' value='delete' onclick='deleteEntry(" . $row['intEntryID'] . ")'></td>";
		}
		echo "</tr>";
	}
echo "</tbody>";
echo "</table>";
	
 include "footer.php"; ?>
