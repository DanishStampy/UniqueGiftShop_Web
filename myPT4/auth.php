<?php
require_once 'database.php';

try{
	$db = new PDO("mysql:host={$servername}; dbname={$dbname}", $username, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
	$e->getMessage();
}

session_start();

if(isset($_SESSION['admin_role']) OR isset($_SESSION['staff_role'])){
		header("location: login.php");
	}	

if(isset($_POST['login'])){
	$email = $_POST['email'];
	$password = $_POST['password'];
	$role = $_POST['userlevel'];

	if(empty($email) || empty($password)){
		echo "<script>alert('Please fill in the blanks');</script>";
	}
	
	if(empty($role)){
		$errorMsg = "Please choose a role";
	}else if($email AND $password AND $role){

		try{
			$stmt = $db->prepare("SELECT fld_staff_name, fld_staff_email, fld_staff_password, fld_staff_level FROM tbl_staffs_a175139_pt2 WHERE fld_staff_email=:email AND fld_staff_password=:password AND fld_staff_level=:role");
			$stmt->bindParam(":email",$email);
			$stmt->bindParam(":password",$password);
			$stmt->bindParam(":role",$role);
			$stmt->execute();

			while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
				$dbname = $row['fld_staff_name'];
				$dbemail = $row['fld_staff_email'];
				$dbpassword = $row['fld_staff_password'];
				$dbrole = $row['fld_staff_level'];
			}
			if($email!=null AND $password!=null AND $role!=null){
				if($stmt->rowCount() > 0){
					if($email==$dbemail AND $password==$dbpassword AND $role==$dbrole){
						switch ($dbrole) {
							case 'admin':
								$_SESSION['admin_login'] = $email;
								$_SESSION['admin_name'] = $dbname;
								$_SESSION['admin_role'] = "Admin";
								header("location: index.php");
								break;

							case 'staff':
								$_SESSION['staff_login'] = $email;
								$_SESSION['staff_name'] = $dbname;
								$_SESSION['staff_role'] = "Staff";
								header("location: index.php");
								break;
							
							default:
								$errorMsg = "Wrong email or password or role yang ni";
						}
						
					}else{
						$errorMsg = "Wrong email or password or role this one";
					}
				}else{
					echo "<script>alert('Wrong email or password or role');</script>";
					// header("location: login.php");
				}
			}else{
				$errorMsg = "Wrong email or password or role 5";
			}
		}catch(PDOException $e){
			$e->getMessage();
		}
	}else{
		$errorMsg = "Email or password or role does not exist";
		echo "<script>console.log(' holla ".$password." ".$email."');</script>";
	}
	unset($password);
	unset($email);
	unset($role);
}
?>