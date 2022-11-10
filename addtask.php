<?php
session_start();
if(!isset($_SESSION['uid'])){
	echo "You have Logged Out";
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Add task</title>
	<!-- Bootstrap link -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<!-- Bootstrap icon -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<!-- Bootstrap js -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	<!-- jquery -->
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<script type="text/javascript">
		var error_title = false;
		var error_progress = false;
		var error_date = false;
		var error_status = false;
		var error_desc = false;
		var formHasError = false;

		$(document).ready(function() {
			$("#title_error_message").hide();
			$("#progress_error_message").hide();
			$("#priority_error_message").hide();
			$("#date_error_message").hide();
			$("#status_error_message").hide();
			$("#desc_error_message").hide();

			$("#form_title").focusout(function() {
				check_title();
			});
			$("#form_progress").focusout(function() {
				check_title();
			});
			$("#form_date").focusout(function() {
				check_date();
			});
			$("#form_priority").focusout(function() {
				check_priority();
			});
			$("#form_status").focusout(function() {
				check_status();
			});
			$("#form_desc").focusout(function() {
				check_desc();
			});

			$("#addtask_form").submit(function() {
				error_title = false;
				error_progress = false;
				error_date = false;
				error_status = false;
				error_desc = false;

				formHasError = false;
				check_title();
				check_date();
				check_status();
				check_priority();
				check_desc();

				if (formHasError === false) {
					return true;
				} else {
					return false;
				}
			});
		});

		function check_title() {
			var title = $("#form_title").val();
			if (title.trim() !== '') {
				$("#title_error_message").hide();
				$("#form_title").css("border-bottom","2px solid #34F458");
			} else {
				$("#title_error_message").html("*Title is Required");
				$("#title_error_message").show();
				$("#form_title").css("border-bottom","2px solid #F90A0A");
				//error_title = true;
				formHasError = true;
			}
		}

		function check_progress() {
			var title = $("#form_title").val();
			if (title.trim() !== '') {
				$("#title_error_message").hide();
				$("#form_title").css("border-bottom","2px solid #34F458");
			} else {
				$("#title_error_message").html("*Title is Required");
				$("#title_error_message").show();
				$("#form_title").css("border-bottom","2px solid #F90A0A");
				//error_title = true;
				formHasError = true;
			}
		}

		function check_date() {
			var txtDate = $("#form_date").val();
			var isValidDate =  this.isValidDate(txtDate);
			if (isValidDate) {
				$("#date_error_message").hide();
				$("#form_date").css("border-bottom","2px solid #34F458");
			} else {
				$("#date_error_message").html("*Please enter valid date");
				$("#date_error_message").show();
				$("#form_date").css("border-bottom","2px solid #F90A0A");
				//error_date = true;
				formHasError = true;
			}
		}

		function isValidDate(s) {
		  var bits = s.split('-');
		  var d = new Date(bits[0] + '/' + bits[1] + '/' + bits[2]);
		  return !!(d && (d.getMonth() + 1) == bits[1] && d.getDate() == Number(bits[2]));
		} 

		function check_status() {
			var txtStatus = $("#form_status").val();
			if (txtStatus != 0) {
				$("#status_error_message").hide();
				$("#form_status").css("border-bottom","2px solid #34F458");
			} else {
				$("#status_error_message").html("*Please select valid status");
				$("#status_error_message").show();
				$("#form_status").css("border-bottom","2px solid #F90A0A");
				//error_time = true;
				formHasError = true;
			}
		}

		function check_priority() {
			var txtStatus = $("#form_priority").val();
			if (txtStatus != 0) {
				$("#priority_error_message").hide();
				$("#form_priority").css("border-bottom","2px solid #34F458");
			} else {
				$("#priority_error_message").html("*Please select valid prioriy");
				$("#priority_error_message").show();
				$("#form_priority").css("border-bottom","2px solid #F90A0A");
				//error_time = true;
				formHasError = true;
			}
		}

		function check_desc() {
			var title = $("#form_desc").val();
			if (title.trim() !== '') {
				$("#desc_error_message").hide();
				$("#form_desc").css("border-bottom","2px solid #34F458");
			} else {
				$("#desc_error_message").html("*Description is Required");
				$("#desc_error_message").show();
				$("#form_desc").css("border-bottom","2px solid #F90A0A");
				//error_desc = true;
				formHasError = true;
			}
		}
	</script>

	<?php
		if(!empty($_POST) && isset($_POST["add"])){
			$title = trim($_POST["title"]);
			$progress = trim($_POST["progress"]);
			$priority = trim($_POST["priority"]);
			$duedate = trim($_POST["d-date"]);
			$status = trim($_POST["status"]);
			$desc = trim($_POST["description"]);
			$uid = $_SESSION['uid'];
			$conn = mysqli_connect("localhost","root","","todo_php");
			$query = "INSERT INTO task (title,progress,priority,due_date,status,description,uid) VALUES ('$title','$progress','$priority','$duedate','$status','$desc','$uid')";
			if(mysqli_query($conn,$query)){
				echo("<script>location.href = 'dashboard.php';</script>");
			} else {
				echo "<script>alert('There was an error');</script>";
				echo("<script>location.href = 'addtask.php';</script>");
			}
		}
	?>

	<style type="text/css">
		.d-flex {
			display: flex;
		}

		.main {
			display: flex;
			position: fixed;
			height: 550px;
			width: 50%;
			top: 15%;
			left: 25%;
			border-radius: 25px;
			align-items: baseline;
			font-size: 19px;
			box-shadow: 0 0 25px -17px #000;
		}

		.navi {
			color: rgb(0, 0, 0) !important;
		}

		.lft {
			padding: 5px auto;
			margin: 10px auto;
			align-items: left;
		}

		.rgt {
			padding: 5px auto;
			margin: 10px auto;
			align-items: right;
			align-content: right;
		}

		.card-header {
			border-top-left-radius: 25px !important;
			border-top-right-radius: 25px !important;
			text-align: center;
		}

		.card-body {
			padding: 1rem 3rem;
		}

		.t-inp {
			height: 40px;
		}

		.d-inp {
			height: 40px;
			align-items: baseline;
			align-self: baseline;
		}

		.decinp {
			height: 100px;
		}

		.but {
			align-self: right;
			align-items: right;
			align-content: right;
			float: right;
			flex-wrap: wrap-reverse;
			direction: row-reverse;
		}

		input[type="date"]::-webkit-calendar-picker-indicator {
			position: absolute;
			padding-left: 0;
			margin-left: 0px;
		}

		input[type="date"]:before {
			content: attr(placeholder) !important;
			margin-right: 1.5em;
		}
		.errorTxt{
			font-family: var(--bs-font-sans-serif);
			font-size: 13px;
			color: red;
		}
		.errorDiv{
			margin-top: -5px;
		}
		.logo{
			width: 160px;
			margin-left: 20px;
		}
	</style>
</head>

<body style="background-color: #f7f7f7 !important">
	<div class="container">
		<!-- Navigation -->
		<nav class="navi navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
			<div class="collapse navbar-collapse align-items-start">
				<div class="col">
					<!-- <a class="navbar-brand" href="#">LOGO</a> -->
					<img class="navbar-brand logo" src="images/logo.png">
				</div>
				<ul class="navbar-nav nav justify-content-end nav-tabs">
					<li class="nav-item">
						<a class="nav-link" href="dashboard.php">Dashboard</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="tasks.php">Tasks</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="meetings.php">Meetings</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="profile.php"><i class="bi bi-person-circle fa-3X"></i></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="logout.php">LogOut</a>
					</li>
				</ul>
			</div>
	</div>
	</nav>
	<!-- MAIN BODY -->
	<div class="container-fluid" style="background-color: #f7f7f7;">
		<div class="d-flex main card">
			<div class="card-header" style="width: 100%"><b>ADD Task</b></div>
			<div class="card-body">
				<form class="row g-3 needs-validation" method="post" id="addtask_form">
					<div class="col-md-6 has-validation">
						<label class="title" name="title">Title</label>
						<input name="title" id="form_title" name="title" type="text" class="form-control t-inp">
						<div class="errorDiv">
							<span class="error_form errorTxt" id="title_error_message"></span>
						</div>
					</div>
					<div class="col-md-6 has-validation">
						<label class="form-label" name="progress">Progress</label>
						<input name="progress" id="form_progress" name="progress" type="range" class="form-range t-inp">
						<div class="errorDiv">
							<span class="error_form errorTxt" id="progress_error_message"></span>
						</div>
					</div>
					<div class="col-md-6 has-validation">
						<label class="form-label" for="priority">Priority</label>
						<select name="priority" id="form_priority" class="d-inp form-control" name="priority">
							<option value="0">--Select--</option>
							<option value="Low">Low</option>
							<option value="Moderate">Moderate</option>
							<option value="High">High</option>
						</select>
						<div class="errorDiv">
							<span class="error_form errorTxt" id="priority_error_message"></span>
						</div>
					</div>
					<div class="col-md-6 has-validation">
						<label class="form-label" name="d-date">Due Date</label>
						<input name="d-date" id="form_date" type="date" class="d-inp form-control">
						<div class="errorDiv">
							<span class="error_form errorTxt" id="date_error_message"></span>
						</div>
					</div>
					<div class="col-12 has-validation">
						<label class="form-label" for="status">Status</label>
						<select name="status" id="form_status" class="d-inp form-control" name="status">
							<option value="0">--Select--</option>
							<option value="Completed">Completed</option>
							<option value="Pending">Pending</option>
							<option value="In-Progress">In-Progress</option>
						</select>
						<div class="errorDiv">
							<span class="error_form errorTxt" id="status_error_message"></span>
						</div>
					</div>
					<div class="col-12">
						<label class="form-label" name="description">Description</label>
						<input name="description" id="form_desc" type="text" class="decinp form-control">
						<div class="errorDiv">	
							<span class="error_form errorTxt" id="desc_error_message"></span>
						</div>
					</div>
					<div class="d-flex flex-row-reverse m-2 p-2">
						<button type="submit" name="add" class="btn btn-outline-success">Add</button>
						<button type="button" class="btn btn-outline-danger" style="margin-right: 10px;"
							name="cancel" onclick="window.location.href='dashboard.php';">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	</div>
</body>

</html>