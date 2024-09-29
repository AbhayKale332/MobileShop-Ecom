<?php
session_start();
if(!isset($_SESSION['logged_in'])){
  header('location: login.php?message=Please Login First');
  exit;
}
if (isset($_POST['add_to_cart'])) {
    if (isset($_SESSION['cart'])) {
        $products_array_ids = array_column($_SESSION['cart'], "product_id");

        if (!in_array($_POST['product_id'], $products_array_ids)) {
            $product_id = $_POST['product_id'];
            $product_array = array(
                'product_id' => $product_id,
                'product_image' => $_POST['product_image'],
                'product_price' => $_POST['product_price'],
                'product_name' => $_POST['product_name'],
                'product_quantity' => $_POST['product_quantity']
            );
            $_SESSION['cart'][$product_id] = $product_array;
        } else {
            echo '<script>alert("Product is already added");</script>';
        }
    } else {
        $product_id = $_POST['product_id'];
        $product_image = $_POST['product_image'];
        $product_price = $_POST['product_price'];
        $product_name = $_POST['product_name'];
        $product_quantity = $_POST['product_quantity'];
        $product_array = array(
            'product_id' => $product_id,
            'product_image' => $product_image,
            'product_price' => $product_price,
            'product_name' => $product_name,
            'product_quantity' => $product_quantity
        );
        $_SESSION['cart'][$product_id] = $product_array;
    }

    calculateTotalCart();
} elseif (isset($_POST['remove_product'])) {
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
    calculateTotalCart();
} elseif (isset($_POST['edit_quantity'])) {
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];
    $product_array = $_SESSION['cart'][$product_id];
    $product_array['product_quantity'] = $product_quantity;
    $_SESSION['cart'][$product_id] = $product_array;
    calculateTotalCart();
} else {
    // header('location: index.php');
}

// Calculate cart total js
function calculateTotalCart()
{
    $subtotal = 0;
    foreach ($_SESSION['cart'] as $key => $value) {
        $product = $_SESSION['cart'][$key];
        $price = $product['product_price'];
        $quantity = $product['product_quantity'];
        $subtotal += $price * $quantity;
    }

    // Format subtotal with two decimal places
    $formattedSubtotal = number_format($subtotal, 2, '.', '');

    // Calculate tax (18%)
    $tax = 0.18 * $formattedSubtotal;

    // Calculate total (subtotal + tax)
    $total = $formattedSubtotal + $tax;

    // Set session variables for formatted subtotal, total, and tax
    $_SESSION['subtotal'] = $formattedSubtotal;
    $_SESSION['total'] = $total;
    $_SESSION['tax'] = $tax;
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
<section>
    <div class="container shopping_cart">
       <h2 class="px-5 p-2">Shopping Cart</h2>
       <div class="cart">
          <div class="col-md-12 col-lg-10 mx-auto">
          <?php foreach($_SESSION['cart'] as $key => $value) { ?>
             <div class="cart-item">
                <div class="row">
                   <div class="col-md-7 center-item">
                      <img src="assets/img/<?php echo $value['product_image']; ?>" alt="Product_img">
                      <h5 class="cart-name" ><?php echo $value['product_name']; ?></h5>
                   </div>

                   <div class="col-md-5 center-item">
                   <form method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                            <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>">
                            <button type="submit" class="edit-btn" name="edit_quantity">Edit</button>
                        </form>
                      <h5>₹ <span id="phone-total"><?php echo $value['product_price'] * $value['product_quantity']; ?></span> </h5>
                      <form method="POST" action="cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                        <button type="submit" name="remove_product" class="transparent-button remove-btn"><i class="fa-solid fa-xmark" style="color: #fe0b0b;"></i></button>
                    </form>
                   </div>
                </div>
             </div>
             <?php }?>
             <div class="cart-item">
                <div class="row g-2">
                   <div class="col-6">
                      <h5 class="cart_num">Subtotal: </h5>
                      <h5 class="cart_num">Tax:</h5>
                      <h5 class="cart_num">Total:</h5>
                   </div>

                   <div class="col-6 status">
                      <h5>₹<span id="sub-total" class="cart_num" > <?php echo isset($_SESSION['subtotal']) ? $_SESSION['subtotal'] : '0.00'; ?></span></h5>
                      <h5>₹<span id="tax-amount"class="cart_num"> <?php echo isset($_SESSION['tax']) ? $_SESSION['tax'] : '0.00'; ?></span></h5>
                      <h5>₹<span id="total-price"class="cart_num"> <?php echo isset($_SESSION['total']) ? $_SESSION['total'] : '0.00'; ?></span></h5>
                   </div>
                </div>
             </div>
             <div class="col-md-12 pt-4 pb-4">
             <form method="POST" action="checkout.php">
                <button type="submit" name="checkout" class="btn btn-success check-out">Check Out</button>
            </form>
             </div>
          </div>
       </div>
    </div>
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