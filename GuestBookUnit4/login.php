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
    $table = 'users';
    if ($errors == 0) {
        if($db_handle->verifyUser($email, $table)){
            $db_handle->verifyPassword($email, $password, $table);
        } else {
            $strError .='<p>Email Address Not Found</p> ';
            $errors .= 1;
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
        <?= $gfn->getHeader() ?>
        <?= $gfn->getTopNav() ?>
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
        <?= $gfn->getFooter() ?>
    </footer>
</div>
</body>
</html>