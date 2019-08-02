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
		body{
			background-color:#aeeaae;
		}
	
		.card{
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
			padding:5px 10px;
			width:100%;
			margin-top; 10px;
			box-shadow: 3px 3px 0 #ddd;
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
	<div class="container">
		<div class="card">
			<div class="card-header">
				<h2 class="header">Ikhmal's Tasks</h2>
			</div>
			<div class="card-body" id="tasklist">
				
			</div>
			<form class="form-action">
				<input type="text" id="addtasktxt" name="name" class="form-control" autocomplete="off" placeholder="Please enter your task" required>
				<button type="submit" class="Submit btn btn-info" id="btnAdd">Add</button>
			</form>
		</div>
	</div>

	<div class="modal fade" id="taskModal">
		<div class="modal-dialog">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Edit task</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<input type="text" class="w-100" id="editTasktxt">
				</div>

				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="btnsavechanges">Save</button>
					<button type="button" class="btn btn-danger" id="btndelete" data-dismiss="modal">Delete</button>
				</div>

			</div>
		</div>
	</div>
	
<script>

	$(document).ready(function(){
		
			var displaytasks = $("#tasklist"); 
			
			$.ajax({
				type:"GET",
				url:"fetch.php",
				dataType: "json",
				success: function(result){
					console.log(result);
					var num = 1;
					var output = "<table><thead><tr><th>No.</th><th>Task</th></thead><tbody>";
					for (var i in result) {
						output +=
						"<tr><td>" +
						num +
						"</td><td>" +
						result[i].name +
						"</td></tr>";
						num++;
					}
					output += "</tbody></table>";
				displaytasks.html(output);
				$("table").addClass("table");
				}
			});
		
		$('.listoftask').each(function(){
			$(this).click(function(event){
				var text = $(this).text();
				$('#editTasktxt').val(text);
				console.log(text);
			});
		});
		
		$("#btnsavechanges").click(function(event){
			var change = $("#editTasktxt").val();
			console.log(change);
			
			$.ajax({
				url:"edit.php",
				type:"POST",
				async:false,
				data: {
					"name": change,
				}
			});
		});
		
		$("#btndelete").click(function(event){
			console.log("Deleted task");
			
			$.ajax({
				url:"delete.php",
				type:"POST",
				async:false,
				data: {
					"name": change,
				}
			});
		});
		
		$("#btnAdd").click(function(event){
			var name = $("#addtasktxt").val();
			console.log(name);
			
			$.ajax({
				url:"add.php",
				type:"POST",
				async:false,
				data: {
					"name": name,
				}
			});
		});
		
	});

</script>
	
</body>

</html>