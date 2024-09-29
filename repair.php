<?php
include("server/connection.php");
if (isset($_POST['track_btn'])) {
    $tracking_code = $_POST['track_code'];

    $stmt = $conn->prepare("SELECT * FROM repairs WHERE tracking_code = ?");
    $stmt->bind_param("s", $tracking_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: repair_info.php?track_code=$tracking_code");
        exit();
    } else {
        echo '<script>alert("Incorrect tracking code. Please try again.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<!-- FontAwesome CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="assets/css/style.css"/>
    <style>

      .track_search{
        display:flex;
        align-items:center;
        justify-content:center;
      }

        #search-wrapper{
        display: flex;
        border: 1px solid rgba(0, 0, 0, 0.276);
        align-items: stretch;
        border-radius: 50px;
        background-color: #fff;
        overflow: hidden;
        max-width: 800px;
        box-shadow: 2px 1px 5px 1px rgba(0, 0, 0, 0.273);

        }
        #search{
            border:none;
            width:600px;
            font-size: 15px;
        }
        #search:focus{
            outline: none;
        }
        .search-icon{
            margin: 10px;
            color:rgba(0, 0, 0, 0.564);
        }
        #search-button{
            border:none;
            cursor: pointer;
            color:#fff;
            background-color: coral;
            padding:0px 10px;
        }
      .content-container {
          padding-top: 65px; 
      }
      .bg-img {
        /* The image used */
        background-image: url("repair-banner.jpg");
      
        min-height: 380px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
      }
      h1{
        text-align: center;
        font-size:large;
      }
      h2{
        color: coral;
      }
      
      /* Add styles to the form container1 */
      .container1 {
        position: absolute;
        right: 0;
        margin: 20px;
        max-width: 300px;
        padding: 16px;
        background-color: white;
      }
      
      /* Full-width input fields */
        .container1 input[type=text]{
        width: 100%;
        padding: 8px;
        margin: 2px 0 10px 0;
        border: none;
        background: #f1f1f1;
      }
      .sel{
        width: 100%;
        padding: 8px;
        margin: 2px 0 10px 0;
        border: none;
        background: #f1f1f1;
      }
      
      .container1 input[type=text]:focus, input[type=password]:focus {
        background-color: #ddd;
        outline: none;
      }
      
      /* Set a style for the submit button */
      .btn {
        background-color: coral;
        color: black;
        padding: 10px 14px;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
        align-self: center;
      }
      
      .btn:hover {
        background-color: crimson;
      }
      .wrapper{
        margin: 50px auto;
        width: 70%;
      }
      .wrapper2{
        margin: 50px auto;
        width: 70%;
      }
      .wrapper .repimg{
        padding-top: 60px;
        padding-bottom: 60px;
        width: 400px;
        float: left;
        margin-right: 40px;
      }
      .wrapper2 .repimg{
        padding-top: 60px;
        padding-bottom: 60px;
        width: 400px;
        float: right;
        margin-left: 40px;
      }
      .text-box p{
        text-align: justify;
        font-size: 16px;
      }
      .repimg {  
    animation-name: repimg;
    animation-duration: 3s;
    animation-iteration-count: infinite;
    animation-timing-function: ease-in-out;
    margin-left: 30px;
    margin-top: 5px;
}
.text-box h2{
    font-size: 30px;
    color: coral;
}
 
    @keyframes repimg {
        0% { transform: translate(0,  0px); }
        50%  { transform: translate(0, 15px); }
        100%   { transform: translate(0, -0px); }    
    }
      </style>
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
      </head>
      <body>
      <div class="content-container">
      <div class="bg-img">
      <form action="repair_form.php" method="post" class="container1">
    <h1>BOOK A REPAIR</h1>
    <input type="text" placeholder="Enter Name" name="name" required>
    <input type="text" placeholder="Enter Phone Number" name="phone" required>
    
    <!-- Select brand -->
    <select class="sel" id="brand" name="brand" required>
        <option value="">Select Brand</option>
        <option value="apple">Apple</option>
        <option value="samsung">Samsung</option>
        <option value="xiaomi">Xiaomi</option>
    </select>
    
    <!-- Select issue -->
    <select class="sel" id="issue" name="issue" required>
        <option value="">Select Issue</option>
        <option value="screen">Screen/Display</option>
        <option value="battery">Battery</option>
        <option value="charging">Charging</option>
    </select>

    <!-- Add a hidden input field for form submission -->
    <input type="hidden" name="submit" value="1">

    <button type="submit" class="btn">Submit</button>
