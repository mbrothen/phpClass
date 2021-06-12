<?php
session_start();

include_once "Config.php";

//Check to see if session retry is "admit."

if (isset($_SESSION["retry"]) && $_SESSION["retry"] == "admit") {
//If so, continue.
    $name = $_SESSION["name"];
} else {
    header("Location: adminAuthen.php");
}

$connection = mysqli_connect(HOST, USER, PASS, DATABASE);
if (!$connection) {
    echo "Cannot connect to MySQL. " . mysqli_connect_error();
    exit();
}

echo "Connected!";
$message = "Nothing";
$message = $_POST['class_title'];
//    private $class_id;
//    private $class_title;
//    private $class_start;
//    private $class_descr;
//    private $class_instr;

// Remove white space, check for blank, remove special characterss
//$class_title = trim($_POST['class_title']);
$class_title = $_POST['class_title'];
echo "Class Title After Trim = " . $class_title;
if ( $class_title === '') {
    $_SESSION["errmsg"] = 2;
    echo "Class_Title = " . $_POST['class_title'];
    header("Location: classentry.php");
    //goto tryagain;
} else {
    $userid = mysqli_real_escape_string($connection, $class_title);
}

//$class_start = trim($_POST['class_start']);
$class_start = $_POST['class_start'];
if ( $class_start === '') {
    $_SESSION["errmsg"] = 3;
    echo "CLASS START = " . $class_start;
    header("Location: classentry.php");
    //goto tryagain;
} else {
    $userPasswd = mysqli_real_escape_string($connection, $class_start);
}

//$class_descr = trim($_POST['class_descr']);
$class_descr = $_POST['class_descr'];
if ( $class_descr === '') {
    echo "CLASS DESCR = " . $class_descr;
    $_SESSION["errmsg"] = 3;
    header("Location: classentry.php");
    //goto tryagain;
} else {
    echo "IN AN ELSE STATEMENT";
    $userPasswd = mysqli_real_escape_string($connection, $class_descr);
}
//$class_cost = trim($_POST['class_instr']);
$class_cost = $_POST['class_cost'];
if ( $class_cost === '' ){
    $_SESSION["errmsg"] = 3;
    header("Location: classentry.php");
    //goto tryagain;
} else {
    $userPasswd = mysqli_real_escape_string($connection, $class_cost);
}
//$class_instr = trim($_POST['class_instr']);
$class_instr = $_POST['class_instr'];
if ( $class_instr === '' ){
    $_SESSION["errmsg"] = 3;
    header("Location: classentry.php");
    //goto tryagain;
} else {
    $userPasswd = mysqli_real_escape_string($connection, $class_instr);
}

// Insert Query
$query = "INSERT INTO class(class_title, class_start, class_descr, class_cost, class_instr) VALUES('".$class_title."', '".$class_start."', '".$class_descr."', ".$class_cost.", '".$class_instr."')";



echo " --------   QUERY : " . $query;
$result = mysqli_query($connection, $query);

if (!$result) {
    $message = "Insert class failed";
    header("location: classentry.php");
} else {
    $message =  "You did it!";
    if($class_id = mysqli_insert_id($connection)) {
        header("Location: classUpdate.php?class_id=" . $class_id);  // Switch to class edit with the class ID in the $_GET
    } else {
        echo "ERROR GETTING CLASS_ID";
    }
}


/*
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
    // Return to Class Entry.php
    header("Location: classentry.php");
} else {

    // if on file get name and reset the session
    $_SESSION["name"] = $db_name;
    $_SESSION["retry"] = "admit";
    $_SESSION["time"] = time();
    header("Location: systementry.php");
}
*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Administrator Registration Page</title>
    <link rel="stylesheet" type="text/css" href="../css/registration.css"/>
    <script language="JavaScript" type="text/javascript"></script>
</head> <!-- Put cursor in the first field -->
<body onload="document.form1.admin_name.focus();"> <!-- From template -->
<div id="wrapper">
    <div id="header"><img src="../images/gatewaylogo.jpg" width="150"/>
        <h1 id="title">Class Selection and Registration</h1>
    </div> <!-- id="header" -->
    <div id="hnav">
        <table width="400" border="0" cellspacing="2" cellpadding="2">
            <tr>
                <td><a href="#">Home</a></td>
                <td><a href="#">About</a></td>
                <td><a href="#">Support </a></td>
                <td><a href="adminAuthen.php"> Maintain</a></td>
            </tr>
        </table>
    </div> <!-- id="hnav" -->


    <div id="vnav">
        <table width="120" border="0" cellspacing="2" cellpadding="2">
            <tr>
                <td id="vhead">Go To:</td>
            </tr>
            <tr>
                <td><a href="classentry.php">Enter New Classes</a></td>
            </tr>
            <tr>
                <td><a href="classupdate.php">Update & Delete Classes</a>
                </td>
            </tr>
        </table>
    </div> <!-- id="vnav" -->
    <div id="main">
        <h1 id="maintitle">Database Entry and Maintenance</h1> <br/>
            <h1><?php echo $message ?></h1>
        </div> <!-- id="main" -->

        <div id="footer">
            <p id="copyright">Copyright &copy
                <?php
                date_default_timezone_set('America/Chicago');
                echo date('Y');
                ?>

        </div> <!-- id="footer" -->
    </div> <!-- id="wrapper" --> </body>
</html>