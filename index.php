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
			<div>
				<input type="text" class="secretclss" id="secretid" style="border:1px white;background-color:#d6f5d6;color:#d6f5d6" disabled>
			</div>
			<form class="form-action">
				<input type="text" id="addtasktxt" name="name" class="form-control" autocomplete="off" placeholder="Please enter your task" required>
				<button type="button" class="Submit btn btn-info" id="btnAdd">Add</button>
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
					<input type="text" class="form-control" id="editTasktxt" placeholder="Please enter a task">
				</div>

				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-primary save" id="btnsavechanges">Save</button>
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
				var output = "<table class='table-striped table-hover'><thead style='text-align:center'><tr><th>No.</th><th>Task</th><th>Actions</th></thead><tbody>";
				for (var i in result) {
					if (result[i].done == 0){output +=
						"<tr class='listoftasks' data-id='" + result[i].id + "'><td>" +
						num +
						"</td><td scope='col' class='task' id='tasktxt" + result[i].id + "'>" +
						result[i].name + "</td><td><button type='submit' class='btn btn-light done' id='btndone'>Done</button>"+
						"<button type='button' class='btn btn-success edit' data-toggle='modal' data-target='#taskModal'>Edit</button>" +
						"<button type='button' class='btn btn-danger delete' id='btndelete'>Delete</button>"+
						"</td></tr>";}
							
					else {output +=
						"<tr class='listoftasks' data-id='" + result[i].id + "'><td>" +
						num +
						"</td><td scope='col' class='task' style='text-decoration:line-through' id='tasktxt" + result[i].id + "'>" +
						result[i].name +
						
					"</td><td><button type='submit' class='btn btn-dark undone' id='btnundone'>Undone</button>" +
					"<button type='button' class='btn btn-success edit' data-toggle='modal' data-target='#taskModal'>Edit</button>" +
					"<button type='button' class='btn btn-danger delete' id='btndelete'>Delete</button>"+
					"</td></tr>";}
					+ num++;
			
				}
				output += "</tbody></table>";
			displaytasks.html(output);
			$("table").addClass("table");
			}
		});
		
		$(document).on("click", "button.done", function(){
			
			$("button").closest("td.task").css({"color": "red", "border": "2px solid red"});
			$(".listoftasks").click(function(){
				var dataId = $(this).data("id");
				console.log(dataId);
				
				$.ajax({
				url:"done.php",
				type:"POST",
				data: {
					"id": dataId,
				}
				});
				alert('Well done for completing the task!');
				window.location.reload();
				console.log("Ajax 'done' successful");
			});
		});
		
		$(document).on("click", "button.undone", function(){
			
			<!--$("button").closest("td").css({"color": "red", "border": "2px solid red"});-->
			$(".listoftasks").click(function(){
				var dataId = $(this).data("id");
				console.log(dataId);
				
				$.ajax({
				url:"undone.php",
				type:"POST",
				data: {
					"id": dataId,
				}
				});
				alert("Task is undoned!");
				window.location.reload();
				console.log("Ajax 'undone' successful");
			});
		});
		
		$(document).on("click", "button.edit", function(){
			
			$(".listoftasks").click(function(){
				var dataId = $(this).data("id");
				console.log(dataId);
				var task = $("#tasktxt" + dataId).text();
				console.log(task);
				$("#editTasktxt").val(task);
				$("#secretid").val(dataId);
				var secretnum = document.getElementById("secretid").value;
				console.log(secretnum);
			});
		});
		
		$(document).on("click", "button.save", function(){
			
			var secretnum = document.getElementById("secretid").value;
			console.log(secretnum);
			var change = $("#editTasktxt").val();
			console.log(change);
				
			$.ajax({
			url:"edit.php",
			type:"POST",
			data: {
				"id" : secretnum,
				"name": change,
			}
			});
			alert("Task edited successfully!");
			window.location.reload();
			console.log("Ajax 'save' successful");
		});
		
		$(document).on("click", "button.delete", function(){
			$(".listoftasks").click(function(){
				var dataId = $(this).data("id");
				console.log(dataId);
			
				var sure = confirm("Are you sure you want to delete this task?");
				if(sure == true){
					$.ajax({
						url:"delete.php",
						type:"POST",
						data: {
							"id" : dataId,
						}
					});
					alert("Task deleted successfully!");
					window.location.reload();
					console.log("Ajax 'delete' successful");
				}
				else{
					alert("You cancelled!");
				}
			});
		});
		
		$("#btnAdd").click(function(event){
			var name = $("#addtasktxt").val();
			console.log(name);
			
			$.ajax({
				url:"add.php",
				type:"POST",
				data: {
					"name": name,
				}
			});
			alert("Successfully added task!");
			window.location.reload();
			console.log("Ajax 'add' successful!");
		});
	});

</script>
	
</body>

</html>