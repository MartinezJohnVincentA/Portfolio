<?php

session_start();

include('connection.php');

//If customer is logged in
if(!isset($_SESSION['logged_in'])){
    header('location: ../checkout.php?message=Please Login First');
    exit;
}

if(isset($_POST['place_order'])){


//get user info and stores in database
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$order_cost = $_SESSION['total'];
$order_status = "P";
$user_id = $_SESSION['user_id'];
$order_date = date('Y-m-d H:i:s');

$stmt = $conn->prepare("INSERT INTO orders (order_cost,user_id,user_contact,user_address,order_date,order_status)
                 VALUES (?,?,?,?,?,?); ");

$stmt->bind_param('iiisss', $order_cost,$user_id,$contact,$address,$order_date,$order_status);

$stmt_status = $stmt->execute();

if(!$stmt_status){
    header('location: index.php');
    exit;
}

//store order info in database
$order_id = $stmt->insert_id;



//get items from cart 

foreach($_SESSION['cart'] as $key => $value){

    $item = $_SESSION['cart'][$key];
    $item_id = $item['item_id'];
    $item_name = $item['item_name'];
    $item_img = $item['item_img'];
    $item_price = $item['item_price'];
    $item_quantity = $item['item_quantity'];

    //store each single item in order_items database
    $stmt1 = $conn->prepare("INSERT INTO order_items (order_id,item_id,item_name,item_img,item_price,item_quantity,user_id,order_date)
                    VALUES (?,?,?,?,?,?,?,?)");

    $stmt1->bind_param('iissiiis',$order_id,$item_id,$item_name,$item_img,$item_price,$item_quantity,$user_id,$order_date);

    $stmt1->execute();


}




//remove everything from cart
//unset($_SESSION['cart]);








//inform user whether everything is Okay/Not Okay
header('location: ../payment.php?order_status=Order Confirmed Successfully');

}














?>