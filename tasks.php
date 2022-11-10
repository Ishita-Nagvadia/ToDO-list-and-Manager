<?php
session_start();
if(!isset($_SESSION['uid'])){
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Show All task</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#myTable').DataTable( {
				"scrollY": "350px",
				"scrollCollapse": true,
				"paging": false,
				"info": false,
				"searching": false,
				"responsive": true
			} );
		} );
	</script>
	<style type="text/css">
		.d-flex{
			display: flex;
		}
		.main{
			display: flex;
			position: fixed;
			height: 550px;
			width: 70%;
			top: 15%;
			left: 15%;
			border-radius: 25px;
			align-items: baseline;
			font-size: 19px;
			box-shadow: 0 0 25px -17px #000;
		}
		.navi{
			color: rgb(0,0,0) !important;
		}
		.lft{
			padding: 5px auto;
			margin: 10px auto;
			align-items: left;
		}
		.rgt{
			padding: 5px auto;
			margin: 10px auto;
			align-items: right;
			align-content: right;
		}
		.card-header{
			border-top-left-radius: 25px !important;
			border-top-right-radius: 25px !important;
			text-align: center; 
		}
		.card-body{
			padding: 1rem 3rem;
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
						<a class="nav-link active" style="color: black;" href="tasks.php">Tasks</a>
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
			<div class="card-header" style="width: 100%"><b>Tasks</b>
				<button type="button" class="btn btn-outline-success" style="float: right;"
				onclick="window.location.href='addtask.php';">Add</button>
			</div>
			<div class="card-body" style="width: 100%">
				<table id="myTable" class="table table-striped responsive display cell-border">
					<thead>
							<tr>
							<th>Title</th>
							<th>Progress</th>
							<th>Priority</th>
							<th>Due Date</th>
							<th>Status</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$sid = $_SESSION['uid'];
							$conn = mysqli_connect("localhost","root","","todo_php");
							$query = "SELECT * FROM task WHERE uid='$sid'"; 
							$result = mysqli_query($conn,$query);
							if (mysqli_num_rows($result) > 0){
								$i=0;
								while($row = mysqli_fetch_array($result)) {
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
							<td><?php echo $row["status"];?></td>
							<td><?php echo $row["description"];?></td>
						</tr>
						<?php
								$i++;
								}
							}
							else{
    							echo "No tasks have been entered";
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