<?php
include_once 'database.php';
?>
<?php
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT * FROM tbl_orders_a175139, tbl_staffs_a175139_pt2,
    tbl_customers_a175139_pt2, tbl_orders_details_a175139 WHERE
    tbl_orders_a175139.fld_staff_num = tbl_staffs_a175139_pt2.fld_staff_num AND
    tbl_orders_a175139.fld_customer_num = tbl_customers_a175139_pt2.fld_customer_num AND
    tbl_orders_a175139.fld_order_num = tbl_orders_details_a175139.fld_order_num AND
    tbl_orders_a175139.fld_order_num = :oid");
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

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Invoice</title>
  <link rel="icon" href="img/logoonly.png" type="image/icon type">
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
   
    <div class="row">
      <div class="col-6 text-center">
        <br>
        <img src="img/giftlogo.png" width="60%" height="80%">
      </div>
      <div class="col-6 text-end">
        <h1>INVOICE</h1>
        <h5>Order: <?php echo $readrow['fld_order_num'] ?></h5>
        <h5>Date: <?php echo $readrow['fld_order_date'] ?></h5>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-6">
        <div class="card card-default">
          <div class="card-header">
            <h4>From: Unique Gift Shop Sdn. Bhd.</h4>
          </div>
          <div class="card-body">
            <p>
              No. 8-A, Jalan Kristal J7/J <br>
              Seksyen 7 <br>
              40000 <br>
              Shah Alam, Selangor <br>
            </p>
          </div>
        </div>
      </div>
      <div class="col-6 col-xs-offset-2 text-end">
        <div class="card card-default">
          <div class="card-header">
            <h4>To : <?php echo $readrow['fld_customer_name']; ?></h4>
          </div>
          <div class="card-body">
            <p>
              Universiti Kebangsaan Malaysia (UKM) <br>
              43600 <br>
              Bangi, Selangor <br>
            </p>
          </div>
        </div>
      </div>
    </div>
    
    <table class="table table-bordered mt-3 mb-3">
      <tr>
        <th>No</th>
        <th>Product</th>
        <th class="text-right">Quantity</th>
        <th class="text-right">Price(RM)/Unit</th>
        <th class="text-right">Total(RM)</th>
      </tr>
      <?php
      $grandtotal = 0;
      $counter = 1;
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM tbl_orders_details_a175139,
          tbl_products_a175139_pt2 where 
          tbl_orders_details_a175139.fld_product_num = tbl_products_a175139_pt2.fld_product_num AND
          fld_order_num = :oid");
        $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
        $oid = $_GET['oid'];
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
        echo "Error: " . $e->getMessage();
      }
      foreach($result as $detailrow) {
        ?>
        <tr>
          <td><?php echo $counter; ?></td>
          <td><?php echo $detailrow['fld_product_name']; ?></td>
          <td class="text-right"><?php echo $detailrow['fld_order_detail_quantity']; ?></td>
          <td class="text-right"><?php echo $detailrow['fld_product_price']; ?></td>
          <td class="text-right"><?php echo $detailrow['fld_product_price']*$detailrow['fld_order_detail_quantity']; ?></td>
        </tr>
        <?php
        $grandtotal = $grandtotal + $detailrow['fld_product_price']*$detailrow['fld_order_detail_quantity'];
        $counter++;
  } // while
  ?>
  <tr>
    <td colspan="4" class="text-right">Grand Total</td>
    <td class="text-end"><?php echo $grandtotal ?></td>
  </tr>
</table>

<div class="row">
  <div class="col-5">
    <div class="card card-default">
      <div class="card-header">
        <h4>Bank Details</h4>
      </div>
      <div class="card-body">
        <p>Danish Irfan</p>
        <p>Bank Islam</p>
        <p>SWIFT : </p>
        <p>Account Number : </p>
        <p>IBAN : </p>
      </div>
    </div>
  </div>
  <div class="col-7">
    <div class="span7">
      <div class="card card-default">
        <div class="card-header">
          <h4>Contact Details</h4>
        </div>
        <div class="card-body">
          <p> Staff: <?php echo $readrow['fld_staff_name'];?> </p>
          <p> Email: <?php echo $readrow['fld_staff_email'] ?> </p>
          <p> Phone: <?php echo $readrow['fld_staff_phone'] ?> </p>
          <p><br></p>
          <p><br></p>
          <p>Computer-generated invoice. No signature is required.</p>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>