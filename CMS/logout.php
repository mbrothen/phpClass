<?php
// Logs the user out

// Include utilities file
require('includes/utilities.inc.php');

// Check if there is a user
if ($user) {
    // clear the var
    $user = null;

    // Clear session data:
    $_SESSION = array();

    // Clear the cookie:
    setcookie(session_name(), false, time()-3600);

    // Destroy session
    session_destroy();
}

// Set the page title and include header
$pageTitle = 'Logout';
include('includes/header.inc.php');

// Add the view
include('view/logout.html');

// Add footer
include('includes/footer.inc.php');