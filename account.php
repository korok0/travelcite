<?php

/*  Check if form type (value of submit button) is "signup" or "signin"*/
if (isset($_POST["type"])){
    if ($_POST["type"] == "signin"){
        echo "sign in detected!";
    }
    else {
        echo "sign up detected!";
    }
}

/* 
IF SIGNIN JUST CALL CHECK FUNCTION AND THEN MATCH SIGN IN DATA WITH DATABASE DATA

IF SIGNUP CALL CHECK FUNCTION THEN REGISTER FUNCTION

check() - checks if username exists in database. boolean return type
match() - matches sign in form data with database data. if they are the same then SIGN IN THE USER (PASS DATA TO SESSION ARRAY TO SAVE) 
          if not the same then do NOT sign in user

register() - creates new user in database


*/
?>