<?php
# Encrypts the password and writes the record

include_once "Config.php";
$connection = mysqli_connect(HOST, USER, PASS, DATABASE);
if (!$connection) {
    echo "Cannot connect to MySQL. " . mysqli_connect_error();
    exit();
}

echo "Connected!";

// Remove white space, check for blank, remove special characterss
if (($name = trim($_POST['admin_name'])) == '') {
    $_SESSION["errmsg"] = 1;
    goto tryagain;
} else {
    $name = mysqli_real_escape_string($connection, $name);
}

if (($userid = trim($_POST['admin_id'])) == '') {
    $_SESSION["errmsg"] = 2;
    goto tryagain;
} else {
    $userid = mysqli_real_escape_string($connection, $userid);
}

if (($userPasswd = trim($_POST['admin_password'])) == '') {
    $_SESSION["errmsg"] = 3;
    goto tryagain;
} else {
    $userPasswd = mysqli_real_escape_string($connection, $userPasswd);
}

$date = time();
$expire = time() + (60 * 60 * 24 * 180);
setcookie("Admin[name]", $name, $expire, "/");
setcookie("Admin[date]", $date, $expire, "/");

// Encrypt the password
$encryptpasswd = sha1($userPasswd);

// See if match in admin table

$query = "SELECT admin_id, admin_password, admin_name
            FROM administrator
            where admin_id= '$userid' AND admin_password='$encryptpasswd'";

$result = mysqli_query($connection, $query);

if (!$result) {
    echo "Select from administrator failed. " . mysqli_error($connection);
    exit();
}

// Verify user and pass

$row = mysqli_fetch_object($result);
$db_userid = $row->admin_id;
$db_password = $row->admin_password;
$db_name = $row->admin_name;

if($db_userid != $userid || $db_password != $encryptpasswd) {
    // Add record to admin table
    $query = "INSERT INTO administrator(admin_id, admin_password, admin_name)
    VALUE('$userid', '$encryptpasswd', '$name')";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        echo("Insert to admin failed. " . mysqli_error($connection));
        exit();
    }

    tryagain:
        // Return to adminAuthen.php
        header("Location: adminAuthen.php");
} else {

    // if on file get name and reset the session
    $_SESSION["name"] = $db_name;
    $_SESSION["retry"] = "admit";
    $_SESSION["time"] = time();
    header("Location: systementry.php");
}