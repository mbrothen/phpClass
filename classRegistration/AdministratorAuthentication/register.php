<?php
# Creation of a new admin
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Administrator Registration Page</title>
    <link rel="stylesheet" type="text/css" href="../css/registration.css"/>
    <script language="JavaScript" type="text/javascript"></script>
</head>
<div id="wrapper">
    <div id="header">
        <img src="../images/gatewaylogo.jpg" width="150"/>
        <h1 id="title">Class Selection and Registration</h1>
    </div>
    <div id="hnav">
        <table width="400" border="0" cellspacing="2" cellpadding="2">
            <tr>
                <td><a href="#">Home</a></td>
                <td><a href="#">About</a></td>
                <td><a href="#">Support</a></td>
                <td><a href="adminAuthen.php">Maintain</a></td>
            </tr>
        </table>
    </div>
    <div id="vnav">
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
    </div>
    <div id="main">
        <h1 id="maintitle">Administrator Registration</h1>
        <br/>
        <?php if ($_SESSION["errmsg"] < 1) {
            ?>
            <p id="mainpara">Please enter your name, user ID, and password, adn click register</p>
        <?php } elseif ($_SESSION["errmsg"] == 1) {
            ?>
            <p class="red">Your name is required</p>
            <p class="red">Please RE-enter your name, user ID, and password, and click register</p>
        <?php } elseif ($_SESSION["errmsg"]) {
            ?>
            <p class="red">A User ID is required</p>
            <p class="red">Please RE-enter your name, user ID, adn password and click register</p>
        <?php } elseif ($_SESSION["errmsg"]){
            ?>
            <p class="red">A Password is required</p>
            <p class="red">Please RE-enter your name, user ID and password and click register</p>
        <?php
        }
        ?>
        <div id="form">
            <form action="enterName.php" method="post" name="form1">
                <table width="300" border="0" cellspacing="1" cellpadding="3">
                    <tr>
                        <th width="30%">Name:</th>
                        <td width="50%">
                            <input type="text" name="admin_name" value="" size="60"/>
                        </td>
                    </tr>
                    <tr>
                        <th>User ID:</th>
                        <td>
                            <input type="text" name="admin_id" value="" size="20"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Password:</th>
                        <td>
                            <input type="password" name="admin_password" value="" size="20"/>
                        </td>
                    </tr>
                </table>
                <br/>
                <input type="submit" name="submit" value="Register" />
            </form>
        </div>
        <br/>
        <p class="red">All fields are required.</p>
    </div>
    <div id="footer">
        <p id="copyright">Copyright &copy
            <?php
            date_default_timezone_set('America/Chicago');
            echo date('Y');
            ?>
        </p>
    </div>
</div>
</html>
