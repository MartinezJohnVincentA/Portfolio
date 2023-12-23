<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM items WHERE item_category LIKE '%Pants%';");


$stmt->execute();

$pants_item = $stmt->get_result();








?>