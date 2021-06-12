<?php
session_start();

include_once "Config.php";


$error = false;
$showForm = true;
$success = false;
$errorMsg = "";


$connection = mysqli_connect(HOST, USER, PASS, DATABASE);

$token = $_GET['token'];
$_SESSION['token'] = $token;

$query = "SELECT * FROM `reset_password` WHERE `token`='$token'";


$row = mysqli_query($connection, $query);
$row = mysqli_fetch_array($row);


$origDate = $row['exp_date'];
$date = new DateTime("now");
$origToken = $row['token'];


if ($origDate < $date->format("U")) {
    $error = true;
    $errorMsg = "The link has expired.  Please try again.";
} else if ($origToken != $token) {
    $error = true;
    $errorMsg = "Invalid token.  Please try again.";
}

if (!$error){
    $_SESSION['email'] = $row['email'];
    $query = "DELETE FROM `reset_password` WHERE `token` = '" . $_SESSION['token'] . "'";
    if (mysqli_query($connection, $query)) {
        $showForm = true;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle password reset
    $submitErrors = false;
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if(!$_GET['token']){
        $showForm = false;
    }
    if(!$password || !$confirmPassword) {
        $errorMsg = "Please enter both passwords";
        $submitErrors = true;

    }
    if($password != $confirmPassword) {
        $errorMsg = "Passwords do not match.";
        $submitErrors = true;
    }
    if (!$submitErrors) {
        $email = $_SESSION['email'];
        $password = mysqli_real_escape_string($password);  // Strip slashes
        $password = sha1($password); // Encrypt pass
        $query = "UPDATE administrator SET admin_password = '" . $password . "' WHERE admin_email= '" . $email . "'";


        if(mysqli_query($connection, $query)) {
            mysqli_error($connection);
            // Reset the session to log the user out if update is success
            $_SESSION["name"] = "";
            $_SESSION["retry"] = "";
            $_SESSION["time"] = "";
            $success = true;
        } else {
            $errorMsg = "Unable to update password.  Please try again.";
            $error = true;
        }
        echo mysqli_error($connection);

        $showForm = false;

    }

}
?>

<!DOCTYPE html>
<htmL>
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
                <td><a href="..#">Support </a></td>
                <td><a href="adminAuthen.php"> Maintain</a></td>
            </tr>
        </table>
    </div> <!-- id="hnav" -->
    <div id="vnav"> <!-- Placeholder only -->
        <table width="120" border="0" cellspacing="2" cellpadding="2">
            <tr>
                <td id="vhead">&nbsp</td>
            </tr>
            <tr>
                <td>&nbsp</td>
            </tr>
            <tr>
                <td>&nbsp</td>
            </tr>
        </table>
    </div> <!-- id="vnav" -->

    <div id="main">
        <h1 id="maintitle">Password Reset</h1> <br/>
        <p id="mainpara">Please enter your new password, and click Reset Password</p>
        <?php
        $retry = $_SESSION["retry"];
        if ($retry > 1) {
            ?>

            <p class="red">Email is invalid or not found</p>
            <?php

        }

        ?>
        <!-- From User Authentication -->
        <?php if($showForm) {?>
        <div id="form">
            <!-- Display the sign-in form. After filling in, go to verify page. -->
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" id="resetForm">
            <table width="200" border="0" cellspacing="3" cellpadding="5">
                <tr>
                    <th width="60">Password:</th>
                    <td width="120">
                        <input type="text" name="password" value="" size="60"/></td>
                </tr>
                <tr>
                    <th width="60">Confirm Password:</th>
                    <td width="120">
                        <input type="text" name="confirmPassword" value="" size="60"/></td>
                </tr>
            </table>
            <input type="submit" name="submit" value="Reset Password"/>
            </form>
        </div> <!-- id="form" -->
        <!-- End User Authentication --> <!-- Begin from template --> <br/>
        <p class="red">All fields are required.</p>
    </div> <!-- id="main" -->
    <?php } elseif ($error) {?>
        <h3 color="red"><?php echo $errorMsg ?></h3>
        <?php
    }
    ?>
    <?php if($success){
        ?><h3>Password Updated.  Please <a href="signin.php">login again</a></h3>
    <?php
    } ?>
    <div id="footer">
        <p id="copyright">Copyright &copy
            <?php
            date_default_timezone_set('America/Chicago');
            echo date('Y');
            ?>

    </div> <!-- id="footer" -->
</div> <!-- id="wrapper" --> </body>
</html>
