<?php
include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='smart-phone' LIMIT 8");
$stmt->execute();
$featured_products = $stmt->get_result();

?>