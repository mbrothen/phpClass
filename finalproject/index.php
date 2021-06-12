
<?php
session_start();
include_once "include\config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Maintenance Master</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div>
        <?= $lfn->getHeader() ?>
        <?= $lfn->getTopNav() ?>
    <main>
        <h1>Home Maintenance Master</h1>
        <?php
            if(!isset($_SESSION['userName'])){
                $lfn->loginRegPrompt();
            } else {
                $lfn->upcomingBrief();
            }
        ?>
    </main>
    <footer>
        <?= $lfn->getFooter() ?>
    </footer>
</div>
</body>
</html>