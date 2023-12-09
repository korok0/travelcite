<?php
session_start();
$servername = "localhost";
$dbUsername = "root"; // Your database username
$dbPassword = ""; // Your database password if there's none
$dbName = "travelcite_reviews"; // Your database name
$tableName = $_GET['location'];
// Create connection
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);
$tableName = 'france';

$accName = $conn->real_escape_string($_SESSION["username"]);
$rating = $conn->real_escape_string($_GET["rating"]);
$review = $conn->real_escape_string($_GET["review"]); 

$sql = "INSERT INTO $tableName (username, rating, review) VALUES ('$accName', $rating, '$review')";
$res = mysqli_query($conn, $sql);
header("Location: location.php?location=$tableName")
?>