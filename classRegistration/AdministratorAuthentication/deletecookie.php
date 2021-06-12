<?php
//Delete cookie for name and date
session_destroy();
setcookie("Admin[name]", $name, $expire, "/");
setcookie("Admin[date]", $date, $expire, "/");
