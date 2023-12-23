<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM items WHERE (item_img LIKE '%1%') AND (item_category LIKE '%Caps%');");


$stmt->execute();

$cap_item = $stmt->get_result();








?>