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
    function checkavail($zipcode)
    {
        $sql = "SELECT * FROM zipcode WHERE  ZipcodeValue = '$zipcode'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $number_of_rows = $stmt->fetchColumn();
        return $number_of_rows;

    }
    function addresslist($zipcode,$userid)
    {
        $sql = "SELECT * FROM useraddress WHERE  PostalCode = '$zipcode' AND  UserId ='$userid' ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $row  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    function insert_address($array){
        $sql_query = "INSERT INTO useraddress(UserId, AddressLine1, AddressLine2, City, PostalCode, Mobile)
        VALUES (:UserId, :AddressLine1, :AddressLine2, :City, :PostalCode, :Mobile)";
        $statement= $this->conn->prepare($sql_query);
        $statement->execute($array);
    }

    function add_service_request($array)
    {
        $sql_query = "INSERT INTO servicerequest(UserId, ServiceStartDate,ZipCode, ServiceHours,ExtraHours, SubTotal,TotalCost, Comments,HasPets,CreatedDate)
        VALUES (:UserId, :ServiceStartDate, :ZipCode, :ServiceHours, :ExtraHours, :SubTotal,:TotalCost,:Comments,:HasPets,:CreatedDate)";
        $statement= $this->conn->prepare($sql_query);
        $statement->execute($array);
        $reqId = $this->conn->lastInsertId();
        return $reqId;

    }
    function add_service_request_address($Add)
    {
        $sql_query = "INSERT INTO servicerequestaddress(ServiceRequestId, AddressId)
        VALUES (:reqid,:addid)";
        $statement= $this->conn->prepare($sql_query);
        $statement->execute($Add);
    }
    function add_extraservice($Add)
    {
        $sql_query = "INSERT INTO servicerequestextra(ServiceRequestId, ServiceExtraId)
        VALUES (:reqid,:selectextraserviceid)";
        $statement= $this->conn->prepare($sql_query);
        $statement->execute($Add);
    }
    function getSPById($zip)
    {
        $sql = "SELECT * FROM user WHERE UserTypeId = 2 AND ZipCode = '$zip' ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $row  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row; 
    }
    function service_history($userid)
    {
        $sql = "SELECT * FROM servicerequest WHERE UserId = '$userid' AND NOT Status=1 ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $row  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row; 
    }
    function getUserbyId($id)
    {
        $sql = "SELECT * FROM user WHERE UserId = '$id' ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $row  = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row; 
    }
    function rate($id)
    {
        $sql = "SELECT * FROM rating WHERE RatingTo = '$id' ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $row  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row; 
    }
    function rateByreqId($id)
    {
        $sql = "SELECT * FROM rating WHERE ServiceRequestId = '$id' ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $row  = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row; 
    }

    function dboard($userid)
    {
        $sql = "SELECT * FROM servicerequest WHERE UserId = '$userid' AND  Status=1 ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $row  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;  
    }
    function SRByreqId($id)
    {
        $sql = "SELECT * FROM servicerequest WHERE ServiceRequestId = '$id' ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $row  = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row; 
    }
    function reschedule($datetime,$reqid)
    {
        $sql_query = "UPDATE servicerequest SET ServiceStartDate ='$datetime' WHERE  ServiceRequestId = '$reqid'";
        $statement= $this->conn->prepare($sql_query);
        $statement->execute();
       
    }

    function cancel($comment,$reqid)
    {
        $sql_query = "UPDATE servicerequest SET Status =3,  Comments='$comment' WHERE  ServiceRequestId = '$reqid'";
        $statement= $this->conn->prepare($sql_query);
        $statement->execute();  
    }
    function getSRAddbySRId($id)
    {
        $sql = "SELECT * FROM servicerequestaddress WHERE ServiceRequestId = '$id' ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $row  = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row; 
    }
    function getUserAddbyAddId($id)
    {
        $sql = "SELECT * FROM useraddress WHERE AddressId = '$id' ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $row  = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row; 
    }
    function getextrabySRId($rqid)
    {
        $sql = "SELECT * FROM servicerequestextra WHERE ServiceRequestId = '$rqid' ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $row  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row; 
    }
    function getextrasbyextraId($id)
    {
        $sql = "SELECT * FROM extraservices WHERE ServiceExtraId = '$id' ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $row  = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row; 
    }
    function israted($id)
    {
        $sql = "SELECT * FROM rating WHERE  ServiceRequestId = '$id'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $number_of_rows = $stmt->fetchColumn();
        return $number_of_rows;

    }
    function submitrate($a,$israted)
    {
        if($israted==0)
        {
            $sql_query = "INSERT INTO rating(ServiceRequestId, RatingFrom,RatingTo,Ratings,Comments,RatingDate,OnTimeArrival,Friendly,QualityOfService)
            VALUES (:ServiceRequestId,:RatingFrom,:RatingTo,:Ratings,:Comments,:RatingDate,:OnTimeArrival,:Friendly,:QualityOfService)";
            $statement= $this->conn->prepare($sql_query);
            $statement->execute($a);
        }
        else
        {
            $sql_query = "UPDATE rating SET RatingFrom='".$a['RatingFrom']."' , RatingTo='".$a['RatingTo']."' , Ratings='".$a['Ratings']."' , Comments='".$a['Comments']."' , RatingDate='".$a['RatingDate']."' , OnTimeArrival='".$a['OnTimeArrival']."' , Friendly='".$a['Friendly']."' , QualityOfService='".$a['QualityOfService']."'  WHERE  ServiceRequestId = '".$a['ServiceRequestId']."' ";
            $statement= $this->conn->prepare($sql_query);
            $statement->execute();
        }
        
    }
    public function check_password($email, $oldpassword)
    {
        $sql_qry = "SELECT * FROM user where Email = '$email' AND Password = '$oldpassword'";
        $statement = $this->conn->prepare($sql_qry);
        $statement->execute();
        $count = $statement->rowCount();
        return $count;
    }

    public function update_password($email, $newpassword)
    {
        $sql_qry = "UPDATE user
                    SET Password = '$newpassword'
                    WHERE Email = '$email'";
        $statement = $this->conn->prepare($sql_qry);
        $statement->execute();
    }
}
?>