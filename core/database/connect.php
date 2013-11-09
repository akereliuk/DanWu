<?php
$strConnectionError = 'sorry we are experiencing an unexpected amount of dan wu.';
mysql_connect('localhost','root','') or die($strConnectionError);
mysql_select_db('dbDanWu') or die($strConnectionError);
?>

