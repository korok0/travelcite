<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="signinstyles.css">
    <script src="register.js"></script>
    <?php 
    
    
    ?>
</head>
<body>
    
    <main>
        <div class="img-container">
            <img src="images/travelsitelogo.png">
        </div>
        <div class="box">
        <form id="signin" action="account.php" method="post">
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
            <div id="formErrors"></div>
            <div class="submit">
                <input type="submit" id="register" form="signin" name="type" value="signup">
            </div>
            <div id="redirect"><a href="signin.php">Already have an account? Sign in.</a></div>
        </form>
        

    </div>
    </main>
</body>
</html>