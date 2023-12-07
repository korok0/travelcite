<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="v2.css">
    <title>Travel Cite</title>
    <script src="loadLocation.js"></script>
    <script src="countries.json"></script>
</head>

<body>
    <main>
        
          <div class="nav">
            <a class ="logo" href="index.php"><img src="images/travelsitelogo.png"></a>
            <div class="navitem"><a class="navbutton" href="home.php">Home</a></div>
            <div class="navitem"><a class="navbutton" href="#about">About</a></div>
            <div class="navitem"><a class="navbutton sign_in" href="signin.php">Sign in?</a></div>
            </div>  
        
    
        <div class="multi imge border"> 
            <p class="choice">Choose your next stop!<P>
            <p class="location-cards-container"></p>
             <!-- Smaller location cards will be loaded here -->
        </div>

        

        <div class="info border">
        </div>
        
        
        
        <div class="border" id="reviews">
            <p></p>
        </div>

    </main>
    <footer>
        <div class="border" id="about">
            About
        </div>
    </footer>
    <script>
        loadMultipleLocations([
            {
                name: "DC",
                backgroundImage: "images/dc-whitehouse.jpg",
                description: "the U.S capital"
            },
            {
                name: "Salem",
                backgroundImage: "images/salem-home.jpg",
                description: "a city in Massachusetts"
            },
            {
                name: "France",
                backgroundImage: "images/france-paris.jpg",
                description: "a country in Western Europe"
            }
        ]);
    </script>
</body>

</html>
