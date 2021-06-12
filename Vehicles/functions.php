<?php

$vehicleObjs = ["car"=> new Car(), "boat" => new Boat(), "plane" => new Plane()];

function getTopNav(){
    ?>
    <ul>
        <li><a href="<?= $_SERVER['PHP_SELF']?>?obj=car">Car</a></li>
        <li><a href="<?= $_SERVER['PHP_SELF']?>?obj=boat">Boat</a></li>
        <li><a href="<?= $_SERVER['PHP_SELF']?>?obj=plane">Plane</a></li>
        <li><a href="<?= $_SERVER['PHP_SELF']?>">Start Over</a></li>
    </ul>
    <?php

}

function getFooter(){
    return "<footer>Copyright 2021 Amazzzing Vehicle Page Co</footer>";
}

function getHeader(){
    $title = '<h1>Amazzzing Vehicles</h1>';
    return "<div class = 'header'>" . $title . "</div>";
}

function resetObj(){
    session_unset();
    session_destroy();
    echo"<h3>Pick a Vehicle</h3>";
}

function showActions($obj){
    ?>
    <div>
        <ul>
            <li><a href="<?= $_SERVER['PHP_SELF']?>?obj=<?=$obj?>&action=start">Start Engine</a></li>
            <li><a href="<?= $_SERVER['PHP_SELF']?>?obj=<?=$obj?>&action=stop">Stop Engine</a></li>
            <li><a href="<?= $_SERVER['PHP_SELF']?>?obj=<?=$obj?>&action=accelerate">Accelerate</a></li>
            <li><a href="<?= $_SERVER['PHP_SELF']?>?obj=<?=$obj?>&action=brake">Brake</a></li>
    </div>
<?php
}

function createObject($type)
{
    $obj = getObj($type);
    if (isset($_GET['action'])) {
        processAction($obj);
    }
    $_SESSION[$type] = serialize($obj);
    $obj->showInfo();
    showActions($type);
}

function processAction($obj){
    switch ($_GET['action']){
        case 'start': $obj->startEngine();
        break;
        case 'stop': $obj->stopEngine();
        break;
        case 'accelerate': $obj->accelerate();
        break;
        case'brake': $obj->brake();
        break;
    }
}

function getObj($type){
    global $vehicleObjs;
    if(isset($_SESSION[$type])){
        return unserialize($_SESSION[$type]);
    }else{
        return $vehicleObjs[$type];
    }
}