<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM items WHERE item_img LIKE '%1%' ORDER BY RAND() LIMIT 4");


$stmt->execute();

$feat_item = $stmt->get_result();








?>