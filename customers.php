<?php
include_once 'customers_crud.php';
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
	<title>Unique Gift Shop Ordering System : Customers</title>
	<link rel="icon" href="img/logoonly.png" type="image/icon type">
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/design.css">
</head>
<body style="background-color: #EDF0DA;">
	
	<?php include_once 'nav_bar.php'; ?>

	<div class="container-fluid">
		<div class="row justify-content-md-center">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
				<div class="pb-2 mt-4 mb-2 borderBot">
					<h1>Create New Customer</h1>
				</div>
				<form action="customers.php" method="post" id="customers-form" class="form-horizontal mt-4 p-4 rounded shadow">

					<div class="row">
					<div class="form-group col-3 mb-2">
						<label for="customerid" class="col-sm-3 form-label">ID</label>
						<div class="">
							<input name="cid" type="text" class="form-control form-text" id="customerid" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_num']; else echo $num;?>" placeholder="Customer ID" required readonly>
						</div>
					</div>

					<div class="form-group col-9 mb-2">
						<label for="customername" class="col-sm-3 form-label">Name</label>
						<div class="">
							<input name="name" type="text" class="form-control" id="customername" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_name']; ?>" placeholder="Name" required>
						</div>
					</div>
					</div>

					<div class="form-group mb-4">
						<label for="customersex" class="col-sm-3 form-label">
							Gender
						</label>
						<div class="col-sm-9">
							<div class="radio">
								<label>
									<input name="gender" type="radio" value="Male" id="customersex" <?php if(isset($_GET['edit'])) if($editrow['fld_customer_gender']=="Male") echo "checked"; ?> required class="form-check-input"> Male
								</label>
							</div>
							<div class="radio">
								<label>
									<input name="gender" type="radio" value="Female" id="customersex" <?php if(isset($_GET['edit'])) if($editrow['fld_customer_gender']=="Female") echo "checked"; ?> required class="form-check-input"> Female
								</label>
							</div>
						</div>
					</div>

					<div class="form-group mb-4">
						<label for="phonenumber" class="col-sm-3 form-label">Phone Number</label>
						<div class="">
							<input name="phone" type="text" class="form-control" id="phonenumber" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_phone']; ?>" required placeholder="Phone Number E.g.(012-3456789)">
						</div>
					</div>

					<?php
					if(isset($_SESSION['admin_role'])){
						?>

						<!-- UPDATE, CREATE AND CLEAR BUTTON -->
						<div class="form-group">
							<div class="col-md-offset-3 col-sm-9">
								<?php if (isset($_GET['edit'])) { ?>
									<input type="hidden" name="oldcid" value="<?php echo $editrow['fld_customer_num']; ?>">
									<button type="submit" name="update" class="btn btn-outline-success" onclick="return checkValidation();">Update</button>
								<?php } else { ?>
									<button type="submit" name="create" class="btn btn-outline-success" onclick="return checkValidation();">Create</button>
								<?php } ?>
								<button type="reset" class="btn btn-outline-warning"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span>Clear</button>
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
										Normal staff cannot create, update or delete any customer information. Only staff at admin level can make the change.
									</div>
								</div>
							</div>
						</div>

					<?php } ?>
				</form>
			</div>
		</div>

		<div class="row justify-content-md-center">
			
			<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
				<div class="pb-2 mt-4 mb-2 borderBot">
					<h1>Customers List</h1>
				</div>
				<table class="table table-striped table-hover align-middle mt-4 shadow">
					<tr class="tableHeader">
						<th>Customer ID</th>
						<th>Name</th>
						<th>Gender</th>
						<th>Phone Number</th>

						<?php
						if(isset($_SESSION['admin_role'])){
							echo '<th></th>';
						}
						?>
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
						$stmt = $conn->prepare("select * from tbl_customers_a175139_pt2 LIMIT $start_from, $per_page");
						$stmt->execute();
						$result = $stmt->fetchAll();
					}
					catch(PDOException $e){
						echo "Error: " . $e->getMessage();
					}
					foreach($result as $readrow) { ?>
						<tr>
							<td><?php echo $readrow['fld_customer_num']; ?></td>
							<td><?php echo $readrow['fld_customer_name']; ?></td>
							<td><?php echo $readrow['fld_customer_gender']; ?></td>
							<td><?php echo $readrow['fld_customer_phone']; ?></td>

							<?php
							if (isset($_SESSION['admin_role'])) {
								?>
								<td>
									<a href="customers.php?edit=<?php echo $readrow['fld_customer_num']; ?>" class="btn btn-outline-success btn-xs" role="button"> Edit </a>
									<a href="customers.php?delete=<?php echo $readrow['fld_customer_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-outline-danger btn-xs" role="button">Delete</a>
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
							$stmt = $conn->prepare("SELECT * FROM tbl_customers_a175139_pt2");
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
							<li class="page-item"><a href="customers.php?page=<? echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true" class="page-link arrowColor">«</span></a></li>
							<?php
						}
						for($i=1; $i<=$total_pages; $i++)
							if($i==$page)
								echo "<li class=\"active page-item\"><a href=\"customers.php?page=$i\" class=\"bgColor\">$i</a></li>";
							else
								echo "<li class=\"page-item\"><a href=\"customers.php?page=$i\" class=\"bgNotActive\">$i</a></li>";
							?>
							<?php if($page==$total_pages) { ?>
								<li class="disabled page-link"><span aria-hidden="true" class="arrowColor">»</span></li>
							<?php } else { ?>
								<li class="page-link"><a href="customers.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true" class="arrowColor">»</span></a></li>
							<?php } ?>
						</ul>
					</nav>
				</div>
			</div>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		<?php include_once 'footer.php'; ?>
		
	</body>
	<script type="text/javascript">
		function checkValidation(){
			var custID = document.getElementById("customerid").value;
			var custPhone = document.getElementById("phonenumber").value;
			var custGender = document.querySelector("input[name='gender']:checked");
			var custName = document.getElementById("customername").value;

			var firstletter = custID.slice(0, 1);
			var lastword = custID.slice(1, custID.length);
			var dashphone = custPhone.slice(3, 4);

				// console.log(lastword);
				// console.log(firstletter);

				var errorMsg="-WARNING-\n\n";
				// if(firstletter !== 'C'){
				// 	errorMsg +='Please use capital "C" letter for customer ID\n';
				// }
				if(custName == ""){
					errorMsg += '-Please enter customer name-\n';
				}
				if(custGender == null){
					errorMsg +='-Please choose a gender-\n';
				}
				if(custPhone.length > 11 || custPhone.length == 0){
					errorMsg +='-Please enter customer phone number-\n';
				}
				else if(dashphone !== '-'){
					errorMsg +='-Please enter the correct phone number with dash-\n';
				}

				if(errorMsg !== "-WARNING-\n\n"){
					alert(errorMsg);
					return false;
				}
				return true;
			}
		</script>
		</html>