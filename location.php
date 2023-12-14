<?php
session_start(); // Start the session
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection settings
$servername = "localhost";
$dbUsername = "root"; // Your database username
$dbPassword = ""; // Your database password if there's none
$dbName = "travelcite_user_account"; // Your database name

// Connect to your database
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$location = $_GET['location']; // Assuming you have a location name
$location = preg_replace("/[^a-zA-Z0-9_]+/", "", $location); // Sanitize to allow only alphanumeric and underscore
$tableName = $location . "_Reviews"; // e.g., Paris_Reviews

// make sure that ?location=(value) is a real location
$sql = "SELECT * FROM locations WHERE location = '$location'";
$res = mysqli_query($conn, $sql);
$locationExists = FALSE;
if($res){
    while ($array = mysqli_fetch_array($res)){
        // if location exists then set bool var to true
        if ($array['location'] == $location){
            $locationExists = TRUE;
        }
        
    }
}
// if location does not exist, then redirect to home and cancel creation of table
if (!$locationExists){
    header("Location: home.php");
    exit();
}

$sql = "CREATE TABLE IF NOT EXISTS $tableName (
    username VARCHAR(255) NOT NULL,
    rating INT NOT NULL,
    review TEXT NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    //echo "Table $tableName created successfully";
} else {
    //echo "Error creating table: " . $conn->error;
}

// Validate $location
if (!preg_match("/^[a-zA-Z0-9_]+$/", $location)) {
    //echo "Invalid location name!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="v2.css">
    <title>Travel Cite</title>
    <script src="loadLocation.js"></script>
    <script src="locationData.json"></script>
    <script src="buttons.js"></script>
    
</head>

<body>
    <main>
        
          <div class="nav">
            <a class ="logo" href="home.php"><img src="images/travelsitelogo.png"></a>
            <div class="navitem"><a class="navbutton" href="home.php">Home</a></div>
            <div class="navitem"><a class="navbutton" href="#about">About</a></div>
            <div class="navitem"><a class="navbutton sign_in" href="signin.php">Sign in</a></div>
            </div>  
        
        <div class="imge border">
            <p class="location">Example</p>
            
        </div>
        <div class="border">
        <div class="rating">
            <h2>Rating </h2>
            <h3>?/10</h3>
        </div>
            <div class="description"><h2>Description</h2>
                <p></p>
            </div>
        </div>
        </div>
        
        <div class="activities border">
            
                <h2>Places to Visit</h2>
            <div class="col">
                <!--Script loads this section-->
            </div>
        </div>
        
        <div class="border" id="reviews">
            <div><h2>Reviews</h2></div>
            <div><p></p></div>
            <div>
            <form id="reviewForm" action="submitReview.php?location=<?php echo urlencode($location); ?>" method="post">
                <textarea type="text" id="reviewBox" placeholder="Leave a review!" name="review"></textarea>
                <select for="reviewForm" id="ratingMenu" name="rating" required>
                <option disabled selected value="">&star;</option>
                <option value="10">10&starf;</option>
                <option value="9">9&starf;</option>
                <option value="8">8&starf;</option>
                <option value="7">7&starf;</option>
                <option value="6">6&starf;</option>
                <option value="5">5&starf;</option>
                <option value="4">4&starf;</option>
                <option value="3">3&starf;</option>
                <option value="2">2&starf;</option>
                <option value="1">1&starf;</option>
            </select>
                <button id="reviewSubmit" type="submit">Submit</button>
            </form>
        </div>
          
    </main>
    <footer>
        <div class="border" id="about">
            <div>
                <h3>References</h3>
                <a href="https://www.w3schools.com/html/" target="_blank">HTML</a>
                <a href="https://www.w3schools.com/js/" target="_blank">PHP</a>
                <a href="https://www.w3schools.com/html/" target="_blank">JS</a>
                <a href="https://www.w3schools.com/css/" target="_blank">CSS</a>
            </div>
            <div class="locationLinks">
                <h3>Location Links</h3>
            </div>
            <div>
                <h3>Other</h3>
                <a href="https://github.com/korok0/travelcite" target="_blank">GitHub Repository</a>
            </div>
        </div>
    </footer>
    <?php 
    $userName = "Guest";
    if(isset($_SESSION['user'])) {
        $userName = $_SESSION['user'];
    }

    if(isset($_SESSION['logged_in'])) {
        // echo "Logged In: " . $_SESSION['logged_in'];
    } else {
        // echo "Logged In: No";
    }
    if(!isset($_GET['location']) or $_GET['location'] == NULL){
        /* 
        if someone tries to do site.php? or site.php?location=
        without specifying location then redirect them back to main page
        */

        /* 
        Redirect user to main page. *Signin page for now
        */
        header("Location: signin.php");

        // Prevent any more of the script to run
        exit();
        }
        else{
            $location = $_GET['location'];
            echo "<script>load('" . $location . "')</script>";
            echo "<script>loadSources('" . $location . "')</script>";
            echo "<script>displayUsername('" . $userName ."')</script>";
        }
        if (isset($_SESSION["logged_in"])){
            echo "<script>changeLogButton()</script>";
        }
        else {
            echo "<script>lockReview()</script>";
        }?>
    
    <?php
    $servername = "localhost";
    $dbUsername = "root"; 
    $dbPassword = "";
    $dbName = "travelcite_user_account";

    // Create connection
    $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    if(isset($_GET["location"])){
        $sql = "SELECT * from {$_GET['location']}_reviews";
        $res = mysqli_query($conn, $sql);
        if($res){
            // add up ratings and number of ratings to perform calculation of average
            $ratingTotal = 0;
            $count = 0;
            while($array = mysqli_fetch_array($res)){
                $username = $array["username"];
                $rating = $array["rating"];
                $review = $conn->real_escape_string($array["review"]);
                echo "<script>loadReviews('$username', $rating,'$review')</script>";
                $count+=1;
                $ratingTotal+=$rating;
            }
            // call js function to perform average calculation
            echo "<script>displayAverageRating($ratingTotal, $count)</script>";
        }
        
    }
    $conn->close();
    ?>
    
</body>

</html>