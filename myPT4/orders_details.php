<?php
include_once 'orders_details_crud.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Bike Ordering System : Orders Details</title>
	<link rel="icon" href="img/logoonly.png" type="image/icon type">
	<link rel="stylesheet" type="text/css" href="css/design.css">
</head>
<body style="background-color: #EDF0DA;">

	<?php include_once 'nav_bar.php'; ?>

	<?php
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("SELECT * FROM tbl_orders_a175139, tbl_staffs_a175139_pt2,
			tbl_customers_a175139_pt2 WHERE
			tbl_orders_a175139.fld_staff_num = tbl_staffs_a175139_pt2.fld_staff_num AND
			tbl_orders_a175139.fld_customer_num = tbl_customers_a175139_pt2.fld_customer_num AND
			fld_order_num = :oid");
		$stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
		$oid = $_GET['oid'];
		$stmt->execute();
		$readrow = $stmt->fetch(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	$conn = null;
	?>

	<div class="container-fluid">
		<div class="row justify-content-md-center">
			<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 ">
				<div class="card m-5 shadow rounded">
					<div class="card-title p-2 text-center cardHeader"><strong>Order Details</strong></div>
					<div class="card-text p-2 text-center">
						Below are details of the order.
					</div>
					<table class="table mb-0">
						<tr>
							<td class="col-xs-4 col-sm-4 col-md-4"><strong>Order ID</strong></td>
							<td><?php echo $readrow['fld_order_num'] ?></td>
						</tr>
						<tr>
							<td><strong>Order Date</strong></td>
							<td><?php echo $readrow['fld_order_date'] ?></td>
						</tr>
						<tr>
							<td><strong>Staff</strong></td>
							<td><?php echo $readrow['fld_staff_name']; ?></td>
						</tr>
						<tr>
							<td><strong>Customer</strong></td>
							<td><?php echo $readrow['fld_customer_name']; ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div class="row justify-content-md-center">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
				<div class="pb-2 mt-4 mb-4 borderBot">
					<h2>Add a Product</h2>
				</div>
				<form action="orders_details.php" method="post" class="form-horizontal mb-4 p-4 rounded shadow" name="frmorder" id="forder" onsubmit="return validateForm()">
					<div class="form-group mb-2">
						<label for="prd" class="col-sm-3 form-label">Product</label>
						<div class="col-sm-9">
							<select name="pid" class="form-control form-text" id="prd">
								<option value="" disabled selected>Please select</option>
								<?php
								try {
									$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
									$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
									$stmt = $conn->prepare("SELECT * FROM tbl_products_a175139_pt2");
									$stmt->execute();
									$result = $stmt->fetchAll();
								}
								catch(PDOException $e){
									echo "Error: " . $e->getMessage();
								}
								foreach($result as $productrow) {
									?>
									<option value="<?php echo $productrow['fld_product_num']; ?>"><?php echo $productrow['fld_product_material']." (".$productrow['fld_product_category'].") ".$productrow['fld_product_name']; ?></option>
									<?php
								}
								$conn = null;
								?>
							</select>
							<div class="invalid-feedback">
								Please select one product
							</div>
						</div>
					</div>
					<div class="form-group mb-4">
						<label for="qty" class="col-sm-3 form-label">Quantity</label>
						<div class="col-sm-9">
							<input name="quantity" type="number" class="form-control form-text" id="qty" min="1">
							<div class="invalid-feedback">
								Please enter quantity
							</div>
						</div>
					</div>
					<div class="form-group mb-5">
						<div class="col-sm-offset-3 col-sm-9">
							<input name="oid" type="hidden" value="<?php echo $readrow['fld_order_num'] ?>">
							<button class="btn btn-outline-success" type="submit" name="addproduct"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Product</button>
							<button class="btn btn-outline-warning" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row justify-content-md-center">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
				<div class="pb-2 mt-4 mb-2 borderBot">
					<h2>Products in This Order</h2>
				</div>
				<table class="table table-striped table-hover align-middle mt-4 shadow">
					<tr class="tableHeader">
						<th>Order Detail ID</th>
						<th>Product</th>
						<th>Quantity</th>
						<th></th>
					</tr>
					<?php
					try {
						$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$stmt = $conn->prepare("SELECT * FROM tbl_orders_details_a175139,
							tbl_products_a175139_pt2 WHERE
							tbl_orders_details_a175139.fld_product_num = tbl_products_a175139_pt2.fld_product_num AND
							fld_order_num = :oid");
						$stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
						$oid = $_GET['oid'];
						$stmt->execute();
						$result = $stmt->fetchAll();
						$count = count($result);
						echo "<script>console.log(".$count.");</script>";
					}
					catch(PDOException $e){
						echo "Error: " . $e->getMessage();
					}
					foreach($result as $detailrow) {
						?>
						<tr>
							<td><?php echo $detailrow['fld_order_detail_num']; ?></td>
							<td><?php echo $detailrow['fld_product_name']; ?></td>
							<td><?php echo $detailrow['fld_order_detail_quantity']; ?></td>
							<td>
								<a href="orders_details.php?delete=<?php echo $detailrow['fld_order_detail_num']; ?>&oid=<?php echo $_GET['oid']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-outline-danger btn-xs" role="button">Delete</a>
							</td>
						</tr>
					<?php } ?>
				</table>
			</div>
		</div>

		<?php
			if ($count != 0) {
		?>
		<div class="row justify-content-md-center">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
				<a href="invoice.php?oid=<?php echo $_GET['oid']; ?>" target="_blank" role="button" class="btn btn-outline-primary btn-lg btn-block text-center">Generate Invoice</a>
			</div>
		</div>
	<?php }else{ ?>
		<!-- ROLE MESSAGES -->
		<div class="accordion w-50" style="margin: 0 auto; display: block;">
			<div class="card">
				<div class="card-header" id="headingMsg">
					<h5 class="mb-0">
						<button type="reset" class="btn btn-warning" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						Order note:
						</button>
					</h5>
				</div>

				<div id="collapseOne" class="collapse show" aria-labelledby="headingMsg" data-parent="#accordion">
					<div class="card-body">
						To generate an invoice, please enter products in this order.
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
		<br>
	</div>

	<script type="text/javascript">

		function validateForm() {

			var x = document.forms["frmorder"]["pid"].value;
			var y = document.forms["frmorder"]["quantity"].value;
	      	//var x = document.getElementById("prd").value;
	      	//var y = document.getElementById("qty").value;
	      	errorMsg = "-WARNING-\n\n";
	     	if (x == null || x == "") {
	    		errorMsg += "-Product must be selected-\n";
	      		document.forms["frmorder"]["pid"].focus();
	          	//document.getElementById("prd").focus();
	      	}
	      	if (y == null || y == "") {
	      		errorMsg += "-Quantity must be filled out-\n";
	      		document.forms["frmorder"]["quantity"].focus();
	          	//document.getElementById("qty").focus();
	      	}

	      	if(errorMsg !== "-WARNING-\n\n"){
	      		alert(errorMsg);
	      		return false;
	      	}

	    	return true;
	  }

	</script>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
	<?php include_once 'footer.php'; ?>
</body>
</html>