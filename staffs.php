<?php
include_once 'staffs_crud.php';
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
	<title>Unique Gift Shop Ordering System : Staffs</title>
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
					<h1>Create New Staffs</h1>
				</div>
				<form action="staffs.php" method="post" class="form-horizontal mt-4 p-4 rounded shadow" id="staffs-form">

					<div class="row">
					<div class="form-group col-3 mb-2 ">
						<label for="staffid" class="col-sm-3 form-label">ID</label>
						<div class="">
							<input name="sid" type="text" class="form-control form-text" id="staffid" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_num']; else echo $num; ?>" readonly placeholder="Staff ID" required>
						</div>
					</div>

					<div class="form-group col-9 mb-2">
						<label for="staffname" class="col-sm-3 form-label">Name</label>
						<div class="">
							<input name="name" type="text" class="form-control form-text" id="staffname" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_name']; ?>" placeholder="Name" required>
						</div>
					</div>
					</div>

					<div class="form-group mb-2">
						<label for="email" class="col-sm-3 form-label">Email</label>
						<div class="">
							<input name="email" type="email" class="form-control form-text" id="email" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_email']; ?>" placeholder="Email" required>
						</div>
					</div>

					<div class="form-group mb-4">
						<label for="password" class="col-sm-3 form-label">Password</label>
						<div class="">
							<input name="password" type="password" class="form-control form-text" id="password" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_password']; ?>" placeholder="Password" required>
						</div>
					</div>

					<div class="form-group mb-4">
						<label for="staffsex" class="col-sm-3 form-label">
							Gender
						</label>
						<div class="col-sm-9">
							<div class="radio">
								<label>
									<input name="gender" type="radio" value="Male" id="staffsex" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_gender']=="Male") echo "checked"; ?> required class="form-check-input"> Male
								</label>
							</div>
							<div class="radio">
								<label>
									<input name="gender" class="form-check-input" type="radio" value="Female" id="staffsex" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_gender']=="Female") echo "checked"; ?>> Female
								</label>
							</div>
						</div>
					</div>

					<div class="form-group mb-2">
						<label for="age" class="col-sm-3 form-label">Age</label>
						<div class="">
							<input type="number" name="age" class="form-control form-text" id="age" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_age']; ?>" required placeholder="Age">
						</div>
					</div>

					<div class="form-group mb-4">
						<label for="phonenumber" class="col-sm-3 form-label">Phone Number</label>
						<div class="">
							<input name="phone" type="text" class="form-control  form-text" id="phonenumber" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_phone']; ?>" required placeholder="Phone Number E.g.(012-3456789)">
						</div>
					</div>

					<div class="form-group mb-4">
						<label for="stafflevel" class="col-sm-3 form-label">
							Staff Level
						</label>
						<div class="col-sm-9">
							<div class="radio">
								<label>
									<input name="role" class="form-check-input" type="radio" value="admin" id="stafflevel" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_level']=="admin") echo "checked"; ?> required> Admin
								</label>
							</div>
							<div class="radio">
								<label>
									<input name="role" class="form-check-input" type="radio" value="staff" id="stafflevel" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_level']=="staff") echo "checked"; ?>> Normal Staff
								</label>
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
									<input type="hidden" name="oldsid" value="<?php echo $editrow['fld_staff_num']; ?>">
									<button type="submit" name="update" class="btn btn-outline-success">Update</button>
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
										Normal staff cannot create, update or delete any staff information. Only staff at admin level can make the change.
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
					<h1>Staffs List</h1>
				</div>
				<table class="table table-striped table-hover align-middle mt-4 shadow">
					<tr class="tableHeader">
						<th>Customer ID</th>
						<th>Name</th>
						<th>Email</th>
						<th>Gender</th>
						<th>Age</th>
						<th>Phone Number</th>
						
						<?php 
						if (isset($_SESSION['admin_role'])) {
							echo "<th>Staff Level</th>";
							echo "<th></th>";
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
						$stmt = $conn->prepare("select * from tbl_staffs_a175139_pt2 LIMIT $start_from, $per_page");
						$stmt->execute();
						$result = $stmt->fetchAll();
					}
					catch(PDOException $e){
						echo "Error: " . $e->getMessage();
					}
					foreach($result as $readrow) { ?>
						<tr>
							<td><?php echo $readrow['fld_staff_num']; ?></td>
							<td><?php echo $readrow['fld_staff_name']; ?></td>
							<td><?php echo $readrow['fld_staff_email']; ?></td>
							<td><?php echo $readrow['fld_staff_gender']; ?></td>
							<td><?php echo $readrow['fld_staff_age']; ?></td>
							<td><?php echo $readrow['fld_staff_phone']; ?></td>

							<?php
							if(isset($_SESSION['admin_role'])){
								?>
								<td><?php echo ucwords($readrow['fld_staff_level']); ?></td>
								<td>
									<a href="staffs.php?edit=<?php echo $readrow['fld_staff_num']; ?>" class="btn btn-outline-success btn-xs" role="button"> Edit </a>
									<a href="staffs.php?delete=<?php echo $readrow['fld_staff_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-outline-danger btn-xs" role="button">Delete</a>
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
							$stmt = $conn->prepare("SELECT * FROM tbl_staffs_a175139_pt2");
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
							<li class="page-item"><a href="staffs.php?page=<? echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true" class="page-link arrowColor">«</span></a></li>
							<?php
						}
						for($i=1; $i<=$total_pages; $i++)
							if($i==$page)
								echo "<li class=\"active page-item\"><a href=\"staffs.php?page=$i\" class=\"bgColor\">$i</a></li>";
							else
								echo "<li class=\"page-item\"><a href=\"staffs.php?page=$i\" class=\"bgNotActive\">$i</a></li>";
							?>
							<?php if($page==$total_pages) { ?>
								<li class="disabled page-link"><span aria-hidden="true" class="arrowColor">»</span></li>
							<?php } else { ?>
								<li class="page-link"><a href="staffs.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true" class="arrowColor">»</span></a></li>
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
			var staffID = document.getElementById("staffid").value;
			var staffPhone = document.getElementById("phonenumber").value;
			var staffGender = document.querySelector("input[name='gender']:checked");
			var staffName = document.getElementById("staffname").value;
			var age = document.getElementById("age").value;
			var staffEmail = document.getElementById("email").value;
			var staffPass = document.getElementById("password").value;
			var level = document.querySelector("input[name='role']:checked");
			var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

			var firstletter = staffID.slice(0, 1);
			var lastword = staffID.slice(1, staffID.length);
			var dashphone = staffPhone.slice(3, 4);

			var errorMsg="-WARNING-\n\n";
				// console.log(lastword);
				// console.log(firstletter);
				// console.log(staffPhone + dashphone);
				// if(firstletter !== 'S'){
				// 	alert('Please use capital "S" letter for staff ID');
				// 	return false;
				// }
				if(staffName == ""){
					errorMsg += '-Please enter staff name-\n';
				}
				if(staffEmail == ""){
					errorMsg += '-Please enter staff email-\n';
				}else if(!(validRegex.test(staffEmail))){
					errorMsg += '-Please use gmail account-\n';
				}
				if(staffPass == ""){
					errorMsg += '-Please enter staff password-\n';
				}else if(staffPass.length < 6){
					errorMsg += '-Please enter password more than 6 characters-\n';
				}
				if(staffGender == null){
					errorMsg += '-Please choose a gender-\n';
				}
				if(age.length == 0){
					errorMsg += '-Please enter staff age-\n';
				}
				if(staffPhone.length == 0){
					errorMsg += '-Please enter staff phone number-\n';
				}
				else if(dashphone !== '-'){
					errorMsg +='-Please enter the correct phone number with dash-\n';
				}
				else if(staffPhone.length > 11){
					errorMsg += '-Please enter staff phone number correctly-\n';
				}
				if(level == null){
					errorMsg +='-Please choose staff level-\n';
				}

				if(errorMsg !== "-WARNING-\n\n"){
					alert(errorMsg);
					return false
				}
				return true;
			}
		</script>
		</html>