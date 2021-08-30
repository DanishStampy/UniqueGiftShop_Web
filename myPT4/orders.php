<?php
include_once 'orders_crud.php';
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
  <title>Unique Gift Shop System : Orders</title>
  <link rel="icon" href="img/logoonly.png" type="image/icon type">
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/design.css">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body style="background-color: #EDF0DA;">
  <?php include_once 'nav_bar.php'; ?>
  <div class="container-fluid">
    <div class="row justify-content-md-center">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <div class="pb-2 mt-4 mb-2 borderBot">
          <h1>Create New Order</h1>
        </div>
        <form action="orders.php" method="post" class="form-horizontal mt-4 p-4 rounded shadow" style="background-color: white">
          <div class="form-group">
            <label for="orderid" class="col-sm-3 form-label">Order ID</label>
            <div class="">
              <input name="oid" type="text" class="form-control mb-2 form-text" id="orderid" placeholder="Order ID" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_order_num']; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="orderdate" class="col-sm-3 form-label">Order Date</label>
            <div class="">
              <input name="orderdate" type="text" class="form-control mb-2 form-text" id="orderdate" placeholder="Order Date" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_order_date']; ?>">
            </div>
          </div>

          <div class="form-group mb-4">
            <label for="staff" class="col-sm-3 form-label">Staff</label>
            <div class="">
              <select name="sid" class="form-control" id="staff" required>
                <option value="" disabled selected>Select staff</option>
                <?php
                try {
                  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a175139_pt2");
                  $stmt->execute();
                  $result = $stmt->fetchAll();
                }
                catch(PDOException $e){
                  echo "Error: " . $e->getMessage();
                }
                foreach($result as $staffrow) {
                  ?>
                  <?php if((isset($_GET['edit'])) && ($editrow['fld_staff_num']==$staffrow['fld_staff_num'])) { ?>
                    <option value="<?php echo $staffrow['fld_staff_num']; ?>" selected><?php echo $staffrow['fld_staff_name'];?></option>
                  <?php } else { ?>
                    <option value="<?php echo $staffrow['fld_staff_num']; ?>"><?php echo $staffrow['fld_staff_name'];?></option>
                  <?php } ?>
                  <?php
                } // while
                $conn = null;
                ?> 
              </select>
              <div class="invalid-feedback">
                Please select one staff
              </div>
            </div>
          </div>  

          <div class="form-group mb-4">
            <label for="customer" class="col-sm-3 form-label">Customer</label>
            <div class="">
              <select name="cid" class="form-control" id="customer" required>
                <option value="" disabled selected>Select customer</option>
                <?php
                try {
                  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $stmt = $conn->prepare("SELECT * FROM tbl_customers_a175139_pt2");
                  $stmt->execute();
                  $result = $stmt->fetchAll();
                }
                catch(PDOException $e){
                  echo "Error: " . $e->getMessage();
                }
                foreach($result as $custrow) {
                  ?>
                  <?php if((isset($_GET['edit'])) && ($editrow['fld_customer_num']==$custrow['fld_customer_num'])) { ?>
                    <option value="<?php echo $custrow['fld_customer_num']; ?>" selected><?php echo $custrow['fld_customer_name'];?></option>
                  <?php } else { ?>
                    <option value="<?php echo $custrow['fld_customer_num']; ?>"><?php echo $custrow['fld_customer_name'];?></option>
                  <?php } ?>
                  <?php 
                  } // while
                  $conn = null;
                  ?> 
                </select>
              </div>
            </div>  

            <!-- UPDATE, CREATE AND CLEAR BUTTON -->
            <div class="form-group mb-2">
              <div class="col-sm-offset-3 col-sm-9">
                <?php if (isset($_GET['edit'])) { ?>
                  <input type="hidden" name="oldsid" value="<?php echo $editrow['fld_staff_num']; ?>">
                  <button class="btn btn-outline-success" type="submit" name="update" onclick="return checkValidation();"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
                <?php } else { ?>
                  <button class="btn btn-outline-success" type="submit" name="create" onclick="return checkValidation();"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
                <?php } ?>
                <button class="btn btn-outline-warning" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
              </div>
            </div>

            <!-- ROLE MESSAGES -->

            <?php
              if (isset($_SESSION['staff_role'])) {
            ?>

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
                    Normal staff cannot update or delete any order information. Only staff at admin level can make the change.
                  </div>
                </div>
              </div>
            </div>

            <?php
              }
            ?>

          </form>
        </div>
      </div>

      <div class="row justify-content-md-center">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
          <div class="pb-2 mt-4 mb-2 borderBot">
            <h1>Order List</h1>
          </div>
          <table class="table table-striped table-hover align-middle mt-4 shadow">
            <tr class="tableHeader">
              <th>Order ID</th>
              <th>Order Date</th>
              <th>Staff</th>
              <th>Customer</th>
              <th></th>
            </tr>
            <?php
          // Read
            $per_page = 5;
            if (isset($_GET["page"]))
              $page = $_GET["page"];
            else
              $page = 1;
            $start_from = ($page-1) * $per_page;
            try {
              $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql = "SELECT * FROM tbl_orders_a175139, tbl_staffs_a175139_pt2, tbl_customers_a175139_pt2 WHERE ";
              $sql = $sql."tbl_orders_a175139.fld_staff_num = tbl_staffs_a175139_pt2.fld_staff_num and ";
              $sql = $sql."tbl_orders_a175139.fld_customer_num = tbl_customers_a175139_pt2.fld_customer_num LIMIT {$start_from}, {$per_page}";
              $stmt = $conn->prepare($sql);
              $stmt->execute();
              $result = $stmt->fetchAll();
            }
            catch(PDOException $e){
              echo "Error: " . $e->getMessage();
            }
            foreach($result as $orderrow) {
              ?>   
              <tr>
                <td><?php echo $orderrow['fld_order_num']; ?></td>
                <td><?php echo $orderrow['fld_order_date']; ?></td>
                <td><?php echo $orderrow['fld_staff_name']; ?></td>
                <td><?php echo $orderrow['fld_customer_name']; ?></td>

                <?php
                  if (isset($_SESSION['admin_role'])) {
                ?>
                <td>
                  <a href="orders_details.php?oid=<?php echo $orderrow['fld_order_num']; ?>" class="btn btn-outline-warning btn-xs" role="button"> Details </a>
                  <a href="orders.php?edit=<?php echo $orderrow['fld_order_num']; ?>" class="btn btn-outline-success btn-xs" role="button"> Edit </a>
                  <a href="orders.php?delete=<?php echo $orderrow['fld_order_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-outline-danger btn-xs" role="button">Delete</a>
                </td>
                <?php
                  }else{
                ?>
                <td>
                  <a href="orders_details.php?oid=<?php echo $orderrow['fld_order_num']; ?>" class="btn btn-outline-warning btn-xs" role="button"> Details </a>
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
              try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM tbl_orders_a175139, tbl_staffs_a175139_pt2, tbl_customers_a175139_pt2 WHERE ";
                $sql = $sql."tbl_orders_a175139.fld_staff_num = tbl_staffs_a175139_pt2.fld_staff_num and ";
                $sql = $sql."tbl_orders_a175139.fld_customer_num = tbl_customers_a175139_pt2.fld_customer_num";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();
                $total_records = count($result);
              }
              catch(PDOException $e){
                echo "Error: " . $e->getMessage();
              }
              $total_pages = ceil($total_records / $per_page);
              ?>
              <?php if ($page==1) { ?>
                <li class="disabled page-link"><span aria-hidden="true" class="arrowColor">«</span></li>
              <?php } else { ?>
                <li class="page-item"><a href="orders.php?page=<?php echo $page-1 ?>" aria-label="Previous" class="page-link arrowColor"><span aria-hidden="true">«</span></a></li>
                <?php
              }
              for ($i=1; $i<=$total_pages; $i++)
                if ($i == $page)
                  echo "<li class=\"active page-item\"><a href=\"orders.php?page=$i\" class=\"bgColor\">$i</a></li>";
                else
                  echo "<li class=\"page-item\"><a href=\"orders.php?page=$i\" class=\"bgNotActive\">$i</a></li>";
                ?>
                <?php if ($page==$total_pages) { ?>
                  <li class="disabled page-link"><span aria-hidden="true" class="arrowColor">»</span></li>
                <?php } else { ?>
                  <li class="page-link"><a href="orders.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true" class="arrowColor">»</span></a></li>
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
        var staff = document.getElementById("staff").value;
        var cust = document.getElementById("customer").value;

        errorMsg = "-WARNING-\n\n";

        if(staff == ""){
          errorMsg += '-Please choose a staff-\n';
        }
        if(cust == ""){
          errorMsg += '-Please choose a customer-';
        }

        if(errorMsg !== "-WARNING-\n\n"){
          alert(errorMsg);
          return false;
        }

        return true;
      }
    </script>
    </html>