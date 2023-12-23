<?php

session_start();

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


<!--Home-->
<section id="home">
	<div class="container">
		<h5>BEST CLOTHES</h5>
		<h1><span>New Merch</span> this Year!!</h1>
		<p>This shop offers the best prices and affordable clothes.</p>
		<a href="#featured"><button>Check Now</button></a>
	</div>
</section>

<!--Featured-->
<section id="featured" class="my-5 pb-5">
	<div class="container text-center mt-5 py-5">
		<h3>Our Merch</h3>
		<hr class="mx-auto">
		<p>Check out the featured Merch</p>
	</div>
	<div class="row mx-auto container-fluid">

	<?php include('server/get_feat_item.php'); ?>


	<?php while($row = $feat_item->fetch_assoc()){    ?>




		<div class="product text-center col-lg-3 col-md-4 col-sm-12">
			<img class="img-fluid mb-3" src="images/<?php  echo $row['item_img']    ?>">
			<div class="star">
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
			</div>
			<h5 class="p-name"><?php echo $row['item_name'];  ?></h5>
			<h4 class="p-price">Php <?php  echo $row['item_price'];  ?></h4>
			<a href="<?php echo "single_product.php?item_id=". $row['item_id'];?>"><button class="buy-btn">Buy</button></a>
		</div>
		
		<?php } ?>

	</div>
</section>


<!--Banner-->
<section id="banner" class="my-5 py-5">
	<div class="container">
		<h4>HOT MERCH</h4>
		<h1>Summer Collection <br>Prices are Poppin'</h1>
		<a href="shop.php"><button class="text-uppercase">Browse Items</button></a>
	</div>
</section>



<!--Clothes-->
<section id="featured" class="my-5">
	<div class="container text-center mt-5 py-5">
		<h3>Shirts</h3>
		<hr class="mx-auto">
		<p>Check out the Shirt Merch</p>
	</div>
	<div class="row mx-auto container-fluid">

	<?php include('server/get_shirts.php'); ?>

		<?php while($row=$shirt_item->fetch_assoc()){  ?>

		<div class="product text-center col-lg-3 col-md-4 col-sm-12">
			<img class="img-fluid mb-3" src="images/<?php echo $row['item_img'];  ?>">
			<div class="star">
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
			</div>
			<h5 class="p-name"><?php echo $row['item_name'];  ?></h5>
			<h4 class="p-price">Php <?php echo $row['item_price'];  ?></h4>
			<a href="single_product.php?item_id=<?php echo $row['item_id'];?>"><button class="buy-btn">Buy</button></a>
		</div>

			<?php } ?>

	</div>
</section>

<!--Pants-->
<section id="featured" class="my-5">
	<div class="container text-center mt-5 py-5">
		<h3>Pants</h3>
		<hr class="mx-auto">
		<p>Check out the Pants Merch</p>
	</div>
	<div class="row mx-auto container-fluid">

	<?php include('server/get_pants.php'); ?>

<?php while($row=$pants_item->fetch_assoc()){  ?>


		<div class="product text-center col-lg-3 col-md-4 col-sm-12">
			<img class="img-fluid mb-3" src="images/<?php echo $row['item_img'];  ?>">
			<div class="star">
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
			</div>
			<h5 class="p-name"><?php echo $row['item_name'];  ?></h5>
			<h4 class="p-price">Php <?php echo $row['item_price'];  ?></h4>
			<a href="single_product.php?item_id=<?php echo $row['item_id'];?>"><button class="buy-btn">Buy</button></a>
		</div>

		<?php } ?>

	</div>
</section>

<!--Hoodies-->
<section id="featured" class="my-5">
	<div class="container text-center mt-5 py-5">
		<h3>Hoodies</h3>
		<hr class="mx-auto">
		<p>Check out the Hoodie Merch</p>
	</div>
	<div class="row mx-auto container-fluid">

	<?php include('server/get_hoodies.php'); ?>

<?php while($row=$hoodie_item->fetch_assoc()){  ?>

		<div class="product text-center col-lg-3 col-md-4 col-sm-12">
			<img class="img-fluid mb-3" src="images/<?php echo $row['item_img'];  ?>">
			<div class="star">
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
			</div>
			<h5 class="p-name"><?php echo $row['item_name'];  ?></h5>
			<h4 class="p-price">Php <?php echo $row['item_price'];  ?></h4>
			<a href="single_product.php?item_id=<?php echo $row['item_id'];?>"><button class="buy-btn">Buy</button></a>
		</div>
		
		<?php } ?>


	</div>
</section>

<!--Cap-->
<section id="featured" class="my-5">
	<div class="container text-center mt-5 py-5">
		<h3>Caps</h3>
		<hr class="mx-auto">
		<p>Check out the Cap Merch</p>
	</div>
	<div class="row mx-auto container-fluid">

	<?php include('server/get_caps.php'); ?>

<?php while($row=$cap_item->fetch_assoc()){  ?>


		<div class="product text-center col-lg-3 col-md-4 col-sm-12">
			<img class="img-fluid mb-3" src="images/<?php echo $row['item_img'];  ?>">
			<div class="star">
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
			</div>
			<h5 class="p-name"><?php echo $row['item_name'];  ?></h5>
			<h4 class="p-price">Php <?php echo $row['item_price'];  ?></h4>
			<a href="single_product.php?item_id=<?php echo $row['item_id'];?>"><button class="buy-btn">Buy</button></a>
		</div>

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