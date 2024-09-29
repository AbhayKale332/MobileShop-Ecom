<?php 
session_start();
include("../server/connection.php");
//if admin is not logged in send him to login page
if (!isset($_SESSION['admin_logged_in'])){
    header('location: admin_login.php');
    exit;
}
if(isset($_POST['update_images'])){
    // Save values in variables
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    
    // Save images
    $image1 = $_FILES['image1']['tmp_name'];
    $image2 = $_FILES['image2']['tmp_name'];
    $image3 = $_FILES['image3']['tmp_name'];
    $image4 = $_FILES['image4']['tmp_name'];
    $image5 = $_FILES['image5']['tmp_name'];

    $image_name1 = ($product_name . "1") . ".jpg"; 
    $image_name2 = ($product_name . "2") . ".jpg";
    $image_name3 = ($product_name . "3") . ".jpg";
    $image_name4 = ($product_name . "4") . ".jpg";
    $image_name5 = ($product_name . "5") . ".jpg";
    
    // Move uploaded files to the destination folder
    move_uploaded_file($image1, "../assets/img/" . $image_name1);
    move_uploaded_file($image2, "../assets/img/" . $image_name2);
    move_uploaded_file($image3, "../assets/img/" . $image_name3);
    move_uploaded_file($image4, "../assets/img/" . $image_name4);
    move_uploaded_file($image5, "../assets/img/" . $image_name5);
    
    // Update database with new image names
    $stmt = $conn->prepare("UPDATE products SET product_image=?, product_image2=?, product_image3=?, product_image4=?, product_image5=? WHERE product_id=?");
    $stmt->bind_param('sssssi', $image_name1, $image_name2, $image_name3, $image_name4, $image_name5, $product_id);
    
    if ($stmt->execute()) {
        header('Location: products.php?images_updated=Images have been updated successfully');
    } else {
        header('Location: products.php?images_failed=Error occurred, please try again');
    }
}
?>
