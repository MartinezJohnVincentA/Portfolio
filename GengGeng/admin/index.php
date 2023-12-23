<?php

include('../server/connection.php');
include('../server/logout.php');

// Check if the user is logged in and is an admin
if (!isset($_SESSION['logged_in']) || $_SESSION['user_control'] !== 'A') {
    header('location: ../login.php?message=You cannot be here');
    exit;
}
?>

<?php

//get orders to admin
    $stmt = $conn->prepare("SELECT o.order_id,o.order_status,u.user_name,o.order_date,o.user_contact,o.user_address FROM orders o 
                                             JOIN users u
                                             on u.user_id = o.user_id");
     
    $stmt->execute();
    
    $orders = $stmt->get_result();
    
$stmtItems = $conn->prepare("SELECT COUNT(*) as totalItems FROM items");
$stmtItems->execute();
$resultItems = $stmtItems->get_result();
$rowItems = $resultItems->fetch_assoc();
$totalItems = $rowItems['totalItems'];

// Get total number of deliveries
$stmtDeliveries = $conn->prepare("SELECT COUNT(*) as totalDeliveries FROM orders WHERE order_status = 'D' ");
$stmtDeliveries->execute();
$resultDeliveries = $stmtDeliveries->get_result();
$rowDeliveries = $resultDeliveries->fetch_assoc();
$totalDeliveries = $rowDeliveries['totalDeliveries'];

$stmtSales = $conn->prepare("SELECT SUM(order_cost) as totalSales FROM orders");
$stmtSales->execute();
$resultSales = $stmtSales->get_result();
$rowSales = $resultSales->fetch_assoc();
$totalSales = $rowSales['totalSales'];


$stmtItems->close();
$stmtDeliveries->close();
$stmtSales->close();
$conn->close();

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

            <div class="container-fluid px-4">
                <div class="row g-3 my-2">
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php echo $totalItems; ?></h3>
                                <p class="fs-5">Items</p>
                            </div>
                            <i class="fas fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2">PHP <?php echo $totalSales; ?></h3>
                                <p class="fs-5">Sales</p>
                            </div>
                            <i
                                class="fas fa-hand-holding-usd fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php echo $totalDeliveries; ?></h3>
                                <p class="fs-5">Delivered</p>
                            </div>
                            <i class="fas fa-truck fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>
                </div>

                <div class="row my-5">
                    <h3 class="fs-4 mb-3">Orders</h3>

                    <?php if(isset($_GET['message'])){ ?>
                        <p class="text-center" style="color: green;"><?php echo $_GET['message'];  ?></p>
                    <?php } ?>

                    <?php if(isset($_GET['error'])){ ?>
                        <p class="text-center" style="color: red;"><?php echo $_GET['error'];  ?></p>
                    <?php } ?>


                    <div class="col">
                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">Order ID</th>
                                    <th scope="col">Order Status</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">User Phone</th>
                                    <th scope="col">User Address</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php while($row = $orders->fetch_assoc()){   ?>
                                <tr>
                                    <th scope="row"><?php echo $row['order_id']; ?></th>
                                    <td><?php echo $row['order_status']; ?></td>
                                    <td><?php echo $row['user_name']; ?></td>
                                    <td><?php echo $row['order_date']; ?></td>
                                    <td><?php echo $row['user_contact']; ?></td>
                                    <td><?php echo $row['user_address']; ?></td>

                                    <td><a href="edit_order.php?order_id=<?php echo $row['order_id']; ?>" class="btn btn-success">Edit</a></td>
                                </tr>
                            
                            <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>

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