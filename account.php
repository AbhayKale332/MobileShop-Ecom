<?php 

    session_start();
    //if user is not logged in send him to login page
    if (!isset($_SESSION['logged_in'])){
        header('location: login.php');
        exit;
    }

    //logout
    if(isset($_GET['logout'])){
        if(isset($_SESSION['logged_in'])){

            unset($_SESSION['logged_in']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);

            
            header('location: login.php');
            exit;
        }
    }
    include('server/connection.php');
    if (isset($_SESSION['logged_in'])){
        $user_id = $_SESSION['user_id'];
    
        $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=? ");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $orders = $stmt->get_result();
    
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>

<body>
    <!---NavBar-->

    <nav class="navbar navbar-expand-lg navbar-light fixed-top" >
        <div class="container-fluid">
          <img src="assets/img/logo.png" height="50px" width="55px"/>
          <h2 class="brand">माउली Mobiles</h2>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="index.php"><i class="fa-solid fa-house"></i>&ensp;Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="shop.php"><i class="fa-solid fa-shop"></i>&ensp;Shop</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="repair.php"><i class="fa-solid fa-screwdriver-wrench"></i>&ensp;Repair</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact_us.php"><i class="fa-solid fa-phone"></i>&ensp;Contact Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-icon" href="cart.php"><i class="fas fa-cart-shopping fa-xl"></i></a>
                <a class="nav-icon" href="account.php"><i class="fas fa-user fa-lg"></i></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!---NavBarEND-->
    <!--Account-->
    <style>
    .btn {
        background-color: yellow;
        transition: background-color 0.3s ease;
        text-decoration: none;
        color: inherit;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .btn:hover {
        background-color: coral;
        color: white;
    }

    .acc-inf {
        margin-top: 0;
        padding-top: 0;
    }
</style>

<section class="my-5 py-5">
    <div class="row container mx-auto">
        <div class="text-center">
            <div class="acc-inf">
                <h3 class="font-weight-bold">Account info</h3><br>
                <style>
                    .account-info-container {
                        border: 2px solid coral;
                        padding: 30px 20px 20px 20px; /* 30px padding top, 20px padding right/left/bottom */
                        border-radius: 10px;
                        background-color: #f9f9f9; /* Optional: Adding a light gray background color */
                        max-width: 400px; /* Adjust the width as needed */
                        margin: 0 auto; /* Center the container horizontally */
                    }
                </style>

                <div class="container pt-3 ">
                    <div class="account-info-container">
                        <div class="account-info">
                        <img src="assets/img/accpfp.png" alt="Profile Picture" class="img-fluid mb-4" style="width: 140px; height: 140px; padding-top: 15px;">
                            <p><strong>Name:</strong> <span><?php echo $_SESSION['user_name']; ?></span></p>
                            <p><strong>Email:</strong> <span><?php echo $_SESSION['user_email']; ?></span></p>
                            <p><a href="#orders" id="order-btn" class="btn">Your Orders</a></p>
                            <p><a href="account.php?logout=1" id="logout-btn" class="btn">Log-Out</a></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>



    <!-- My orders -->
<section id="orders" class="acc-orders container my-5 py-5">
    <div class="container mt-5">
        <h2 class="font-weight-bold text-center">Your Orders</h2>
        <hr>
    </div>
    <table class="mt-5 pt-5">
        <tr>
            <th>Order_ID</th>
            <th>Order cost</th>
            <th>Order Status</th>
            <th>Order Date</th>
            <th>Order Details</th>
        </tr>

        <?php while($row = $orders->fetch_assoc()){?>

        <tr class="product-row">
            <td>
                <div>
                    <!-- <img src="assets/img/featured1.png" alt="img"> -->
                    <div>
                        <p class="mt-3"><?php echo $row['order_id']; ?></p>
                    </div>
                </div>
            </td>
            <td>
                <span><?php echo $row['order_cost']; ?></span>
            </td>
            <td>
                <span><?php echo $row['order_status']; ?></span>
            </td>
            <td>
                <span><?php echo $row['order_date']; ?></span>
            </td>
            <td>
                <form method="GET" action="order_details.php">
                    <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id">
                    <input class="btn order-details" name="order_details_btn" type="submit" value="Details">
                </form>
            </td>
        </tr>
<?php } ?>
        
    </table>

</section>

 <!-- footer -->
            
 <footer class="mt-5 py-5">
    <div class="row container mx-auto pt-5">
        <div class="footer-one col-lg-3  col-md-6 col-sm-12">
            <img src="assets/img/logo.png" alt="logo" height="40%" width="40%">
            <p class="pt-3">"Discover the best in mobile solutions at Mauli Mobiles. We offer premium smartphones, 
                expert repair services, and quality accessories. 
                Trust Mauli Mobiles for top-notch devices and personalized care. Your mobile experience, our priority."</p>
        </div>
        <div class="footer-one col-lg-3  col-md-6 col-sm-12">
            <h5 class="pb-2">Featured</h5>
            <ul class="text-uppercase">
                <li><a href="https://www.instagram.com/abhaykale_27/">Abhay😎</a></li>
                <li><a href="https://www.instagram.com/abhaykale_27/">Abhay😎</a></li>
                <li><a href="https://www.instagram.com/abhaykale_27/">Abhay😎</a></li>
                <li><a href="https://www.instagram.com/abhaykale_27/">Abhay😎</a></li>
                <li><a href="https://www.instagram.com/abhaykale_27/">Abhay😎</a></li>
                <!-- Add other unique items -->
            </ul>
        </div>
        <div class="footer-one col-lg-3  col-md-6 col-sm-12">
            <a href="contact-us.html"><h5 class="pb-2">Contact Us</h5></a>
            <div>
                <h6 class="text-uppercase">Address</h6>
                <p>69, ABC Street<br>छत्रपति संभाजी नगर<br>PIN: 123456<br>भारत</p>
            </div>
            <div>
                <h6 class="text-uppercase">Phone Number</h6>
                <p>9222 222 007</p>
            </div>
            <div>
                <h6 class="text-uppercase">Email</h6>
                <p>Mauimobiles@gmail.com</p>
            </div>
        </div>
        <div class="footer-one col-lg-3  col-md-6 col-sm-12">
            <h5 class="pb-2">Instagram</h5>
            <div class="row">
                <img src="assets/img/acc-1.webp" alt="Instagram Image" class="img-fluid w-25 h-100 m-2">
                <img src="assets/img/brand2.png" alt="Instagram Image" class="img-fluid w-25 h-100 m-2">
                <img src="assets/img/iphone.jpg" alt="Instagram Image" class="img-fluid w-25 h-100 m-2">
                <img src="assets/img/featured-2.jpg" alt="Instagram Image" class="img-fluid w-25 h-100 m-2">
                <img src="assets/img/brand3.png" alt="Instagram Image" class="img-fluid w-25 h-100 m-2">
            </div>
        </div>
    </div> 
    <div class="copyright mt-5">
      <div class="row container mx-auto">
        <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
          <img src="assets/img/upi_logo.png">
        </div>
        <div class="col-lg-3 col-md-5 col-sm-12 mb-4 text-nowrap mb-2">
          <p>माउली Mobiles © 2024 All Rights Reserved</p>
        </div>
        <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
          <a href="#"><i class="fa-brands fa-facebook fa-xl"></i></a>
          <a href="#"><i class="fa-brands fa-instagram fa-xl"></i></a>
          <a href="https://discord.com/login"><i class="fa-brands fa-discord fa-xl"></i></a>
        </div>
      </div>
    </div> 
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>