<?php 
session_start();
include("../server/connection.php");
//if admin is not logged in send him to login page
if (!isset($_SESSION['admin_logged_in'])){
    header('location: admin_login.php');
    exit;
}
//get products info
if (isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE product_id=? ");
$stmt->bind_param('i', $product_id);
$stmt->execute();
$products = $stmt->get_result();
}
else if(isset($_POST['spec_btn']))
{
    $product_id = $_POST['product_id'];
    $display_size = $_POST['display_size'];
    $processor = $_POST['processor'];
    $rom_size = $_POST['rom_size'];
    $ram_size = $_POST['ram_size'];
    $battery_cap = $_POST['battery_cap'];
    $operating_system = $_POST['operating_system'];
    $camera = $_POST['camera'];

    $stmt = $conn->prepare("UPDATE products SET display_size=?, processor=?, rom_size=?, ram_size=?, battery_cap=?, operating_system=?, camera=? WHERE product_id=?");
    $stmt->bind_param("sssssssi", $display_size, $processor, $rom_size, $ram_size, $battery_cap, $operating_system, $camera, $product_id);
    
    
    
    if ($stmt->execute()) {
        // Redirect before any output is sent to the browser
        header('location: products.php?edit_success_message=Product has been updated successfully');
        exit(); // Ensure that no further code is executed after the redirect
    }
    
    // If execution fails, you can set an error message
    $error_message = "Update failed!";

    header('location: products.php');

}

else{

    header('location: products.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="wrapper">
    <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a class="logo-txt" href="dashboard.php"><span class="logo-txt">माउली MOB</span></a>
                </div>
            </div>
            <ul class="sidebar-nav">
            <li class="sidebar-item">
                    <a href="admin_account.php" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Admin Account</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="dashboard.php" class="sidebar-link">
                    <i class="lni lni-control-panel"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="products.php" class="sidebar-link">
                    <i class="lni lni-list"></i>
                        <span>Products</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="add_product.php" class="sidebar-link">
                    <i class="lni lni-circle-plus"></i>
                        <span>Add Product</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="repairs.php" class="sidebar-link">
                    <i class="lni lni-shield"></i>
                        <span>Repairs</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="var_product.php" class="sidebar-link">
                    <i class="lni lni-pallet"></i>
                        <span>Add Colors/Storage</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="contacts.php" class="sidebar-link">
                    <i class="lni lni-popup"></i>
                        <span>Contact Data</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="logout.php?logout=1" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <div class="main p-3">
    <div class="text-center">
        <h1>Edit Product</h1>
    </div>
    <div class="edit-form">
        <form method="POST" action="edit_specification.php">
        <?php foreach($products as $product){ ?>
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">

            <label for="display_size">Display Size</label>
            <input type="text" id="display_size" name="display_size" value="<?php echo $product['display_size']; ?>">

            <label for="processor">Processor</label>
            <input type="text" id="processor" name="processor" value="<?php echo $product['processor']; ?>">

            <label for="rom_size">ROM Size</label>
            <input type="text" id="rom_size" name="rom_size" value="<?php echo $product['rom_size']; ?>">

            <label for="ram_size">RAM Size</label>
            <input type="text" id="ram_size" name="ram_size" value="<?php echo $product['ram_size']; ?>">

            <label for="battery_cap">Battery Capacity</label>
            <input type="text" id="battery_cap" name="battery_cap" value="<?php echo $product['battery_cap']; ?>">

            <label for="operating_system">Operating System</label>
            <input type="text" id="operating_system" name="operating_system" value="<?php echo $product['operating_system']; ?>">

            <label for="camera">Camera</label>
            <input type="text" id="camera" name="camera" value="<?php echo $product['camera']; ?>">

            <input type="submit" value="Edit" name="spec_btn">
            <?php } ?>
        </form>
    </div>
</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script>
    const hamBurger = document.querySelector(".toggle-btn");
    hamBurger.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("expand");
    });
</script>
</html>