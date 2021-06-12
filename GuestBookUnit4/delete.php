<?php
session_start();
include_once("config.php");
$message = '';
$table = "guestbook";
$gfn->isAllowed();

if (isset($_SESSION['userName'])) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        try {

            $result = $db_handle->deleteOneRecord($id, $table);
            if (!$result) {
                $message = "Unable to delete post.  Something went wrong";
                exit();
            } else {
                $message = "Post Deleted";
            }
        } catch (Exception $e) {
            echo "Error " . $e;
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
<div>
    <?= $gfn->getHeader() ?>
    <?= $gfn->getTopNav() ?>
    <main>
        <h2><?= $message ?></h2>

    </main>
    <footer>
        <?= $gfn->getFooter() ?>
    </footer>
</div>
</body>
</html>