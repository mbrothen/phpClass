
<?php
session_start();
include_once "config.php";
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
        <h1>Welcome to my Guestbook!</h1>
    </main>
    <footer>
        <?= $gfn->getFooter() ?>
    </footer>
</div>
</body>
</html>