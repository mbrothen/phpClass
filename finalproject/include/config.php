<?php

define('HOST', 'localhost');
define('USER', 'brothenm2');
define('PASS', 'password');
define('DB', 'brothenm2_final');
define('TABLE_USER', 'users');
define('TABLE_POST', 'posts');
define('TABLE_TASKS', 'tasks');
define('TABLE_TASK_HISTORY', 'task_history');


define('DRIVER', 'mysql');

include_once 'DB.php';
include_once 'functions.php';
include_once 'layoutFunctions.php';

$db = new DB();
$lfn = new layoutFunctions();