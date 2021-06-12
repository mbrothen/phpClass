<?php

define("HOST", "localhost");
define("USER", "brothenm2");
define("PASS", "password");
#define("DB", "brothenm2_guestbook");
define("DB", "brothenm2_guestbook2");
define("TABLE", "guestbook");

$conn = new mysqli(HOST, USER, PASS, DB);

if  (!$conn) {
    die ( 'Could not connect: '  .  mysqli_connect_error());
}


function getTopNav(){
    $baseNav =
    "<nav >
        <ul id='nav'>
            <li><a href='index.php'>Home</a></li>
            <li><a href='view.php'>View Guestbook</a></li>
            <li><a href='post.php'>Sign Guestbook</a></li>";
    $endNav = "
            </ul>
        </nav>
        ";
    $midNav = '';
    if(!isset($_SESSION['userName'])){
        //display login or register
        $midNav = "<li class='push'><a href='register.php'>Register</a></li>
            <li><a href='login.php'>Login</a></li>";
    } elseif(isset($_SESSION['userName'])){
        $midNav = "<li class='push'><a href='logout.php'>Logout</a></li>";
    }
    return $baseNav . $midNav . $endNav;

}

function getFooter(){
    return "<footer>Copyright 2021 Guestbook is Bestbook</footer>";
}

function getHeader(){
    $welcome = '';
    $title = '<h1>Guestbook is Bestbook</h1>';
    if(isset($_SESSION['userName'])){
        $username = $_SESSION["userName"];
        $welcome = "<div class='welcomeMessage'><p>Welcome back $username</p></div>";
    }
    return "<div class = 'header'>".$welcome . $title . "</div>";
}