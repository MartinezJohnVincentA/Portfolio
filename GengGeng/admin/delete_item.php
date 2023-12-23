<?php session_start();

include('../server/connection.php');

?>

<?php

// Check if the user is logged in and is an admin
if (!isset($_SESSION['logged_in']) || $_SESSION['user_control'] !== 'A') {
    header('location: ../login.php?message=You cannot be here');
    exit;
}

if(isset($_GET['item_id'])){

    $item_id = $_GET['item_id'];

    $stmt = $conn->prepare("DELETE FROM items WHERE item_id=?");
    $stmt->bind_param('i',$item_id);
    
    
    if($stmt->execute()){


    header('location: items.php?delete=Item has been deleted Successfully');
    
     }else{
        header('location: items.php?failure=Could not Delete Item');
     }
}


?>