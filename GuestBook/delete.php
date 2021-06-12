<?php
session_start();
include_once("config.php");
$message = '';

if(!isset($_SESSION['userName'])){
    #header("location: login.php");
    $message = "Unable to delete post.  Please <a href='login.php'>Login</>";
}
if (isset($_SESSION['userName'])) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        try {
            $query = "delete from " . TABLE . " where ID=" . $id;
            $result = $conn->query($query);
            if (!$result) {
                echo " Unable to delete: " . $conn->error;
                $conn->close();
                $message = "Unable to delete post.  Something went wrong";
                exit();
            } else {
                #$currentPost = mysqli_fetch_array($result);
                #$displayForm = false;
                #showPost($currentPost);
                $message = "Post Deleted";
            }
        } catch (Exception $e) {
            echo "Error " . $e;
        }
        mysqli_close($conn);
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
<div>
    <header>
        <h1>Guestbook is Bestbook</h1>
        <?= getTopNav() ?>
    </header>
    <main>
        <h2><?= $message ?></h2>

    </main>
    <footer>
        <?= getFooter() ?>
    </footer>
</div>
</body>
</html>