<?php
include "header.php";

echo toJavaScript();

function toJavaScript(){
	ob_start();
	?>
	<script>
		$(document).ready(function(){
			$("#entryTable").tablesorter();
		});
		
		function deleteEntry(intEntryID){
			$.ajax({
					url: 'viewbooks.php',
					async: true,
					type: 'post',
					contentType: "application/x-www-form-urlencoded;charset=ISO-8859-15",
					data: {
						intEntryID: intEntryID
					},
					beforeSend: function(){
						$('#entryRow' + intEntryID).remove();
					},
					success: function(data){
						alert('Entry deleted');
					},
					error: function(textStatus, errorThrown){
						alert(textStatus);
					}
			});
		}
	</script>
	<?
		$strJS = ob_get_contents();
		ob_end_clean();
		
		return $strJS;
}

$result = mysql_query("SELECT intEntryID, intUserID, strBookName, strAuthor, dblPrice, dtmDate FROM tblEntry");

?>
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

$strMkTable = "<table id='entryTable' border='1'>
<thead>
<tr id='headingRow'>
<th id='userCol'>User</th>
<th id='bookCol'>Book</th>
<th id='authorCol'>Author</th>
<th id='priceCol'>Price</th>
<th id='dateCol'>Date</th>
<th>Info</th>
 <th>Options</th> 
</tr>
</thead>";
echo $strMkTable;

echo "<tbody>";
while($row = mysql_fetch_array($result))
{
  echo "<tr id='entryRow" . $row['intEntryID'] . "'>";
  echo "<td>" . getUsernameFromUserID($row['intUserID']) . "</td>";
  echo "<td>" . $row['strBookName'] . "</td>";
  echo "<td>" . $row['strAuthor'] . "</td>";
  echo "<td>" . $row['dblPrice'] . "</td>";
  echo "<td>" . $row['dtmDate'] . "</td>";
  echo "<td><a href='bookdetails.php?intEntryID=" . $row['intEntryID'] . "'>Details</a></td>";
  if(logged_in() && (is_admin() || $row['intUserID'] == $intSessionUserID)){
	  echo "<td><input type='button' id='deleteButton" . $row['intEntryID'] . "' value='delete' onclick='deleteEntry(" . $row['intEntryID'] . ")'></td>";
  }
  else{
	echo "<td>&nbsp;</td>";
  }
  echo "</tr>";
}
echo "</tbody>";
echo "</table>";


if(isset($_POST['intEntryID']) && !empty($_POST['intEntryID'])){
	$intEntryID = $_POST['intEntryID'];
	delete_entry($intEntryID);
}

include "footer.php";
?>


