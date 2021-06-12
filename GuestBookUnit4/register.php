<?php
session_start();
//add database connection
require_once("config.php");
$strError = '';
$errors = 0;
$message = '';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $userName = stripslashes($_POST["txtUserName"]);
    $email = stripslashes($_POST["txtEmail"]);
    $password = stripslashes($_POST["txtPassword"]);
    $verifyPassword = stripslashes($_POST["txtVerifyPassword"]);
    // Verify fields contain data
    if(empty($_POST['txtUserName'])){
        $strError .= ' <p> Enter a username.</p>';
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
        if($db_handle->verifyUser($email, $table)){
            $strError .= ' <p> Email address is already in use </p> ';
            ++$errors;
        }
    }
        /*

        $SQLstring = "SELECT count(*) FROM $Table" . " where email= '$email'";
        $QueryResult = $conn->query($SQLstring);
        if ($QueryResult != FALSE) {
            $Row = mysqli_fetch_row($QueryResult);
            $message = $Row;
            if ($Row[0]>0){
                $strError .= ' <p> Email address is already in use </p> ';
                ++$errors;
            }
        }
    }*/
    if ($errors == 0){
        if(!$db_handle->createUser($email, $password, $userName, $table)){
            $strError .= ' <p> Unable to save registation </p> ';
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
    <title>Guestbook is Bestbook</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div>
    <?= $gfn->getHeader() ?>
    <?= $gfn->getTopNav() ?>
    <main>
        <h1>Register for my Guestbook!</h1>
        <form method="post"  action="<?= $_SERVER['PHP_SELF'] ?>">
            <div>
                <label for="txtUserName">Username:</label>
                <input name="txtUserName" id="txtUserName" type="text">
            </div>
            <div>
                <label for="txtEmail">Email:</label>
                <input name="txtEmail" id = "txtEmail" type="text">
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
        <?= $gfn->getFooter() ?>
    </footer>
</div>
</body>
</html>