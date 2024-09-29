<?php

session_start(); // Add this line to start the session

include("../server/connection.php");
// when admin tries to open login page even when he is logged in

if(isset($_SESSION['admin_logged_in'])){
  header('location: dashboard.php');
  exit;
}
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
  
    $stmt = $conn->prepare("SELECT admin_id,admin_name,admin_email,admin_password FROM admins WHERE admin_email = ? AND admin_password = ? LIMIT 1");
  
    $stmt->bind_param("ss", $email,$password);
  
  
    if($stmt->execute()){
        $stmt ->bind_result($admin_id, $admin_name, $admin_email, $admin_password);
        $stmt->store_result();
        if($stmt->num_rows == 1){
  
          $stmt->fetch();
                  $_SESSION['admin_id'] = $admin_id;
                  $_SESSION['admin_name'] = $admin_name;
                  $_SESSION['admin_email'] = $admin_email;
                  $_SESSION['admin_logged_in'] = true;
  
                  header('location: dashboard.php?message = logged in successfully');
    }else{
      echo '<script>alert("Email/Password Is Incorrect")</script>'; 
    }
  }else{
    //error
    echo '<script>alert("Something Webt Wrong")</script>'; 
  }
  }
?>
<!DOCTYPE html>
<html>

<head>
	<title>Admin Login</title>

</head>

<body>
	<div class="main">
		<h1>Mauli Mobiles Admin Login</h1>
		<h3>Enter your login credentials</h3>
        <form method="POST" action="admin_login.php">
            <label for="email">Enter Admin Email</label>
				<input type="email"
					class="email ele" id="login-name" name="email"
					placeholder="Email" required>
            <label for="password">Enter Admin Password</label>
				<input type="password"
					class="password ele" id="login-password" name="password"
					placeholder="Password" required>
				<button class="clkbtn" type="submit" name="login" id="login-btn">Login</button>
      </form>
	</div>
</body>

</html>
<style>
    /*style.css*/
body {
	display: flex;
	align-items: center;
	justify-content: center;
	font-family: sans-serif;
	line-height: 1.5;
	min-height: 100vh;
	background: #f3f3f3;
	flex-direction: column;
	margin: 0;
}

.main {
	background-color: #fff;
	border-radius: 15px;
	box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
	padding: 10px 20px;
	transition: transform 0.2s;
	width: 500px;
	text-align: center;
}

h1 {
	color: #4CAF50;
}

label {
	display: block;
	width: 100%;
	margin-top: 10px;
	margin-bottom: 5px;
	text-align: left;
	color: #555;
	font-weight: bold;
}


input {
	display: block;
	width: 100%;
	margin-bottom: 15px;
	padding: 10px;
	box-sizing: border-box;
	border: 1px solid #ddd;
	border-radius: 5px;
}

button {
	padding: 15px;
	border-radius: 10px;
	margin-top: 15px;
	margin-bottom: 15px;
	border: none;
	color: white;
	cursor: pointer;
	background-color: #4CAF50;
	width: 100%;
	font-size: 16px;
}

.wrap {
	display: flex;
	justify-content: center;
	align-items: center;
}

</style>