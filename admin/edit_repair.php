<?php 
session_start();
include("../server/connection.php");
//if admin is not logged in send him to login page
if (!isset($_SESSION['admin_logged_in'])){
    header('location: admin_login.php');
    exit;
}
//get products info
if (isset($_GET['repair_id'])){
    $repair_id = $_GET['repair_id'];
$stmt = $conn->prepare("SELECT * FROM repairs WHERE repair_ID=? ");
$stmt->bind_param('i', $repair_id);
$stmt->execute();
$order = $stmt->get_result();
}
else if(isset($_POST['edit_repair']))
{
    $repair_status = $_POST['repair_status'];
    $order_id = $_POST['order_id'];
    $description = $_POST['description'];
    $price = $_POST['repair_cost'];
    $stmt = $conn->prepare("UPDATE repairs SET repair_status=?, repair_cost=?, repair_desc=? WHERE repair_ID=?");
    $stmt->bind_param("sisi", $repair_status, $price, $description, $order_id);
    
    
    
    if ($stmt->execute()) {
        // Redirect before any output is sent to the browser
        header('location: repairs.php?edit_success_message=order has been updated successfully');
        exit(); // Ensure that no further code is executed after the redirect
    }
    
    // If execution fails, you can set an error message
    $error_message = "Update failed!";

    header('location: repairs.php');

}

else{

    header('location: repairs.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order Status</title>
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
                    Edit Order Status
                </h1>
            </div>
            <div class="edit-form" >
            <form method="POST" action="edit_repair.php">
                <?php foreach($order as $r){ ?>
                
                    <p style="color: red;">
                        <?php if(isset($_GET['error'])){ echo $_GET['error']; } ?>
                    </p>

                    <div class="form-group my-3">
                        <label>Repair ID</label>
                        <div style="background-color: white; padding: 10px;">
                            <p class="my-2"><?php echo $r['repair_ID']; ?></p>
                        </div>
                    </div>

                    <div class="form-group my-3">
                        <label>Tracking Code</label>
                        <div style="background-color: white; padding: 10px;">
                            <p class="my-2"><?php echo $r['tracking_code']; ?></p>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label>Order Date&Time</label>
                        <div style="background-color: white; padding: 10px;">
                            <p class="my-2"><?php echo $r['repair_date']; ?></p>
                        </div>
                    </div>


                     <div class="form-group mt-3">
                        <label>Repair Cost</label>
                        <input type="number" value="<?php echo $r['repair_cost']; ?>" name="repair_cost" >
                    </div>

                    <input type="hidden" name="order_id" value="<?php echo $r['repair_ID'] ?>">

                    <div class="form-group my-3">
                        <label>Order Status</label>
                        <select class="form-select" required name="repair_status">
                        
                        <option value="Waiting For Executive Approval" <?php if($r['repair_status'] == 'Waiting For Executive Approval'){echo "selected";} ?> >Waiting For Executive Approval</option>
                        <option value="Waiting For Pickup" <?php if($r['repair_status'] == 'Waiting For Pickup'){echo "selected";} ?> >Waiting For Pickup</option>
                        <option value="Device Is Picked Up" <?php if($r['repair_status'] == 'Device Is Picked Up'){echo "selected";} ?> >Device Is Picked Up</option>
                        <option value="Repairing Your Device" <?php if($r['repair_status'] == 'Repairing Your Device'){echo "selected";} ?> >Repairing Your Device</option>
                        <option value="preparing" <?php if($r['repair_status'] == 'preparing'){echo "selected";} ?> >Preparing For Shipping</option>
                        <option value="shipped" <?php if($r['repair_status'] == 'shipped'){echo "selected";} ?> >Shipped</option>
                        <option value="delivered" <?php if($r['repair_status'] == 'delivered'){echo "selected";} ?> >Delivered</option>

                        </select>
                    </div>

                    <label for="desc">Description</label>
                    <textarea id="subject" name="description" style="height:200px"><?php echo $r['repair_desc']; ?></textarea>

                <input type="submit" value="Edit" name="edit_repair">
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