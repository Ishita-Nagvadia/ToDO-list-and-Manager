<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
	<!-- Bootstrap link -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<!-- Bootstrap icon -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<!-- Bootstrap js -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	<!-- jquery -->
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<script type="text/javascript">
		var error_uname = false;
		var error_email = false;
		var error_bday = false;
		var error_password = false;
		var error_cpassword = false;

		$(document).ready(function() {
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
				formHasError = false;
				check_uname();
				check_email();
				check_password();
				check_cpassword();

				/*if (error_uname === false && error_email === false && error_password === false && error_cpassword === false) {
					//alert("Registration Successfull");
					window.location.href='dashboard.html';
					return true;
				} else {
					//alert("Please Fill the form Correctly");
					return false;
				}*/
				if (formHasError === false) {
					return true;
				} else {
					return false;
				}
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
				formHasError = true;
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
				formHasError = true;
			}
		}

		function check_password() {
			var password_length = $("#form_password").val().trim().length;
			if (password_length < 8) {
				$("#password_error_message").html("*Atleast 8 Characters");
				$("#password_error_message").show();
				$("#form_password").css("border-bottom","2px solid #F90A0A");
				error_password = true;
				formHasError = true;
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
				formHasError = true;
			} else {
				$("#cpassword_error_message").hide();
				$("#form_cpassword").css("border-bottom","2px solid #34F458");
			}
		}
	</script>

	<?php
    	if(isset($_POST["register"]) && !empty($_POST)) {
    		$username = trim($_POST["uname"]);
  			$useremail = trim($_POST["email"]);
            $userbday = trim($_POST["Birthday"]);
            $pass = trim($_POST["password"]);
            $upass = md5($pass);

    		$conn = mysqli_connect("localhost","root","","todo_php");
			
			$query1 = "SELECT email FROM user_list WHERE email='$useremail'";
    		$result = mysqli_query($conn,$query1);
			$rowCount = mysqli_num_rows($result);

			if($rowCount>0){
				echo '<script type="text/javascript">';
				echo ' alert("User already exist. Try Again")';
				echo '</script>';
			} 
			else{
				$insert = "INSERT INTO user_list (username,email,bday,password) VALUES('$username','$useremail','$userbday','$upass')";
				$result1 = mysqli_query($conn,$insert); 
				if($result1){
					$id = "SELECT uid FROM user_list WHERE email='$useremail'";
					$result2 = mysqli_query($conn,$id); 
					$rowCount1 = mysqli_num_rows($result2);
					if($rowCount1>0){
						$fetcharray = mysqli_fetch_assoc($result2);
						$_SESSION['uid'] = $fetcharray['uid'];
						echo ("<script>location.href = 'dashboard.php';</script>");
					}
				}
			}
    	}
	?>

	<style type="text/css">
		.cnt{
			background-color: #d3d3d3;
			height: 100%;
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
			top: 12%;
			left: 22%;
			align-items: center;
			display: flex;
			justify-content: center;
			border-radius: 25px;
		}
		.img{
			width: 95%;
		}
		.imgdiv{
			position: relative;
		}
		.imgdiv i{
			position: absolute;
			left: 28px; 
			top: 3px;
		}
		.inp{
			width: 300px;
			display: block;
			border: none;
			border-bottom: 1px solid #999;
			padding: 0px 30px;
			margin: 7px;
		}
		input[type="date"]::-webkit-calendar-picker-indicator { 
			position: absolute; 
			left: 0; 
			padding-left: 0; 
			margin-left: 26px;
		}	
		.errorTxt{
			font-family: var(--bs-font-sans-serif);
			font-size: 13px;
			color: red;
		}
		.errorDiv{
			margin-left: 15px;
			margin-top: -5px;
		}
		.txtlink {
			color: green;
			text-decoration:none;
			margin-left:20px;
			font-size:16px;
		}
		.txtlink1 {
			color: blue;
			text-decoration:none;
			margin-left:20px;
			font-size:16px;
		}
		.txtlink:hover {
			text-decoration:underline;
			color: darkgreen;
		}
	</style>
</head>
<body style="background-color: #f7f7f7;">
	<div class="cnt">
		<div class="container-fluid bg-light">
			<div class="d-flex row p-5 main card">
				<div class="content col-6 card-body">
					<form id="registration_form" class="row g-4 p-2" method="post">
						<h1>Sign Up</h1>
						<div class="imgdiv">
							<i class="bi bi-person-fill"></i>
							<input class="inp form-control" type="text" id="form_uname" name="uname" placeholder="Username">
							<div class="errorDiv">
								<span class="error_form errorTxt" id="uname_error_message"></span>	
							</div>
						</div>
						<div class="imgdiv">
							<i class="bi bi-envelope-fill"></i>
							<input class="inp form-control" type="email" id="form_email" name="email" placeholder="Email">
							<div class="errorDiv">
								<span class="error_form errorTxt" id="email_error_message"></span>
							</div>
						</div>
						<div class="imgdiv">
							<input class="inp form-control" type="date" id="form_bday" name="Birthday" bplaceholder="Birthdate">
							<div class="errorDiv">
								<span class="error_form errorTxt" id="bday_error_message"></span>
							</div>
						</div>
						<div class="imgdiv">
							<i class="bi bi-lock-fill"></i>
							<input class="inp form-control" type="password" id="form_password" name="password" placeholder="Password">
							<div class="errorDiv">
								<span class="error_form errorTxt" id="password_error_message"></span>
							</div>
						</div>
						<div class="imgdiv">
							<i class="bi bi-lock"></i>
							<input class="inp form-control" type="password" id="form_cpassword"name="cpassword" placeholder="Confirm Password">
							<div class="errorDiv">
								<span class="error_form errorTxt" id="cpassword_error_message"></span>
							</div>
						</div>
						<div>
							<button type="submit" name="register" class="btn btn-primary btn-sm btn-block" style="width:100%">Register</button>
						</div>
						<p style="text-align: center"><a class="txtlink1" href="index.php">Back to home</a></p>
					</form>
				</div>
				<div class="col-6 p-2">
					<img class="img img-fluid" src="images/signup-image.jpg"><br>
					<p style="text-align: center;"><a class="txtlink" href="login.php">Already a Member</a></p>
				</div>
			</div>	
		</div>
	</div>
</body>
</html>