</form>

      </div>
      </div>
        <!-- order tracking code -->
      <div class="text-box text-center pt-5">
        <h2>
          Track Your Device
        </h2>
        <form action="" method="POST" >
        <div class="track_search">
        <div id="search-wrapper">
          <i class="search-icon fas fa-search"></i>
        <input type="text" id="search" name="track_code" placeholder="Enter Your Tracking Code">
        <button id="search-button" type="submit" name="track_btn" >Search</button>
        </form>
        </div>
      </div>
      </div>
      <script>
          var search=document.getElementById('search');


            search.addEventListener('focus',(event)=>{

              document.getElementById('search-wrapper').style.border="1px solid #1dbf73";

            });


            search.addEventListener('focusout',(event)=>{

            document.getElementById('search-wrapper').style.border="1px solid rgba(0, 0, 0, 0.276)";

            });
      </script>

      <div class="text-box text-center pt-5">
        <h2>
          How does it work?
        </h2>
      </div>
      <div id="timeline-wrap">
        <div id="timeline"></div>
      
        <!-- Marker 1 -->
        <div class="marker mfirst timeline-icon one">
          <i class="fa-solid fa-mobile-screen"></i>
        </div>
      
        <!-- Marker 2 -->
        <div class="marker m2 timeline-icon two">
          <i class="fa-solid fa-door-open"></i>
        </div>
      
        <!-- Panel 1 -->
        <div class="pdtp">
        <div class="timeline-panel">
          <p><h1>BOOK A REPAIR</h1>
            Select your mobile and book a repair according to your needs.</p>
        </div>
        <div class="timeline-panel">
          <p><h1>FREE DOORSTEP PICKUP</h1>We made a hassle-free process for you. One of our Mauli Mobiles executives will reach to your preferred location to pick up your mobile phone.</p>
        </div>
        <div class="timeline-panel">
          <p><h1>DIAGNOSIS & REPAIR</h1>Our certified mobile technician will diagnose and repair your mobile in our well-equipped lab using certified tools and quality parts.</p>
        </div>
        <div class="timeline-panel">
          <p><h1>FAST & FREE DELIVERY AT DOORSTEP</h1>Once your mobile passes our quality check, one of our Mauli Mobile executives will deliver your mobile phone at your doorstep.</p>
        </div>
      </div>
        <!-- Marker 3 -->
        <div class="marker m3 timeline-icon three">
          <i class="fa-solid fa-screwdriver-wrench"></i>
        </div>
      
        <!-- Marker 4 -->
        <div class="marker mlast timeline-icon four">
          <i class="fa-solid fa-truck"></i>
        </div>

        <script>
          document.addEventListener("DOMContentLoaded", function() {
            // Hide all timeline panels initially
            var timelinePanels = document.querySelectorAll(".timeline-panel");
            timelinePanels.forEach(function(panel) {
              panel.style.display = "none";
            });
        
            // Handle marker click
            var markers = document.querySelectorAll(".marker");
            markers.forEach(function(marker) {
              marker.addEventListener("click", function() {
                // Hide all timeline panels
                timelinePanels.forEach(function(panel) {
                  panel.style.display = "none";
                });
        
                // Show the corresponding timeline panel based on the clicked marker
                var markerIndex = Array.from(markers).indexOf(marker);
                timelinePanels[markerIndex].style.display = "block";
              });
            });
          });
        </script>
        
        
      
      
      
      </div>
      



      <div class="wrapper">
        <div>
            <img class="repimg" src="assets/img/repairbackg.png" alt="">
        </div>
        <div class="text-box">
            <h2 class="titi">Screen Replacement</h2>
            <p>Smartphone screens are our portal to the whole digital world. While they are efficient, they are also very brittle. Smartphone screens are easily susceptible to damage such as scratches and cracks. All the smartphones come with a touchscreen control. If the screen is damaged, using the phone can be a difficult task.
                <br><br>
                Our professional technicians are trained to repair your mobile screen to its former glory. We equip our technicians to conduct a screen replacement at your doorstep. They will meet you at your location and replace the screen on your smartphone with a new one.
                <br><br>
                Your mobile will be as good as new and in good working condition all under 30 minutes. If the damage has spread to the internal units of the phone and replacing the screen did not fix it, our technicians have a solution there as well.
                <br><br>
                The technician will bring your device to the service center to fix the issue. Once it is ready, he will deliver it back to you for no additional cost. You can move on with life with your smartphone back where it belongs. Our services are quick, cost-effective, and seamless.
            </p>
        </div>
      </div>

      <div class="wrapper2">
        <div>
            <img class="repimg" src="assets/img/motherboard-repair.png" alt="">
        </div>
        <div class="text-box">
            <h2 class="titi">Motherboard Repair</h2>
            <p>
                Mobile phones draw their performance and power from the motherboards. The motherboard is an important component of a mobile phone. When there is an error in the motherboard, it can be quite frustrating to the user. Your phone may frequently hang, develop glitches, the buttons stop working, and sometimes can entirely black out.
                <br><br>
                Our team of technicians - trained to handle situations like this - can help you revive your device. When you book a mobile repair service from Mauli Mobiles, our expert will meet you at your doorstep to help you with your problem. The technician will inspect your device to understand the root cause of the problem. Due to their rigorous training and years of experience, our technicians can identify the trouble quickly and will suggest the remedy.
                <br><br>
                If the damage is easily reversible, the technician will do it at the doorstep while you watch. In some cases, the damage might be intense and require the support of lab equipment. In such events, the technician will carry the device with him to the service center. Once the issue gets fixed, your device will be delivered to you for no additional cost.
            </p>
        </div>
      </div>
      <div class="wrapper">
        <div>
            <img class="repimg" src="assets/img/battery-replacement.png" alt="">
        </div>
        <div class="text-box">
            <h2 class="titi">Battery Replacement</h2>
            <p>It is common for smartphone batteries to deteriorate over time. Over the years, smartphone batteries fail to hold charge for as long as they did when they were new.
                <br><br>
                The most significant sign of a weak smartphone battery is the quick draining of power in your smartphone. When this starts happening, you might not be able to leave home without the charger. Or you might even be stranded in the middle of your day with a dead phone in your hand.
                <br><br>
                We have the best solution to avoid such situations. Our technicians at Mauli Mobiles and have your smartphone battery replaced with a new one in no time at all! Upon booking a service from Mauli Mobiles, one from our troop of trained technicians will be assigned to you. This technician will visit you at your doorstep.
                <br><br>
                He will inspect the device thoroughly to identify the reason for your battery drain.
            </p>
        </div>
      </div>
      <div class="wrapper2">
        <div>
            <img class="repimg" src="assets/img/water-damage-repair.png" alt="">
        </div>
        <div class="text-box">
            <h2 class="titi" >Water Damage Repair</h2>
            <p>
                Water damage is quite common, especially if the season is monsoon. Our smartphones accompany us everywhere, and it will not be shocking if they get spilled with water, coffee, or cold drinks.
                <br><br>
                As we already know, electronics and water are not meant to meet each other. In the unfortunate event that it happens, your smartphone might start acting up.
                <br><br>
                At Mauli Mobiles, we understand the stress and frustration that comes with water damage to your phone. Whether it's dropping your phone in a pool, toilet, or any other body of water, our expert technicians have seen and solved every possible water damage problem.
                <br><br>
                Our technicians are professionally trained and tested to handle damages caused by liquids to your smartphones. Once you book a service, one of our expert mobile repair technicians will visit you at the location of your choosing to fix your phone.
            </p>
        </div>
      </div>


