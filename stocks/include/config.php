<?php

define('HOST', 'localhost');
define('USER', 'brothenm2');
define('PASS', 'password');
define('DB', 'brothenm2_stocks');
define('TABLE_STOCK', 'stocks');
define('DRIVER', 'mysql');

include_once 'DB.php';
include_once 'functions.php';

$db = new DB();
$sfn = new Stock();