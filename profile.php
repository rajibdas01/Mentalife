<?php
// Example of querying user details based on their username

// Start the session to access the session variables
session_start();

// Check if the username is set in the session
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Get the username from the session
$username = $_SESSION['username'];

// Database connection
$servername = "localhost"; // Change this if necessary
$dbname = "customerDB";     // Change to your database name
$usernameDB = "root";       // Replace with your database username
$passwordDB = "";           // Replace with your database password

// Create connection
$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL query with a placeholder for the username
$sql = "SELECT name, email, phone_number, age, gender FROM users WHERE username = ?";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Check if the preparation is successful
if ($stmt === false) {
    die('MySQL prepare error: ' . $conn->error);
}

// Bind the parameter (username) to the placeholder in the query
$stmt->bind_param("s", $username); // "s" means that $username is a string

// Execute the statement
$stmt->execute();

// Bind the result to variables
$stmt->bind_result($name, $email, $phone_number, $age, $gender);

// Fetch the results
if ($stmt->fetch()) {
} else {
    echo "User not found!";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Page</title>
  <link rel="stylesheet" href="profile.css">
</head>
<a href="open.php" class="btn">Go Back Home</a>
<body>
  <div class="profile-container">
    <div class="profile-header">
      <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
    </div>
    <div class="profile-body">
      <div class="info">
        <label>Name:</label>
        <span><?php echo htmlspecialchars($name); ?></span>
      </div>
      <div class="info">
        <label>Email:</label>
        <span><?php echo htmlspecialchars($email); ?></span>
      </div>
      <div class="info">
        <label>Phone:</label>
        <span><?php echo htmlspecialchars($phone_number); ?></span>
      </div>
      <div class="info">
        <label>Age:</label>
        <span><?php echo htmlspecialchars($age); ?></span>
      </div>
      <div class="info">
        <label>Gender:</label>
        <span><?php echo htmlspecialchars($gender); ?></span>
      </div>
    </div>
    <div class="profile-footer">
      <a href="edit_profile.php">Edit Profile</a>&nbsp;
      <a href="delete.php">Delete Account</a>
    </div>
  </div>
</body>
</html>