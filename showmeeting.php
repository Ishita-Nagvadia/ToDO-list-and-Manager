<?php
session_start();
if (!isset($_SESSION['uid'])) {
	echo "You have Logged Out";
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Edit Meeting</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	<!-- jquery -->
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<script type="text/javascript">
		var error_title = false;
		var error_location = false;
		var error_date = false;
		var error_status = false;
		var error_time = false;
		var error_desc = false;
		var formHasError = false;

		$(document).ready(function() {
			$("#title_error_message").hide();
			$("#location_error_message").hide();
			$("#date_error_message").hide();
			$("#status_error_message").hide();
			$("#time_error_message").hide();
			$("#desc_error_message").hide();

			$("#form_title").focusout(function() {
				check_title();
			});
			$("#form_location").focusout(function() {
				check_location();
			});
			$("#form_date").focusout(function() {
				check_date();
			});
			$("#form_status").focusout(function() {
				check_status();
			});
			$("#form_time").focusout(function() {
				check_time();
			});
			$("#form_desc").focusout(function() {
				check_desc();
			});

			$("#showMeetingForm").submit(function() {
				error_title = false;
				error_location = false;
				error_date = false;
				error_status = false;
				error_time = false;
				error_desc = false;

				formHasError = false;
				check_title();
				check_location();
				check_date();
				check_status();
				check_time();
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
				$("#form_title").css("border-bottom", "2px solid #34F458");
			} else {
				$("#title_error_message").html("*Title is Required");
				$("#title_error_message").show();
				$("#form_title").css("border-bottom", "2px solid #F90A0A");
				//error_title = true;
				formHasError = true;
			}
		}

		function check_location() {
			var location = $("#form_location").val();
			if (location.trim() !== '') {
				$("#location_error_message").hide();
				$("#form_location").css("border-bottom", "2px solid #34F458");
			} else {
				$("#location_error_message").html("*Location is Required");
				$("#location_error_message").show();
				$("#form_location").css("border-bottom", "2px solid #F90A0A");
				//error_location = true;
				formHasError = true;
			}
		}

		function check_date() {
			var txtDate = $("#form_date").val();
			var isValidDate = this.isValidDate(txtDate);
			if (isValidDate) {
				$("#date_error_message").hide();
				$("#form_date").css("border-bottom", "2px solid #34F458");
			} else {
				$("#date_error_message").html("*Please enter valid date");
				$("#date_error_message").show();
				$("#form_date").css("border-bottom", "2px solid #F90A0A");
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
				$("#form_status").css("border-bottom", "2px solid #34F458");
			} else {
				$("#status_error_message").html("*Please select valid status");
				$("#status_error_message").show();
				$("#form_status").css("border-bottom", "2px solid #F90A0A");
				//error_time = true;
				formHasError = true;
			}
		}

		function check_time() {
			var pattern = /^(?:[01][0-9]|2[0-3])[-:h][0-5][0-9]$/;
			var txtTime = $("#form_time").val();

			if (pattern.test(txtTime) && txtTime.trim() !== '') {
				$("#time_error_message").hide();
				$("#form_time").css("border-bottom", "2px solid #34F458");
			} else {
				$("#time_error_message").html("*Please enter valid time");
				$("#time_error_message").show();
				$("#form_time").css("border-bottom", "2px solid #F90A0A");
				//error_status = true;
				formHasError = true;
			}
		}

		function check_desc() {
			var title = $("#form_desc").val();
			if (title.trim() !== '') {
				$("#desc_error_message").hide();
				$("#form_desc").css("border-bottom", "2px solid #34F458");
			} else {
				$("#desc_error_message").html("*Description is Required");
				$("#desc_error_message").show();
				$("#form_desc").css("border-bottom", "2px solid #F90A0A");
				//error_desc = true;
				formHasError = true;
			}
		}
	</script>
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
			/* width: 670px; */
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

		input[type="time"]::-webkit-calendar-picker-indicator {
			position: absolute;
			padding-left: 0;
			margin-left: 0px;
		}

		input[type="time"]:before {
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
		.logo {
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
			<div class="card-header" style="width: 100%"><b>Show Meeting</b></div>
			<div class="card-body">
				<?php
				$sid = $_SESSION['uid'];
				$mid = $_GET['mid'];
				$conn = mysqli_connect("localhost", "root", "", "todo_php");
				$query = "SELECT * FROM meeting WHERE uid='$sid' AND mid='$mid'";
				$result = mysqli_query($conn, $query);
				if (mysqli_num_rows($result) > 0) {
					$row = mysqli_fetch_array($result);
				?>
					<form class="row g-3 needs-validation" id="showMeetingForm" method="post">
						<div class="col-md-6 has-validation">
							<label class="title" name="title">Title</label>
							<input type="text" name="title" id="form_title" class="form-control t-inp" value="<?php echo $row["title"]; ?>">
							<div class="errorDiv">
								<span class="error_form errorTxt" id="title_error_message"></span>
							</div>
						</div>
						<div class="col-md-6 has-validation">
							<label class="location" name="location">Location</label>
							<input type="text" name="location" id="form_location" class="form-control t-inp" value="<?php echo $row["location"]; ?>">
							<div class="errorDiv">
								<span class="error_form errorTxt" id="location_error_message"></span>
							</div>
						</div>
						<div class="col-md-6 has-validation">
							<label class="form-label" name="date">Date</label>
							<input type="date" name="date" id="form_date" class="form-control d-inp" value="<?php echo $row["date"]; ?>">
							<div class="errorDiv">
								<span class="error_form errorTxt" id="date_error_message"></span>
							</div>
						</div>
						<div class="col-md-6 has-validation">
							<label class="form-label" for="status">Status</label>
							<select id="form_status" class="d-inp form-control" name="status" value="<?php echo $row["status"]; ?>">
								<option value="Completed">Completed</option>
								<option value="Pending">Pending</option>
								<option value="Posponed">Posponed</option>
							</select>
							<div class="errorDiv">
								<span class="error_form errorTxt" id="status_error_message"></span>
							</div>
						</div>
						<div class="col-12 has-validation">
							<label class="form-label" name="time">Time</label>
							<?php
							$time1 = strtotime($row["time"]);
							$newformat1 = date('H:i', $time1);
							?>
							<input id="form_time" type="time" name="time" class="form-control d-inp" value="<?php echo $newformat1; ?>">
							<div class="errorDiv">
								<span class="error_form errorTxt" id="time_error_message"></span>
							</div>
						</div>
						<div class="col-12">
							<label class="form-label" name="description">Description</label>
							<input id="form_desc" type="text" name="description" class="decinp form-control" value="<?php echo $row["description"]; ?>">
							<div class="errorDiv">
								<span class="error_form errorTxt" id="desc_error_message"></span>
							</div>
						</div>
						<div class="d-flex flex-row-reverse m-2 p-2">
							<button type="submit" name="edit" class="btn btn-outline-success">Edit</button>
							<button type="submit" name="delete" class="btn btn-outline-danger" style="margin-right: 10px;">Delete</button>
							<button type="button" name="cancel" class="btn btn-outline-danger" style="margin-right: 10px;" onclick="window.location.href='meetings.php';">Cancel</button>
						</div>
					</form>
				<?php
				} else {
					// echo "Sorry there was an error";
				}

				if (!empty($_POST) && isset($_POST["edit"])) {
					$title = trim($_POST["title"]);
					$location = trim($_POST["location"]);
					$date = trim($_POST["date"]);
					$status = trim($_POST["status"]);
					$time = trim($_POST["time"]);
					$description = trim($_POST["description"]);

					$query2 = "UPDATE meeting SET title='$title',location='$location',date='$date',status='$status',time='$time',description='$description' WHERE uid='$sid' AND mid='$mid'";
					$result2 =  mysqli_query($conn, $query2);
					echo ("<script>location.href = 'meetings.php';</script>");
				} else if (!empty($_POST) && isset($_POST["delete"])) {
					$query2 = "DELETE FROM meeting WHERE uid='$sid' AND mid='$mid'";
					$result2 =  mysqli_query($conn, $query2);
					echo ('<script>if (confirm("Are you sure you want to Delete?")) {
						' . $result2 =  mysqli_query($conn, $query2) . '
						location.href = "meetings.php";
					  }</script>');
					//echo("location.href = 'meetings.php';</script>");
				}
				?>
			</div>
		</div>
	</div>
	</div>
</body>

</html>