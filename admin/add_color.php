<?php 

    session_start();
    include("../server/connection.php");
    //if admin is not logged in send him to login page
    if (!isset($_SESSION['admin_logged_in'])){
        header('location: admin_login.php');
        exit;
    }

    if (isset($_GET['product_id'])){
        $pinfo_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id=? ");
    $stmt->bind_param('i', $pinfo_id);
    $stmt->execute();
    $pinfos = $stmt->get_result();
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
                    Add Different Color To Product
                </h1>
            </div>
            <div class="edit-form">
                <form id="create-form" method="POST" enctype="multipart/form-data" action="create_product.php">

                <?php foreach($pinfos as $pinfo){ ?>
                
                <input name="product_id" type="hidden" value="<?php echo $pinfo['product_id']; ?>" >

                <label for="fname">Title <br> Previous Title :<?php echo $pinfo['product_name']; ?> </label>
                <input type="text" id="fname" name="title" >

                <label for="model">Product Model</label>
                <input type="text" id="model" value="<?php echo $pinfo['product_model']; ?>" name="model" readonly>

                <textarea id="subject" name="description" style="height:200px" hidden><?php echo $pinfo['product_description']; ?></textarea>


                <label for="price">Price</label>
                <input type="number" value="<?php echo $pinfo['product_price']; ?>" id="price" name="price">

                <input type="number" value="<?php echo $pinfo['product_special_offer']; ?>" id="spprice" name="spprice" hidden>

                <label for="color">Color</label>
                <input type="text" id="color" name="color" required>

                <select id="country" name="category" hidden>
                    <option value="smart-phone"<?php if ($pinfo['product_category'] == 'smart-phone') echo ' selected'; ?>>Smart-Phone</option>
                    <option value="accessory"<?php if ($pinfo['product_category'] == 'accessory') echo ' selected'; ?>>Accesory</option>
                </select>
            
                <input type="text" value="<?php echo $pinfo['product_brand']; ?>"id="brand" name="brand" hidden>

                <div class="form-group mt-2">
                <label><b>Put Different Images </b> <br> Image 1</label>
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

                <br>
            <input type="text" id="display_size" name="display_size" value="<?php echo $pinfo['display_size']; ?>" hidden>
            <input type="text" id="processor" name="processor" value="<?php echo $pinfo['processor']; ?>" hidden>
            <input type="text" id="rom_size" name="rom_size" value="<?php echo $pinfo['rom_size']; ?>" hidden>
            <input type="text" id="ram_size" name="ram_size" value="<?php echo $pinfo['ram_size']; ?>" hidden>
            <input type="text" id="battery_cap" name="battery_cap" value="<?php echo $pinfo['battery_cap']; ?>" hidden>
            <input type="text" id="operating_system" name="operating_system" value="<?php echo $pinfo['operating_system']; ?>" hidden>
            <input type="text" id="camera" name="camera" value="<?php echo $pinfo['camera']; ?>" hidden>


            <?php } ?>
            <input type="submit" value="Add Color" name="create_product">
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