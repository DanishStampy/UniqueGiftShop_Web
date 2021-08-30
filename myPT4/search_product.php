<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/design.css">
<?php
	require 'database.php';
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if(!$conn){
		die("Error: Failed to coonect to database!");
	}

	if (isset($_POST['search'])) {
?>
	<div class="row justify-content-md-center" style="margin-right: 0">
		<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
			<div class="pb-2 mt-4 mb-2 borderBot">
				<h2>Products List</h2>
			</div>
			<table class="table table-striped table-hover align-middle mt-4">
				<tr class="tableHeader">
					<th>Product ID</th>
					<th>Name</th>
					<th>Price</th>
					<th>Category</th>
					<th>Color</th>
					<th>Material</th>
					<th>In-Stock Quantity</th>
					<th></th>
				</tr>

				<?php
					$keyword = $_POST['keywords'];
					$aKeyword = explode(" ", $keyword);
					$q = "SELECT * FROM `tbl_products_a175139_pt2` WHERE `fld_product_name` LIKE '%". $aKeyword[0] ."%' OR `fld_product_category` LIKE '%". $aKeyword[0] ."%' OR `fld_product_material` LIKE '%". $aKeyword[0] ."%'";

					for ($i=1; $i < count($aKeyword) ; $i++) { 
						if(!empty($aKeyword[$i])){
							$q .= " OR `fld_product_name` LIKE '%" . $aKeyword[$i] . "%' OR `fld_product_category` LIKE '%" . $aKeyword[$i] . "%' OR `fld_product_material` LIKE '%" . $aKeyword[$i] . "%'";
						}
					}

					$query = $conn->prepare($q);
					$query->execute();
					$countRow = $query->rowCount();

					if($countRow > 0){
					while ($row = $query->fetch()) {
				?>
				<tr>
					<td><?php echo $row['fld_product_num'] ?></td>
					<td><?php echo $row['fld_product_name'] ?></td>
					<td><?php echo $row['fld_product_price'] ?></td>
					<td><?php echo $row['fld_product_category'] ?></td>
					<td><input type="color" value="<?php echo $row['fld_product_color']; ?>" disabled style="border-style: none;"></td>
					<td><?php echo $row['fld_product_material'] ?></td>
					<td><?php echo $row['fld_product_quantity'] ?></td>
					<td>
							<a href="products_details.php?pid=<?php echo $row['fld_product_num']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
						</td>
				</tr>
				<?php
					}
				}else{
					// echo $countRow;
				?>
				
			</table>

				<p>No results found...</p>
				<?php
				}
				?>
		</div>
		
	</div>
<?php
	}else{
?>
<!-- This is PRODUCT LIST -->

	<div class="row justify-content-md-center" style="margin-right: 0;">
		<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
			<div class="pb-2 mt-4 mb-2 borderBot">
				<h2>Products List</h2>
			</div>
			<table class="table table-striped table-hover align-middle mt-4 shadow">
				<tr class="tableHeader">
					<th>Product ID</th>
					<th>Name</th>
					<th>Price</th>
					<th>Category</th>
					<th>Color</th>
					<th>Material</th>
					<th>In-Stock Quantity</th>
					<th></th>
				</tr>
				<?php
				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("select * from tbl_products_a175139_pt2");
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
						<td><?php echo $readrow['fld_product_quantity']; ?></td>
						<td>
							<a href="products_details.php?pid=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
						</td>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>
	
	<?php
		}
	?>