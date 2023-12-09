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
        <div class="info border">
            <div class="rating"><h2>Rating </h2><h3>?/10</h3>
                <p></p>
            </div>
            <div class="description"><h2>Description</h2>
                <p></p>
            </div>
        </div>
        
        <div class="activities border">
            
                <h2>Things To Do</h2>
            <div class="col">
                <!--Script loads this section-->
            </div>
        </div>
        
        <div class="border" id="reviews">
            <div><h2>Reviews</h2></div>
            <div><p></p></div>
            <div>
            <form id="reviewForm" action="submitReview.php" method="get">
                <textarea type="text" id="reviewBox" placeholder="Leave a review!" name="review"></textarea>
                <select id="ratingMenu" name="rating" required>
                    <option disabled selected value="">&star;</option>
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
            About
        </div>
    </footer>
    <?php 
    if(!isset($_GET['location']) or $_GET['location'] == NULL){
        /* 
        if someone tries to do site.php? or site.php?location=
        without specifying location then redirect them back to main page
        */

        /* 
        Redirect user to main page. *Signin page for now
        */
        header("Location: signin.php");

        // prevent any more of the script to run
        exit();
    }
    else{
        $location = $_GET['location'];
        echo "<script>load('" . $location . "')</script>";
    }
    ?>
    <?php
            // resume the session when switching pages
            session_start();
            // if user is logged in 
            if (isset($_SESSION["logged_in"])){
                // change sign in button to log out!
                echo "<script>changeLogButton()</script>";
            }
            else {
                // if user is not logged in, lock ratings and review buttons
                echo "<script>lockReview()</script>";
            }
            ?>
    
</body>

</html>