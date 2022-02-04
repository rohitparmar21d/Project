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
    
    function Signup($table,$array){
        $sql_query = "INSERT INTO $table(FirstName,LastName,Email,Password,Mobile,UserTypeId)
        VALUES (:FirstName,:LastName,:Email,:Password,:Mobile,:UserTypeId)";
        $statement= $this->conn->prepare($sql_query);
        $statement->execute($array);
    }

    function CheckEmail($table ,$email)
    {
        $Check_Query = "SELECT * FROM $table WHERE Email='$email'";
        $statement= $this->conn->prepare($Check_Query);
        $statement->execute();
        $number_of_rows = $statement->fetchColumn(); 
        return $number_of_rows;
    }

    function CheckMobile($table ,$mobile)
    {
        $Check_Query = "SELECT * FROM $table WHERE  Mobile = '$mobile'";
        $statement= $this->conn->prepare($Check_Query);
        $statement->execute();
        $number_of_rows = $statement->fetchColumn(); 
        return $number_of_rows;
    }
    function resetpass($table ,$email,$Password)
    {
        $sql_query = "UPDATE $table SET Password ='$Password' WHERE  Email = '$email'";
        $statement= $this->conn->prepare($sql_query);
        $statement->execute();
       
    }
    function userData($email,$Password)
    {
        $sql = "SELECT * FROM user WHERE Email = '$email' AND Password = '$Password' ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $row  = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row; 
    }

}