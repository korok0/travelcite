<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="signinstyles.css">
    <!--Not using routes so we set a default value and can change it for different page to be loaded-->
    <?php 
    
    
    ?>
</head>
<body>
    
    <main>
        <div class="img-container">
            <img src="images/travelsitelogo.png">
        </div>
        <div class="box">
        <form id="signin" action="signin.php" method="post">
            <div>
                <label for="username">Username:</label>
                <input id="username" type="text" name="user" autocomplete="off" required>
            </div>

            <div>
                <label for="password" >Password:</label>
                <input id="password" type="text" name="pass" autocomplete="off" required>
            </div>
            <div>
                <label for="cpassword" >Confirm Password:</label>
                <input id="cpassword" type="text" name="cpass" autocomplete="off" required>
            </div>
            <div class="submit">
                <input type="submit" id="login" form="signin" value="Login">
            </div>
            
        </form>

    </div>
    </main>
</body>
</html>