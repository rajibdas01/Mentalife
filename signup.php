<?php
// Database connection
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "customerDB";

$con = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$username = $_POST['username'];
$name = $_POST['name'];
$password = $_POST['password'];
$email = $_POST['email'];
$phone = $_POST['phone_number'];
$gender = $_POST['gender'];
$age = $_POST['age'];

// Check if the username already exists
$checkUserQuery = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($con, $checkUserQuery);

if (mysqli_num_rows($result) > 0) {
    // Redirect back to the signup page with an error message
    header("Location: signup.html?error=Username_already_exists");
    exit(); // Stop further execution
} else {
    // Insert new user
    $sql = "INSERT INTO users (username, name, password, email, phone_number, gender, age) VALUES ('$username', '$name', '$password', '$email', '$phone', '$gender', '$age')";

    if (mysqli_query($con, $sql)) {
        // Redirect to login page after successful signup
        header("Location: login.html?message=Signup_successful");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}

// Close the connection
mysqli_close($con);
?>