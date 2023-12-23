<?php
include('../server/connection.php');
include('../server/logout.php');

// Check if the user is logged in and is an admin
if (!isset($_SESSION['logged_in']) || $_SESSION['user_control'] !== 'A') {
    header('location: ../login.php?message=You cannot be here');
    exit;
}

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $stmt = $conn->prepare("SELECT orders.*, GROUP_CONCAT(order_items.item_name SEPARATOR ', ') AS item_names
                            FROM orders
                            LEFT JOIN order_items ON orders.order_id = order_items.order_id
                            WHERE orders.order_id = ?");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $order = $stmt->get_result();
} else if (isset($_POST['edit_order'])) {
    $order_status = $_POST['order_status'];
    $order_id = $_POST['order_id'];

    $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
    $stmt->bind_param('si', $order_status, $order_id);

    if ($stmt->execute()) {
        header('location: index.php?message=Status Has Been Updated');
    } else {
        header('location: index.php?error=Error Occurred');
    }
} else {
    header('location: index.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin CornHub Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
	<link rel="stylesheet" type="text/css" href="../styleee.css">
</head>
<body>

    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas fa-carrot me-2 me-2"></i><span>Corn</span>Hub</div>
            <div class="list-group list-group-flush my-3">
                <a href="index.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-project-diagram me-2"></i>Dashboard</a>
                <a href="index.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-shopping-cart me-2"></i>Orders</a>
                <a href="items.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-solid fa-tshirt me-2"></i>Items</a>
                <a href="items_add.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-cog me-2"></i>Create Items</a>
                <a href="account.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-user-cog me-2"></i>Account</a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-wrench me-2"></i>Help</a>
                <a href="../server/logout.php?logout=1" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                        class="fas fa-power-off me-2"></i>Logout</a>
            </div>
        </div>

<!-- Content Home -->
<div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Dashboard</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>

<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Edit Order</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
        <form id="edit-form" method="POST" action="edit_order.php">
		<div class="mb-3 edit-small-element">

    <?php foreach($order as $r){ ?>
    
    <label class="form-label">Order ID</label>
    <p class="my-4"><?php echo $r['order_id']; ?></p>
  </div>
	
<input type="hidden" name="order_id" value="<?php echo $r['order_id'];?>">

  <div class="mb-3 edit-small-element">
    <label class="form-label">Order Status</label>
    <select required name="order_status" class="form-select">
        <option value="P" <?php if($r['order_status'] == 'P'){ echo "selected";}?>>Pending</option>
        <option value="D" <?php if($r['order_status'] == 'D'){ echo "selected";}?>>Delivered</option>
        <option value="C" <?php if($r['order_status'] == 'C'){ echo "selected";}?>>Cancelled</option>
    </select>
  </div>

  <div class="mb-3 edit-large-element">
    <label class="form-label">Order Cost</label>
    <p class="my-4"><?php echo $r['order_cost']; ?></p>
  </div>

  <div class="mb-3 edit-small-element">
    <label class="form-label">Order Date</label>
    <p class="my-4"><?php echo $r['order_date']; ?></p>
  </div>

  <div class="mb-3 edit-small-element">
    <label class="form-label">Order Items</label>
    <p class="my-4"><?php echo $r['item_names']; ?></p>
  </div>

  <div class="form-group edit-btn-container">
  <input type="submit" class="btn" id="edit-btn" name="edit_order" value="Edit">
      </div>  
    
<?php }  ?>

    </form>
    </div>
</section>

            </div>
        </div>
    </div>
   
    </div>




    


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>



</body>
</html>