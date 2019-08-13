<?php

require_once 'init.php';

if(isset($_POST['name'])){
	$name = trim($_POST['name']);
	$id = $_POST['id'];
	
	if(!empty($name)){
		$editedQuery = $db->prepare("
			UPDATE tasks
			SET name = :name WHERE id = :id
		");
		
		$editedQuery->execute([
			'name' => $name,
			'id' => $id
		]);
	}
}
?>