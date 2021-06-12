<?php
session_start();
//add database connection
require_once("config.php");

$strError = '';
$errors = 0;
$message = '';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = stripslashes($_POST["txtEmail"]);
    $password = stripslashes($_POST["txtPassword"]);
    // Verify fields contain data

    if(empty($_POST['txtEmail'])){
        $strError .= ' <p> Enter an email address.</p>';
        $errors .= 1;
    }
    if(empty($_POST['txtPassword'])){
        $strError .= ' <p> Enter a password.</p>';
        $errors .= 1;
    }
    // Verify email is valid
    if(filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        $strError .= ' <p>Please enter a valid email </p>';
        $errors .= 1;
    }
//Attempt login
    $Table = 'users';
    if ($errors == 0) {
        $SQLstring = "SELECT id, username, email FROM $Table" . " where email='".$email."' and password='".md5($password) . "'";

        $QueryResult = $conn->query($SQLstring);
        // Error on no record match
        if (mysqli_num_rows($QueryResult) == 0) {
            $strError .= ' <p> Invalid Email/Password Combination </p> ';
            ++$errors;
        } else {
            //Success Logic

            // Gather User Info.  Display welcome message
            $Row = $QueryResult->fetch_array();

            $id = $Row[0];
            $userName = $Row[1];
            $email = $Row[2];

            $message = "Welcome Back, $userName";

            //Store Session Here
            $_SESSION["userID"] = $id;
            $_SESSION["userName"] = $userName;
            $_SESSION["email"] = $email;
        }

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
    <header>
        <?= getHeader() ?>
        <?= getTopNav() ?>
    </header>
    <main>
        <h1>Login to my Guestbook!</h1>
        <form method="post"  action="<?= $_SERVER['PHP_SELF'] ?>">
            <div>
                <label for="txtEmail">Email:</label>
                <input name="txtEmail" id="txtEmail" type="text">
            </div>
            <div>
                <label for="txtPassword">Password:</label>
                <input name="txtPassword" id = "txtPassword" type="password" >
            </div>
            <input type="reset" name="reset" value="Reset Form" />
            <input type="submit" name="login" value="Login"/>
        </form>
        <h4><?=$strError?></h4>
        <h3><?=$message?></h3>
    </main>
    <footer>
        <?= getFooter() ?>
    </footer>
</div>
</body>
</html>