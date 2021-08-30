<?php

include_once 'database.php';

$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Create
if (isset($_POST['create'])) {

  try {

    $stmt = $conn->prepare("INSERT INTO tbl_staffs_a175139_pt2(fld_staff_num, fld_staff_name, fld_staff_gender, fld_staff_age, fld_staff_phone, fld_staff_email, fld_staff_password, fld_staff_level) VALUES(:sid, :name, :gender, :age, :phone, :email, :password, :level)");

    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(':age', $age, PDO::PARAM_INT);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->bindParam(':level', $level, PDO::PARAM_STR);

    $sid = $_POST['sid'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $level = $_POST['role'];

    $stmt->execute();
    header("location: staffs.php");
  }

  catch(PDOException $e)
  {
    echo "Error: " . $e->getMessage();
  }
}

//Update
if (isset($_POST['update'])) {

  try {

    $stmt = $conn->prepare("UPDATE tbl_staffs_a175139_pt2 SET fld_staff_num = :sid, fld_staff_name = :name, fld_staff_gender = :gender, fld_staff_age = :age, fld_staff_phone = :phone, fld_staff_email = :email, fld_staff_password = :password, fld_staff_level = :level WHERE fld_staff_num = :oldsid");

    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(':age', $age, PDO::PARAM_INT);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->bindParam(':level', $level, PDO::PARAM_STR);
    $stmt->bindParam(':oldsid', $oldsid, PDO::PARAM_STR);

    $sid = $_POST['sid'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $level = $_POST['role'];
    $oldsid = $_POST['oldsid'];

    $stmt->execute();

    header("Location: staffs.php");
  }

  catch(PDOException $e)
  {
    echo "Error: " . $e->getMessage();
  }
}

//Delete
if (isset($_GET['delete'])) {

  try {

    $stmt = $conn->prepare("DELETE FROM tbl_staffs_a175139_pt2 where fld_staff_num = :sid");

    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);

    $sid = $_GET['delete'];

    $stmt->execute();

    header("Location: staffs.php");
  }

  catch(PDOException $e)
  {
    echo "Error: " . $e->getMessage();
  }
}

//Edit
if (isset($_GET['edit'])) {

  try {

    $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a175139_pt2 where fld_staff_num = :sid");

    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);

    $sid = $_GET['edit'];

    $stmt->execute();

    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
  }

  catch(PDOException $e)
  {
    echo "Error: " . $e->getMessage();
  }
}

$num = $conn->query("SELECT MAX(fld_staff_num) AS pid FROM tbl_staffs_a175139_pt2")->fetch()['pid'];

  if($num){
    $num = ltrim($num, 'S')+1;
    $num = 'S'.str_pad($num, 3, "0", STR_PAD_LEFT);
  }else{
    $num = 'S'.str_pad(1,3,"0",STR_PAD_LEFT);
  }

$conn = null;

?>