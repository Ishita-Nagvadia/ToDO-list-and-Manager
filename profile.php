<?php
session_start();
if(!isset($_SESSION['uid'])){
	//echo "You have Logged Out";
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	<script type="text/javascript">
		var error_uname = false;
		var error_email = false;
		var error_bday = false;
		var error_password = false;
		var error_cpassword = false;

		$(function() {

			$("#uname_error_message").hide();
			$("#email_error_message").hide();
			$("#bday_error_message").hide();
			$("#password_error_message").hide();
			$("#cpassword_error_message").hide();

			$("#form_uname").focusout(function() {
				check_uname();
			});
			$("#form_email").focusout(function() {
				check_email();
			});
			$("#form_bday").focusout(function() {
				check_bday();
			});
			$("#form_password").focusout(function() {
				check_password();
			});
			$("#form_cpassword").focusout(function() {
				check_cpassword();
			});

			$("#registration_form").submit(function() {
				error_uname = false;
				error_email = false;
				error_password = false;
				error_cpassword = false;
				check_uname();
				check_email();
				check_password();
				check_cpassword();
			});
		});

		function check_uname() {
			var pattern = /^([A-Za-z0-9]{3,20})?$/;
			var uname = $("#form_uname").val();
			if (pattern.test(uname) && uname !== '') {
				$("#uname_error_message").hide();
				$("#form_uname").css("border-bottom","2px solid #34F458");
			} else {
				$("#uname_error_message").html("*Invalid Username");
				$("#uname_error_message").show();
				$("#form_uname").css("border-bottom","2px solid #F90A0A");
				error_uname = true;
			}
		}

		function check_email() {
			var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			var email = $("#form_email").val();
			if (pattern.test(email) && email !== '') {
				$("#email_error_message").hide();
				$("#form_email").css("border-bottom","2px solid #34F458");
			} else {
				$("#email_error_message").html("*Invalid Email");
				$("#email_error_message").show();
				$("#form_email").css("border-bottom","2px solid #F90A0A");
				error_email = true;
			}
		}

		function check_password() {
			var password_length = $("#form_password").val().trim().length;
			if (password_length < 8) {
				$("#password_error_message").html("*Atleast 8 Characters");
				$("#password_error_message").show();
				$("#form_password").css("border-bottom","2px solid #F90A0A");
				error_password = true;
			} else {
				$("#password_error_message").hide();
				$("#form_password").css("border-bottom","2px solid #34F458");
			}
		}

		function check_cpassword() {
			var password = $("#form_password").val();
			var cpassword = $("#form_cpassword").val();
			if (password !== cpassword) {
				$("#cpassword_error_message").html("*Passwords does not match");
				$("#cpassword_error_message").show();
				$("#form_cpassword").css("border-bottom","2px solid #F90A0A");
				error_cpassword = true;
			} else {
				$("#cpassword_error_message").hide();
				$("#form_cpassword").css("border-bottom","2px solid #34F458");
			}
		}
	</script>
	<style type="text/css">
		.cnt{
			overflow: hidden;
			overflow-x: hidden;
		}
		.d-flex{
			display: flex;
		}
		.main{
			position: fixed;
			height: 550px;
			width: 57%;
			top: 15%;
			left: 22%;
			align-items: center;
			display: flex;
			justify-content: center;
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
			margin-bottom: 503px; 
		}
		.card-body{
			padding: 1rem 3rem;
		}
		.t-inp{
			height: 40px;
			width: 250px;
		}
		.d-inp{
			height: 40px;
			width: 200px;
			align-items: baseline;
			align-self: baseline;
		}
		.decinp{
			height: 100px;
			width: 670px;
		}
		.but{
			align-self: right;
			align-items: right;
			align-content: right;
			float: right;
			flex-wrap: wrap-reverse;
			direction: row-reverse;
		}
		.img{
			width: 95%;
			justify-content: center;
		}
		.imgdiv{
			position: relative;
		}
		.imgdiv i{
			position: absolute;
			left: 17px; 
			top: 4px;
		}
		.inp{
			width: 300px;
			display: block;
			border: none;
			border-bottom: 1px solid #999;
			padding: 0px 30px;
			line-height: 40px
		}
		.logo{
			width: 160px;
			margin-left: 20px;
		}
		input[type="date"]::-webkit-calendar-picker-indicator { position: absolute; left: 0; padding-left: 0; margin-left: 13px;}
	</style>
</head>
<body style="background-color: #f7f7f7;">
	<div class="cnt bg-light">
		<div class="container-fluid">
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
							<a class="nav-link active" href="profile.php" style="color: black;"><i class="bi bi-person-circle fa-3X"></i></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="logout.php">LogOut</a>
						</li>
					</ul>	
				</div>
			</div>
		</nav>
		<div class="d-flex row p-5 main card">
			<!-- <div class="card-header" style="width: 100%">Profile</div> -->
			<div class="col-6 p-2 ml-2">
				<img class="img img-fluid" src="images/signin-image.jpg"><br>
			</div>
			<div class="content col-6 card-body">
			<?php
				$sid = $_SESSION['uid'];
				$conn = mysqli_connect("localhost","root","","todo_php");
				$query = "SELECT * FROM user_list WHERE uid='$sid'";
				$result = mysqli_query($conn,$query);
				if (mysqli_num_rows($result) > 0){
					$row = mysqli_fetch_array($result);
			?>
				<form class="row needs-validation g-4 p-2" method="post">
					<h1>Profile</h1>
					<div class="imgdiv">
						<i class="bi bi-person-fill"></i>
						<input class="inp form-control" type="text" name="uname" id="form_uname" placeholder="Username" value="<?php echo $row["username"]; ?>">
						<div class="errorDiv">
							<span class="error_form errorTxt" id="uname_error_message"></span>	
						</div>
					</div>
					<div class="imgdiv">
						<i class="bi bi-envelope-fill"></i>
						<input class="inp form-control" id="form_email" type="email" name="Email" placeholder="Email" value="<?php echo $row["email"]; ?>">
						<div class="errorDiv">
							<span class="error_form errorTxt" id="email_error_message"></span>
						</div>
					</div>
					<div class="imgdiv">
						<input class="inp form-control" type="date" id="form_bday" name="Birthday" placeholder="Birthdate" value="<?php echo $row["bday"]; ?>">
						<div class="errorDiv">
							<span class="error_form errorTxt" id="bday_error_message"></span>
						</div>
					</div>
					<div class="imgdiv">
						<i class="bi bi-lock-fill"></i>
						<input class="inp form-control" type="password" id="form_password" name="Password" placeholder="Password">
						<div class="errorDiv">
							<span class="error_form errorTxt" id="password_error_message"></span>
						</div>
					</div>
					<div>
						<button name="profile" type="submit" class="btn btn-primary btn-sm btn-block" style="width: 100%;">Update Changes</button>
						
					</div>
				</form>
			<?php
				}
				else{
					// echo "Sorry there was an error";
				}
				
				if(isset($_POST["profile"])){
					$username = trim($_POST["uname"]);
					$useremail = trim($_POST["Email"]);
					$userbday = trim($_POST["Birthday"]);
					$pass = trim($_POST["Password"]);
					$upass = md5($pass);
					if($pass!=''){
						$query1 = "UPDATE user_list SET username='$username',email='$useremail',bday='$userbday',password='$upass' WHERE uid='$sid'";
						$result1 =  mysqli_query($conn,$query1);
						echo '<script type="text/javascript">';
						echo ' alert("User data updated. Login Again");';
						echo '</script>';
						session_destroy();
						echo("<script>location.href = 'login.php';</script>");
					} else {
						$query2 = "UPDATE user_list SET username='$username',email='$useremail',bday='$userbday' WHERE uid='$sid'";
						$result2 =  mysqli_query($conn,$query2);
						echo '<script type="text/javascript">';
						echo ' alert("User data updated. Login Again")';
						echo '</script>';
						session_destroy();
						echo("<script>location.href = 'login.php';</script>");
					}
				}
			?>
			</div>
	</div>	
</div>
</div>
</body>
</html>