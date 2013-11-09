<?php
session_start();

require 'database/connect.php';
require 'functions/general.php';
require 'functions/users.php';
require 'functions/books.php';
require 'functions/entry.php';

if (logged_in() === true) {
	$intSessionUserID = $_SESSION['intUserID'];
}	

$arrErrors = array();

?>
