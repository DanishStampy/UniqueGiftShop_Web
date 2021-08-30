<?php

include_once 'database.php';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Create
if (isset($_POST['create'])) {

  $target_dir = "products/";
  $target_file = $target_dir . basename($_FILES['img']['name']);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  $msg='IMAGE ERROR\n\n';

  //Check existing image file
  if(empty($_FILES['img']['name'])){
    echo "<script>alert('Please choose an image');</script>";
    $uploadOk = 0;
  }
  else{

    //if file already exist
    if (file_exists($target_file)) {
      $msg.='Sorry, file already exists.\n';
      $uploadOk = 0;
    }
    
    // Check if image file is a actal image or fake image
    $check = getimagesize($_FILES['img']['tmp_name']);
    if($check !== false)
      $uploadOk = 1;
    else{
      // echo "<script>alert('Selected file is not an image. Please choose a image');</script>";
      $msg.='Selected file is not an image. Please choose an image.\n';
      $uploadOk = 0;
    } 

    //Check file size
    if($_FILES['img']['size'] > 10000000){
      // echo "<script>alert('');</script>";
      $msg.='Selected image size is above 10MB. Please choose another image.\n';
      $uploadOk = 0;
    }

    //Allow certain formats
    if($imageFileType != "gif"){
      // echo "<script>alert('Only image file PNG, GIF and JPG type are accepted. Please choose another image');</script>";
      $msg.='Only image file GIF type are accepted. Please choose another image.\n';
      $uploadOk = 0;
    }
  }

  

  //Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    $msg.='Sorry your file was not uploaded.\n';
    echo "<script>alert('".$msg."');</script>";
  }else{

    if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {

      try {

        $stmt = $conn->prepare("INSERT INTO tbl_products_a175139_pt2(fld_product_num,
          fld_product_name, fld_product_price, fld_product_category, fld_product_color,
          fld_product_material, fld_product_quantity, fld_product_image) VALUES(:pid, :name, :price, :category,
          :color, :material, :quantity, :picture)");

        $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->bindParam(':color', $color, PDO::PARAM_STR);
        $stmt->bindParam(':material', $material, PDO::PARAM_STR);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':picture', $picture, PDO::PARAM_STR);

        $pid = $_POST['pid'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category =  $_POST['category'];
        $color = $_POST['color'];
        $material = $_POST['material'];
        $quantity = $_POST['quantity'];
        $picture = $_FILES['img']['name'];

        $stmt->execute();
        header("location: products.php");
      }

      catch(PDOException $e)
      {
        echo "Error: " . $e->getMessage();
      }
    }
  } 
}

