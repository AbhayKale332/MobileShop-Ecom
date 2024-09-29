<?php 
// Include database connection file
include("server/connection.php");
date_default_timezone_set("Asia/Kolkata");
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    $newsletter = isset($_POST['newsletter']) ? $_POST['newsletter'] : 'no';

    // Insert form data into database
    $sql = "INSERT INTO contacts (name, email, phone, message, newsletter) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss', $name, $email, $phone, $message, $newsletter);
    
    if ($stmt->execute()) {
      header('Location: index.php?message=thank_you');
      exit;
    } else {
        // Error occurred
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
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
    <style>
          html{
              padding-top: 5%;
  box-sizing:border-box;
}
*{
box-sizing:inherit;
}
body{
background: white;
width:90%;
max-width: 800px;
margin:50px auto;
font-family: Calibri, Arial, sans-serif;
padding:20px;
}
h1, p{
text-align: center;
}
label{
display:block;
margin:1em 0 .2em;
}
/* single-line text, checkbox, and button */
input, select, textarea{
display:block;
width:100%;
padding:.3em;
font-size:20px;
background-color:#fbfbfb;
border:solid 1px #CCC;
resize:vertical;
}
textarea{
min-height:180px;
}
select{
color:indigo;
}
option{
color:blue;
background: lavenderBlush;
}
input[type=checkbox]{
display:inline;
width:auto;
color:red;
}

input[type=submit]{
background:lightcoral;
margin:1em 0 0;
color:white;
border:none;
border-radius:8px;
transition:all .3s ease-out;
}

input:focus,
input:hover,
select:focus,
select:hover,
textarea:focus,
textarea:hover{
background: lavenderBlush;
}

/* hover and focus states */
input[type=submit]:hover,
input[type=submit]:focus{
background: lightgreen;
outline:none;
}

@media screen and (min-width:600px) {
/*  make the form 2 columns */
form:after{
  content:'';
  display:block;
  clear:both;
}
.column{
  width:50%;
  padding:1em;
  float:left;
}
}
    </style>
    <form action="#" method="post">
        <h1>Contact Us</h1>
        <p>Please take a moment to get in touch, we will get back to you shortly.</p>
      
        <div class="column">
          <label for="the-name">Your Name</label>
          <input type="text" name="name" id="the-name">
      
          <label for="the-email">Email Address</label>
          <input type="email" name="email" id="the-email">
      
          <label for="the-phone">Phone Number</label>
          <input type="tel" name="phone" id="the-phone">
      
        </div>
        <div class="column">
          <label for="the-message">Message</label>
          <textarea name="message" id="the-message"></textarea>
          <label>
          <input type="checkbox" name="newsletter" value="yes"> Join our mailing list?
          </label>
          <input type="submit" value="Send Message">
        </div>
      </form>

</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>