<?php

class layoutFunctions
{
    function getTopNav()
    {
        $adminNav = '';
        $baseNav =
            "<nav >
            <ul id='nav'>
                <li><a href='index.php'>Home</a></li>
               ";
        $endNav = "
                </ul>
            </nav>
            ";
        $midNav = '';
        if (!isset($_SESSION['userName'])) {
            //display login or register
            $midNav = "<li class='push'><a href='register.php'>Register</a></li>
                <li><a href='login.php'>Login</a></li>";
        } elseif (isset($_SESSION['userName'])) {
            if ($_SESSION['role'] == 'admin'){
                $adminNav = '<li><a href="admin\admin.php">Admin</a></li>';
            }
            $midNav = "
                        <li><a href='upcoming.php'>Upcoming Tasks</a></li>
                        <li><a href='managehome.php'>Manage Home</a></li>"
                        . $adminNav .
                        "<li class='push'><a href='profile.php'>Manage Profile</a></li>
                        <li class='push'><a href='logout.php'>Logout</a></li>";
        }
        return $baseNav . $midNav . $endNav;

    }

    function getFooter()
    {
        return "<footer>Copyright 2021 Home Maintenance Master</footer>";
    }

    function getHeader()
    {
        $welcome = '';
        $title = '<h1>Home Maintenance Master</h1>';
        if (isset($_SESSION['userName'])) {
            $username = $_SESSION["userName"];
            $welcome = "<div class='welcomeMessage'><p>Welcome back $username</p></div>";
        }
        return "<div class = 'header'>" . $welcome . $title . "</div>";
    }

    function loginRegPrompt()
    {
        // Expand this to create a full intro page
        return "<div class='loginPrompt'>
            <h3><a href='login.php'>Login</a> or <a href='register'>Register</a></h3>";
    }

    function upcomingBrief()
    {
        // Get the next month of tasks
    }


    /*
     *
     * ADMIN LAYOUT FUNCTIONS
     *
     */

    function getAdminNav()
    {
        return "
                    <ul>
                        <li><a href='user.php'>Users</a></li>
                        <li><a href='tasks.php'>Tasks</a></li>
                    </ul>
                    ";
    }




}