<!-- Faq swction -->


<style>
.text-secondary {
    color: #3d5d6f;
  }
  
  .h4,
  h4 {
    font-size: 1.2rem;
  }

  h2 {
    color: #333;
  }
  
  .fa,
  .fas {
    font-family: 'FontAwesome';
    font-weight: 400;
    font-size: 1.2rem;
    font-style: normal;
  }
  
  .right-0 {
    right: 0;
  }
  
  .top-0 {
    top: 0;
  }
  
  .h-100 {
    height: 100%;
  }
  
  a.text-secondary:focus,
  a.text-secondary:hover {
    text-decoration: none;
    color: #22343e;
  }
  
  #accordion .fa-plus {
    transition: -webkit-transform 0.25s ease-in-out;
    transition: transform 0.25s ease-in-out;
    transition: transform 0.25s ease-in-out, -webkit-transform 0.25s ease-in-out;
  }
  
  #accordion a[aria-expanded=true] .fa-plus {
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
  }
  #accordion .card {
    background-color: transparent; /* Set it to 'transparent' or any color you prefer */
    border: none; /* Remove border if needed */
    padding: 0; /* Adjust padding as needed */
}
</style>

<div class="text-center">
    <h2 class="mt-5 mb-5 titi">Frequently Asked Questions</h2>
  </div>
  <section class="container my-5" id="maincontent">
    <section id="accordion">
      <a class="py-3 d-block h-100 w-100 position-relative z-index-1 pr-1 text-secondary border-top" aria-controls="faq-17" aria-expanded="false" data-toggle="collapse" href="#faq-17" role="button">
        <div class="position-relative">
          <h2 class="h4 m-0 pr-3">
            What if I want custom gear?
          </h2>
          <div class="position-absolute top-0 right-0 h-100 d-flex align-items-center">
            <i class="fa fa-plus"></i>
          </div>
        </div>
      </a>
      <div class="collapse" id="faq-17">
        <div class="card card-body border-0 p-0">
          <p>Custom gear can be ordered through our contact form. Additional fees may apply.</p>

        </div>
      </div>

      <a class="py-3 d-block h-100 w-100 position-relative z-index-1 pr-1 text-secondary border-top" aria-controls="faq-18" aria-expanded="false" data-toggle="collapse" href="#faq-18" role="button">
        <div class="position-relative">
          <h2 class="h4 m-0 pr-3">
            What is the official mission statement?
          </h2>
          <div class="position-absolute top-0 right-0 h-100 d-flex align-items-center">
            <i class="fa fa-plus"></i>
          </div>
        </div>
      </a>
      <div class="collapse" id="faq-18">
        <div class="card card-body border-0 p-0">
          <p>Our official mission statement is lorem ipsum dolor sit.</p>
          <p>
          </p>
        </div>
      </div>

      <a class="py-3 d-block h-100 w-100 position-relative z-index-1 pr-1 text-secondary border-top" aria-controls="faq-19" aria-expanded="false" data-toggle="collapse" href="#faq-19" role="button">
        <div class="position-relative">
          <h2 class="h4 m-0 pr-3">
            What is the purpose of LunarXP?
          </h2>
          <div class="position-absolute top-0 right-0 h-100 d-flex align-items-center">
            <i class="fa fa-plus"></i>
          </div>
        </div>
      </a>
      <div class="collapse" id="faq-19">
        <div class="card card-body border-0 p-0">
          <p>The purpose of LunarXP is to give you the best Mars experience!</p>
          <p>
          </p>
        </div>
      </div>

      <a class="py-3 d-block h-100 w-100 position-relative z-index-1 pr-1 text-secondary  border-top" aria-controls="faq-20" aria-expanded="false" data-toggle="collapse" href="#faq-20" role="button">
        <div class="position-relative">
          <h2 class="h4 m-0 pr-3">
            What is the best email to reach you at?
          </h2>
          <div class="position-absolute top-0 right-0 h-100 d-flex align-items-center">
            <i class="fa fa-plus"></i>
          </div>
        </div>
      </a>
      <div class="collapse" id="faq-20">
        <div class="card card-body border-0 p-0">
          <p>The best email for any inquiries is email@email.com!</p>
          <p>
          </p>
        </div>
      </div>

      <a class="py-3 d-block h-100 w-100 position-relative z-index-1 pr-1 text-secondary  border-top" aria-controls="faq-21" aria-expanded="false" data-toggle="collapse" href="#faq-21" role="button">
        <div class="position-relative">
          <h2 class="h4 m-0 pr-3">
            Where can I read more about this company?
          </h2>
          <div class="position-absolute top-0 right-0 h-100 d-flex align-items-center">
            <i class="fa fa-plus"></i>
          </div>
        </div>
      </a>
      <div class="collapse" id="faq-21">
        <div class="card card-body border-0 p-0">
          <p>Lorem ipsum dolor sit!</p>
          <p>
          </p>
        </div>
      </div>

      <a class="py-3 d-block h-100 w-100 position-relative z-index-1 pr-1 text-secondary  border-top" aria-controls="faq-22" aria-expanded="false" data-toggle="collapse" href="#faq-22" role="button">
        <div class="position-relative">
          <h2 class="h4 m-0 pr-3">
            What is the best time to call?
          </h2>
          <div class="position-absolute top-0 right-0 h-100 d-flex align-items-center">
            <i class="fa fa-plus"></i>
          </div>
        </div>
      </a>
      <div class="collapse" id="faq-22">
        <div class="card card-body border-0 p-0">
          <p>The best time to call is 24/7! We are always available to answer any questions.</p>
          <p>
          </p>
        </div>
      </div>
    </section>
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
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>