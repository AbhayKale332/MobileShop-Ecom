<?php 
session_start();
include("../server/connection.php");
//if admin is not logged in send him to login page
if (!isset($_SESSION['admin_logged_in'])){
    header('location: admin_login.php');
    exit;
}
if (!isset($_SESSION['admin_logged_in'])){
    header('location: admin_login.php');
    exit;
}

if(isset($_GET['product_id'])){
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id=?");
    $stmt->bind_param("i", $_GET["product_id"]);

    if($stmt->execute()){

    header('location: products.php?deleted_successfully=Product Has Been deleted successfully');
    }else{
        header('location: products.php?deleted_unsuccessfully=Product Delete Failure');
    }
}

?>