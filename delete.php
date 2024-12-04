<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');  // Redirect to login page if user is not logged in
    exit();
}

// Database connection settings
$servername = "localhost";   // Change to your database server if needed
$dbname = "customerDB";      // Change to your database name
$usernameDB = "root";        // Replace with your DB username
$passwordDB = "";            // Replace with your DB password

// Create connection
$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the username of the logged-in user
$user = $_SESSION['username'];

// Handle account deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Call the deleteAccount function to delete the current user's account
    deleteAccount($user, $conn);
    // Destroy session and redirect to the login page after account deletion
    session_destroy();
    header("Location: login.html?message=delete_account");
    exit();
}

// Function to delete the current user
function deleteAccount($username, $conn) {
    // Prepare the DELETE SQL query
    $deleteSql = "DELETE FROM users WHERE username = ?";
    $deleteStmt = $conn->prepare($deleteSql);

    if ($deleteStmt === false) {
        die("Error preparing SQL query for deletion: " . $conn->error);
    }

    // Bind the username parameter and execute the query
    $deleteStmt->bind_param("s", $username);
    
    if ($deleteStmt->execute()) {
        echo "Your account has been deleted successfully.";
    } else {
        echo "Error deleting account: " . $deleteStmt->error;
    }

    // Close the delete statement
    $deleteStmt->close();
}

$conn->close();
?>
<style>
.delete-btn {
    background-color: red;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 20px;
    width: 100%;
    text-align: center;
}

.delete-btn:hover {
    background-color: #330bd1;
}

.not-btn{
    background-color: green;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 20px;
    width: 100%;
    text-align: center;
} 
.not-btn:hover{
    background-color: blueviolet;
}


.form-container {
    display: flex;
    justify-content: center;   /* Center the button horizontally */
    align-items: center;       /* Center the button vertically (optional) */
    flex-direction: column;    /* Make sure elements inside are stacked vertically */
    min-height: 100vh;         /* Make sure it takes the full height of the screen */
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
</head>
<body>

<div class="form-container">
    <h1>Delete Your Account</h1>
    
    <p>Are you sure you want to delete your account? This action is irreversible.</p>
    
    <form method="POST" action="">
        <button type="submit" class="btn delete-btn">Yes, Delete My Account</button>
    </form>

    <form method="GET" action="profile.php">
        <button type="submit" class="not-btn">Cancel</button>
    </form>
</div>

</body>
</html>
