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
    if($strError=='') {
        $table = "guestbook";
        if ($db_handle->insertOneRecord($table, $_POST)) {
            $message = "Posted Successfully";
        } else {
            $message = "Unable to post";
        }
    }

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
    <?= $gfn->getHeader() ?>
    <?= $gfn->getTopNav() ?>
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
</main>
<footer>
    <?= $gfn->getFooter() ?>
</footer>

</body>
</html>