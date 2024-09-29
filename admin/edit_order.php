<?php 
session_start();
include("../server/connection.php");
//if admin is not logged in send him to login page
if (!isset($_SESSION['admin_logged_in'])){
    header('location: admin_login.php');
    exit;
}
//get products info
if (isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
$stmt = $conn->prepare("SELECT * FROM orders WHERE order_id=? ");
$stmt->bind_param('i', $order_id);
$stmt->execute();
$order = $stmt->get_result();
}
else if(isset($_POST['edit_order']))
{
    $order_status = $_POST['order_status'];
    $order_id = $_POST['order_id'];
    $price = $_POST['price'];
    $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
    $stmt->bind_param("si", $order_status, $order_id);
    
    
    
    if ($stmt->execute()) {
        // Redirect before any output is sent to the browser
        header('location: dashboard.php?edit_success_message=order has been updated successfully');
        exit(); // Ensure that no further code is executed after the redirect
    }
    
    // If execution fails, you can set an error message
    $error_message = "Update failed!";

    header('location: dashboard.php');

}

else{

    header('location: dashboard.php');
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
            <form method="POST" action="edit_order.php">
                <?php foreach($order as $r){ ?>
                
                    <p style="color: red;">
                        <?php if(isset($_GET['error'])){ echo $_GET['error']; } ?>
                    </p>

                    <div class="form-group my-3">
                        <label>Order ID</label>
                        <p class="my-4"><?php echo $r['order_id']; ?></p>
                    </div>

                     <div class="form-group mt-3">
                        <label>Order Price</label>
                        <p class="my-4"><?php echo $r['order_cost']; ?></p>
                    </div>

                    <input type="hidden" name="order_id" value="<?php echo $r['order_id'] ?>">

                    <div class="form-group my-3">
                        <label>Order Status</label>
                        <select class="form-select" required name="order_status">
                        
                            <option value="ON_HOLD" <?php if($r['order_status'] == 'ON_HOLD'){echo "selected";} ?> >ON Hold</option>
                            <option value="preparing" <?php if($r['order_status'] == 'preparing'){echo "selected";} ?> >Preparing For Shipping</option>
                            <option value="shipped" <?php if($r['order_status'] == 'shipped'){echo "selected";} ?> >Shipped</option>
                            <option value="delivered" <?php if($r['order_status'] == 'delivered'){echo "selected";} ?> >Delivered</option>
                        </select>
                    </div>

                <div class="form-group mt-3">
                        <label>Order Date</label>
                        <p class="my-4"><?php echo $r['order_date']; ?></p>
                    </div>

                <input type="submit" value="Edit" name="edit_order">
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
<style>
input[type=text], select,textarea {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=number], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}
.edit-form{
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

</style>
</html>