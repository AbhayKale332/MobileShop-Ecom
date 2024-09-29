<?php
session_start();
if( !empty($_SESSION['cart']) && isset($_POST['checkout']) ){
//let user in

}
//send user to home page
else{
  header('location: index.php');
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
<style>
    body{
        background: radial-gradient(circle at 10% 20%, rgb(255, 197, 61) 0%, rgb(255, 94, 7) 90%);
        padding: 2rem 0;
    }
    .chckform{
        padding-top: 50px;
        width: 100%;
    }
    .newsp{
        color: black;
        font-weight: 600;
    }
    .btn{
        background-color: coral;
    }
    .opop{
        font-size: 22px;
    }
</style>
<div class="container chckform">
  <div class="row mx-0 justify-content-center">
    <div class="col-md-9 col-lg-7 col-xl-6 col-xxl-5 px-lg-2">
        <div>
            <h1 class="text-center">
            Billing Address
            </h1>
        </div>
      <form id="checkout_form" method="POST" action="place_order.php" class="w-100 rounded-1 p-4 border bg-white">
        <label class="d-block mb-4">
          <span class="newsp" class="form-label d-block">Your name</span class="newsp">
          <input
          id="fname" name="name"
            class="form-control"
        
          />
        </label>

        <label class="d-block mb-4">
          <span class="newsp" class="form-label d-block">Address</span class="newsp">
          <input
          id="adr" name="address"
            type="text"
            class="form-control"
        
          />
        </label>

        <label class="d-block mb-4">
          <span class="newsp" class="form-label d-block">City</span class="newsp">
          <input id="city" name="city" type="text" class="form-control" />
        </label>

        <label class="d-block mb-4">
          <span class="newsp" class="form-label d-block">State</span class="newsp">
          <input id="state" name="state" type="text" class="form-control" />
        </label>

        <label class="d-block mb-4">
          <span class="newsp" class="form-label d-block">Zip/Postal code</span class="newsp">
          <input id="zip" name="zip" type="text" class="form-control" />
        </label>

        <label class="d-block mb-4">
          <span class="newsp" class="form-label d-block">Mobile Number</span class="newsp">
          <input
          id="email" name="email"
            type="text"
            class="form-control"
        
          />
        </label>

        <label class="d-block mb-4">
          <span class="newsp" class="form-label d-block">Delivery information</span class="newsp">
          <textarea
            name="message"
            class="form-control"
            rows="3"
            placeholder="floor/door lock code/etc."
          ></textarea>
        </label>
        <p class="opop" >Total : <span class="newsp" style="color:black"><b></b>₹ <?php echo $_SESSION['total'] ?> </span></p>
        <div class="mb-3">
        <input type="submit" name="place_order" value="Plce Order" class="btn"  >
        </div>

        <div class="d-block text-end">
          <div class="small">
          जय राम कृष्ण हरी
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<style>
    .btn {
        width: 100%; /* Set the width of the button to 100% */
        box-sizing: border-box; /* Include padding and border in the width */
    }
</style>
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
                            <li><a href="https://www.instagram.com/abhaykale_27/">Prasad bhau pankar</a></li>
                            <li><a href="https://www.instagram.com/abhaykale_27/">Prasad bhau pankar</a></li>
                            <li><a href="https://www.instagram.com/abhaykale_27/">Prasad bhau pankar</a></li>
                            <li><a href="https://www.instagram.com/abhaykale_27/">Prasad bhau pankar</a></li>
                            <li><a href="https://www.instagram.com/abhaykale_27/">Prasad bhau pankar</a></li>
                            <!-- Add other unique items -->
                        </ul>
                    </div>
                    <div class="footer-one col-lg-3  col-md-6 col-sm-12">
                        <a href="contact-us.html"><h5 class="pb-2">Contact Us</h5></a>
                        <div>
                            <h6 class="text-uppercase">Address</h6>
                            <p>Near Z.P School, Turkabad (Kharadi) <br>Chhatrapati SambhajiNagar<br>PIN: 431133<br></p>
                        </div>
                        <div>
                            <h6 class="text-uppercase">Phone Number</h6>
                            <p>7378366436</p>
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