<?php
session_start();
include_once "object.php";
include_once "car.php";
include_once "Plane.php";
include_once "Boat.php";
include_once "functions.php"
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Amazzzing Vehicles</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div>
    <header>
        <?php getHeader() ?>
        <?php getTopNav() ?>
    </header>


    <main>
        <?php
        if(isset($_GET['obj'])){
            if(in_array($_GET['obj'],array_keys($vehicleObjs))){
                createObject($_GET['obj']);
            }else{
                showInvalid();
            }
        }else{
            resetObj();
        }
        ?>

    </main>
    <footer>
    </footer>
</div>
</body>
</html>