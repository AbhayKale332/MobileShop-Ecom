<?php
include('server/connection.php');

// Initialize variables
$products = null;
$searchTerm = null;
$brand = null;
$price = null;
$message = "";

// Handle search bar
if(isset($_POST['search'])) {
  $searchTerm = $_POST['search'];
  $stmt = $conn->prepare("SELECT * FROM products WHERE product_name LIKE ?");
  $searchTermLike = "%{$searchTerm}%"; // Including wildcards in the search term for the SQL query
  $stmt->bind_param("s", $searchTermLike);
  $stmt->execute();
  $products = $stmt->get_result();
  if ($products->num_rows == 0) {
      // Removing wildcards from the message
      $message = "No products found for '{$searchTerm}'";
  }
}


// Handle filter section
if(isset($_POST['category']) && isset($_POST['price'])) {
    $brand = $_POST['category'];
    $price = $_POST['price'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_brand=? AND product_price<=?");
    $stmt->bind_param("si", $brand, $price);
    $stmt->execute();
    $products = $stmt->get_result();
} elseif (!$products) {
    // If no search or filter applied, fetch all products
    $stmt = $conn->prepare("SELECT * FROM products");
    $stmt->execute();
    $products = $stmt->get_result();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    
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
      <!-- Search Bar -->

<!-- Search Filters -->
<section id="search" class="search my-5 py-5 ms-2">
<style>
    .search {
        left: 0;
        top: -50px;
        float: left;
    }

    #search {
        margin-right: 20px;
        margin-bottom: 20px;
    }

    #featured {
        display: flex;
        justify-content: space-between;
    }

    .filter-section {
        width: 20%;
    }

    .product-grid {
        width: 95%;
        margin-left: auto;
        display: flex;
        flex-wrap: wrap;
    }

    .product {
        margin-bottom: 20px;
        width: calc(33.3333% - 20px);
        box-sizing: border-box;
    }

    .product-img img {
        width: 100%;
        height: auto;
    }

    .titis {
        padding-left: 7%;
    }

    .pagination {
        padding-left: 30%;
    }

    .finpri {
        font-size: 20px;
        color: #00ff00;
        font-weight: 700;
    }
</style>

  <div class="container  py-5">
    <p>Search Products</p>
    <hr>
  </div>
  <form action="shop.php" method="POST" >
    <div class="row mx-auto container">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <p>Brand</p>
        <div class="form-check">
          <input class="form-check-input" value="Apple" type="radio" name="category" id="category_one" <?php if(isset($brand) && $brand=='Apple') {echo 'checked';}?> >
          <label class="form-check-label" for="category_one">Apple</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" value="Samsung" type="radio" name="category" id="category_two" <?php if(isset($brand)&& $brand=='Samsung'){echo 'checked';}?>>
          <label class="form-check-label" for="category_two">Samsung</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" value="OnePlus" type="radio" name="category" id="category_three" <?php if(isset($brand)&& $brand=='OnePlus'){echo 'checked';}?>>
          <label class="form-check-label" for="category_three">OnePlus</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" value="Redmi" type="radio" name="category" id="category_four" <?php if(isset($brand) && $brand=='Redmi') {echo 'checked';}?>>
          <label class="form-check-label" for="category_four">Redmi</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" value="Realme" type="radio" name="category" id="category_five" <?php if(isset($brand) && $brand=='Realme') {echo 'checked';}?>>
          <label class="form-check-label" for="category_five">Realme</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" value="Oppo" type="radio" name="category" id="category_six" <?php if(isset($brand) && $brand=='Oppo') {echo 'checked';}?>>
          <label class="form-check-label" for="category_six">Oppo</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" value="Vivo" type="radio" name="category" id="category_seven" <?php if(isset($brand) && $brand=='Vivo') {echo 'checked';}?>>
          <label class="form-check-label" for="category_seven">Vivo</label>
        </div>
      </div>
    </div>
    <div class="row mx-auto container mt-5">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="slider-container">
            <div id="currentValue" class="slider-value">₹<?php if(isset($price)){echo $price;}else {echo '30000';}?></div>
            <input type="range" class="form-range w-150" name="price" value="<?php if(isset($price)){echo $price;}else {echo '30000';}?>" min="5000" max="200000" step="1000" id="customRange2">
        </div>
    </div>
