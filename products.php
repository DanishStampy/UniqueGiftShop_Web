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
	<link rel="stylesheet" type="text/css" href="css/design.css">
</head>
<body style="background-color: #EDF0DA;">

	<!-- THIS IS NAVIGATION BAR -->
	<?php include_once 'nav_bar.php'; ?>

	<div class="container-fluid">
		<div class="row justify-content-md-center">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-3">
				<div class="pb-2 mt-4 mb-2 borderBot">
					<?php
					if(isset($_GET['edit'])){
						echo '<h1>Edit '.$editrow['fld_product_num'].' Product</h1>';
					}else{
						echo "<h1>Create New Product</h1>";
					}
					?>
					
				</div>
				<form action="products.php" method="post" class="row mt-4 mb-4 p-4 rounded shadow" enctype="multipart/form-data" id="products-form">
					<div class="col-8">

						<div class="row">
							<div class="form-group col-3 mb-2">
								<label for="productid" class="col-sm-3 form-label">ID</label>
								<div class="">
									<input name="pid" type="text" class="form-control form-text" id="productid" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_num']; else echo $num; ?>" readonly placeholder="Product ID" required>
								</div>
							</div>

							<div class="form-group col-9 mb-2">
								<label for="productname" class="col-sm-3 form-label">Name</label>
								<div class="">
									<input name="name" type="text" class="form-control form-text" id="productname" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>" placeholder="Product Name" required>
									<div class="invalid-feedback">
										Please enter product's name
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group col-6 mb-2">
								<label for="productprice" class="col-sm-3 form-label">Price (RM)</label>
								<div class="">
									<input name="price" type="number" class="form-control form-text" id="productprice" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>" placeholder="Product Price" min="0" required>
									<div class="invalid-feedback">
										Please enter product's price
									</div> 
								</div>
							</div>

							<div class="form-group col-6">
								<label for="productcategory" class="col-sm-3 form-label">
									Category
								</label>
								<div class="">
									<select name="category" class="form-control mb-2 form-text" id="productcategory" required>
										<option value="" readonly selected>Please select</option>
										<option value="Home Decoration" <?php if(isset($_GET['edit'])) if($editrow['fld_product_category']=="Home Decoration") echo "selected"; ?>>Home Decoration</option>
										<option value="Kitchen Accessories" <?php if(isset($_GET['edit'])) if($editrow['fld_product_category']=="Kitchen Accessories") echo "selected"; ?>>Kitchen Accessories</option>
										<option value="Jewelry & Accessories" <?php if(isset($_GET['edit'])) if($editrow['fld_product_category']=="Jewelry & Accessories") echo "selected"; ?>>Jewelry & Accessories</option>
										<option value="Keychain" <?php if(isset($_GET['edit'])) if($editrow['fld_product_category']=="Keychain") echo "selected"; ?>>Keychain</option>
										<option value="Fridge Magnet" <?php if(isset($_GET['edit'])) if($editrow['fld_product_category']=="Fridge Magnet") echo "selected"; ?>>Fridge Magnet</option>
										<option value="Toy & Entertainment" <?php if(isset($_GET['edit'])) if($editrow['fld_product_category']=="Toy & Entertainment") echo "selected"; ?>>Toy & Entertainment</option>
									</select>
									<div class="invalid-feedback">
										Please enter product's category
									</div>
								</div>
							</div>
						</div>


						<div class="row mb-2">
							<div class="form-group col-6">
								<label for="productmaterial" class="form-label">Product Material</label>
								<div class="">
									<input name="material" type="text" class="form-control form-text" id="productmaterial" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_material']; ?>" min="0" placeholder="Product Material" required>
									<div class="invalid-feedback">
										Please enter product's material
									</div>
								</div>
							</div>

							<div class="form-group col-6">
								<label for="productq" class="col-sm-3 form-label">Quantity</label>
								<div class="">
									<input name="quantity" type="number" class="form-control form-text" id="productq" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_quantity']; ?>" placeholder="Product Quantity" min="0" required>
									<div class="invalid-feedback">
										Please enter product's stock
									</div>
								</div>
							</div>
						</div>

						<div class="form-group mb-4">
							<label for="productcolor" class="col-sm-3 form-label">Color</label>
							<div class="col-sm-9">
								<input type="color" name="color" id="productcolor" class="form-control form-text" required value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_color']; ?>" style="width: 20%; height: 50px;">
								<div class="invalid-feedback">
										Please enter product's color
									</div>
							</div>
						</div>

						<?php
						if(isset($_SESSION['admin_role'])){
							?>

							<!-- UPDATE, CREATE AND CLEAR BUTTON -->
							<div class="form-group">
								<div class="col-md-offset-3 col-sm-9">
									<?php if (isset($_GET['edit'])) { ?>
										<input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_num']; ?>">
										<button type="submit" name="update" class="btn btn-outline-success" onclick="return checkValidation();">Update</button>
									<?php } else { ?>
										<button type="submit" name="create" class="btn btn-outline-success" onclick="return checkValidation();">Create</button>
									<?php } ?>
									<button type="reset" class="btn btn-outline-warning">Clear</button>
								</div>
							</div>

							<?php
						}else{
							?>

							<!-- ROLE MESSAGES -->
							<div class="accordion">
								<div class="card">
									<div class="card-header" id="headingMsg">
										<h5 class="mb-0">
											<button type="reset" class="btn btn-warning" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
												Important Message for Normal Staff
											</button>
										</h5>
									</div>

									<div id="collapseOne" class="collapse show" aria-labelledby="headingMsg" data-parent="#accordion">
										<div class="card-body">
											Normal staff cannot create, update or delete any product information. Only staff at admin level can make the change.
										</div>
									</div>
								</div>
							</div>



						<?php } ?>

					</div>

					<!-- IMAGE INPUT --> 
					<div class="col-4">
						<div class="form-group">
							<label for="productimg" class="form-label">Picture of Product</label>
							<div class="text-center">
								<img src="<?php if(isset($_GET['edit'])) echo 'products/'.$editrow['fld_product_image']; else echo 'products/default.png'; ?>" class="img-thumbnail rounded" id="output">
							</div>
							<div class="mt-3">
								<label for="file" class="form-label">Choose picture from a local disk.</label>
								<input class="form-control" type="file" id="file" name="img" accept="image/*" onchange="loadFile(event)" <?php if(!isset($_GET['edit'])) echo 'required'; ?> >
								<div class="invalid-feedback">
										Please enter product's image
								</div>
							</div>
						</div>
					</div>

				</form>
			</div>
		</div>
		

		<div class="row justify-content-md-center">
			<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-2">
				<div class="pb-2 mt-4 mb-2 borderBot">
					<h1>Products List</h1>
				</div>
				<table class="table table-striped table-hover align-middle mt-4 shadow w-100">
					<tr class="tableHeader">
						<th>Product ID</th>
						<th>Name</th>
						<th>Price</th>
						<th>Category</th>
						<th>Color</th>
						<th>Material</th>
						<th>Image</th>
						<th>In-Stock Quantity</th>
						<th></th>
					</tr>
					<?php
					$per_page = 5;
					if (isset($_GET["page"]))
						$page = $_GET["page"];
					else
						$page = 1;
					$start_from = ($page-1) * $per_page;
					try {
						$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$stmt = $conn->prepare("select * from tbl_products_a175139_pt2 LIMIT $start_from, $per_page");
						$stmt->execute();
						$result = $stmt->fetchAll();
					}
					catch(PDOException $e){
						echo "Error: " . $e->getMessage();
					}
					foreach($result as $readrow) { ?>
						<tr>
							<td><?php echo $readrow['fld_product_num']; ?></td>
							<td><?php echo $readrow['fld_product_name']; ?></td>
							<td><?php echo 'RM'.$readrow['fld_product_price']; ?></td>
							<td><?php echo $readrow['fld_product_category']; ?></td>
							<td><input type="color" value="<?php echo $readrow['fld_product_color']; ?>" disabled style="border-style: none;"></td>
							<td><?php echo $readrow['fld_product_material']; ?></td>
							<td><?php echo '<img style="width: 100px;" src="products/'.$readrow['fld_product_image'].'">'; ?></td>
							<td class="text-center"><?php echo $readrow['fld_product_quantity']; ?></td>

							<?php
							if(isset($_SESSION['admin_role'])){
								?>
								<td>
									<a href="products_details.php?pid=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-outline-warning btn-xs" role="button">Details</a>
									<a href="products.php?edit=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-outline-success btn-xs" role="button"> Edit </a>
									<a href="products.php?delete=<?php echo $readrow['fld_product_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-outline-danger btn-xs" role="button">Delete</a>
								</td>
								<?php
							}else{
								?>
								<td>
									<a href="products_details.php?pid=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-outline-warning btn-xs" role="button">Details</a>
								</td>
								<?php
							}
							?>
						</tr>
					<?php } ?>
				</table>
			</div>
		</div>
		<div class="row justify-content-md-center">
			<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
				<nav>
					<ul class="pagination justify-content-center">
						<?php  
						try{
							$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
							$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$stmt = $conn->prepare("SELECT * FROM tbl_products_a175139_pt2");
							$stmt->execute();
							$result = $stmt->fetchAll();
							$total_records = count($result);
						}
						catch(PDOException $e){
							echo "Error: ".$e->getMessage();
						}
						$total_pages = ceil($total_records/$per_page);
						?>
						<?php if($page==1) { ?>
							<li class="disabled page-link"><span aria-hidden="true" class="arrowColor">«</span></li>
						<?php } else { ?>
							<li class="page-item"><a href="products.php?page=<? echo $page-1 ?>" aria-label="Previous" class="page-link arrowColor"><span aria-hidden="true">«</span></a></li>
							<?php
						}
						for($i=1; $i<=$total_pages; $i++)
							if($i==$page)
								echo "<li class=\"active page-item\"><a href=\"products.php?page=$i\" class=\"bgColor\">$i</a></li>";
							else
								echo "<li class=\"page-item\"><a href=\"products.php?page=$i\" class=\"bgNotActive\">$i</a></li>";
							?>
							<?php if($page==$total_pages) { ?>
								<li class="disabled page-link"><span aria-hidden="true" class="arrowColor">»</span></li>
							<?php } else { ?>
								<li class="page-link"><a href="products.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true" class="arrowColor">»</span></a></li>
							<?php } ?>
						</ul>
					</nav>
				</div>
			</div>

		</div>

		<?php include_once 'footer.php'; ?>
		<script>
			var loadFile = function(event) {
				var image = document.getElementById('output');
				image.src = URL.createObjectURL(event.target.files[0]);
			};

			function checkValidation(){
				var productID = document.getElementById("productid").value;
				var productName = document.getElementById("productname").value;
				var productPrice = document.getElementById("productprice").value;
				var productCategory = document.getElementById("productcategory").value;
				var productQuantity = document.getElementById("productq").value;
				var productMaterial = document.getElementById("productmaterial").value;

				var firstletter = productID.slice(0, 1);
				var lastword = productID.slice(1, productID.length);

				var errorMsg = "-WARNING-\n\n";
				// console.log(lastword);
				// console.log(firstletter);
				// if(firstletter !== 'P'){
				// 	alert('Please use capital "P" letter for product ID');
				// 	return false;
				// }
				if(productName == ""){
					errorMsg += '-Please enter product name-\n';
				}
				if(productPrice == ""){
					errorMsg += '-Please enter product price-\n';
				}
				if(productCategory == ""){
					errorMsg += '-Please choose a product category-\n';
				}
				if(productMaterial == ""){
					errorMsg += '-Please enter product material-\n';
				}
				if(productQuantity == ""){
					errorMsg += '-Please enter a product quantity-\n';
				}

				if(errorMsg !== "-WARNING-\n\n"){
					alert(errorMsg);
					return false;
				}

				return true;
			}
		</script>
	</body>
	</html>