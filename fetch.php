<?php

	require_once 'init.php';
	
	$tasksQuery = $db->prepare("
		SELECT ID, name, done
		FROM tasks
		WHERE user = :user 
		ORDER BY created DESC
	");
	
	// Execute the statement here
	$tasksQuery->execute([
		'user' => $_SESSION['user_id']
	]);
	
	// Get data here
	$result = $tasksQuery->fetchAll();
	
	echo json_encode ($result);
?>