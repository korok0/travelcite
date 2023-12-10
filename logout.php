<?php
session_start();
// re
if(isset($_SERVER['HTTP_REFERER'])){
    $lastpage = $_SERVER['HTTP_REFERER'];
}
$_SESSION = [];
header("Location: $lastpage");
exit();
?>