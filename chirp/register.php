<?php


require "config.php";
require "includes/forms/register_handler.php";
require "includes/forms/login_handler.php";


?>



<html>
<head>
    <title>Chirp</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="assets/js/register.js" type="text/javascript"></script>
</head>
<body>
    <?php
    if(isset($_POST['register_button'])){
        echo '
        <script>
        $(document).ready(fuction(){
            $("#first").hide();
            $("#second").show();
        });
        </script>';
    }
    ?>

    <div class="wrapper">

        <div class="login_box">
            <div class="login_header">
                <h1>Chirp</h1>
                Login or Sign Up Below!
            </div>
            <div id = "first">
                    <form action="register.php" method="post">
                        <input type="email" name="log_email" placeholder="Email Address" required>
                        <br>
                        <input type="password" name="log_password" placeholder="Password" required>
                        <br>
                        <?php if(in_array("Email or Password incorrect<br>", $error_array)){
                            echo "Email or Password incorrect<br>";
                        }
                        ?>
                        <input type="submit" name="login_button" value="Login">

                        <br>
                        <a href="#" id="signup" class="signup"> Need an account?  Register here!</a>

                    </form>
                </div>
                <div id="second">
                    <form action="register.php" method="post">
                        <input type="text" name="reg_fname" placeholder="First Name"
                               <?php
                                if(isset($_SESSION['reg_fname'])){
                                    echo $_SESSION['reg_fname'];
                                }
                               ?>required>
                        <br>
                        <?php if(in_array("Last name must be between 2 and 60 characters<br>", $error_array)){
                            echo "Last name must be between 2 and 60 characters<br>";
                        }
                        ?>
                        <input type="text" name="reg_lname" placeholder="Last Name" <?php
                        if(isset($_SESSION['reg_lname'])){
                            echo $_SESSION['reg_lname'];
                        }
                        ?>required>
                        <br>
                        <?php if(in_array("Email already in use<br>", $error_array)){
                            echo "Email already in use<br>";
                        }
                        ?>
                        <input type="email" name="reg_email" placeholder="Email"
                               <?php
                        if(isset($_SESSION['reg_email'])){
                            echo $_SESSION['reg_email'];
                        }
                        ?>required>
                        <br>
                        <?php if(in_array("Email already in use<br>", $error_array)){
                            echo "Email already in use<br>";
                        }
                        if (in_array("Invalid Email<br>", $error_array)) {
                            echo "Invalid Email<br>";
                        }

                        ?>
                        <input type="text" name="reg_email2" placeholder="Confirm Email"
                               <?php
                        if(isset($_SESSION['reg_email2'])){
                            echo $_SESSION['reg_email2'];
                        }
                        ?>required>
                        <?php if(in_array("Emails don't match<br>", $error_array)){
                            echo "Emails don't match<br>";
                        }
                        ?>
                        <br>
                        <input type="password" name="reg_password" placeholder="Password" required>
                        <br>

                        <?php if(in_array("Password must be between 5 and 30 characters<br>", $error_array)){
                            echo "Password must be between 5 and 30 characters<br>";
                        }
                        ?>
                        <input type="password" name="reg_password2" placeholder="Confirm Password" required>
                        <br>
                        <?php if(in_array("Passwords do not match<br>", $error_array)){
                            echo "Passwords do not match<br>";
                        }
                        ?>
                        <input type="submit" name="register_button" value="Sign Up">

                        <br>

                <a href="#" id="signup" class="signup"> Already have an account?  Signin here!</a>




            </form>
        </div>
        <br>
        <?php if(in_array("<span>Registeration Successful <br> Please Login </span>", $error_array)){
            echo "<span>Registeration Successful <br> Please Login </span>";
        }
        ?>
        </div>

    </div>
</body>
</html>
