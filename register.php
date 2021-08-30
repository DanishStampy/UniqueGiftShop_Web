<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register - Unique Gift Shop</title>
	<link rel="icon" href="logoonly.png" type="image/icon type">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
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
		#register-form{
			padding: 50px;
			width: 670px;
			background-color: #ffcbdd;
			border-radius: 10px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		}
		#register-form label{
			font-weight: 400;
		}
		.register{
			background-color: white;
			color: #81717a;
			border: none;
			transition: all 0.1s;
			font-size: 14px;
		}
	</style>
	
</head>
<body>
	<div id="wrapper-form">
		<form id="register-form">
			<h1>Sign Up</h1>
			<hr>

			<div class="form-group">
				<label for="name">Username</label>
				<input type="name" id="name" name="name" class="form-control" aria-describedby="emailHelp" placeholder="Enter your username here...">
			</div>

			<div class="form-group">
				<label for="email">Email Address</label>
				<input type="email" id="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter your email here...">
				<small id="emailHelp" class="form-text text-muted">E.g. example@gmail.com</small>
			</div>

			<div class="form-group">
				<label for="phonenum">Phone Number</label>
				<input type="text" id="phonenum" name="phonenum" class="form-control" placeholder="Enter your phone number here..." aria-describedby="phoneHelp">
				<small>E.g. 012-3456789</small>
			</div>

			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" class="form-control" placeholder="Enter password here..." aria-describedby="passwordHelp">
				<small id="passwordHelp" class="form-text text-muted">Must more than 6 character</small>
			</div>

			<div class="form-group">
				<label>Staff level</label>
				<div class="form-check">
					<input type="radio" name="userlevel" class="form-check-input" value="admin" id="radio-btn">
					<label class="form-check-label" for="radio-btn">Admin</label>
				</div>
				<div class="form-check">
					<input type="radio" name="userlevel" class="form-check-input" value="user" id="radio-btn">
					<label class="form-check-label" for="radio-btn">Normal Staff</label>
				</div>
			</div>

			<button type="submit" name="register" class="btn btn-primary register">Register</button>
			<button type="reset" name="reset" class="btn btn-primary register">Clear</button>
		</form>
	</div>
</body>
</html>