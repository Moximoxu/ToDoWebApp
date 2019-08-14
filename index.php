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
		.tdone{
			text-decoration:line-through;
		}
		.tundone{
			text-decoration:none;
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
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h2 class="header">Ikhmal's Tasks</h2>
				</div>
				<div class="card-body" id="tasklist">
					<table class='table-striped table-hover' id='tasktable'>
						<thead style='text-align:center'>
							<tr><th>No.</th><th>Task</th><th>Actions</th>
						</thead>
						<tbody id='tasks_name'>
							
						</tbody>
					</table>
				</div>
				<form class="form-action" method="post" id="add_task">
					<input type="text" id="addtasktxt" name="name" class="form-control" autocomplete="off" placeholder="Please enter your task" required>
					<button type="submit" class="Submit btn btn-info" id="btnAdd">Add</button>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="taskModal">
		<div class="modal-dialog">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title" id="modaltitle">Edit task</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<input type="text" class="form-control" id="editTasktxt" placeholder="Please enter a task">
					<p id="modalmessage" style="display:none"></p>
				</div>

				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-info" id="btnok" style="display:none" data-dismiss="modal">Okay</button>
					<button type="button" class="btn btn-primary save" id="btnsavechanges">Save</button>
					<button type="button" class="btn btn-danger confirm" id="btnconfirm" style="display:none">Yes</button>
					<button type="button" class="btn btn-info" id="btncancel" style="display:none" data-dismiss="modal">Cancel</button>
				</div>

			</div>
		</div>
	</div>
	
<script>

	$(document).ready(function(){
		
		fetch();
		
		function fetch(){
			var displaytasks = $("#tasks_name"); 
			
			$.ajax({
				type:"GET",
				url:"fetch.php",
				dataType: "json",
				success: function(result){
					var output, count = 1;
					for (var i in result) {
						if (result[i].done == 0){output +=
							"<tr class='listoftasks' data-id='" + result[i].id + "' id='tasktr" + result[i].id + "'><td class='number' id='number'><span class='"+count+"'></span>"+
							"</td><td class='task tundone' id='tasktxt" + result[i].id + "'>" +
							result[i].name + 
							"</td><td><button type='submit' class='btn btn-light done' id='btndone" + result[i].id + "' data-id='" + result[i].id + "'>Done</button>"+
							"<button type='submit' class='btn btn-dark undone' id='btnundone" + result[i].id + "' data-id='" + result[i].id + "' style='display:none'>Undone</button>" +
							"<button type='button' class='btn btn-success edit' data-toggle='modal' data-target='#taskModal' data-id='" + result[i].id + "'>Edit</button>" +
							"<button type='button' class='btn btn-danger delete' id='btndelete' data-id='" + result[i].id + "' data-toggle='modal' data-target='#taskModal' >Delete</button>"+
							"</td></tr>";
						}	
						else {output +=
							"<tr class='listoftasks' data-id='" + result[i].id + "' id='tasktr" + result[i].id + "'><td class='number' id='number'><span class='"+count+"'></span>" +
							"</td><td class='task tdone' id='tasktxt" + result[i].id + "'>" +
							result[i].name +
							"</td><td><button type='submit' class='btn btn-dark undone' id='btnundone" + result[i].id + "' data-id='" + result[i].id + "'>Undone</button>" +
							"<button type='submit' class='btn btn-light done' id='btndone" + result[i].id + "' data-id='" + result[i].id + "' style='display:none'>Done</button>" +
							"<button type='button' class='btn btn-success edit' data-toggle='modal' data-target='#taskModal' data-id='" + result[i].id + "'>Edit</button>" +
							"<button type='button' class='btn btn-danger delete' id='btndelete' data-id='" + result[i].id + "' data-toggle='modal' data-target='#taskModal' >Delete</button>"+
							"</td></tr>";
						}
						count++;
					}
					displaytasks.html(output);
					numarrange(0);
					$("table").addClass("table");
					console.log("Tasks fetched");
				}
			});
		};
		
		var click = 0;
		$(document).on("keypress", "input", function(enter){
			var check = false;
			var code = (enter.keyCode ? enter.keyCode : enter.which);
			if(code == 13 &! check){
				click++;
				var subtract = 1;
				var num = $("#tasks_name tr").length;
				enter.preventDefault();
				var name = $("#addtasktxt").val();
				console.log(name);
				check = true;
				
				$.ajax({
					url:"add.php",
					type:"POST",
					dataType:"json",
					data: {
						"name" : name,
					},
					success:function(result){
						var id = result.id;
						var html = '<tr class="listoftasks" data-id="' + id + '" id="tasktr' + id + '">';
						html += '<td class="newnumber" id="newnumber"><span class="newnumber'+click+'"><p id="num1">1</p></span></td>';
						html += '<td class="task tundone" id="tasktxt' + id + '">' + name;
						html += '<td><button type="submit" class="btn btn-light done" id="btndone'+id+'" data-id="'+id+'">Done</button>';
						html += '<button type="submit" class="btn btn-dark undone" id="btnundone' + id + '" data-id="' + id + '" style="display:none">Undone</button>';
						html += '<button type="button" class="btn btn-success edit" data-toggle="modal" data-target="#taskModal" data-id="' + id + '">Edit</button>';
						html += '<button type="button" class="btn btn-danger delete" id="btndelete" data-id="' + id + '" data-toggle="modal" data-target="#taskModal">Delete</button>';
						html += '</td></tr>';
						console.log(id);
						$('#tasks_name').prepend(html);
						$('#add_task')[0].reset();
					}
				});
				getalertmodal("Task added", "Successfully added task");
				subtract += 2;
				newnumarr(click);
				numarrange(click);
				console.log("Current number of click= "+click);
				console.log("Current length of tasks name is= "+num);
				console.log("Ajax 'add' successful!");
			}
			
		});
		
		$(document).on("click", "button.done", function(){
			
			var dataId = $(this).data("id");
			console.log(dataId);
			var taskname = $("#tasktr" +dataId);
			console.log(taskname);
			var bttnundone = $("#btnundone" + dataId);
			var bttndone = $("#btndone" + dataId);
			
			$.ajax({
				url:"done.php",
				type:"POST",
				data: {
					"id": dataId,
				},
				success:function(){
					$(taskname).toggleClass( "tdone" );
					$(bttnundone).show("400");
					$(bttndone).hide("400");
				}
				});
				console.log("Ajax 'done' successful");
		});
		
		$(document).on("click", "button.undone", function(){
			
			var dataId = $(this).data("id");
			var taskname = $("#tasktr" +dataId);
			console.log(taskname);
			console.log(dataId);
			var bttnundone = $("#btnundone" + dataId);
			var bttndone = $("#btndone" + dataId);
			
			$.ajax({
			url:"undone.php",
			type:"POST",
			data: {
				"id": dataId,
			},
			success:function(){
				$(taskname).toggleClass( "tdone" );
				$(bttndone).show("400");
				$(bttnundone).hide("400");
			}
			});
			console.log("Ajax 'undone' successful");
		});
		
		$(document).on("click", "button.edit", function(){
			
			var dataId = $(this).data("id");
			console.log(dataId);
			var task = $("#tasktxt" + dataId).text();
			console.log(task);
			$("#editTasktxt").val(task);
			console.log(dataId);
			
			$(document).on("click", "button.save", function(){
			
				console.log(dataId);
				var change = $("#editTasktxt").val();
				console.log(change);
					
				$.ajax({
				url:"edit.php",
				type:"POST",
				data: {
					"id" : dataId,
					"name": change,
				},
				success:function(){
				fetch();
				}
				});
				getalertmodal("Task edited", "Task successfully edited");
				console.log("Ajax 'save' successful");
			});
		});
		
		$(document).on("click", "button.delete", function(){
			var dataId = $(this).data("id");
			console.log("Current data-id is "+dataId);
			$("#modaltitle").text("Deleting task");
			$("#modalmessage").show("400");
			$("#modalmessage").text("Are you sure you want to delete this task?");
			$("#editTasktxt").hide("400");
			$("#btnok").hide("400");
			$("#btnconfirm").show("400");
			$("#btncancel").show("400");
			$("#btnsavechanges").hide("400");
			
			$(document).on("click", "button.confirm", function(){
			
				console.log(dataId);
				$.ajax({
				url:"delete.php",
				type:"POST",
				data: {
					"id" : dataId,
				},
				success:function(){
				fetch();
				}
				});
				$("#btnconfirm").hide("400");
				$("#btncancel").hide("400");
				getalertmodal("Task deleted", "Task successfully deleted");
				console.log("Ajax 'save' successful");
			});
			
		});
		
		$("#add_task").on("submit", function(event){
			var name = $("#addtasktxt").val();
			console.log(name);
			event.preventDefault();
			var num = $('#tasks_name tr').length;
			console.log(num);
			$.ajax({
				url:"add.php",
				type:"POST",
				data: {
					"name" : name,
				},
				success:function(data){
					var html = '<tr>';
					html += '<td>1</td>'+
					'<td class="task tundone" id="tasktxt"' + result[i].id + '">' + name +
					'<td><button type="submit" class="btn btn-light done" id="btndone">Done</button></td>'+
					'<button type="submit" class="btn btn-dark undone" id="btnundone' + result[i].id + '" data-id="' + result[i].id + '" style="display:none">Undone</button>' +
					'<button type="button" class="btn btn-success edit" data-toggle="modal" data-target="#taskModal" data-id="' + result[i].id + '">Edit</button>' +
					'<button type="button" class="btn btn-danger delete" id="btndelete" data-id="' + result[i].id + '" data-toggle="modal" data-target="#taskModal">Delete</button>'+
					'</td></tr>';
					$('#tasks_name').prepend(html);
					$('#add_task')[0].reset();
					numarrange(1);
				}
			});
			getalertmodal("Task added", "Successfully added task");
			console.log("Ajax 'add' successful!");
		});
		
		function getalertmodal(title, message){
			$("#modaltitle").text(title);
			$("#modalmessage").show("400");
			$("#modalmessage").text(message);
			$("#editTasktxt").hide("400");
			$("#btnok").show("400");
			$("#btnsavechanges").hide("400");
		}
		
		function numarrange(start){
			var num = $("#tasks_name tr").length;
			var numbers = [];
			var integ = 1;
			//Inserting integers into array
			for (var i=0; i < num; i++){
				numbers [i] = integ;
				integ++;
			}
			$.each(numbers, function(index, value){
				$("span." + value).text(value+start);
			});
		};
		
		function newnumarr(start){
			$("#num1").hide("400");
			var numbers = [];
			var integ = 1;
			//Inserting integers into array
			for (var i=0; i <= start; i++){
				numbers [i] = integ;
				console.log(integ);
				integ++;
			}
			console.log(numbers);
			$.each(numbers, function(index, value){
				$("span.newnumber" + index).text(-1*(value-integ));
				console.log(value);
			});
		}
		
	});

</script>
	
</body>

</html>