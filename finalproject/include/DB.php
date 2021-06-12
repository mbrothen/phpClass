<?php
include_once "config.php";

class DB
{
    private $PDO = null;
    private $dsn;

    public function __construct($driver=DRIVER, $host=HOST, $user=USER, $pass=PASS, $db = DB)
    {
        $this->setDsn($driver, $db, $host);
        $this->connect($user, $pass);
    }
    function connect($user, $pass){
        try{
            $this->PDO = new PDO($this->getDsn(), $user, $pass);
            if(!$this->PDO){
                throw new Exception("Unable to connect");
            }
        } catch (Exception $e){
            echo "Unable to connect.";
            echo "Error: " . $e->getMessage();
        }
    }

    function hashPass($password) {
        // Provide password hashing
        return password_hash($password, PASSWORD_DEFAULT);
    }

    function verifyPass($enteredPass, $databasePass) {
        // Verify if password matches database record after hashing
        return password_verify($enteredPass, $databasePass);
    }

    function getAllRecords($table){
        $query = "SELECT * FROM $table";
        return $this->PDO->query($query);
    }
    function createUser($userName, $firstName, $lastName, $zipCode, $email, $password){
        // Create a new user record
        $password = $this->hashPass($password);
        $userRole = "user";
        //$today = date();
/*
        $query = "INSERT INTO USERS (user_name, user_firstName, user_lastName, user_email, user_password, user_zipcode, user_role, user_join_date )
                  $userName, $firstName, $lastName, $email, $password, $zipCode, $userRole, $today";
*/
        $query = "INSERT INTO USERS (user_name, user_firstName, user_lastName, user_email, user_password, user_zipcode, user_role) 
                  $userName, $firstName, $lastName, $email, $password, $zipCode, $userRole";
        return $this->PDO->query($query);
    }

    function verifyUser($email) {
        // Find if $email exists in user table
        // Returns true if email is in use, false if not
        $query = "SELECT * FROM " . TABLE_USER . " WHERE user_email = '".$email ."'";
        $result = $this->PDO->query($query);

        if ($result->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function insertRecord($table, $data){
        $params = [NULL, $data[1], $data[2], $data[3], $data[4]];
        $query = "INSERT INTO $table VALUES(?,?,?,?,?)";
        $statement = $this->PDO->prepare($query);
        return $statement->execute($params);
    }
    function truncateTable($table){
        $query="TRUNCATE TABLE $table";
        return $this->PDO->query($query);
    }

    function getTableCount($table, $where) {
        if ($where) {
            $query = "SELECT COUNT(*) FROM " . $table . " WHERE " . $where;
        } else {
            $query = "SELECT COUNT(*) FROM " . $table;
        }

        return $this->PDO->query($query);
    }

    /**
     * @return null
     */
    public function getPDO()
    {
        return $this->PDO;
    }

    /**
     * @param null $PDO
     */
    public function setPDO($PDO)
    {
        $this->PDO = $PDO;
    }

    /**
     * @return mixed
     */
    public function getDsn()
    {
        return $this->dsn;
    }

    /**
     * @param mixed $dsn
     */
    public function setDsn($driver, $db, $host)
    {
        $this->dsn = $driver.":dbname=".$db.";host=".$host;
    }


}