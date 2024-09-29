<?php
include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='accessory' LIMIT 4");
$stmt->execute();
$acc = $stmt->get_result();

?>