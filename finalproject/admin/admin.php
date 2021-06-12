
<?php
session_start();
include_once "include\config.php";

function adminDashboard()
{
    $regUsers = "WHERE user_role = USER";
    $tasks = '';

    return "
        <ul>
            <li>Total Number Of Users: " . $db->getTableCount(TABLE_USER, $regUsers) . "</li>
            <li>Total Number of Tasks: " . $db->getTableCount(TABLE_TASKS, $tasks) . "</li>
            <li></li>
        </ul>
        ";

}

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
    <?= $lfn->getAdminNav() ?>
    <main>
        <h1>Admin Panel</h1>
        <?php
        if(!isset($_SESSION['userName']) || ($_SESSION['user_role'] != 'admin')){
            // Redirect people not logged in or an admin
            header("Location: index.php");
            //$lfn->loginRegPrompt();
        } else {
            adminDashboard();
        }
        ?>
    </main>
    <footer>
        <?= $lfn->getFooter() ?>
    </footer>
</div>
</body>
</html>