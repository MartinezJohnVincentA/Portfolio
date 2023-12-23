<?php

session_start();

include('server/connection.php');


        //If user has already registered
if(isset($_SESSION['logged_in'])){
        header('location: account.php');
        exit;
      
      }




if(isset($_POST['register'])){

$fname = $_POST['fname'];
$uname = $_POST['uname'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$cpass = $_POST['cpass'];
$add = $_POST['add'];
$user_contact = $_POST['contact'];
$user_control = "U";

//If pass dont match
if($pass !== $cpass){
  header('location: registration.php?error=Password dont Match');


//If pass has less characters
}else if(strlen($pass) < 6){
  header('location: registration.php?error=Password must be at least 6 characters');





//If there is no error
}else{
          //Check whether there is a User with same email/ not
          $stmt1 = $conn->prepare("SELECT user_id, user_name, user_email, user_pass, user_add, user_contact, user_fullname, user_control FROM users WHERE user_email=?");
          $stmt1->bind_param('s', $email);
          $stmt1->execute();
          $stmt1->bind_result($user_id, $user_name, $user_email, $user_pass, $user_add, $user_contact, $user_fullname, $user_control);
          $stmt1->store_result();
          $num_rows = $stmt1->num_rows;


          //If there is a user already registered
          if($num_rows != 0){
            header('location: registration.php?error=User with this Email already exist');
          
          //If no User Has User Info Yet
          }else{


                //Creates the User Info
                $stmt = $conn->prepare("INSERT INTO users (user_name,user_email,user_pass,user_add,user_contact,user_fullname,user_control)
                              VALUES (?,?,?,?,?,?,?)");


                $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
                $stmt->bind_param('ssssiss',$uname,$email,$hashed_password,$add,$user_contact,$fname,$user_control);

                //If account created Successfully
                if($stmt->execute()){
                  $user_id = $stmt->insert_id;
                  $_SESSION['user_id'] = $user_id;
                  $_SESSION['user_email'] = $email;
                  $_SESSION['user_name'] = $uname;
                  $_SESSION['user_contact'] = $user_contact;
                  $_SESSION['logged_in'] = true;
                  header('location: account.php?message=You Registered Successfully');

                  //If Account has not been created/error
                }else{

                  header('location: registration.php?error=Could not create account');


                }

          }
        }

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




<!--Register-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Registration</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
        <form id="register-form" method="POST" action="registration.php">
          <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
		<div class="mb-3">
    <label class="form-label">Fullname</label>
    <input type="text" class="form-control" id="reg-full" name="fname" placeholder="Complete Name" required>
  </div>
		<div class="mb-3">
    <label class="form-label">Username</label>
    <input type="text" class="form-control" id="reg-name" name="uname" placeholder="Username" required>
  </div>
		<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" class="form-control" id="reg-email" name="email" placeholder="Email" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" class="form-control" id="reg-password" name="pass" placeholder="Password" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="reg-cpassword" name="cpass" placeholder="Confirm Password" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Address</label>
    <input type="text" class="form-control" id="reg-add" name="add" placeholder="Address" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Contact</label>
    <input type="number" class="form-control" id="reg-num" name="contact" placeholder="Contact Number" required>
  </div>
  <input type="submit" class="btn" id="reg-btn" name="register" value="Register">
  <br>
  <a id="login-url" class="btn" href="login.php">Already a Member?</a>
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