<?php 
session_start();
include("../server/connection.php");

// Check if admin is logged in, otherwise redirect to login page
if (!isset($_SESSION['admin_logged_in'])){
    header('location: admin_login.php');
    exit;
}

if(isset($_POST['create_product'])){
    // Save values in variables
    $title = $_POST['title'];
    $description = $_POST['description'];
    $model =$_POST['model'];
    $price = $_POST['price'];
    $spprice = $_POST['spprice'];
    $color = $_POST['color'];
    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $display_size = $_POST['display_size'];
    $processor = $_POST['processor'];
    $rom_size = $_POST['rom_size'];
    $ram_size = $_POST['ram_size'];
    $battery_cap = $_POST['battery_cap'];
    $operating_system = $_POST['operating_system'];
    $camera = $_POST['camera'];

    // Save images
    $image1 = $_FILES['image1']['tmp_name'];
    $image2 = $_FILES['image2']['tmp_name'];
    $image3 = $_FILES['image3']['tmp_name'];
    $image4 = $_FILES['image4']['tmp_name'];
    $image5 = $_FILES['image5']['tmp_name'];

    // Save image locations
    $image_name1 = $_FILES['image1']['name']; 
    $image_name2 = $_FILES['image2']['name'];
    $image_name3 = $_FILES['image3']['name'];
    $image_name4 = $_FILES['image4']['name'];
    $image_name5 = $_FILES['image5']['name'];

    move_uploaded_file($image1, "../assets/img/" . $image_name1);
    move_uploaded_file($image2, "../assets/img/" . $image_name2);
    move_uploaded_file($image3, "../assets/img/" . $image_name3);
    move_uploaded_file($image4, "../assets/img/" . $image_name4);
    move_uploaded_file($image5, "../assets/img/" . $image_name5);

    // Prepare and execute SQL statement to insert product into database
    $stmt = $conn->prepare("INSERT INTO products 
                            (product_name, product_description, product_model, product_price, product_special_offer, product_category, 
                            product_brand, display_size, processor, rom_size, ram_size, battery_cap, operating_system, 
                            camera, product_image, product_image2, product_image3, product_image4, product_image5, product_color) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param('sssiisssssssssssssss', $title, $description, $model, $price, $spprice, $category, $brand, 
                      $display_size, $processor, $rom_size, $ram_size, $battery_cap, $operating_system, 
                      $camera, $image_name1, $image_name2, $image_name3, $image_name4, $image_name5, $color);

    // Check if the execution was successful and redirect accordingly
    if ($stmt->execute()) {
        header('Location: products.php?product_created=Product has been created successfully');
        exit;
    } else {
        header('Location: products.php?product_failed=Error occurred, try again');
        exit;
    }
}
?>