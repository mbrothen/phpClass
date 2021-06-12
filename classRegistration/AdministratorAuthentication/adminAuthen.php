<?php
# Verifies Cookie
session_start();

// Check if user has a cookie
if(!isset($_SESSION["errmsg"])){
    $_SESSION["errmsg"] = "";
}

if (isset ($_COOKIE["Admin"])) {
    // Set the session and go to sign in
    $_SESSION["name"] = $_COOKIE["Admin"][name];
    $_SESSION["retry"] = 0;
    $_SESSION["time"] = time();
    header("Location: signin.php");
} else {
    header("Location: register.php");
}