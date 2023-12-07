<?php
// logout user if they head to sign up page while logged in
session_start();
$_SESSION = [];
$servername = "localhost"; // Your server name
$dbUsername = "root"; // Your database username, if you're using root
$dbPassword = ""; // Your root password
$dbName = "travelcite_user_account"; // Your database name
$tableName = "account_info"; // Your table name
$usernameColumn = "Username"; // Your username column name
$passwordColumn = "Password"; // Your password column name

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create connection
    $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $accountName = $conn->real_escape_string($_POST['user']);
    $accountPassword = $conn->real_escape_string($_POST['pass']);
    $confirmPassword = $conn->real_escape_string($_POST['cpass']);

    // Confirm that passwords match
    if ($accountPassword !== $confirmPassword) {
        echo "Passwords do not match!";
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($accountPassword, PASSWORD_DEFAULT);

    // SQL to insert new user
    $sql = "INSERT INTO $tableName ($usernameColumn, $passwordColumn) VALUES (?, ?)";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $accountName, $hashedPassword);

    // Execute and check success
    if ($stmt->execute()) {
        // Redirect to signin.php after a successful registration
        header("Location: signin.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Registration</title>
    <link rel="stylesheet" href="signinstyles.css">
    <script src="register.js"></script>
   
</head>
<body>
    <main>
        <div class="img-container">
            <img src="images/travelsitelogo.png">
        </div>
        <div class="box">
            <!-- Update the action to point to this file (signup.php) -->
            <form id="signin" action="signup.php" method="post">
                <div>
                    <label for="username">Username:</label>
                    <input id="username" type="text" name="user" autocomplete="off" required>
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input id="password" type="password" name="pass" required>
                </div>
                <div>
                    <label for="cpassword">Confirm Password:</label>
                    <input id="cpassword" type="password" name="cpass" required>
                </div>
                <div id="formErrors"></div>
                <div class="submit">
                    <input type="submit" id="register" form="signin" value="signup">
                </div>
                <div id="redirect"><a href="signin.php">Already have an account? Sign in.</a></div>
                <div id="redirect"><a href="home.php">Don't want an account? Go to home!</a></div>
            </form>
        </div>
    </main>
</body>
</html>