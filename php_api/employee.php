<?php

class Employee
{
    private $conn;
    private $table;
    public $eid;
    public $first_name;
    public $last_name;
    public $email;
    public $position;
    public $company;
    public $country;

    function  __construct($db_handle,$table)
    {
        $this->conn = $db_handle;
        $this->table = $table;
    }

    /**
     * GET (Read) one or all records from the Employee table
     * @param $id - if $id is provided then Read ONE else Read ALL
     * @return mixed
     */
    function get($id){

        // Sanitize and clean up $id
        // Strip off any malicious tags
        // Remove leading and trailing white spaces
        $id=trim(htmlspecialchars(strip_tags($id)));
        $id = "{$id}";

        // Read ONE
        if(strlen($id)>0) {
            $query = "SELECT * FROM $this->table
            WHERE eid = ?";

            // Prepare the query statement
            $result = $this->conn->prepare($query);

            // Bind to parameters
            $result->bindParam(1, $id);

        // Read ALL
        }else{
            $query = "SELECT * FROM $this->table
            ORDER BY eid ASC";
            // Prepare the query statement
            $result = $this->conn->prepare($query);
        }
        // Execute query
        $result->execute();
        return $result;
    }

    /**
     * POST (Insert) data into the Employee table
     * @param $data - the new data to be updated
     * @return mixed
     * private $eid;
    private $first_name;
    private $last_name;
    private $email;
    private $position;
    private $company;
    private $country;
     */
    function post($data){
        // TODO

        $query = "INSERT INTO Employee Set first_name=:first_name, last_name=:last_name, email=:email, position=:position, company=:company, country=:country";

        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->first_name = trim(htmlspecialchars(strip_tags($this->first_name)));
        $this->last_name = trim(htmlspecialchars(strip_tags($this->last_name)));
        $this->email = trim(htmlspecialchars(strip_tags($this->email)));
        $this->position = trim(htmlspecialchars(strip_tags($this->position)));
        $this->company = trim(htmlspecialchars(strip_tags($this->company)));
        $this->country = trim(htmlspecialchars(strip_tags($this->country)));

        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":position", $this->position);
        $stmt->bindParam(":company", $this->company);
        $stmt->bindParam(":country", $this->country);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    /**
     * PUT (Update) existing record in the Employee table
     * @param $data - the data to be updated
     * @param $id - $id of the record to be updated
     * @return mixed
     */
    function put($data,$id){
        // TODO
        $query = "UPDATE Employee SET
                    fist_name = :first_name,
                    last_name = :last_name,
                    email = :email, 
                    position = :position,
                    company = :company,
                    country = :country
                    WHERE
                        eid = :eid";

        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->first_name = trim(htmlspecialchars(strip_tags($this->first_name)));
        $this->last_name = trim(htmlspecialchars(strip_tags($this->last_name)));
        $this->email = trim(htmlspecialchars(strip_tags($this->email)));
        $this->position = trim(htmlspecialchars(strip_tags($this->position)));
        $this->company = trim(htmlspecialchars(strip_tags($this->company)));
        $this->country = trim(htmlspecialchars(strip_tags($this->country)));
        $this->eid = trim(htmlspecialchars(strip_tags($this->eid)));

        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":position", $this->position);
        $stmt->bindParam(":company", $this->company);
        $stmt->bindParam(":country", $this->country);
        $stmt->bindParam(":eid", $this->eid);


    }

    /**
     * DELETE one or all records from the Employee table
     * @param $id - if $id is provided then Delete ONE else Delete ALL
     * @return mixed
     */
    function delete($id){
        // TODO
        $query = "DELETE FROM Employee WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->eid = htmlspecialchars(strip_tags($this->eid));

        // Bind ID to delete statement
        $stmt->bindParam(1, $this->eid);

        // Run Query
        if($stmt->execute()){
            return true;
        }

        return false;
    }


    //======= GETTERS and SETTERS =============
    /**
     * @return mixed
     */
    public function getEid()
    {
        return $this->eid;
    }

    /**
     * @param mixed $eid
     */
    public function setEid($eid): void
    {
        $this->eid = $eid;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name): void
    {
        $this->first_name = $first_name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position): void
    {
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company): void
    {
        $this->company = $company;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country): void
    {
        $this->country = $country;
    }

}