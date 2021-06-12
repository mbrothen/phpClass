<?php
# checks if userid and pass are on the table
session_start();

include_once "Config.php";

$connection = mysqli_connect(HOST, USER, PASS, DATABASE);
if (!$connection) {
    echo "Cannot connect to MySQL. " . mysqli_connect_error();
    exit();
}  // Remove white space, check for blank and remove special chars
if (($userid = trim($_POST['userid'])) == '') {
    $_SESSION["errmsg"] = 1;
    goto tryagain;
} else {
    $userid = mysqli_real_escape_string($connection, $userid);
}
if (($userPasswd = trim($_POST['passwd'])) == '') {
    $_SESSION["errmsg"] = 2;
    goto tryagain;
} else {
    $userPasswd = mysqli_real_escape_string($connection, $userPasswd);
}

// Encrypt the password
$encryptpasswd = sha1($userPasswd);

// Check if match in admin table
$query = "SELECT admin_id, admin_password, admin_name FROM administrator 
    WHERE admin_id='$userid' AND admin_password='$encryptpasswd'";

$result = mysqli_query($connection, $query);
if (!$result) {
    echo "Select from administrator failed. " . mysqli_error($connection);
    exit();
}

// Determine if user id and pass are on file
$row = mysqli_fetch_object($result);
$db_userid = $row->admin_id;
$db_password = $row->admin_password;
$db_name = $row->admin_name;

if ($db_userid != $userid || $db_password != $encryptpasswd) {
    tryagain:
    $retry = $_SESSION["retry"];
    $retry++;
    if ($retry > 3) {
        header("Location: register.php");
    } else {
        $_SESSION["retry"] = $retry;
        header("Location: signin.php");
    }
} else {
    //If on file, get name, reset the session, and enter site.
    $_SESSION["name"] = $db_name;
    $_SESSION["retry"] = "admit";
    $_SESSION["time"] = time();
    header("Location: systementry.php");

}