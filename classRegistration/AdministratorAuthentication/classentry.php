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
        <div id="form">
            <!-- Display the class create form. -->
            <form action="createClass.php" method="post" id="createClassForm">
                <table width="200" border="0" cellspacing="3" cellpadding="5">
                    <tr>
                        <th width="60">Class Title:</th>
                        <td width="120">
                            <input type="text" name="class_title" value="" size="60"/></td>
                    </tr>
                    <tr>
                        <th>Class Start:</th>
                        <td><input type="date" name="class_start" value="" size="20"/></td>
                    </tr>
                    <tr>
                        <th>Class Description:</th>
                        <td><textarea name="class_descr" value="" cols="56" rows="6"></textarea> </td>
                    </tr>
                    <tr>
                        <th>Class Cost:</th>
                        <td><input type="number" min="0.01" step="0.01" max="999999.99" name="class_cost"
                                   size="10"/></td>
                    </tr>
                    <tr>
                        <th>Class Instructor:</th>
                        <td><input type="text" name="class_instr" value="" size="20" /> </td>
                    </tr>
                </table>
                <input type="submit" name="submit" value="Create Class"/>
            </form>
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