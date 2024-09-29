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
else if(isset($_POST['edit_btn']))
{
    $product_id = $_POST['product_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $spprice = $_POST['spprice'];
    $color = $_POST['color'];
    $category = $_POST['category'];
    $brand = $_POST['brand'];

    $stmt = $conn->prepare("UPDATE products SET product_name=?, product_description=?, product_price=?, product_special_offer=?, product_color=?, product_category=?, product_brand=? WHERE product_id=?");
    $stmt->bind_param("ssddsssi", $title, $description, $price, $spprice, $color, $category, $brand, $product_id);
    
    
    
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
                <h1>
                    Edit Products
                </h1>
            </div>
            <div class="edit-form" >
            <form method="POST" action="edit_product.php">
                <?php foreach($products as $pinfo){ ?>
                
                <input name="product_id" type="hidden" value="<?php echo $pinfo['product_id']; ?>" >

                <label for="fname">Title</label>
                <input type="text" id="fname" value="<?php echo $pinfo['product_name']; ?>" name="title" >

                <label for="desc">Description</label>
                <textarea id="subject" name="description" style="height:200px"><?php echo $pinfo['product_description']; ?></textarea>


                <label for="price">Price</label>
                <input type="number" value="<?php echo $pinfo['product_price']; ?>" id="price" name="price">

                <label for="price">Orignal Price</label>
                <input type="number" value="<?php echo $pinfo['product_special_offer']; ?>" id="spprice" name="spprice">

                <label for="color">Color</label>
                <input type="text" value="<?php echo $pinfo['product_color']; ?>" id="color" name="color">

                <label for="country">Category</label>
                <select id="country" name="category">
                    <option value="smart-phone"<?php if ($pinfo['product_category'] == 'smart-phone') echo ' selected'; ?>>Smart-Phone</option>
                    <option value="accessory"<?php if ($pinfo['product_category'] == 'accessory') echo ' selected'; ?>>Accesory</option>
                </select>


                <label for="brand">Brand</label>
                <input type="text" value="<?php echo $pinfo['product_brand']; ?>"id="brand" name="brand">

                <input type="submit" value="Edit" name="edit_btn">
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