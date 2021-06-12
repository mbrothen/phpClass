<?php
include_once('config.php');
require('classes/Page.php');
require('classes/User.php');
function class_loader($class) {
    #require('classes/' . $class . '.php');
    if (file_exists(dirname(__FILE__).'classes/'.$class . '.php')){

    require('classes/' . $class . '.php');
    }
}
spl_autoload_register('class_loader');

// Start Session
session_start();

// Check for a user
$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : null;

// Create the database connection  as PDO Object
try {
    //Create PDO Obj
    $dsn = DRIVER . ":dbname=" . DB . ";host=" . HOST;
    $pdo = new PDO($dsn, USER, PASS);
} catch (PDOException $e) {
        $pageTitle = 'Error!';
        include('includes/header.inc.php');
        include('views/error.html');
        include('includes/footer.inc.php');
        exit();
    }
