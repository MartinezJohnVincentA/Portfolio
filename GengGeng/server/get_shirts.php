<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM items WHERE (item_img LIKE '%1%') AND (item_category LIKE '%Shirts%');");


$stmt->execute();

$shirt_item = $stmt->get_result();








?>