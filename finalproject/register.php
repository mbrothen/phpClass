<?php
session_start();
//add database connection
require_once("include\config.php");
$strError = '';
$errors = 0;
$message = '';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $userName = stripslashes($_POST["txtUserName"]);
    $firstName = stripslashes($_POST['txtFirstName']);
    $lastName = stripslashes($_POST['txtLastName']);
    $zipCode = stripslashes($_POST['numZipcode']);
    $email = stripslashes($_POST["txtEmail"]);
    $password = stripslashes($_POST["txtPassword"]);
    $verifyPassword = stripslashes($_POST["txtVerifyPassword"]);

    // Verify fields contain data
    if(empty($_POST['txtUserName'])){
        $strError .= ' <p> Enter a username.</p>';
        $errors .= 1;
    }
    if(empty($_POST['txtFirstName'])){
        $strError .= ' <p> Enter a first name.</p>';
        $errors .= 1;
    }
    if(empty($_POST['txtLastName'])){
        $strError .= ' <p> Enter a last name.</p>';
        $errors .= 1;
    }
    if(empty($_POST['numZipcode'])){
        $strError .= ' <p> Enter a zipcode.</p>';
        $errors .= 1;
    }
    if(empty($_POST['txtEmail'])){
        $strError .= ' <p> Enter an email address.</p>';
        $errors .= 1;
    }
    if(empty($_POST['txtPassword'])){
        $strError .= ' <p> Enter a password.</p>';
        $errors .= 1;
    }
    if(empty($_POST['txtVerifyPassword'])){
        $strError .= ' <p> Please verify password.</p>';
        $errors .= 1;
    }
    // Verify email is valid
    if(filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        $strError .= ' <p>Please enter a valid email </p>';
        $errors .= 1;
    }
    // Verify password length only if they are filled
    if ((!(empty($password)) && (!(empty($verifyPassword))))){
        if (strlen($password) < 6){
            $strError .= ' <p>Password is too short</p>';
            $errors .= 1;
        }
        // Verify Passwords match
        if($password != $verifyPassword){
            $strError .= ' <p> Passwords do not match </p>';
            $errors .= 1;
        }
    }

    // Verify email is not already in the users table
    $table = 'users';
    if ($errors == 0) {
        if($db->verifyUser($email)){
            $strError .= ' <p> Email address is already in use </p> ';
            ++$errors;
        }
    }
    if ($errors == 0){
        if(!($db->createUser($userName, $firstName, $lastName, $zipCode, $email, $password))){
            $strError .= ' <p> Unable to save registration </p> ';
            ++$errors;
        }
    }

    if ($errors == 0) {
        $message = "Thank you for registering <br> Please <a href='login.php'>Login</a>";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Maintenance Master</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div>
    <?= $lfn->getHeader() ?>
    <?= $lfn->getTopNav() ?>
    <main>
        <h1>Register for Home Maintenance Master</h1>
        <form method="post"  action="<?= $_SERVER['PHP_SELF'] ?>">
            <div>
                <label for="txtUserName">Username:</label>
                <input name="txtUserName" id="txtUserName" type="text">
            </div>
            <div>
                <label for="txtFirstName">First Name:</label>
                <input name="txtFirstName" id="txtFirstName" type="text">
            </div>
            <div>
                <label for="txtLastName">Last Name:</label>
                <input name="txtLastName" id="txtLastName" type="text">
            </div>
            <div>
                <label for="txtEmail">Email:</label>
                <input name="txtEmail" id = "txtEmail" type="text">
            </div>
            <div>
                <label for="txtZipcode">Zip Code:</label>
                <input name="numZipcode" id = "numZipcode" type="number" maxlength="5">
            </div>
            <div>
                <label for="txtPassword">Password:</label>
                <input name="txtPassword" id = "txtPassword" type="password">
            </div>
            <div>
                <label for="txtVerifyPassword">Verify Password:</label>
                <input name="txtVerifyPassword" id = "txtVerifyPassword" type="password">
            </div>
            <input type="reset" name="reset" value="Reset Form" />
            <input type="submit" name="register" value="Register"/>
        </form>
        <h4><?=$strError?></h4>
        <h3><?=$message?></h3>
    </main>
    <footer>
        <?= $lfn->getFooter() ?>
    </footer>
</div>
</body>
</html>