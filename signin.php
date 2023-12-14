<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start or resume the session
session_start();

// Database connection settings
$servername = "localhost";
$dbUsername = "root"; // Your database username
$dbPassword = ""; // Your database password if there's none
$dbName = "travelcite_user_account"; // Your database name

// Create connection
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if the user is already logged in, if yes, redirect to home.php
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === "1") {
    header("Location: home.php");
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    // Prepare a statement for user validation
    $stmt = $conn->prepare("SELECT Password FROM account_info WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $row['Password'])) {
            // User is authenticated successfully
            $_SESSION['user'] = $username;
            $_SESSION['logged_in'] = "1";

            
            header("Location: home.php");
            exit();
            
        } else {
            // Handle incorrect password
        }
    } else {
        // Handle user not found
    }

    $stmt->close();
    $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="signinstyles.css">
</head>
<body>
    <main>
        <div class="img-container">
            <img src="images/travelsitelogo.png">
        </div>
        <div class="box">
            <form id="signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div>
                    <label for="username">Username:</label>
                    <input id="username" type="text" name="user" autocomplete="off" required>
                </div>

                <div>
                    <label for="password" >Password:</label>
                    <input id="password" type="password" name="pass" autocomplete="off" required>
                </div>
                <div class="submit">
                    <input type="submit" id="login" value="signin">
                </div>
                <div id="redirect"><a href="signup.php">Don't have an account? Sign up.</a></div>
                <div id="redirect"><a href="home.php">Don't want an account? Go to home!</a></div>
            </form>
        </div>
    </main>
</body>
</html>