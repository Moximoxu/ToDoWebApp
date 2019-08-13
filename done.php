<?php

require_once 'init.php';

if(isset($_POST['id'])){
	$id = $_POST['id'];

	if(!empty($id)){
		$doneQuery = $db->prepare("
		UPDATE tasks SET done = 1 WHERE id = :id;
		");
			
		$doneQuery->execute([
			'id' => $id
		]);
	}
}
?>