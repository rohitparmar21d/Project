<?php
class Helperland
{

    /* Creates database connection */
    public function __construct()
    {
        try {
            /* Properties */
            $dsn = 'mysql:dbname=helperland;host=localhost';
            $user = 'root';
            $password = '';
            $this->conn = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "";
            die();
        }
    }
    function ContactUs($table,$array){
        $sql_query = "INSERT INTO $table(Name, Email, Subject, PhoneNumber, Message, CreatedOn)
        VALUES (:Name, :Email, :Subject, :PhoneNumber, :Message, :CreatedOn)";
        $statement= $this->conn->prepare($sql_query);
        $statement->execute($array);
    }
}