</div>

<script>
    var slider = document.getElementById('customRange2');
    var currentValue = document.getElementById('currentValue');

    slider.addEventListener('input', function () {
        var newValue = "₹" + Math.ceil(this.value / 1000) * 1000; // Include rupee symbol and round up to the nearest 1000
        currentValue.innerText = newValue;
        currentValue.style.backgroundColor = '#00FFFF'; // Set background color
        updateSliderValuePosition();
    });

    slider.addEventListener('change', function () {
        currentValue.style.backgroundColor = 'transparent'; // Reset background color when value is not changing
    });

    function updateSliderValuePosition() {
        var sliderWidth = slider.offsetWidth;
        var range = slider.max - slider.min;
        var percent = (slider.value - slider.min) / range;
        var position = percent * sliderWidth;
        currentValue.style.left = position + 'px';
    }

    // Initial positioning of the slider value
    updateSliderValuePosition();
</script>


<style>
    .slider-container {
        position: relative;
    }

    .slider-value {
        position: absolute;
        top: -30px; /* Adjust the distance above the slider */
        left: 50%; /* Center the value */
        transform: translateX(-50%); /* Adjust to center the value horizontally */
        white-space: nowrap;
        padding: 5px;
        background-color: transparent; /* Initial background color */
        color: black; /* Set text color to contrast with background */
        border-radius: 5px;
        transition: background-color 0.3s ease; /* Add a smooth transition for the background color */
    }
</style>


    <div class="form-group my-3 mx-3">
      <input type="submit" name="filter" value="Search" class="btn btn-primary">
    </div>
  </form>
</section>


<!-- Search Bar -->

<section id="search-bar" class="search-bar py-4" style="margin-top: 100px;">
    <div class="container">
        <form action="shop.php" method="POST" class="row gx-3">
            <div class="col">
                <input type="text" name="search" class="form-control" placeholder="Search products...">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>
</section>
<?php if (!empty($searchTerm)): ?>
    <p>Showing results for: <strong><?php echo $searchTerm; ?></strong></p>
<?php endif; ?>

<?php if (!empty($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<!-- products -->
<section id="featured" class="pb-5">
      <div class="container prod-card ">
      <?php while ($row = $products->fetch_assoc()) { ?>
        <div class="card bg-white mt-4 product-grid">
          <img src="assets/img/<?php echo $row['product_image']; ?>" class="card-img-top" alt="...">
          <div class="card-body">
            <div class="text-section">
              <h4 class="card-title fw-bold text-dark"><?php echo $row['product_name']; ?></h4>
              <p class="card-text text-dark"><strike class="discount">₹ <?php echo $row['product_special_offer']; ?></strike></p>
              <?php 
                  if ($row['product_category'] !== 'accessory') {
              ?>
              <ul>
                <li><?php echo $row['rom_size']; ?> ROM</li>
                <li><?php echo $row['ram_size']; ?> RAM</li>
                <li><?php echo $row['display_size']; ?></li>
                <li><?php echo $row['camera']; ?></li>
                <li><?php echo $row['processor']; ?></li>
                <li>1 Year Warranty For Phone</li>
              </ul> 
              <?php } ?>
            </div>
            <div class="cta-section">
              <div class="text-green finpri ">₹<?php echo $row['product_price']; ?></div>
              <a href="<?php echo "single_product.php?product_id=". $row['product_id'];?>&product_model=<?php echo $row['product_model']; ?>&product_color=<?php echo $row['product_color']; ?>"><button class="buy-btn"  >Buy Now</button></a>
            </div>
          </div>
        </div>
        <?php }?>
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