<!DOCTYPE html>
<html>
	<head>
		<title>Homepage</title>
		<!-- Bootstrap link -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
		<!-- Bootstrap icon -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
		<!-- Bootstrap js -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
		<!-- jquery -->
		<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
		<script type="text/javascript">
			$(function() {
				$("#email_error_message").hide();
				var error_email = false;

         		$("#form_email").focusout(function() {
            		check_email();
         		});
			
				function check_email() {
            		var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            		var email = $("#form_email").val();
            		if (pattern.test(email) && email !== '') {
               			$("#email_error_message").hide();
              			$("#form_email").css("border-bottom","2px solid #34F458");
            		} else {
               			$("#email_error_message").html("Invalid Email");
               			$("#email_error_message").show();
               			$("#form_email").css("border-bottom","2px solid #F90A0A");
               			error_email = true;
            		}
         		}

         		$("#registration_form").submit(function() {

         			check_email();

         			if (error_email === false) {
         				/*alert("Registration Successfull");*/
         				window.location.replace("signup.php");
         				return true;
         			} else {
    				//alert("Please Fill the form Correctly");
    				return false;
    				}
         		});
      		});
		</script>
		<style type="text/css">
			.cnt{
				width: 100%;
				overflow-x: hidden; 
				margin: auto;
			}
			.navbar{
				display: flex;
				width: 80%;
				margin: auto;
				margin-bottom: 30px;
			}
			.maintag{
				width: 80%;
				margin: auto;
				text-align: left;
			}
			.img{
				width: 110%;
			}
			.main{
				height: 500px;
			}
			.adv{
				height: 450px;
				width: 75%;
				margin: auto;
			}
			.card{
				align-items: baseline;
				border-radius: 18px;
				max-height: 360px;
			}
			.card-img-top{
				width: 60%;
				align-self: center;
				margin: 10px auto; 
				align-items: baseline;
			}
			#card2{
				padding-top: 20px;
			}
			#card3{
				padding-top: 4px;
    			width: 75%;
			}
			.ftr{
				margin-top: 30px;
				height: 250px;
				overflow: hidden;
			}
			.cs{
				margin-left: 200px;
			}
			.fem{
				float: center;
				margin: 50px;
				margin-left: 50px auto;
				margin-right: 50px auto;
				margin-bottom: 20px auto;
			}
			.mr-5{
				margin-right : 5px;
			}
			.logo{
				width: 160px;
			}
		</style>
	</head>
	<body>
		<div class="cnt">
			<!-- Navigation -->
			<nav class="navbar pb-5">
  				<div class="container-fluid">
  					<!-- <p class="navbar-brand">LOGO</p> -->
  					<img class="navbar-brand logo" src="images/logo.png">
  					<div class="d-flex flex-row-reverse bd-highlight">
  						<div class="p-2 bd-highlight"><button class="btn btn-success" id="signup" onclick="window.location.href='signup.php';">Sign Up</button></div>
  						<div class="p-2 bd-highlight"><button class="btn btn-success" id="login" onclick="window.location.href='login.php';">Login</button></div>	
  					</div>
      			</div>
			</nav>
			<!-- Section1- main tag -->
			<div class=" maintag row pb-5">
				<div class="col-6">
					<div class="p-5">
						<h1 class="mb-3" style="line-height: 150px">Welcome to ToDo list</h1>
						<h4 class="mb-3">Start managing your daily tasks, meeting and make space for some peace</h4><br/><br/>
						<button class="btn btn-primary btn-lg" onclick="window.location.href='signup.php';">Get Started</button>
					</div>
				</div>
				<div class="col-6">
					<img class="img img-fluid" src="images/main-page-img1.svg">
				</div>	
			</div>
			<!-- Advantages -->
			<div class="bg-light">
				<div class="p-5 text-center">
					<h1 class="mb-3">Use inbuilt features to your advantage</h1>
				</div>
				<div class="row adv">
					<div class="col-md-4 pb-5">
						<div class="card">
							<img src="images/card1.svg" class="card-img-top img-fluid">
							<div class="card-body">
								<h5 class="card-title text-center">Manage daily tasks</h5><br/>
								<p class="card-text">Write down all all your tasks and never forget anything</p>
							</div>
						</div>
					</div>
					<div class="col-sm-4 pb-5">
						<div class="card">
							<img src="images/card2.svg" class="card-img-top img-fluid" id="card2">
							<div class="card-body">
								<h5 class="card-title text-center">Manage your meetings</h5><br/>
								<p class="card-text">Write down all the details and resources related to meeting</p>
							</div>
						</div>
					</div>
					<div class="col-sm-4 pb-5">
						<div class="card">
							<img src="images/card3.svg" class="card-img-top img-fluid" id="card3">
							<div class="card-body">
								<h5 class="card-title text-center">Prioritize Everyting</h5><br/>
								<p class="card-text">Prioritizing your tasks to achive greater heights</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Footer -->
			<footer class="ftr text-center text-lg-start pb-5">
  				<div class="container p-4">
    				<div class="row">
      					<div class="col-lg-3 col-md-6 mb-2 mb-md-0">
        					<h5 class="text-uppercase">To Do List</h5>
        					<p>
        						Sign up with your email now and regain clarity and calmness by getting all those tasks out of your head and add them onto your to-do list and start achieving succes.
        					</p>
      					</div>
      					<div class="col-lg-3 col-md-6 mb-2 mb-md-0 cs">
        					<h5 class="text-uppercase">Contact US</h5>
        					<span><i class="bi bi-map-fill mr-5"></i>Marwadi university,Rajkot</span>
							<br/>
							<span><i class="bi bi-telephone-inbound-fill mr-5"></i>Phone: 0123456789</span>
							<br/>
        					<span><i class="bi bi-envelope-fill mr-5"></i>Email: contactus@gmail.com</span>
      					</div>
      					<div class="col-lg-3 col-md-6 mb-2 mb-md-0">
      						<!-- <form class="needs-validation" method="post">
      						</form> -->
							<div class="fem input-group mb-3 form-outline">
      							<label for="signup" class="form-label"></label>
      							<input id="form_email" type="email" class="form-control" placeholder="Enter your email">
      							<div class="input-group-append">
      								<button class="btn btn-success" id="sbtn" type="submit" name="register" onclick="window.location.href='signup.php';">Signup</button>
      							</div>
      							<span class="error_form" id="email_error_message"></span>
      						</div>
      					</div>
      				</div>
      			</div>
      		</footer>
		</div>
	</body>
</html>