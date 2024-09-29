<?php
// Include the connection file if not already included
include("server/connection.php");

// Check if the tracking code is provided in the URL
if (isset($_GET['track_code'])) {
    // Get the tracking code from the URL
    $tracking_code = $_GET['track_code'];

    // Retrieve repair information based on the tracking code
    $stmt = $conn->prepare("SELECT * FROM repairs WHERE tracking_code = ?");
    $stmt->bind_param("s", $tracking_code);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a matching record is found
    if ($result->num_rows > 0) {
        // Fetch the repair information
        $repair = $result->fetch_assoc();
    } else {
        // If no matching record is found, display an error message
        echo "No repair information found for the provided tracking code.";
        exit;
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
    <style>
        /* Add your CSS styles for the page here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .info-item {
            margin-bottom: 15px;
        }
        .info-item label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="cont1 pt-5 " >
    <div class="container">
        <h1>Repair Information</h1>
        <div class="info-item">
            <label>Repair ID:</label>
            <?php echo $repair['repair_ID']; ?>
        </div>
        <div class="info-item">
            <label>Tracking Code:</label>
            <?php echo $repair['tracking_code']; ?>
        </div>
        <div class="info-item">
            <label>Repair Status:</label>
            <?php echo $repair['repair_status']; ?>
        </div>
        <div class="info-item">
            <label>User Name:</label>
            <?php echo $repair['user_name']; ?>
        </div>
        <div class="info-item">
            <label>User Phone:</label>
            <?php echo $repair['user_phone']; ?>
        </div>
        <div class="info-item">
            <label>Phone Brand:</label>
            <?php echo $repair['phone_brand']; ?>
        </div>
        <div class="info-item">
            <label>Phone Issue:</label>
            <?php echo $repair['phone_issue']; ?>
        </div>
        <div class="info-item">
            <label>Repair Cost:</label>
            <?php echo $repair['repair_cost']; ?>
        </div>
        <div class="info-item">
            <label>Repair Description:</label>
            <?php echo $repair['repair_desc']; ?>
        </div>
        <div class="info-item">
            <label>Repair Date:</label>
            <?php echo $repair['repair_date']; ?>
        </div>
    </div>
    </div>
</body>
</html>
