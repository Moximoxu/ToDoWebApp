<!DOCTYPE html>
<html lang="en"
<head>
	<title>WhatToDo To-Do List Web App</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, intial-scale=1">
	
	<!--Icon-->
	<link rel="icon" href="Resources/Sakamoto.jpg" type="image/png">

	<!--Link-->
	<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
	<link rel="stylesheet" 
		href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel='stylesheet' 
		href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<!--Script sources-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://jqueryvalidation.org/files/lib/jquery.js"></script>
	<script src="https://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"</script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui-js"></script>

	<!--Stylesheet-->
	<style>
		#navLogo {
			font-family:Georgia;
			font-size:40px;
		}
	</style>
	
	<nav class="navbar navbar-expand-sm navbar-dark" style="background-color:#33cc33">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link text-white" id="navLogo" href="#"><b>WhatToDo</b></a>
			</li>
		</ul>
	</nav>
	
</head>

<body>
	<div class="list">
		<h2 class="header">Ikhmal's Tasks</h1>
		
		<ol class="tasks">
			<li>
				<span class="task">Get a cat</span>
				<a href="#" class="done_bttn">Mark as done</a>
			</li>
			<li>
				<span class="task done">Look for a munchkin.</span>
			</li>
		</ol>
		
		<form class="task-add" method="post">
			<input type="text" name="title" class="input" autocomplete="off" placeholder="Please enter your task" required>
			<input type="submit" value="Add" class="Submit">
		</form>
	</div>
<!--
	<div class="container">
		<form method="post" id="task_form">
		<div class="table-responsive">
			<table id="task_data">
				<tr>
					<td><input type="checkbox">Find a cat</input></td>
				</tr>
			
				<tr>
					<td><input type="checkbox">Feed a cat</input></td>
				</tr>
			</table>
		</div>
		</form>
		<div align="right">
			<button type="button" name="addTask" id="addTask" class="btn btn-success">Add Task</button>
		</div>
		
		<div id="user_dialog" title="Add Task">
			<div class="form-group">
				<label>What do you want to do?</label>
				<input type="text" name="task" id="task" class="form-control"/>
				<span id="errtask" class="text-danger"></span>
			</div>
			<div class="form-group" align="center">
				<input type="hidden" name="row_id" value="hidden_row_id"/>
				<button type="button" name="save" id="save" class="btn btn-info">Save</button>
			</div>
		</div>
		<div id="action_alert" title="Action">
			
		</div>
	</div>
	<script>
	$(document).ready(function(){
		var count= 0;
		$('#user_dialog').dialog({
			autoOpen:false,
			width:400
		});
		
		$('#addTask').click(function(){
			$('#user_dialog').dialog('option', 'title', 'Add Task');
			$('#task').val('');
			$('#errrask').text('');
			$('#save').text('Save');
			$('#user_dialog').dialog('open');
		});
	});
	</script>
	-->
	
	<style>
		body{
			background-color:#aeeaae;
		}
	
		.list{
			background-color:#d6f5d6;
			margin:20px auto;
			width:100%;
			max-width:500px;
			padding:20px;
			border-radius:5px;
			box-shadow:3px 3px 0 rgba(0, 0, 0, .1);
			box-sizing:border-box;
		}
		
		
		.tasks{
			margin:0;
			padding:0;
		}
		
		.tasks li:hover .done_bttn{
			opacity:1;
		}
		
		.tasks .task.done{
			text-decoration:line-through;
		}
		
		.tasks li, task-add input{
			border:0;
			border-bottom:1px dashed #ccc;
			padding:15px 0;
		}
		
		.input{
			width:100%;
		}
		
		.done_bttn{
			display:inline-block;
			background-color:#85e085;
			color:#e67300;
			padding:3px 6px;
			border:0;
			opacity:0.5;
		}
		
		.Submit{
			background-color:#fff;
			padding:5px 10px;
			width:100%;
			margin-top; 10px;
			box-shadow: 3px 3px 0 #ddd;
		}
	</style>
	
	<?php
		session_start();
		
		$_SESSION['user_id'] = 1;
		
		$db = new PDO('mysql:dbname=)
	?>
</body>

</html>