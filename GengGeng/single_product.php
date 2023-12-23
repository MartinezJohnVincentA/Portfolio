<?php
session_start();
include('server/connection.php');

if (isset($_GET['item_id'])) {
    $item_id = $_GET['item_id'];

    // Fetch main product details
    $mainProduct = $conn->query("SELECT * FROM items WHERE item_id = $item_id")->fetch_assoc();

    // Fetch variants for the main product
    $variants = $conn->query("SELECT * FROM variants WHERE item_id = $item_id")->fetch_all(MYSQLI_ASSOC);
} else {
    header('location: index.php');
    exit();
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



<!--Single Prod-->
<section class="container single-product my-5 pt-5">
    <div class="row mt-5">
        <div class="col-lg-5 col-md-6 col-sm-12">
            <img id="mainProductImage" class="img-fluid w-100 pb-1" src="images/<?php echo $mainProduct['item_img']; ?>">
        </div>

        <div class="col-lg-6 col-md-12 col-12">
            <h6>Merch</h6>
            <h3 class="py-4" id="mainProductName"><?php echo $mainProduct['item_name']; ?></h3>
            <h2 id="mainProductPrice">PHP <?php echo $mainProduct['item_price']; ?></h2>


            <div class="mb-3">

            <form method="POST" action="cart.php">
    <input type="hidden" name="item_id" value="<?php echo $mainProduct['item_id']; ?>">
    <input type="hidden" name="item_img" value="<?php echo $mainProduct['item_img']; ?>">
    <input type="hidden" name="item_name" value="<?php echo $mainProduct['item_name']; ?>">
    <input type="hidden" name="item_price" value="<?php echo $mainProduct['item_price']; ?>">
    <input type="number" name="item_quantity" value="1"/>
    <button class="buy-btn" type="submit" name="add_to_cart">Add to Cart</button>
            </form>

            <h4 class="mt-5 mb-5">Product Details</h4>
            <span id="productDetails"><?php echo $mainProduct['item_desc']; ?> </span>
        </div>
    </div>
</section>



<!--Related Prod-->
<section id="related-products" class="my-5 pb-5">
	<div class="container text-center mt-5 py-5">
		<h3>Related Products</h3>
		<hr class="mx-auto">
	</div>
	<div class="row mx-auto container-fluid">
	<?php
        $relatedProductsQuery = $conn->query("SELECT * FROM items WHERE item_img LIKE '%1%' ORDER BY RAND() LIMIT 4");
        while ($relatedProduct = $relatedProductsQuery->fetch_assoc()) {
        ?>
		<div class="product text-center col-lg-3 col-md-4 col-sm-12">
			<img class="img-fluid mb-3" src="images/<?php echo $relatedProduct['item_img']; ?>">
			<div class="star">
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
				<i class="fas fa-star"></i>
			</div>
			<h5 class="p-name"><?php echo $relatedProduct['item_name']; ?></h5>
			<h4 class="p-price">Php <?php echo $relatedProduct['item_price']; ?></h4>
			<button class="buy-btn">Buy</button>
		</div>
		<?php
        }
        ?>
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