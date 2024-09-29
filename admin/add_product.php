<?php 

    session_start();
    include("../server/connection.php");
    //if admin is not logged in send him to login page
    if (!isset($_SESSION['admin_logged_in'])){
        header('location: admin_login.php');
        exit;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
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
                    Add New Product
                </h1>
            </div>
            <div class="edit-form">
                <form id="create-form" method="POST" enctype="multipart/form-data" action="create_product.php">

                <label for="fname">Title</label>
                <input type="text" id="fname" name="title">

                <label for="model">Product Model</label>
                <input type="text" id="model" name="model">

                <label for="desc">Youtube Video Link</label>
                <input type="text" id="subject" name="description">

                <label for="price">Price</label>
                <input type="number" id="price" name="price">

                <label for="price">Original Price</label>
                <input type="number" id="spprice" name="spprice">

                <label for="color">Color</label>
                <input type="text" id="color" name="color">

                <label for="country">Category</label>
                <select id="country" name="category">
                    <option value="smart-phone">Smart-Phone</option>
                    <option value="accessory">Accessory</option>
                </select>

                <label for="brand">Brand</label>
                <input type="text" id="brand" name="brand">

                <div class="form-group mt-2">
                <label>Image 1</label>
                <input type="file" class="form-control" id="image1" name="image1" placeholder="Image 1" required/>
                </div>

                <div class="form-group mt-2">
                <label>Image 2</label>
                <input type="file" class="form-control" id="image2" name="image2" placeholder="Image 2" required/>
                </div>

                <div class="form-group mt-2">
                <label>Image 3</label>
                <input type="file" class="form-control" id="image3" name="image3" placeholder="Image 3" required/>
                </div>

                <div class="form-group mt-2">
                <label>Image 4</label>
                <input type="file" class="form-control" id="image4" name="image4" placeholder="Image 4" required/>
                </div>

                <div class="form-group mt-2">
                <label>Image 5</label>
                <input type="file" class="form-control" id="image5" name="image5" placeholder="Image 5" required/>
                </div>

                <label for="display_size">Display Size</label>
                <input type="text" id="display_size" name="display_size">

                <label for="processor">Processor</label>
                <input type="text" id="processor" name="processor">

                <label for="rom_size">ROM Size</label>
                <input type="text" id="rom_size" name="rom_size">

                <label for="ram_size">RAM Size</label>
                <input type="text" id="ram_size" name="ram_size">

                <label for="battery_cap">Battery Capacity</label>
                <input type="text" id="battery_cap" name="battery_cap">

                <label for="operating_system">Operating System</label>
                <input type="text" id="operating_system" name="operating_system">

                <label for="camera">Camera</label>
                <input type="text" id="camera" name="camera">



            <input type="submit" value="Add Product" name="create_product">
        </form>
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