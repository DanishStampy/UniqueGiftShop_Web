<?php require 'auth.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - Unique Gift Shop</title>
	<link rel="icon" href="img/logoonly.png" type="image/icon type">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
	<style type="text/css">
		body{
			font-family: 'Ubuntu', sans-serif;
			margin: 0;
			background-image: url("https://cdn.statically.io/img/wallpaperaccess.com/full/729354.jpg");
			background-repeat: no-repeat;
			background-size: cover;
			background-attachment: fixed;
			color: #81717a;
		}
		#wrapper-form{
			display: flex;
			justify-content: center;
			align-self: center;
			margin-top: 40px;
		}
		#login-form{
			padding: 50px;
			width: 670px;
			background-color: #ffcbdd;
			border-radius: 10px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		}
		#login-form label{
			font-weight: 400;
		}
		.login{
			background-color: white;
			color: #81717a;
			border: none;
			transition: all 0.1s;
			font-size: 14px;
		}
		#information{
			display: none;
		}
		#btn-wrapper > button:hover{
			color: white;
			background-color: maroon;
		}
	</style>
	
</head>
<body>
	<div id="wrapper-form">
		<form id="login-form" class="mb-5" method="post" onsubmit="return validateForm();">
			<h1>Login</h1>
			<hr>

			<div class="form-group mb-2">
				<label for="email"><i class="fas fa-envelope"></i> Email Address</label>
				<input type="email" id="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter your email here..." autocomplete="off" required>
				<small id="emailHelp" class="form-text text-muted">E.g. example@gmail.com</small>
			</div>

			<div class="form-group mb-2">
				<label for="password"><i class="fas fa-key"></i> Password</label>
				<input type="password" name="password" id="password" class="form-control" placeholder="Enter password here..." aria-describedby="passwordHelp" required>
			</div>

			<div class="form-group mb-4">
				<label><i class="fas fa-users"></i> Staff level</label>
				<div class="form-check">
					<input type="radio" name="userlevel" class="form-check-input" value="admin" id="radio-btn" required>
					<label class="form-check-label" for="radio-btn">Admin</label>
				</div>
				<div class="form-check">
					<input type="radio" name="userlevel" class="form-check-input" value="staff" id="radio-btn">
					<label class="form-check-label" for="radio-btn">Normal Staff</label>
				</div>
			</div>

			<div class="text-center" id="btn-wrapper">
				<button type="submit" name="login" class="btn btn-primary login" >Sign In</button>
				<button type="reset" name="reset" class="btn btn-primary login">Clear</button>
				<!-- <button type="button" name="info" class="btn btn-outline-primary login" onclick="DisplayInfo();">Info</button> -->
			</div>
			
			<!-- ROLE MESSAGES -->
			<div class="accordion accordion-flush mt-3" id="accordionFlushExample">
				<div class="accordion-item">
					<h2 class="accordion-header" id="flush-headingOne">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
							Demo Account
						</button>
					</h2>
					<div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
						<div class="accordion-body">
							<code>Admin</code>
							<p>Email: admin@gmail.com <br> Password: admin123</p>
							
							<code>Normal Staff</code>
							<p>Email: staff@gmail.com <br> Password: staff123</p>
						</div>
					</div>
				</div>
			</div>
			</form>
		</div>
	</body>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
		function validateForm() {
			var username = document.getElementById("email").value;
			var password = document.getElementById("password").value;
			var level = document.querySelector("input[name='userlevel']:checked");

			var errorMsg = "";

			if (username == "") {
				errorMsg += '-Please insert your email first-\n';
				console.log('hi');
			}
			if (password.length == 0) {
				errorMsg += '-Please enter your password first-\n';
			}else if(password.length < 6){
				errorMsg += '-Please enter more than 6 character-\n';
			}
			if(level == null){
				errorMsg +='-Please choose staff level-\n';
			}

			if(errorMsg == ""){
				<?php 
				if($errorMsg!= null){	
					echo "errorMsg += '-".$errorMsg."-';";
					// header("location: login.php");
				}
				?>
			}


			if(errorMsg!==""){
				alert(errorMsg);
				return false;
			}

			return true;
		}

	</script>
	</html>