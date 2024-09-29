<?php
// Include the connection file if not already included
include("server/connection.php");

$error = '';

// Check if the form is submitted
if (isset($_POST['track_btn'])) {
    // Retrieve the tracking code from the form
    $tracking_code = $_POST['track_code'];

    // Validate the tracking code (assuming 'tracking_code' is the column name in the database)
    $stmt = $conn->prepare("SELECT * FROM repairs WHERE tracking_code = ?");
    $stmt->bind_param("s", $tracking_code);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a matching record is found
    if ($result->num_rows > 0) {
        // Redirect to a new page with the tracking code as a parameter
        header("Location: repair_info.php?track_code=$tracking_code");
        exit();
    } else {
        // Display an error message if no matching record is found
        $error = "Invalid tracking code. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Your Device</title>
    <!-- Include any CSS stylesheets here -->
</head>
<body>
    <div class="text-box text-center pt-5">
        <h2>Track Your Device</h2>
        <form action="tracking.php" method="POST">
            <div class="track_search">
                <div id="search-wrapper">
                    <i class="search-icon fas fa-search"></i>
                    <input type="text" id="search" name="track_code" placeholder="Enter Your Tracking Code">
                    <button id="search-button" type="submit" name="track_btn">Search</button>
                </div>
            </div>
        </form>
        <?php if ($error) : ?>
            <!-- Display error message -->
            <p><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
    <!-- Include any JavaScript scripts here -->
</body>
</html>
