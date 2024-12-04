<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Database connection settings
$servername = "localhost";
$dbname = "customerDB";
$usernameDB = "root";
$passwordDB = "";

// Create connection
$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch current user data
$user = $_SESSION['username'];
$sql = "SELECT name, email, phone_number, age FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing SQL query: " . $conn->error);  // Error handling for prepare
}

$stmt->bind_param("s", $user);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($currentName, $currentEmail, $currentPhoneNumber, $currentAge);

// Fetch data from result set
$stmt->fetch();

// Close the statement after fetching results
$stmt->close();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName = $_POST['name'];
    $newEmail = $_POST['email'];
    $newPhoneNumber = $_POST['phone_number'];
    $newAge = $_POST['age'];

    // Prepare the update SQL query
    $updateSql = "UPDATE users SET name = ?, email = ?, phone_number = ?, age = ? WHERE username = ?";
    $updateStmt = $conn->prepare($updateSql);

    // Check if prepare() failed
    if ($updateStmt === false) {
        die("Error preparing SQL query: " . $conn->error);  // Error handling for prepare
    }

    // Bind parameters and execute update query
    $updateStmt->bind_param("sssis", $newName, $newEmail, $newPhoneNumber, $newAge, $user);

    if ($updateStmt->execute()) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile: " . $updateStmt->error;  // Error during execute
    }

    // Close the update statement
    $updateStmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="edit_profile.css">
</head>

<body>

    <div class="form-container">
        <h1>Edit Profile</h1>

        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($currentName); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" pattern=".+@gmail.com" id="email" name="email" value="<?php echo htmlspecialchars($currentEmail); ?>" required>
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($currentPhoneNumber); ?>" required>
            </div>

            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($currentAge); ?>" required>
            </div>

            <button type="submit" class="btn">Update Profile</button>
        </form>
        <a href="profile.php">
            <center>Back to Profile</center>
        </a> </>
    </div>
</body>

</html>