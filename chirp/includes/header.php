<?php
include_once 'config.php';

if (isset($_SESSION['username'])){
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($conn, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);

} else {
    header("Location: register.php");
}
?>

<html>
<head>
    <title>Chirp</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"></head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class = "top_bar">
        <div class="logo">

            <a href="index.php"><img src="assets/images/logo.png">Chirp</a>
        </div>
        <nav>
            <a href="profile.php?username=<?php echo $userLoggedIn;?>">
                <?php
                echo $user['first_name'] ;
                ?>
            </a>
            <a href="index.php">Home</a>
            <a href="includes/logout.php">Logout</a>

        </nav>
    </div>
<div class="container">
    <?php
        if(isset($_SESSION['statusMSG'])) {
            echo '<div class="statusMSG">' . $_SESSION['statusMSG'] . '</div>';
            $_SESSION['statusMSG'] = "";
        }