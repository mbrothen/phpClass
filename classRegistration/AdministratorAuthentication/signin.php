<?php
# Entry of user ID and password
session_start();
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
        <h1 id="maintitle">Administrator Sign In</h1> <br/>
        <?php
        $retry = $_SESSION["retry"];
        if ($retry < 1) {
            ?>

            <p id="mainpara">Please enter your user ID and password, and click Sign In.</p>
            <?php

        } elseif ($_SESSION["errmsg"] == 1) {
            ?>

            <p class="red">A User ID is required</p>
            <p class="red">Please RE-enter your user ID and password, and click Sign In.</p>

            <?php
            $_SESSION["errmsg"] = NULL;
        } elseif ($_SESSION["errmsg"] == 2) {
            ?>
            <p class="red">A Password is required.</p>
            <p class="red">Please RE-enter your user ID and password, and click Sign in.</p>
            <?php
            $_SESSION["errmsg"] = NULL;
        } else { ?>
            <p class="red">&nbsp</p>
            <p class="red">Please RE-enter your user ID and password, and click Sign In.</p>
            <?php
        }

        ?>
        <!-- From User Authentication -->
        <div id="form">
            <!-- Display the sign-in form. After filling in, go to verify page. -->
            <form action="verify.php" method="post" id="signinForm">
                <table width="200" border="0" cellspacing="3" cellpadding="5">
                    <tr>
                        <th width="60">User ID:</th>
                        <td width="120">
                            <input type="text" name="userid" value="" size="60"/></td>
                    </tr>
                    <tr>
                        <th>Password:</th>
                        <td><input type="password" name="passwd" value="" size="20"/></td>
                    </tr>
                </table>
                <input type="submit" name="submit" value="Sign In"/>
            </form>
            <a href="resetpassword.php">Forget Password?  Click her to reset.</a>
        </div> <!-- id="form" -->
        <!-- End User Authentication --> <!-- Begin from template --> <br/>
        <p class="red">All fields are required.</p>
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
