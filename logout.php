<?php
session_start();
$_SESSION = [];
header("Location: home.php");
exit();
?>