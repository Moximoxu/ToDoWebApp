<?php
	session_start();
	
	$_SESSION['user_id'] = 1;
	
	$db = new PDO('mysql:dbname=homestead;host=localhost', 'homestead', 'secret');

	if(!isset($_SESSION['user_id'])){
		die('You are not signed in.');
	}

?>