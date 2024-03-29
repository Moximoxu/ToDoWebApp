<?php

require_once 'init.php';

if(isset($_POST['name'])){
	$name = trim($_POST['name']);
	
	if(!empty($name)){
		$addedQuery = $db->prepare("
			INSERT INTO tasks (name, done, user, created)
			VALUES (:name, 0, :user, NOW())
		");
		
		$addedQuery->execute([
			'name' => $name,
			'user' => $_SESSION['user_id']
		]);
	}
	
	$singletaskQuery = $db->prepare("
		SELECT id, name, done
		FROM tasks
		WHERE created = NOW()
	");
	
	// Execute the statement here
	$singletaskQuery->execute();
	
	// Get data here
	$result = $singletaskQuery->fetch();
	
	echo json_encode ($result);
}

?>