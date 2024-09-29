<?php

session_start(); // Add this line to start the session

include("server/connection.php");
// when user tries to open login page even when he is logged in

if(isset($_SESSION['logged_in'])){
  header('location: account.php');
  exit;
}

//Php for Registratiion Form

if(isset($_POST['register'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmpass = $_POST['confirmpass'];

  if($password !== $confirmpass){
      echo '<script>alert("Password Does Not Match")</script>'; 
  } else if(strlen($password) < 6){
      echo '<script>alert("Password is less than 6 characters")</script>'; 
  } else {
      // Check if there is a user with the same email
      $stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email=?");
      $stmt1->bind_param('s', $email);
      $stmt1->execute();
      $stmt1->bind_result($num_rows);
      $stmt1->store_result();
      $stmt1->fetch();

      if($num_rows != 0){
          echo '<script>alert("User with the same email already exists")</script>'; 
      } else {
          // Create a new user
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);
          $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?,?,?)");
          $stmt->bind_param('sss', $name, $email, $hashed_password);

          // Store the data in the session
          if($stmt->execute()){
              $user_id = $stmt->insert_id;
              $_SESSION['user_id'] = $user_id;
              $_SESSION['user_email'] = $email;
              $_SESSION['user_name'] = $name;
              $_SESSION['logged_in'] = true;
              header('location: account.php?register=You are registered successfully');
          } 
      }
  }
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
    <link rel="stylesheet" href="assets/css/login.css"/>
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
    <div class="center">
      <h1>Register</h1>
      <form method="post" action="register.php">
        <div class="txt_field">
          <input class="reg-nam" type="text" id="register-name" name="name" required>
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
            <input class="reg-nam" type="text" id="register-email" name="email" required>
            <span></span>
            <label>Email</label>
          </div>
        <div class="txt_field">
          <input type="password" id="register-password" name="password" required>
          <span></span>
          <label>Password</label>
        </div>
        <div class="txt_field">
            <input type="password" id="register-name" name="confirmpass" required>
            <span></span>
            <label>Confirm Password</label>
          </div>
        <input type="submit" value="Register" name="register" id="register-btn">
        <div class="signup_link">
          Already a member? <a href="login.php">Login</a>
        </div>
      </form>
    </div>

  </body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>