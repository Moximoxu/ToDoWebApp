<?php

require_once 'init.php';

if(isset($_POST['name']) && isset($_POST['id'])){
	$name = trim($_POST['name']);
	$id = $_POST['id'];
	
	if(!empty($name)){
		$editedQuery = $db->prepare("
			UPDATE tasks (name)
			VALUES (:name) WHERE id = :id
		");
		
		$editedQuery->execute([
			'name' => $name,
			'id' => $id
		]);
	}
}
header('Location: index2.php');