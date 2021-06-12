<?php
session_start();
// Check if session retry is "admin"
if (isset($_SESSION["retry"]) && $_SESSION["retry"] == "admit") {
    // continue
    echo "Hello ", $_SESSION["name"], "!<br />";
} else {
    header("Location: adminAuthen.php");
}