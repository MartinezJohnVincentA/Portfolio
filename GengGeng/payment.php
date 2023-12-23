<?php

session_start();


if(isset($_POST['order_pay'])){
	$order_status = $_POST['order_status'];
	$total_order = $_POST['total_order'];
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




<!--Payment-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Payment</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container text-center">
        

		<?php if(isset($_SESSION['total'])  && $_SESSION['total'] != 0){ ?>
		<p>Total Amount: PHP <?php echo $_SESSION['total'];  ?></p>
		<input type="submit" class="btn btn-success" value="Pay Now">
		
		<?php } elseif(isset($_POST['order_status']) && $_POST['order_status'] == "P"){ ?>
			<p>Total Amount: PHP <?php echo $_POST['total_order']; ?></p>
			<input type="submit" class="btn btn-success" value="Pay Now">
			
		<?php } else {  ?>
			<p>No items in Cart</p>
		<?php } ?>
       

    </div>
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