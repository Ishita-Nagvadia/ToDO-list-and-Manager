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
	<title>Dashboard</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	<script type="text/javascript" src="cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			var tbl1 = $('#myTable1').DataTable({
				"scrollY": "350px",
				"scrollCollapse": true,
				"paging": false,
				"info": false,
				"searching": false,
				"responsive": true
			});

			var tbl2 = $('#myTable2').DataTable({
				"scrollY": "350px",
				"scrollCollapse": true,
				"paging": false,
				"info": false,
				"searching": false,
				"responsive": true
			});
		});
	</script>
	<style type="text/css">
		.d-flex {
			display: flex;
		}

		.main {
			/*display: flex;*/
			/* position: fixed; */
			height: 550px;
			width: 40%;
			margin-top: 100px;
			border-radius: 25px;
			align-items: baseline;
			font-size: 19px;
			box-shadow: 0 0 25px -17px #000;
		}

		.navi {
			color: rgb(0, 0, 0) !important;
		}

		.card-header {
			border-top-left-radius: 25px !important;
			border-top-right-radius: 25px !important;
		}
		.flex-child {
			flex: 1;
		}

		.flex-child:first-child {
			margin-right: 20px;
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
						<a class="nav-link active" style="color: black;" href="dashboard.php">Dashboard</a>
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
						<a class="nav-link" href="logout.php">Logout</a>
					</li>
				</ul>
			</div>
		</nav>
		<!-- MAIN BODY -->
		<div class="d-flex">
			<!-- <div style="width: 100%; height: 750px"> -->
			<div class="main card flex-child">
				<div class="card-header" style="width: 100%;">Tasks
					<button type="button" class="btn btn-outline-success" style="float: right;"
						onclick="window.location.href='addtask.php';">Add</button>
				</div>
				<div class="card-body" style="width: 100%;">
					<table id="myTable1" class="table table-striped responsive display cell-border">
						<thead>
							<tr>
								<th>Title</th>
								<th>Progress</th>
								<th>Priority</th>
								<th>Due Date</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sid = $_SESSION['uid'];
								$conn = mysqli_connect("localhost","root","","todo_php");
								$query = "SELECT tid,title,progress,priority,due_date FROM task WHERE uid='$sid'"; 
								$result = mysqli_query($conn,$query);
								if (mysqli_num_rows($result) > 0){
								$i=0;
								while($row = mysqli_fetch_array($result)){
							?>
							<tr>
								<td><?php echo '<a href="showtask.php?tid='.$row["tid"].'">'.$row["title"].'</a>'?></td>
								<td><?php echo $row["progress"];?></td>
								<td><?php echo $row["priority"];?></td>
								<?php 
									$time = strtotime($row["due_date"]);
									$newformat = date('d-m-Y',$time);
								?>
								<td><?php echo $newformat;?></td>
							</tr>
							<?php
									$i++;
								}
							}
							else{
    							echo "No Tasks have been entered";
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="main card flex-child">
				<div class="card-header" style="width: 100%;">Meetings
					<button type="button" class="btn btn-outline-success" style="float: right;"
						onclick="window.location.href='addmeeting.php';">Add</button>
				</div>
				<div class="card-body" style="width: 100%;">
					<table id="myTable2" class="table table-striped responsive display cell-border"
						style="width: 100%;">
						<thead>
							<tr>
								<th>Title</th>
								<th>Location</th>
								<th>Date</th>
								<th>Time</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$query1 = "SELECT mid,title,location,date,time FROM meeting WHERE uid='$sid'"; 
								$result1 = mysqli_query($conn,$query1);
								if (mysqli_num_rows($result1) > 0){
								$i=0;
								while($row1 = mysqli_fetch_array($result1)){
							?>
							<tr>
								<td><?php echo '<a href="showmeeting.php?mid='.$row1["mid"].'">'.$row1["title"].'</a>'?></td>
								<td><?php echo $row1["location"];?></td>
								<?php 
									$time1 = strtotime($row1["date"]);
									$newformat1 = date('d-m-Y',$time1);
								?>
								<td><?php echo $newformat1;?></td>
								<?php 
									$time2 = strtotime($row1["time"]);
									$newformat2 = date('h:i a',$time2);
								?>
								<td><?php echo $newformat2;?></td>
							</tr>
							<?php
									$i++;
								}
							}
							else{
    							echo "No meetings have been entered";
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

</body>

</html>