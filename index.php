<?php
	session_start();
	if(!isset($_SESSION['admin_role']) AND !isset($_SESSION['staff_role'])){
		header("location: login.php");
	}	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Unique Gift Shop Ordering System</title>
	<link rel="icon" href="img/logoonly.png" type="image/icon type">
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>

	<!-- THIS IS NAVIGATION BAR -->
	<?php include 'nav_bar.php'; ?>
	<div class="wrapper-menu">
		<div class="title">
			<h1>Welcome to</h1>
			<img src="img/giftlogo.png">
			<p>Gift & Souvenirs Management System</p>
		</div>
		<!-- <div class="txt-menu">
			<h1>Welcome to <br>Unique Gift Shop!!</h1>
			<blockquote><p>“Someone I loved once gave me a box full of darkness. It took me years to understand that this too, was a gift.”
			― Mary Oliver</p><p>“Everyone has a gift for something, even if it is the gift of being a good friend.”
			― Marian Anderson</p></blockquote>
		</div>
		<div class="image-menu">
			<img src="giftlogo.png">
		</div> -->
	</div>

	

	

	<?php include_once 'footer.php';?>
</body>
</html>