<?php
include "UtilityFunction.php";

class GuestbookFunction extends UtilityFunction
{

    function getHeader()
    {
        $welcome = '';
        $title = '<h1>Guestbook is Bestbook</h1>';
        if(isset($_SESSION['userName'])){
            $username = $_SESSION["userName"];
            $welcome = "<div class='welcomeMessage'><p>Welcome back $username</p></div>";
        }
        return "<header><div class = 'header'>".$welcome . $title . "</div></header>";
    }

    function getTopNav()
    {
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

}