<?php
include_once 'database.php';
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
	<title>Unique Gift Shop Ordering System : Products Details</title>
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
	<link rel="icon" href="img/logoonly.png" type="image/icon type">
	<link rel="stylesheet" type="text/css" href="design.css">
	<style type="text/css">
		body{
			margin: 0;
			font-family: 'Ubuntu', sans-serif;
		}
		.customCard{
			background-color: white;
			align-items: center;
			border-radius: 10px;
			height: 500px;
		}
		.spec-card{
			margin-left: 0px;
		}
		
		.cardHeader{
			background-color: #800000;
			color: white;
		}


	</style>
</head>
<body style="background-color: #AA4465;">
	
	<?php include_once 'nav_bar.php' ?>

	<?php
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("SELECT * FROM tbl_products_a175139_pt2 WHERE fld_product_num = :pid");
		$stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
		$pid = $_GET['pid'];
		$stmt->execute();
		$readrow = $stmt->fetch(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	$conn = null;
	?>

	<div class="container-fluid"  style="height: 100vh;">
		<div class="row justify-content-evenly m-5 shadow customCard">
			<div class="col-xs-12 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 text-center spec-card">
				<?php if ($readrow['fld_product_image'] == "" ) {
					echo "No image";
				}
				else { ?>
					<img src="products/<?php echo $readrow['fld_product_image'] ?>" class="img-fluid rounded">
				<?php } ?>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-4 ">
				<div class="card">
					<div class="card-title p-2 text-center cardHeader"><strong>Product Details</strong></div>
					<div class="card-text p-2 text-center">
						Below are specifications of the product.
					</div>
					<table class="table table-striped table-hover mb-0">
						<tr>
							<td class="col-xs-4 col-sm-4 col-md-4"><strong>Product ID</strong></td>
							<td><?php echo $readrow['fld_product_num'] ?></td>
						</tr>
						<tr>
							<td><strong>Name</strong></td>
							<td><?php echo $readrow['fld_product_name'] ?></td>
						</tr>
						<tr>
							<td><strong>Price</strong></td>
							<td>RM <?php echo $readrow['fld_product_price'] ?></td>
						</tr>
						<tr>
							<td><strong>Category</strong></td>
							<td><?php echo $readrow['fld_product_category'] ?></td>
						</tr>
						<tr>
							<td><strong>Color</strong></td>
							<td><input type="color" value="<?php echo $readrow['fld_product_color'] ?>" disabled style="border-style: none;"></td>
						</tr>
						<tr>
							<td><strong>Material</strong></td>
							<td><?php echo $readrow['fld_product_material'] ?></td>
						</tr>
						<tr>
							<td><strong>In-Stock Quantity</strong></td>
							<td><?php echo $readrow['fld_product_quantity'] ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
	<?php include_once 'footer.php'; ?>
</body>
</html>