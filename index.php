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

      <!-- HOME -->
      <?php
    // Check if a message parameter is set and display the corresponding alert
    if(isset($_GET['message'])) {
        $message = $_GET['message'];
        if($message == 'thank_you') {
            echo "<script>alert('Thank you for contacting us');</script>";
        }
    }
    ?>
      <section class="home">
        <div class="button-container left">
            <button class="transparent-button" onclick="goPrev()"><i class="fa-solid fa-arrow-left fa-xl"></i></button>
        </div>
    
        <div class="slider">
            <img src="assets/img/slide1.jpg" class="slide" alt="slideIMG" height="500px" width="1000px">
            <img src="assets/img/slide2.jpg" class="slide" alt="slideIMG" height="500px" width="1000px">
            <img src="assets/img/slide3.jpg" class="slide" alt="slideIMG" height="500px" width="1000px">
            <img src="assets/img/slide4.jpg" class="slide" alt="slideIMG" height="500px" width="1000px">
            <img src="assets/img/slide5.jpg" class="slide" alt="slideIMG" height="500px" width="1000px">
            <img src="assets/img/slide6.jpg" class="slide" alt="slideIMG" height="500px" width="1000px">
            <img src="assets/img/slide7.jpg" class="slide" alt="slideIMG" height="500px" width="1000px">
            <img src="assets/img/slide8.jpg" class="slide" alt="slideIMG" height="500px" width="1000px">
        </div>
    
        <div class="button-container right">
            <button class="transparent-button" onclick="goNext()"><i class="fa-solid fa-arrow-right fa-xl"></i></i></button>
        </div>
      </section>
    <script>
        const slides = document.querySelectorAll(".slide");
        var counter = 0;
    
        slides.forEach((slide, index) => {
            slide.style.left = `${index * 100}%`;
        });
    
        function goPrev() {
            counter--;
            if (counter < 0) {
                counter = slides.length - 1;
            }
            slideImage();
        }

        function goNext() {
            counter++;
            if (counter >= slides.length) {
                counter = 0;
            }
            slideImage();
        }
        
        const slideImage = () => {
            slides.forEach((slide) => {
                slide.style.transform = `translateX(-${counter * 100}%)`;
            });
        };
    
        // Automatically go to the next slide every 9 seconds
        setInterval(goNext, 9000);
    </script>

        <!--Brands-->
        <section id="brand" class="container brands">
            <div class="row">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/img/brand2.png"/>
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/img/brand1.png"/>
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/img/brand3.png"/>
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/img/brand4.png"/>
            
            </div>
            </section>
        <!--Brands END-->

        <!-- featured produts -->
        <section id="featured" class="my-5 pb-5 feat ">
              <div class = "container text-center mt-5 py-5">
                      <h3>Our Featured <span> Products</span></h3>
                      <hr>
                      <p>Here you can check out our featured and most popular <span>Smartphones</span></p>
                  </div>
                  <div class="row mx-auto container-fluid ">
                  <?php include('server/get_featured_products.php');?>
                  <?php while ($row = $featured_products->fetch_assoc()) { ?>
                        <div class="product text-center col-lg-3 col-md-4 col-sm-12" >
                            <img class="img-fluid mb-3" src="assets/img/<?php echo $row['product_image']; ?>" alt="Product_Image">

                            <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                            <h4 class="p-price">₹ <?php echo $row['product_price']; ?></h4>
                            <a href="<?php echo "single_product.php?product_id=". $row['product_id'];?>&product_model=<?php echo $row['product_model']; ?>&product_color=<?php echo $row['product_color']; ?>"><button class="buy-btn"  >Buy Now</button></a>
                        </div>
                        <?php } ?>
                </div>
        </section>

        <!--Banner-->
    <section id="banner" class="my-5 py-5">
    <div class="container">
    <h4>Professional Reparing Services</h4>
    <h1>Screen Replacements <br> Motherboard Replacements</h1>
    <button class="text-uppercase">Repair Now</button>
    </div>
    </section>


    <!-- Our Services -->
    <section class="service-grid">
        <div class="container">
            <div class = "container text-center">
                      <h3>Our <span> Services</span></h3>
                      <hr>
                      <p class="ssx">Here you can check out our featured and most popular <span>Smartphones</span></p>
                  </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 text-center mb-3">
                    <div class="service-wrap">
                        <div class="service-icon">
                            <i class="fa-solid fa-mobile-screen"></i>
                        </div>
                        <h4>Mobiles At Best Price</h4>
                        <p>Buy mobile phone at wholesale price with heavy discount and 1 year warrenty Our mobiles have 100% Quality Guarantee</p>
                        <a href="shop.php">Buy Now</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 text-center mb-3">
                    <div class="service-wrap">
                        <div class="service-icon">
                            <i class="fa-solid fa-headset"></i>
                        </div>
                        <h4>24/7 Support</h4>
                        <p>With Mauli Mobiles you get 24/7 support the customer can call hour helpline number or submit the Contact Us form</p>
                        <a href="contact_us.php">Contact Us</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 text-center mb-3">
                    <div class="service-wrap">
                        <div class="service-icon">
                            <i class="fas fa-screwdriver-wrench"></i>
                        </div>
                        <h4>Doorstep Mobile repairs</h4>
                        <p>We provide Doorstep Mobile Repair service in CHH.Sambhaji Nagar. Get your smartphones fixed without leaving home</p>
                        <a href="repair.php">Repair Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- accessories -->

    <section id="featured" class="my-5 acc">
        <div class = "container text-center mt-5 py-5">
                <h3>Our Featured <span> Accessories</span></h3>
                <hr>
                <p>Here you can check out our most popular <span>Accessories</span></p>
            </div>
            <div class="row mx-auto container-fluid ">
                  <?php include('server/get_accessories.php');?>
                  <?php while ($row = $acc->fetch_assoc()) { ?>
                        <div class="product text-center col-lg-3 col-md-4 col-sm-12" >
                            <img class="img-fluid mb-3" src="assets/img/<?php echo $row['product_image']; ?>" alt="Product_Image">

                            <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                            <h4 class="p-price">₹ <?php echo $row['product_price']; ?></h4>
                            <a href="<?php echo "single_product.php?product_id=". $row['product_id'];?>&product_model=<?php echo $row['product_model']; ?>&product_color=<?php echo $row['product_color']; ?>"><button class="buy-btn"  >Buy Now</button></a>
                        </div>
                        <?php } ?>
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
                            <li><a href="https://www.instagram.com/abhaykale_27/">Bhagwan Mete</a></li>
                            <li><a href="https://www.instagram.com/abhaykale_27/">Mauli Mete</a></li>
                            <li><a href="https://www.instagram.com/abhaykale_27/">Abhay Kale</a></li>
                            <li><a href="https://www.instagram.com/abhaykale_27/">Aman Khan</a></li>
                            <li><a href="https://www.instagram.com/abhaykale_27/">Prasad Pankar</a></li>
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