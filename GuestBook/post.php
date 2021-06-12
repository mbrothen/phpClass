<?php
session_start();
//add database connection
require_once("config.php");

$strUrl = 'guestbook.html';
$strError = '';
$message = 'Sign the Guestbook';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name = $_POST["txtName"];
    $email = $_POST["txtEmail"];
    $comment = $_POST["txtComment"];
    $datetime = strtotime("now");
    //validate
    if($name=='') {$strError = '<br /> Please enter a name';}
    if(filter_var($email, FILTER_VALIDATE_EMAIL) == false) {$strError .= "<br />Please enter a valid email";}
    if($comment=='') {$strError .= '<br />Please enter a comment';}

    if($strError!=''){
        echo $strError."<br /><a href='javascript:history.back();'>Back</a>";die;
    }

    //Post
    if($strError==''){
        #$strInsert = "insert into guestbook (Name,Email,Url,Comment,IP_Address,Date_Time) values ('".$name."','"
        #.$email.$comment."',$datetime)";

        $strInsert = "insert into guestbook (Name,Email,Comment,Date_Time) values ('".$name."','".$email."','"
           .$comment."',$datetime)";
        if ($conn -> connect_errno) {
            // Check connection again
            echo "Failed to connect to MySQL: " . $conn -> connect_error;
            exit();
        }
        if (!$result = $conn->query($strInsert)) {
            // Handle insert error, display message
            echo " Insert Failed " . $conn -> error;
            $conn -> close();
            exit();
        }
        $message = "Posted Successfully";
    }
    mysqli_close($conn);


 #   $strUrl = 'guestbook.html?a=y';
  #  header("location: $strUrl");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guestbook is Bestbook</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <?= getHeader() ?>
    <?= getTopNav() ?>
</header>
<main>


    <h2><?=$message?></h2>


    <form name="guestBook" id="guest_book" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <div>
            <label for="txtName">Name:</label>
            <input name="txtName" id="txtName" type="text">
        </div>
        <div>
            <label for="txtEmail">Email:</label>
            <input name="txtEmail" id = "txtEmail" type="text">
        </div>
        <div>
            <label for="txtComment">Comment:</label>
            <textarea name="txtComment" id="txtComment"></textarea>
        </div>
        <div>
            <input type="submit" name="submit">
        </div>
    </form>
    <h3><?=$strError?></h3>
    <!--
    <form name="guestBook" action="" method="post">

        <tr>
            <td>Name</td>
            <td><input type="text" name="txtName" id="txtName" maxlength="32" /></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="txtEmail" id = "txtEmail" maxlength="256""/></td>
        </tr>
        <tr>
            <td>Comment</td>
            <td><input type="text" name="txtComment" id="txtComment" maxlength="1024" /></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="btnSubmit" value="Submit" /></td>
        </tr>
        <tr>
            <td>
            </td>
            <td><a href="view.php">View Guestbook</a></td>
        </tr>

    </form>
    -->
</main>
<footer>
    <?= getFooter() ?>
</footer>

</body>
</html>