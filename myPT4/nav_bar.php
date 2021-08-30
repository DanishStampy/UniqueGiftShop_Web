<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
<style type="text/css">
    body{
      font-family: 'Ubuntu', sans-serif;
    }
    .pad{
      padding-left: 20px;
      font-weight: 500;
    }
    .fontlink{
      color: #EDF0DA;
      font-weight: 400;
    }
    .fontlink:link, .fontlink:visited{
      color: #EDF0DA;
    }
    .fontlink:hover{
      color: #cfd1be;
    }
  </style>

<nav class="navbar sticky-top navbar-expand-lg navbar-default" style="background-color: #AA4465;">
    <a href="index.php" class="navbar-brand fontlink pad">Unique Gift <i class="fas fa-gifts"></i>

</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link fontlink" href="index.php">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fontlink" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Product
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="search.php">Search Product</a>
            <a class="dropdown-item" href="products.php">Add Product</a>
          </div>

        </li>
        <li class="nav-item">
          <a class="nav-link fontlink" href="staffs.php">Staff</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fontlink" href="customers.php">Customer</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fontlink" href="orders.php">Order</a>
        </li>
      </ul>
      <ul class="nav ms-auto">
        <?php

        if(isset($_SESSION['staff_role'])){
          $role = '<i class="fas fa-user"></i> '.$_SESSION['staff_role'];
          $name = $_SESSION['staff_name'];
        }else{
          $role = '<i class="fas fa-user-cog"></i> '.$_SESSION['admin_role'];
          $name = $_SESSION['admin_name'];
        }
        
        echo '<li class="nav-item">';
        echo '<a class="nav-link fontlink" href="">'.$role.' | '.$name.'</a>';
        echo '</li>';
        
        ?>
        <li class="nav-item">
          <a class="nav-link active fontlink" aria-current="page" href="logout.php"> <i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="js/bootstrap.min.js"></script>