<?php

session_start();

//Check to see if session retry is "admit."

if (isset($_SESSION["retry"]) && $_SESSION["retry"] == "admit") {
//If so, continue.
    $name = $_SESSION["name"];
} else {
    header("Location: adminAuthen.php");
}
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
        <p id="mainpara">Hello
            <?php echo $name;
            ?>
        </p> <br/>
        <p id="mainpara">Please choose the task you want to<br/>
            perform from the menu on the left.</p> <!-- <p class="red">*A footnote.</p> -->
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