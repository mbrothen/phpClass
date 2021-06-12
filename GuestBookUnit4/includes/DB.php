<?php

define("HOST", "localhost");
define("USER", "brothenm2");
define("PASS", "password");
#define("DB", "brothenm2_guestbook");
define("DB", "brothenm2_guestbook2");
define("TABLE", "guestbook");


class DB
{
    private $conn = null;
    public function __construct(){
        $this->connect();
    }

    function connect(){
        try {
            $this->conn = new mysqli(HOST, USER, PASS, DB);
            if (!$this->conn) {
                throw new Exception("Cannot Connect");
            }
        } catch (Exception $e) {
            echo "Something went wrong.  Unable to connect. ";
            echo "Error: " . $e->getMessage();
        }

    }
    function makeQuery($query){
        return $this->conn->query($query);
    }
    function getOneRecord($id, $table)
    {
       $query = "SELECT * FROM $table WHERE id='$id'";
        return $this->makeQuery($query);
    }
    function getAllRecords($table){
        $query = "SELECT * FROM $table";
        return $this->makeQuery($query);
    }
    function deleteOneRecord($id, $table){
        $query = "DELETE FROM $table WHERE id='$id'";
        return $this->makeQuery($query);
    }
    public function updateOneRecord($data, $table){
        $id = $data['id'];
        $name = $data["txtName"];
        $email = $data["txtEmail"];
        $comment = $data["txtComment"];
        $datetime = strtotime("now");
        $updateQuery = "UPDATE ". $table ." SET name='$name', email='$email', comment='$comment', Date_Time='$datetime'
               WHERE ID='$id'";
        return $this->makeQuery($updateQuery);
    }
    function insertOneRecord($table, $data){
        $name = $data["txtName"];
        $email = $data["txtEmail"];
        $comment = $data["txtComment"];
        $datetime = strtotime("now");
        $strInsert = "insert into $table (Name,Email,Comment,Date_Time) values ('".$name."','".$email."','"
            .$comment."',$datetime)";
        return $this->makeQuery($strInsert);
    }
    // Auth and registration
    function verifyUser($email, $table){
        $query = "SELECT * FROM $table WHERE email = '$email'";
        $result = $this->makeQuery($query);
        if (mysqli_num_rows($result) == 0) {
           return false;

        } else {
            return true;
        }
    }
    function verifyPassword($email, $password, $table){
        $query = "SELECT id, username, email FROM $table" . " where email='".$email."' and password='".md5($password) .
            "'";
        $result = $this->makeQuery($query);
        if ($result->num_rows > 0){
            $row = $result->fetch_array();
            $id = $row[0];
            $userName = $row[1];
            $email = $row[2];

            //$message = "Welcome Back, $userName";

            //Store Session Here
            $_SESSION["userID"] = $id;
            $_SESSION["userName"] = $userName;
            $_SESSION["email"] = $email;
        }
    }
    //TODO - FIGURE OUT WHY IT'S NOT ADDING EMAIL
    function createUser($email, $password, $username, $table) {
        $query = "INSERT INTO $table " .
            " (username, email, password) ".
            " VALUES( '$username', '$email', " .
            " '" . md5($password) . "')";
        $user = $this->makeQuery($query);
        mysqli_insert_id($this->conn);
        return $user;
    }

    //Getter and Setter Methods

    /**
     * @return null
     */
    public function getConn()
    {
        return $this->conn;
    }

    /**
     * @param null $conn
     */
    public function setConn($conn)
    {
        $this->conn = $conn;
    }
    

}