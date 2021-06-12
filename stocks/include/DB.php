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
    function getAllRecords($table){
        $query = "SELECT * FROM $table";
        return $this->PDO->query($query);
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