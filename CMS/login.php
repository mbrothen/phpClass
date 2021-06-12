<?php # login.php

// This displays and handles the login form
// Add utilities files
require('includes/utilities.inc.php');

// Create a new form
# I don't think I need this
#set_include_path(get_include_path() . PATH_SEPARATOR . '/HTML/');
#set_include_path('../');
#set_include_path(get_include_path() . PATH_SEPARATOR . ' ../');
set_include_path(get_include_path() . PATH_SEPARATOR . '/usr/local/pear/share/pear');
require('HTML/QuickForm2.php');
#include('HTML/QuickForm2.php');
$form = new HTML_QuickForm2('loginForm');

// Add the email address:

$email = $form->addElement('text', 'email');
$email->setLabel('Email Address');
$email->addFilter('trim');
$email->addRule('required', 'Please enter your email address.');
$email->addRule('email', 'Please enter your email address');

// Add the password field
$password = $form->addElement('password', 'pass');
$password->setLabel('Password');
$password->addFilter('trim');
$password->addRule('required', 'Please enter your password.');

// Add the submit button
$form->addElement('submit', 'submit', array('value'=>'Login'));

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //validate the form data
    if ($form->validate()){
        // Check against the database
        $q = 'SELECT id, userType, username, email FROM users WHERE email=:email AND pass=SHA1(:pass)';
        $stmt = $pdo->prepare($q);
        $r = $stmt->execute(array(':email'=>$email->getValue(), ':pass' => $password->getValue()));

        // Try and fetch the results
        if ($r) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $user = $stmt->fetch();
        }

        // Store the user in the session and redirect
        if ($user) {
            // Store in session
            $_SESSION['user'] = $user;

            // Redirect
            header("Location:index.php");
            exit;
        }
    }
}
// Show the login page
$pageTitle = 'Login';
include('includes/header.inc.php');
include('views/login.html');
include('includes/footer.inc.php');

?>