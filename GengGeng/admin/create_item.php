<?php

include('../server/connection.php');

if(isset($_POST['add_btn'])){

$item_name = $_POST['name'];
$item_category = $_POST['category'];
$item_price = $_POST['price'];
$item_status = $_POST['status'];
$item_desc = $_POST['description'];

$item_image = $_POST['image'];
$item_image2 = $_POST['image2'];
$item_image3 = $_POST['image3'];
$item_image4 = $_POST['image4'];


//Creates Item
$stmt = $conn->prepare("INSERT INTO items (item_name,item_category,item_img,item_img2,item_img3,item_img4,item_price,item_status,item_desc)
                              VALUES (?,?,?,?,?,?,?,?,?)");

$stmt->bind_param('sssssssss', $item_name,$item_category,$item_image,$item_image2,$item_image3,$item_image4,$item_price,$item_status,$item_desc);

if($stmt->execute()){
    header('location: items.php?message=Item has been Added');
}else{
    header('location: items.php?error=Error Occured');
}



}















?>