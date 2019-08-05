<?php

require_once 'init.php';
	
if(isset($_POST['id'])){
	$id = $_POST['id'];
	
	if(!empty($id)){
		$deletedQuery = $db->prepare("
			DELETE FROM tasks WHERE id = :id;
		");
		
		$deletedQuery->execute([
			'id' => $id
		]);
	}
}
header('Location: index2.php');