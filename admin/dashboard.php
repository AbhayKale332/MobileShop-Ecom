<?php 
session_start();
include("../server/connection.php");
//check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])){
    header('location: admin_login.php');
    exit;
}


    //get prodcuts

  
    $stmt = $conn->prepare("SELECT * FROM orders ORDER BY order_id DESC");
    $stmt->execute();
    $orders = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
                <h1>Orders </h1>
                <hr>
                <?php
                    if (isset($_GET['edit_success_message'])) {
                        ?>
                        <p class="text-center" style="color: green;"><?php echo $_GET['edit_success_message'];
                        } ?></p>
                    
                <?php
                    if (isset($_GET['deleted_successfully'])) {
                        ?>
                        <p class="text-center" style="color: green;"><?php echo $_GET['deleted_successfully'];
                        } ?></p>

                <?php
                    if (isset($_GET['deleted_unsuccessfully'])) {
                        ?>
                        <p class="text-center" style="color: green;"><?php echo $_GET['deleted_unsuccessfully'];
                        } ?></p>
                    
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Order Status</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Mob.Number</th>
                            <th scope="col">User Address</th>
                            <th scope="col">Order Cost</th>
                            <th scope="col">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($orders as $order){ ?>
                        <tr>
                        <td><?php echo $order['order_id']; ?></td>
                        <td><?php echo $order['order_status']; ?></td>
                        <td><?php echo $order['user_id']; ?></td>
                        <td><?php echo $order['order_date']; ?></td>
                        <td><?php echo $order['user_phone']; ?></td>
                        <td><?php echo $order['user_address']; ?></td>
                        <td><?php echo $order['order_cost']; ?></td>
                        <td><a class="edit-btn" href="edit_order.php?order_id=<?php echo $order['order_id'] ?>">Edit Status</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
</body>

</html>