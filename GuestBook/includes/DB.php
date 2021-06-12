<?php

define("HOST", "localhost");
define("USER", "brothenm2");
define("PASS", "password");
#define("DB", "brothenm2_guestbook");
define("DB", "brothenm2_guestbook2");
define("TABLE", "guestbook");
$conn = new mysqli(HOST, USER, PASS, DB);

if  (!$conn) {
    die ( 'Could not connect: '  .  mysqli_connect_error());
}

class DB
{


    public function getOneRecord($id, $table)
    {
       $query = "SELECT * FROM $table WHERE id='$id'";
        return $this->makeQuery($query);
    }


}