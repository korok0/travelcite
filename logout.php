<?php
session_start();
$_SESSION = [];
// try to redirect user to last page
if(isset($_SERVER['HTTP_REFERER'])){
    $lastpage = $_SERVER['HTTP_REFERER'];
    header("Location: $lastpage");
    exit();
}
// if it fails then send to home instead
else{
    header("Location: home.php");
    exit();
}
?>