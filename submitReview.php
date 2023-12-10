<?php
session_start();

$servername = "localhost";
$dbUsername = "root"; // Your database username
$dbPassword = ""; // Your database password
$dbName = "travelcite_user_account"; // Your main database name

// Create connection
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Validate and fetch data
$location = isset($_GET['location']) ? $conn->real_escape_string($_GET['location']) : exit('Location is required');
$accName = $conn->real_escape_string($_SESSION["user"]);
$rating = intval($_POST["rating"]); // Use $_POST to get the rating and review from the form
$review = $conn->real_escape_string($_POST["review"]);

// Determine the location-specific table based on $_GET['location']
$locationTable = "{$location}_reviews"; // This assumes you have tables like "dc_reviews", "france_reviews", etc.

// Insert into the location-specific table
$sql = "INSERT INTO $locationTable (username, rating, review) VALUES ('$accName', $rating, '$review')";
if ($conn->query($sql) === TRUE) {
    echo "Review submitted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
// Redirect back to the location page
header("Location: location.php?location=" . urlencode($location). "#reviews");
?>
