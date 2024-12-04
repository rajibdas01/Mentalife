<?php
session_start();
// Database connection
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "customerDB";

// Sanitize and validate input data here

// Connect to your database
$con = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Prepare and bind
    $stmt = $con->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $user, $pass);

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a matching record is found
    if ($result->num_rows > 0) {
        // Login successful
        $_SESSION['username'] = $user;
        header("Location: open.php"); // Redirect to a welcome page
    } else {
        // Redirect to login page with error message
        header("Location: login.html?error=invalid_password_username");
        exit;
    }
} else {
    // Username not found
    header("Location: login.html?error=invalid_username");
    exit;

    }

    // Close the statement
    $stmt->close();
// Close the connection
$con->close();
?>
