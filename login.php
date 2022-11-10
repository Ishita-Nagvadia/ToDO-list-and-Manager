<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<!-- Bootstrap link -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<!-- Bootstrap icon -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<!-- Bootstrap js -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	<!-- jquery -->
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<script type="text/javascript">
    	var error_email = false;
    	var error_password = false;
    	$(document).ready(function() {
    		$("#email_error_message").hide();
    		$("#password_error_message").hide();

    		$("#form_email").focusout(function() {
    			check_email();
    		});
    		$("#form_password").focusout(function() {
    			check_password();
    		});
    		$("#registration_form").submit(function() {
    			error_email = false;
    			error_password = false;
				formHasError = false;
    			check_email();
    			check_password();

    			/*if (error_email === false && error_password === false) {
    				alert("Registration Successfull");
    				window.location.replace("dashboard.php");
    				return true;
    			} else {
    				alert("Please Fill the form Correctly");
    				return false;
    			}*/
				if (formHasError === false) {
					return true;
				} else {
					return false;
				}
    		});
    	});


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
    </script>
    
    <?php
        if(isset($_POST["login"])){
            $uemail = trim($_POST["email"]);
            $upass = trim($_POST["password"]);
			$pass = md5($upass); 

            $conn = mysqli_connect("localhost","root","","todo_php");

			$query = "SELECT uid,email,password FROM user_list WHERE email='$uemail'";
            $result = mysqli_query($conn,$query);
            $rowCount = mysqli_num_rows($result);
			
			if($rowCount>0){
				$fetcharray = mysqli_fetch_assoc($result);
				$dbpass = $fetcharray['password'];
				if($pass == $dbpass){
					session_start();
					$_SESSION['uid'] = $fetcharray['uid']; 
					echo ("<script>location.href = 'dashboard.php';</script>");
				}
				else {
					echo '<script type="text/javascript">';
					echo ' alert("User dose not exist. Try Again")';
					echo '</script>';
				}
			}
			
        }        
    ?>

    <style type="text/css">
    	.cnt{
    		background-color: #d3d3d3;
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
    		justify-content: center;
    	}
    	.imgdiv{
    		position: relative;
    	}
    	.imgdiv i{
    		position: absolute;
    		left: 28px; 
    		top: 13px;
    	}
    	.inp{
    		width: 300px;
    		display: block;
    		border: none;
    		border-bottom: 1px solid #999;
    		padding: 0px 30px;
    		line-height: 40px;
    		margin: 7px;
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
	<div class="cnt bg-light">
		<div class="container-fluid">
			<div class="d-flex row p-5 main card">
				<div class="col-6 p-2 ml-2">
					<img class="img img-fluid" src="images/signin-image.jpg"><br>
					<p style="text-align: center;"><a class="txtlink" href="signup.php">New Member</a></p>
				</div>
				<div id="registration_form" class="content col-6 card-body">
					<form id="registration_form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"" method="post" class="row needs-validation g-4 p-2" novalidate>
						<h1>Sign In</h1>
						<div class="imgdiv has-validation">
							<i class="bi bi-envelope-fill"></i>
							<input class="inp form-control" type="email" name="email" id="form_email" placeholder="Email" aria-describedby="inputGroupPrepend">
							<div class="errorDiv">
								<span class="error_form errorTxt" id="email_error_message"></span>
							</div>
						</div>
						<div class="imgdiv has-validation">
							<i class="bi bi-lock-fill"></i>
							<input class="inp form-control" type="password" name="password" id="form_password" placeholder="Password" aria-describedby="inputGroupPrepend">
							<div class="errorDiv">
								<span class="error_form errorTxt" id="password_error_message"></span>
							</div>
						</div>
						<div>
							<button type="submit" name="login" class="btn btn-primary btn-sm btn-block" style="width: 100%;">LogIn</button>
						</div>
						<p style="text-align: center"><a class="txtlink1" href="index.php">Back to home</a></p>
					</form>
				</div>
			</div>	
		</div>
	</div>
</body>
</html>