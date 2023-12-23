<?php 

session_start();
include('server/connection.php');
include('server/logout.php');

if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
    exit;
}

if(isset($_POST['change_pword'])){

    $pword = $_POST['pword'];
    $cpword = $_POST['cpword'];
    $user_email = $_SESSION['user_email'];

//If pass dont match
if($pword !== $cpword){
    header('location: account.php?error=Password dont Match');
  
  
  //If pass has less characters
  }else if(strlen($pword) < 6){
    header('location: account.php?error=Password must be at least 6 characters');
  

    //no errors
  }else{

    $hashed_password = password_hash($pword, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET user_pass=? WHERE user_email=?");
    $stmt->bind_param('ss' ,$hashed_password,$user_email);

    if($stmt->execute()){
        header('location: account.php?message=Password Updated Successfully');
    }else{
        header('location: account.php?error=Password Not Updated');
    }


  }



}

//get orders
if(isset($_SESSION['logged_in'])){


$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=? ");

$stmt->bind_param('i',$user_id);

$stmt->execute();

$orders = $stmt->get_result();



}



?>

<!DOCTYPE html>
<html>
<head>
	<title>CornHub</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
	<link rel="stylesheet" type="text/css" href="styleee.css">

</head>
<body>


<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-dark py-3 fixed-top">
  <div class="container p-0">
 
    <a class="navbrand" href="index.php">
      <img class="logo" src="images/logoch.png" alt="Logo">
	<h3 class="brandd">Corn<span>Hub</span></h3>
    </a>
 
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="shop.php">Shop</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact Us</a>
      </li>

      <li class="nav-item">
          <a href="cart.php">
			<i class="fas fa-shopping-cart">
				<?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0){ ?>
			<span class="cart-quantity"> <?php echo $_SESSION['quantity']; ?> </span>
			<?php } ?>
			</i></a>
        </li>

        <li class="nav-item">
          <a href="account.php"><i class="fas fa-user"></i></a>
        </li>

</ul>
    </div>
  </div>
</nav>




<!--Account-->
<section class="my-5 py-5">
    <div class="row container mx-auto">
        <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
            <p style="color: lime" class="text-center"><?php if(isset($_GET['message'])){ echo $_GET['message'];} ?></p>
            <h3 class="font-weight-bold">Account Info</h3>
            <hr class="mx-auto">

            <div class="account-info">
                <?php if (isset($_SESSION['user_control']) && $_SESSION['user_control'] === 'U') { ?>
                    <!-- Display user-specific information for regular users -->
                    <p>Name:<span><?php if (isset($_SESSION['user_name'])) { echo $_SESSION['user_name']; } ?></span></p>
                    <p>Contact:<span><?php if (isset($_SESSION['user_contact'])) { echo $_SESSION['user_contact']; } ?></span></p>
                    <p><a href="#orders" id="order-btn">Your Orders</a></p>
                    <p><a href="server/logout.php?logout=1" id="logout-btn">Logout</a></p>
                <?php } ?>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12">
            <?php
                // Check if the user is not an admin
                if (isset($_SESSION['user_control']) && $_SESSION['user_control'] !== 'A') {
            ?>
                <form id="account-form" method="POST" action="account.php">
                    <p style="color: red" class="text-center"><?php if(isset($_GET['error'])){ echo $_GET['error'];} ?></p>
                    <h3>Change Password</h3>
                    <hr class="mx-auto">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="pword" id="acc-pass" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password" class="form-control" name="cpword" id="acc-cpass" placeholder="Confirm New Password" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Change Password" name="change_pword" class="btn" id="change-pass-btn">
                    </div>
                </form>
            <?php
                }
            ?>
        </div>
    </div>
</section>



<!--Orders-->
<section id="orders" class="orders container my-5 py-3">
    <div class="container mt-2">
        <h2 class="font-weight-bold text-center">Your Orders</h2>
        <hr class="mx-auto">
    </div>

    <table class="mt-5 pt-5">
        <tr>
            <th>Order ID</th>
            <th>Order Cost</th>
            <th>Order Status(P - Pending, D - Delivered)</th>
            <th>Order Date</th>
            <th>Order Details</th>
        </tr>
        
        <?php while($row = $orders->fetch_assoc()){   ?>
        
        
         <tr>
            <td>
                <!-- <div class="product-info">
                    <img src="images/brand2.jfif">
                    <div>
                        <p class="mt-3"></p>
                    </div>
                </div> -->

            <span><?php echo $row['order_id']; ?></span>
            </td>
           

          <td>
            <span>PHP <?php echo $row['order_cost']; ?></span>
          </td>

          <td>
            <span><?php echo $row['order_status']; ?></span>
          </td>

          <td>
            <span><?php echo $row['order_date']; ?></span>
          </td>

          <td>
            <form method="POST" action="order_details.php">
            <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status">
              <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id">
              <input class="btn details-btn" name="details_btn" type="submit" value="Details">
            </form>
          </td>


        </tr> 

<?php  }  ?>


    </table>



</section>









<!--Footer-->
<footer class="mt-5 py-5">
	<div class="row container mx-auto pt-5">
		<div class="footer-one col-lg-3 col-md-6 col-sm-12">
			<img class="logo" src="images/logoch.png">
			<p class="pt-3">We provide the best items for everyone and the best affordable prices that anyone can pay. If any means have a complain, Contact Us at "Contact Us" tab below.</p>
		</div>
		<div class="footer-one col-lg-3 col-md-6 col-sm-12">
			<h5 class="pb-2">Featured</h5>
			<ul class="text-uppercase">
				<li><a href="#">Shirts</a></li>
				<li><a href="#">Pants</a></li>
				<li><a href="#">Hoodies</a></li>
				<li><a href="#">Caps</a></li>
				<li><a href="#">About</a></li>
				<li><a href="#">Secret</a></li>
			</ul>
	</div>
	
<div class="footer-one col-lg-3 col-md-6 col-sm-12">
	<h5 class="pb-2">Contact Us</h5>
	<div>
		<h6 class="text-uppercase">Address:</h6>
		<p>Bicol University Polangui Campus</p>
	</div>
	<div>
		<h6 class="text-uppercase">Phone:</h6>
		<p>123 456 7890</p>
	</div>
	<div>
		<h6 class="text-uppercase">Email:</h6>
		<p>cornhub@gmail.com</p>
	</div>
</div>

<div class="footer-one col-lg-3 col-md-6 col-sm-12">
	<h5 class="pb-2">GengGeng</h5>
	<div class="row">
	   <img src="images/me.jpg" class="img-fluid w-25 h-100 m-2">
	   <img src="images/jv.jpg" class="img-fluid w-25 h-100 m-2">
	   <img src="images/tris.jpg" class="img-fluid w-25 h-100 m-2">
	   <img src="images/haiji.jpg" class="img-fluid w-25 h-100 m-2">
	   <img src="images/rob.jpg" class="img-fluid w-25 h-100 m-2">
	   <img src="images/cris.jpg" class="img-fluid w-25 h-100 m-2">
	</div>
</div>

</div>


<div class="copyright mt-5">
	<div class="row container mx-auto">
		<div class="col-lg-3 col-md-6 col-sm-12">		
		</div>
		<div class="col-lg-3 col-md-6 col-sm-12 text-nowrap mb-2">
			<p>CornHub @ GENGGENG 2023 All Right Reserved</p>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-12">
			<a href="#"><i class="fab fa-facebook"></i></a>
			<a href="#"><i class="fab fa-instagram"></i></a>
			<a href="#"><i class="fab fa-twitter"></i></a>
		</div>
	</div>
</div>


</footer>








<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>