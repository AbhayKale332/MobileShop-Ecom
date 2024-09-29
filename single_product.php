<?php
include('server/connection.php');
if (isset($_GET['product_id']) && isset($_GET['product_model'])) {
    $product_id = $_GET['product_id'];
    $product_model = $_GET['product_model'];
    $product_color = $_GET['product_color'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $products = $stmt->get_result();
} else {
    header('location: index.php');
    exit; // Exit after redirection to prevent further execution
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
<div class="container">
<?php while($row=$products->fetch_assoc()){ ?>
    <div class="wrapper">
        <div class="product-box">
            <div class="all-images">
            <div class="small-images">
                <img src="assets/img/<?php echo $row['product_image']; ?>" alt="Product Image" onclick="clickimg(this)">
                <img src="assets/img/<?php echo $row['product_image2']; ?>" alt="Product Image" onclick="clickimg(this)">
                <img src="assets/img/<?php echo $row['product_image3']; ?>" alt="Product Image" onclick="clickimg(this)">
                <img src="assets/img/<?php echo $row['product_image4']; ?>" alt="Product Image" onclick="clickimg(this)">
                <img src="assets/img/<?php echo $row['product_image5']; ?>" alt="Product Image" onclick="clickimg(this)">
            </div>
            <div class="main-images">
                <img src="assets/img/<?php echo $row['product_image']; ?>" alt="Product Image" id="imagebox">
            </div>
        </div>
        </div>
        <div class="text">
            <div class="content">
                <p class="brandi"><?php echo $row['product_brand']; ?></p>
                <h2><?php echo $row['product_name']; ?></h2>
                <div class="review">
                    <span class="revi" >4.6</span>
                    <span class=" revi fa fa-star" ></span>
                </div>
                <div class="price-box">
                    <p class="price">₹ <?php echo $row['product_price']; ?></p>
                    <strike class="discount">₹ <?php echo $row['product_special_offer']; ?></strike>
                </div>
                <!-- Product Colors buttons -->
                <div>
                    <label style="font-size: 22px; font-weight: bold;">Colors:</label><br>
                    <?php 
                        $stmt = $conn->prepare("SELECT product_id, product_model, product_color FROM products WHERE product_model = ?");
                        $stmt->bind_param("s", $product_model);
                        $stmt->execute();
                        $colors = $stmt->get_result();

                        // Array to store the displayed colors
                        $displayed_colors = array();

                        // Check if there are any colors found
                        if ($colors->num_rows > 0) {
                            while ($col = $colors->fetch_assoc()) {
                                // Check if the color has already been displayed
                                if (!in_array($col['product_color'], $displayed_colors)) {
                                    // Add the color to the displayed colors array
                                    $displayed_colors[] = $col['product_color'];
                                    
                                    // Generate a button for each color with inline styling
                                    echo '<a href="single_product.php?product_id=' . $col['product_id'] . '&product_model=' . urlencode($col['product_model']) . '&product_color=' . urlencode($col['product_color']) . '">';
                                    echo '<button class="color_btn" style="background-color:' . $col['product_color'] . ';">' . $col['product_color'] . '</button>';
                                    echo '</a>';
                                }
                            }
                        } else {
                            // Handle case where no colors are found
                            echo 'No colors found.';
                        }
                    ?>
                </div>


                    <!-- Product Ram buttons -->
                    <div>
                    <?php 
                        $stmt = $conn->prepare("SELECT product_id, product_model, product_color, ram_size, rom_size, product_category FROM products WHERE product_model = ? AND product_color = ?");
                        $stmt->bind_param("ss", $product_model, $product_color);
                        $stmt->execute();
                        $storage = $stmt->get_result();

                        // Check if there are any storage options found
                        if ($storage->num_rows > 0) {
                            $sto = $storage->fetch_assoc();
                            // Check if the product category is not "accessory"
                            if ($sto['product_category'] !== 'accessory') {
                                echo '<div>';
                                echo '<label style="font-size: 22px; font-weight: bold;">Storage Options:</label><br>';
                                while ($sto) {
                                    // Generate a button for each storage option
                                    echo '<a href="single_product.php?product_id=' . $sto['product_id'] . '&product_model=' . urlencode($sto['product_model']) . '&product_color=' . urlencode($sto['product_color']) . '">';
                                    echo '<button class="color_btn">' . $sto['ram_size'] . ' + ' . $sto['rom_size'] . '</button>';
                                    echo '</a>';
                                    $sto = $storage->fetch_assoc();
                                }
                                echo '</div>';
                            }
                        } else {
                            // Handle case where no storage options are found
                            echo 'No storage options found.';
                        }
                    ?>

                    </div>





              <!-- hidden form -->
                <form method="POST" action="cart.php">
                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>">
                <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">


                <label for="number">Quantity :</label>
                <input type="number" name="product_quantity" value="1"/><br>
                <div class="buybtnx">
                    <button class="buy-btn" type="submit" name="add_to_cart" ><span class="fa fa-cart-shopping"></span> Add To Cart</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    
</div>


<?php 
    if ($row['product_category'] !== 'accessory') {
?>
<section class="specs">
    <div class="spec-table container">
        <div class="title">
            <h3>Product<span> Specification</span></h3>
            <hr>
            <p>Here you can check the product <span>Specification</span></p>
        </div>
        <table class="table table-striped table-hover">
            <tbody>
                <tr>
                    <td>Manufacturer:</td>
                    <td><?php echo $row['product_brand']; ?></td>
                </tr>
                <tr>
                    <td>Name :</td>
                    <td><?php echo $row['product_name']; ?></td>
                </tr>
                <!-- <tr>
                    <td>Description :</td>
                    <td><?php echo $row['product_description']; ?></td>
                </tr> -->
                <tr>
                    <td>Price :</td>
                    <td>₹ <?php echo $row['product_special_offer']; ?></td>
                </tr>
                <tr>
                    <td>Camera Setup :</td>
                    <td><?php echo $row['camera']; ?></td>
                </tr>
                <tr>
                    <td>Processor :</td>
                    <td><?php echo $row['processor']; ?></td>
                </tr>
                <tr>
                    <td>Display :</td>
                    <td><?php echo $row['display_size']; ?></td>
                </tr>
                <tr>
                    <td>Storage(ROM) :</td>
                    <td><?php echo $row['rom_size']; ?></td>
                </tr>
                <tr>
                    <td>Memory(RAM) :</td>
                    <td><?php echo $row['ram_size']; ?></td>
                </tr>
                <tr>
                    <td>Battery Capacity :</td>
                    <td><?php echo $row['battery_cap']; ?></td>
                </tr>
                <tr>
                    <td>Operating System :</td>
                    <td><?php echo $row['operating_system']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
<?php 
    }
?>


<!-- youtube video -->
<div class = "title">
              <h3>Product<span> Review</span></h3>
              <hr>
          </div>
<div class="yt-container">
    <div class="ytvid">
    <?php
    $data = $row['product_description'];
    $final = str_replace('watch?v=', 'embed/', $data);
    echo "
        <iframe
            width='800' 
            height='420' 
            src='$final'
            frameborder='0'
            allow='autoplay; encrypted-media'
            allowfullscreen>
        </iframe>
    ";
?>

    </div>
</div>


<?php } ?>
    
    
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
          <script>
            function clickimg(smallImg){
                var fullImg = document.getElementById("imagebox");
                fullImg.src = smallImg.src
            }
        </script>


<!-- Accessories -->
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
        </body>
    </html>