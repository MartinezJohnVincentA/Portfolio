<?php

session_start();

if(isset($_POST['add_to_cart'])){

    //if user has already a item added to cart
    if(isset($_SESSION['cart'])){


        $items_array_id = array_column($_SESSION['cart'],"item_id"); 
        
        //if item has already been added to cart or not
        if(!in_array($_POST['item_id'], $items_array_id) ){

           $item_id = $_POST['item_id'];
    
            $item_array = array(
                                'item_id' => $_POST['item_id'],
                                'item_name' => $_POST['item_name'],
                                'item_price' => $_POST['item_price'],
                                'item_img' => $_POST['item_img'],
                                'item_quantity' => $_POST['item_quantity']
    
            );
    
            $_SESSION['cart'][$item_id] = $item_array;





            //item already added
        }else{

            echo '<script>alert("Item already on the cart");</script>';



        }
    



        //If this is First item
    }else{

        $item_id = $_POST['item_id'];
        $item_name = $_POST['item_name'];
        $item_price = $_POST['item_price'];
        $item_img = $_POST['item_img'];
        $item_quantity = $_POST['item_quantity'];

        $item_array = array(
                            'item_id' => $item_id,
                            'item_name' => $item_name,
                            'item_price' => $item_price,
                            'item_img' => $item_img,
                            'item_quantity' => $item_quantity

        );

        $_SESSION['cart'][$item_id] = $item_array;

    }


calculateTotalCart();






//Removes Item From Cart
}else if(isset($_POST['remove_item'])){


    $item_id = $_POST['item_id'];
    unset($_SESSION['cart'][$item_id]);


calculateTotalCart();

}else if(isset($_POST['edit_quantity'])){

  
    $item_id = $_POST['item_id'];
    $item_quantity = $_POST['item_quantity'];

    
  $item_array = $_SESSION['cart'][$item_id];

 
  $item_array['item_quantity'] = $item_quantity;


  $_SESSION['cart'][$item_id] = $item_array;



calculateTotalCart();


}else{
//header('location: index.php');


}



function calculateTotalCart(){

    $total_price = 0;
    $total_quantity = 0;

foreach($_SESSION['cart'] as $key => $value){

    $item = $_SESSION['cart'][$key];

    $price = $item['item_price'];
    $quantity = $item['item_quantity'];

    $total_price = $total_price + ($price * $quantity);
    $total_quantity = $total_quantity + $quantity;

}

$_SESSION['total'] = $total_price;
$_SESSION['quantity'] = $total_quantity;

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



<!--Cart-->
<section class="cart container my-5 py-5">
    <div class="container mt-5">
        <h2 class="font-weight-bold">Your Cart</h2>
        <hr>
    </div>

    <table class="mt-5 pt-5">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>


<?php if(isset($_SESSION['cart'])){ ?>

<?php foreach($_SESSION['cart'] as $key => $value){ ?>




        <tr>
            <td>
               <div class="product-info">
                    <img src="images/<?php echo $value['item_img']; ?>">
                    <div>
                        <p><?php echo $value['item_name']; ?></p>
                        <small><span>PHP</span><?php echo $value['item_price']; ?></small>
                        <br>
                        <form method="POST" action="cart.php">

                        <input type="hidden" name="item_id" value="<?php echo $value['item_id']; ?>">
                        <input type="submit"  name="remove_item" class="remove-btn" value="Remove">

                        </form>

                    </div>
                </div>
            </td>

            <td>
                
               <form method="POST" action="cart.php">  
               <input type="hidden" name="item_id" value="<?php echo $value['item_id']; ?>">
              <input type="number" name="item_quantity" value="<?php echo $value['item_quantity']; ?>"/>
               <input type="submit" class="edit-btn" value="Edit" name="edit_quantity">
            </form>

            </td>

            <td>
                <span>PHP </span>
                <span class="product-price"><?php echo $value['item_quantity'] * $value['item_price']; ?></span>
            </td>
        </tr>

      <?php } ?>


      <?php } ?>

    </table>

<div class="cart-total">
    <table>
        <tr>
            <td>Total</td>
        <?php if(isset($_SESSION['cart'])){ ?>
            <td>PHP <?php echo $_SESSION['total']; ?></td>
        <?php } ?>
        </tr>
    </table>
</div>



<div class="checkout-container">
    <form method="POST" action="checkout.php">

<input type="submit" class="btn checkout-btn" value="Checkout" name="checkout">

    </form>
    
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