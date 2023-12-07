<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// logout user if they head to sign in page while logged in
session_start();
$_SESSION = [];
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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['user']);
    $password = $_POST['pass']; // The password user entered in the form

    // SQL to fetch user with the username
    $sql = "SELECT * FROM account_info WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify the password (using password_verify)
            if (password_verify($password, $row['Password'])) {
                // Passwords match! Log the user in and redirect to home.php
                $_SESSION['user_id'] = $row['account_ID']; // or any other user info you want to store in the session
                $_SESSION['username'] = $username;
                
                // tell session that user is logged in. random value for now. what matters is setting it in the array
                $_SESSION['logged_in'] = "1";
                header("Location: home.php");
                exit();
            } else {
                echo "Invalid password!";
            }
        } else {
            echo "No user found with that username!";
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
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
            </form>
        </div>
    </main>
</body>
</html>