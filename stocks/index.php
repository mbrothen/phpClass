<?php
$message = "";
$showTable = false;
$filename = "stocks.txt";
include_once "include/config.php";
    if(isset($_GET['t'])){
        $link = $_GET['t'];

        if($link == "view"){
            $rows = $db->getAllRecords(TABLE_STOCK);
            if($rows->rowCount() == 0) {
                $message = "Please load stocks";
            } else{
                $showTable = true;
            }
        } else if($link == "reset"){
            $success = $db->truncateTable(TABLE_STOCK);
            if ($success){
                $message = "Data cleared";
            } else{
                $errors[] = "Unable to delete";
            }
        } else if ($link == "stocks"){
            $result = $db->getAllRecords(TABLE_STOCK);
            if($result->rowCount() > 0) {
                $message = "Stocks already added";
            } else {
                $success = $sfn->readFile($filename, $db);
                if ($success) {
                    $message = "Stocks loaded";
                } else {
                    $errors[] = "Unable to load stocks";
                }
            }
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Amazzzing Stocks</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
<div>
    <?php $sfn->getHeader(); ?>
    <?php $sfn->getTopNav(); ?>
    <main>
        <!-- show error messages-->
        <?php
        if(isset($errors)){
            echo "<div class='error-message'>";
            foreach($errors as $error){
                echo "<h1>* $error</h1>";
            }
            echo "</div>";
        }

        // show table
        if($showTable) {
            $sfn->showStocks($rows);
        }
        else{
            echo " <h1>$message</h1>";
        }?>

    </main>
    <?php $sfn->getFooter(); ?>
</div>
</body>
</html>