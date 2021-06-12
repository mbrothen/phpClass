<?php
session_start();
define('HOST', 'localhost');
define('USER', 'brothenm2');
define('PASS', 'password');
define('DB', 'brothenm2_chirp');
define('TABLE_USERS', 'users');
define('DRIVER', 'mysql');
$conn  = mysqli_connect(HOST, USER, PASS, DB);
if(mysqli_connect_error()){
    echo "Failed to connect ". mysqli_connect_error();
}

$timezone = date_default_timezone_set("America/Chicago");