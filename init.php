<?php
	session_start();
	
	$db = new PDO('mysql:dbname=homestead;host=localhost', 'homestead', 'secret');

	if(!isset($_SESSION['user_id'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$userquery = $db->prepare("
			SELECT * FROM users
			WHERE username = :username AND password = :password;
		");
	
		$userquery->execute([
			'username' => $username,
			'password' => $password,
		]);
		
		$result = $userquery->fetch();
		
		$_SESSION['user_id'] = $result["userid"];
		
		echo json_encode($result);
	}

//Must be able to detect changes in the user id that is injected and deny any attempt for access.
?>