//Update
if (isset($_POST['update'])) {

  $temp_image = basename($_FILES['img']['name']);

  if ($temp_image == "") {

    try {

      $stmt = $conn->prepare("UPDATE tbl_products_a175139_pt2 SET fld_product_num = :pid,
        fld_product_name = :name, fld_product_price = :price, fld_product_category = :category,
        fld_product_color = :color, fld_product_material = :material, fld_product_quantity = :quantity
        WHERE fld_product_num = :oldpid");

      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':category', $category, PDO::PARAM_STR);
      $stmt->bindParam(':color', $color, PDO::PARAM_STR);
      $stmt->bindParam(':material', $material, PDO::PARAM_STR);
      $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
      $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);

      $pid = $_POST['pid'];
      $name = $_POST['name'];
      $price = $_POST['price'];
      $category =  $_POST['category'];
      $color = $_POST['color'];
      $material = $_POST['material'];
      $quantity = $_POST['quantity'];
      $oldpid = $_POST['oldpid'];

      $stmt->execute();

      header("Location: products.php");
    }

    catch(PDOException $e)
    {
      echo "Error: " . $e->getMessage();
    }
  }else{

    $target_dir = "products/";
    $target_file = $target_dir . basename($_FILES['img']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $msg='IMAGE ERROR\n\n';

  // Check if image file is a actal image or fake image
    $check = getimagesize($_FILES['img']['tmp_name']);
    if($check !== false)
      $uploadOk = 1;
    else{
      // echo "<script>alert('Selected file is not an image. Please choose a image');</script>";
      $msg.='Selected file is not an image. Please choose a image\n';
      $uploadOk = 0;
    } 

    //if file already exist
    if (!file_exists($target_file)) {
      $uploadOk = 1;
    }else{
      $uploadOk = 0;
      $msg.='Sorry, file already exists.\n';
    }

  //Check file size
    if($_FILES['img']['size'] > 10000000){
      // echo "<script>alert('Selected image size is above 10MB. Please choose another image');</script>";
      $msg.='Selected image size is above 10MB. Please choose another image\n';
      $uploadOk = 0;
    }

  //Allow certain formats
    if($imageFileType != "gif"){
      // echo "<script>alert('Only image file PNG, GIF and JPG type are accepted. Please choose another image');</script>";
      $msg.='Only image file GIF type are accepted. Please choose another image\n';
      $uploadOk = 0;
    }

  //Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "<script>alert('".$msg."');</script>";
    }else{

      if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {

        try {
          //SELECT AND UNLINK IMAGE FILE
          $stmt = $conn->prepare("SELECT fld_product_image FROM tbl_products_a175139_pt2 WHERE fld_product_num = :pid");

          $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
          $pid = $_POST['pid'];
          $stmt->execute();
          $result = $stmt->fetch();

          $path = 'products/'.$result['fld_product_image'];
          unlink($path);

          $stmt = $conn->prepare("UPDATE tbl_products_a175139_pt2 SET fld_product_num = :pid, 
            fld_product_name = :name, fld_product_price = :price, fld_product_category = :category,
            fld_product_color = :color, fld_product_material = :material, fld_product_quantity = :quantity, fld_product_image =:picture 
            WHERE fld_product_num = :oldpid");

          $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
          $stmt->bindParam(':name', $name, PDO::PARAM_STR);
          $stmt->bindParam(':price', $price, PDO::PARAM_INT);
          $stmt->bindParam(':category', $category, PDO::PARAM_STR);
          $stmt->bindParam(':color', $color, PDO::PARAM_STR);
          $stmt->bindParam(':material', $material, PDO::PARAM_STR);
          $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
          $stmt->bindParam(':picture', $picture, PDO::PARAM_STR);
          $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);

          $pid = $_POST['pid'];
          $name = $_POST['name'];
          $price = $_POST['price'];
          $category =  $_POST['category'];
          $color = $_POST['color'];
          $material = $_POST['material'];
          $quantity = $_POST['quantity'];
          $picture = $_FILES['img']['name'];
          $oldpid = $_POST['oldpid'];

          $stmt->execute();
          header("location: products.php");
        }

        catch(PDOException $e)
        {
          echo "Error: " . $e->getMessage();
        }
      }
    } 
  }
}

//Delete
if (isset($_GET['delete'])) {

  try {
    // SELECT WHICH IMAGE FILE TO DELETE
    $stmt = $conn->prepare("SELECT fld_product_image FROM tbl_products_a175139_pt2 WHERE fld_product_num = :pid");

    $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
    $pid = $_GET['delete'];
    $stmt->execute();
    $result = $stmt->fetch();

    $path = 'products/'.$result['fld_product_image'];

    //DELETE IMAGE FILE AND OTHERS DATA
    $stmt = $conn->prepare("DELETE FROM tbl_products_a175139_pt2 WHERE fld_product_num = :pid");
  
    $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
    $pid = $_GET['delete'];

    if($path !== 'products/default.png'){
      unlink($path);
    }
    $stmt->execute();
    
    header("Location: products.php");
  }
  
  catch(PDOException $e)
  {
    echo "Error: " . $e->getMessage();
  }
}

//Edit
if (isset($_GET['edit'])) {

  try {

    $stmt = $conn->prepare("SELECT * FROM tbl_products_a175139_pt2 WHERE fld_product_num = :pid");
    
    $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
    
    $pid = $_GET['edit'];
    
    $stmt->execute();
    
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
  }
  
  catch(PDOException $e)
  {
    echo "Error: " . $e->getMessage();
  }
}

$num = $conn->query("SELECT MAX(fld_product_num) AS pid FROM tbl_products_a175139_pt2")->fetch()['pid'];

if($num){
  $num = ltrim($num, 'P')+1;
  $num = 'P'.str_pad($num, 3, "0", STR_PAD_LEFT);
}else{
  $num = 'P'.str_pad(1,3,"0",STR_PAD_LEFT);
}

$conn = null;
?>