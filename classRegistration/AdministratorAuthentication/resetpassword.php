<?php
# Reset password
session_start();

include_once "Config.php";

$connection = mysqli_connect(HOST, USER, PASS, DATABASE);
$_SESSION['resetSuccess'] = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle Form Submit
    if($email = mysqli_real_escape_string($connection, $_POST['useremail'])){
        if($result = checkEmail($email, $connection)) {  // See if email is in the database
            handleReset($email, $connection);
        } else {
            $_SESSION["retry"] = 1;

        }
    } else {
        $_SESSION["retry"] = 1;
    }

}

function handleReset($email, $connection) {

    $token = getToken(32);
    $date = new DateTime("now");   	//time right now
    $date->modify("+1 day");		//expires in 24 hours
    $query = "INSERT INTO reset_password (id,email,token,exp_date)
         VALUES(NULL,'. $email.','.$token.','" . $date->format('Y-m-d') . "')";
    $row = mysqli_query($connection, $query);
    echo mysqli_error($connection);
    if ($row) {
        $link = "<a href='" . PW_RESET_URL . "?token=" . $token . "'>SET NEW PASSWORD</a>";
        mail($email, "Password Reset", $link);
        $_SESSION["resetSuccess"] = true;
        $_SESSION["retry"] = 0;
        $_SESSION["email"] = $email;  //Save email to session to use later
    }

}

function checkEmail($email, $connection){
    // Checks if email exists in admin table
    $query = "SELECT 1 FROM administrator WHERE admin_email= '" . $email . "'";
    $row = mysqli_query($connection, $query);

    if(mysqli_num_rows($row) > 0 ){
        return true;
    }
    return false;
}

function crypto_rand_secure($min, $max)
{
    $range = $max - $min;
    if ($range < 1) return $min;
    $log = ceil(log($range, 2));
    $bytes = (int)($log / 8) + 1;       // length in bytes
    $bits = (int)$log + 1;              // length in bits
    $filter = (int)(1 << $bits) - 1;    // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter;          // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}

function getToken($length)
{
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet .= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i = 0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max - 1)];
    }
    return $token;
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
        <?php
        $retry = $_SESSION["retry"];
        if ($retry > 1) {
            ?>

            <p class="red">Email is invalid or not found</p>
            <?php

        }

        ?>
        <!-- From User Authentication -->
        <?php if(!$_SESSION['resetSuccess']) {?>
        <p id="mainpara">Please enter your user email, and click Reset Password</p>

        <div id="form">
            <!-- Display the sign-in form. After filling in, go to verify page. -->
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" id="signinForm">
                <table width="200" border="0" cellspacing="3" cellpadding="5">
                    <tr>
                        <th width="60">Email:</th>
                        <td width="120">
                            <input type="text" name="useremail" value="" size="60"/></td>
                    </tr>
                </table>
                <input type="submit" name="submit" value="Reset Password"/>
            </form>
        </div> <!-- id="form" -->
        <!-- End User Authentication --> <!-- Begin from template --> <br/>
        <p class="red">All fields are required.</p>
    </div> <!-- id="main" -->
    <?php } elseif ($_SESSION['resetSuccess']) {?>
        <p>Please check your email and click Reset Password</p>
        <p>Check your mailbox for instructions to reset your password</p>
    <?php
    }
    ?>
    <div id="footer">
        <p id="copyright">Copyright &copy
            <?php
            date_default_timezone_set('America/Chicago');
            echo date('Y');
            ?>

    </div> <!-- id="footer" -->
</div> <!-- id="wrapper" --> </body>
</html>
