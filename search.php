<?php
include_once 'products_crud.php';
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
	<title>Unique Gift Shop Ordering System : Products</title>
	<link rel="icon" href="img/logoonly.png" type="image/icon type">
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">
		html{
			width: 100%;
		}
		body{
			margin: 0;
			font-family: 'Ubuntu', sans-serif;
			box-sizing: border-box;
		}
		#search-wrapper{
			background-color: #AA4465;
			height: 250px;
			border-radius: 0 0 100px 100px;
			z-index: 0;
		}
		.helpText{
			background-color: transparent;
			color: #d6d4d4;
			font-size: 20px;
			margin: 0 auto;
			display: block;
		}
		.search {
			position: relative;
			box-shadow: 0 0 40px rgba(51, 51, 51, .1)
		}

		.search input {
			height: 60px;
			text-indent: 25px;
			border: 2px solid #d6d4d4;
		}

		.search input:focus {
			box-shadow: none;
			border: 2px solid #EDF0DA;
		}

		.search .fa-search {
			position: absolute;
			top: 20px;
			left: 16px
		}

		.search button {
			position: absolute;
			top: 5px;
			right: 5px;
			height: 50px;
			width: 110px;
			background-color: #a89b8c;
			border: none;
		}
		.search button:hover{
			background-color: white;
			color: #a89b8c;
			border: 1px solid #a89b8c;
		}
	</style>
</head>
<body>

	<!-- THIS IS NAVIGATION BAR -->
	<?php include 'nav_bar.php'; ?>

	<!-- This is SEARCH BAR -->
	<div class="row justify-content-md-center" id="search-wrapper" style="margin-right: 0">
		<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
			<div class="pb-2 mt-4 mb-2 border-bottom">
				<h1 class="text-center" style="color: #EDF0DA;">Search Product</h1>	
			</div>
			<div>
				<p class="text-center mb-0" style="color: #EDF0DA;">Please enter keywords either based on name, category, material or 3 of them.</p>
			</div>
			<form method="POST" action="" id="wrapper" onsubmit="return validateForm();">
				<div class="container">
					<div class="row height d-flex justify-content-center align-items-center">
						<div class="col-md-8">
							<div class="search mt-3"> 
								<i class="fa fa-search"></i> 
								<input type="text" id="keywords" class="form-control" name="keywords" placeholder="Enter keywords here"><button class="btn btn-primary" name="search">Search</button>
								<p class="helpText mt-1">E.g. "Wood Hanging Vase Home Decoration"</p>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	
	<?php include 'search_product.php'; ?>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
</body>
<script type="text/javascript">

	function validateForm(){
		var key = document.getElementById('keywords');

		if(key.value == ""){
			alert('Please enter any keywords');
		}
	}
	
</script>
</html>