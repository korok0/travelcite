<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="signinstyles.css">
    <!--Not using routes so we set a default value and can change it for different page to be loaded-->
    
</head>
<body>
    
    <main>
        <div class="img-container">
            <img src="images/travelsitelogo.png">
        </div>
        <div class="box">
        <form id="signin" action="index.php" method="post">
            <div>
                <label for="username">Username:</label>
                <input id="username" type="text" name="user" autocomplete="off" required>
            </div>

            <div>
                <label for="password" >Password:</label>
                <input id="password" type="text" name="pass" autocomplete="off" required>
            </div>
            <div class="submit">
                <input type="submit" id="login" form="signin" value="Login">
            </div>
    <!-- Upon submitting, send to script that checks if account exists. If it does, redirect to index.php-->


    <!--This PHP block is just a test. Matching password confirmation works. Data sent through post successfully. Tested to see if signup sends post data to sign in. 
    After user submits credentials, check if they exist in database. If it does, redirect to main page
    -->
    <?php 
        $e = $_POST['cpass'];
        $p = $_POST['pass'];
        if ($e == $p){
            echo "<p>HEYYYYYYYYYYYYYYY</p>";
            }
        
        ?>
        </form>

    </div>
    </main>
</body>
</html>