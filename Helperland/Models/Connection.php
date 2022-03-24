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
        $sql_query = "INSERT INTO $table(FirstName,LastName,Email,Password,Mobile,UserTypeId,IsApproved,IsActive,CreatedDate)
        VALUES (:FirstName,:LastName,:Email,:Password,:Mobile,:UserTypeId,:IsApproved,:IsActive,:CreatedDate)";
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
        $sql = "SELECT * FROM user WHERE Email = '$email' AND Password = '$Password'";
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
        $sql = "SELECT * FROM useraddress WHERE  PostalCode = '$zipcode' AND  UserId ='$userid' AND IsDeleted=0 ";
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
    public function updatemydetails($array)
    {
        $sql_qry = "UPDATE user
                    SET FirstName = :FirstName, LastName = :LastName , Mobile = :Mobile, DateOfBirth = :DateOfBirth
                    WHERE UserId = :UserId ";
        $statement = $this->conn->prepare($sql_qry);
        $statement->execute($array);
    }
    function UserAdresses($userid)
    {
        $sql = "SELECT * FROM useraddress WHERE UserId ='$userid' AND IsDeleted=0 ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $row  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    function deleteaddressesinsettings($id)
    {
        $sql_query = "UPDATE useraddress SET IsDeleted =1 WHERE  AddressId = '$id'";
        $statement= $this->conn->prepare($sql_query);
        $statement->execute();  
    }
    function getAddressbyId($id)
    {
        $sql = "SELECT * FROM useraddress WHERE AddressId = '$id' ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $row  = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row; 
    }
    function editadd($array,$edittype)
    {
        if($edittype==0)
        {
            $sql_query = "INSERT INTO useraddress(UserId,AddressLine1, AddressLine2, City, PostalCode, Mobile)
            VALUES (:UserId,:AddressLine1, :AddressLine2, :City, :PostalCode, :Mobile)";
            $statement= $this->conn->prepare($sql_query);
            $statement->execute($array);
        }
        else
        {
            $sql_query = "UPDATE useraddress
                    SET AddressLine1 = :AddressLine1, AddressLine2 = :AddressLine2 , City = :City, PostalCode = :PostalCode, Mobile = :Mobile
                    WHERE AddressId = :AddressId ";
            $statement = $this->conn->prepare($sql_query);
            $statement->execute($array);
        }
        
    }
    function newservicesrequests($id,$zip,$pet)
    {
        if($pet==1)
        {
            $sql = "SELECT * FROM servicerequest WHERE HasPets=1 AND SPAcceptedDate IS NULL AND ZipCode='$zip' AND Status=1  AND (ServiceProviderId IS NULL OR ServiceProviderId='$id') ";
            $stmt =  $this->conn->prepare($sql);
            $stmt->execute();
            $row  = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $row; 
        }
        else
        {
            $sql = "SELECT * FROM servicerequest WHERE SPAcceptedDate IS NULL AND ZipCode='$zip' AND Status=1  AND (ServiceProviderId IS NULL OR ServiceProviderId='$id') ";
            $stmt =  $this->conn->prepare($sql);
            $stmt->execute();
            $row  = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $row; 
        } 
    }
    function upcoming($id)
    {
        $sql = "SELECT * FROM servicerequest WHERE SPAcceptedDate IS NOT NULL AND  Status=1 AND  ServiceProviderId='$id' ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $row  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    function acceptrequest($array)
    {
        $sql_query = "UPDATE servicerequest
                    SET ServiceProviderId = :ServiceProviderId, SPAcceptedDate = :SPAcceptedDate 
                    WHERE ServiceRequestId = :ServiceRequestId ";
        $statement = $this->conn->prepare($sql_query);
        $statement->execute($array);
    }
    function getSPScheduledetail($id)
    {
        $sql = "SELECT * FROM servicerequest WHERE ServiceProviderId='$id' ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $row  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    function cancelrequest($id)
    {
        $sql_query = "UPDATE servicerequest
                      SET ServiceProviderId=NULL, SPAcceptedDate=NULL
                      WHERE ServiceRequestId = '$id' ";
        $statement = $this->conn->prepare($sql_query);
        $statement->execute();  
    }
    function completerequest($id)
    {
        $sql_query = "UPDATE servicerequest
                      SET Status=2
                      WHERE ServiceRequestId = '$id' ";
        $statement = $this->conn->prepare($sql_query);
        $statement->execute();
    }
    function sphistory($id)
    {
        $sql = "SELECT * FROM servicerequest WHERE ServiceProviderId = '$id' AND Status=2";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $row  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row; 
    }
    public function fill_selected_pending_request($selectedrequestid)
    {
        $sql_qry = "SELECT * FROM servicerequest WHERE ServiceRequestId = $selectedrequestid";
        $statement = $this->conn->prepare($sql_qry);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    public function get_requests_for_that_date( $serviceproviderid, $date, $nextdate)
    {
        $sql_qry = "SELECT * FROM servicerequest 
                    WHERE ServiceProviderId = '$serviceproviderid' AND SPAcceptedDate IS NOT NULL  AND Status = 1 AND ServiceStartDate BETWEEN '$date' AND '$nextdate'";
        $statement = $this->conn->prepare($sql_qry);
        $statement->execute();
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    public function blockcard($serviceproviderid)
    {
        $sql_qry = "SELECT DISTINCT UserId FROM servicerequest WHERE ServiceProviderId = $serviceproviderid AND Status = 2";
        $statement = $this->conn->prepare($sql_qry);
        $statement->execute();
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    public function checkblocked($selectedcustomerid,$serviceproviderid)
    {
        $sql_qry = "SELECT * FROM favoriteandblocked WHERE UserId = $serviceproviderid AND TargetUserId = $selectedcustomerid";
        $statement = $this->conn->prepare($sql_qry);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    public function blockcustomer($selectedcustomerid, $serviceproviderid)
    {
        $sql_qry = "INSERT INTO favoriteandblocked(UserId, TargetUserId, IsBlocked)
                    VALUES ($serviceproviderid, $selectedcustomerid, 1)";
        $statement= $this->conn->prepare($sql_qry);
        $statement->execute();
    }

    public function unblockcustomer($selectedcustomerid, $serviceproviderid)
    {
        $sql_qry = "DELETE FROM favoriteandblocked WHERE UserId = $serviceproviderid AND TargetUserId = $selectedcustomerid AND IsBlocked = 1";
        $statement= $this->conn->prepare($sql_qry);
        $statement->execute();
    }
    function UserAddress($userid)
    {
        $sql = "SELECT * FROM useraddress WHERE UserId ='$userid' AND IsDeleted=0 ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $row  = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    public function update_sp_details($table, $userid, $array)
    {
        $sql_qry = "UPDATE $table
                    SET FirstName = :spfname, LastName = :splname , Mobile = :spmobile, DateOfBirth = :spdob, LanguageId = :splanguage, NationalityId = :spnationality, Gender = :spgender, UserProfilePicture = :selectedavatar
                    WHERE UserId = $userid";
        $statement = $this->conn->prepare($sql_qry);
        $statement->execute($array);
    }

    function insert_update_spaddress($table, $array2, $edit)
    {
        if($edit == 0)
        {
            $sql_query = "INSERT INTO $table (UserId, AddressLine1, AddressLine2, City, PostalCode, Mobile, Email)
                        VALUES (:UserId, :AddressLine1, :AddressLine2, :City, :PostalCode, :Mobile, :Email)";
            $statement= $this->conn->prepare($sql_query);
            $statement->execute($array2);
        }
        else
        {
            $sql_query = "UPDATE $table
                        SET AddressLine1 = :AddressLine1, AddressLine2 = :AddressLine2 , City = :City, PostalCode = :PostalCode
                        WHERE AddressId = :AddressId";
            $statement = $this->conn->prepare($sql_query);
            $statement->execute($array2);
        }
    }
    function getallservicerequest()
    {
        $sql = "SELECT * FROM servicerequest ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $row  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    function usermanagement()
    {
        $sql = " SELECT * FROM user WHERE NOT UserTypeId=3 ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $row  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    function activeuser($id)
    {
        $sql_query = "UPDATE user SET IsActive =1 WHERE  UserId = '$id'";
        $statement= $this->conn->prepare($sql_query);
        $statement->execute();  
    }
    function deactiveuser($id)
    {
        $sql_query = "UPDATE user SET IsActive =0 WHERE  UserId = '$id'";
        $statement= $this->conn->prepare($sql_query);
        $statement->execute();  
    }
    function approvesp($id)
    {
        $sql_query = "UPDATE user SET IsActive =1 , IsApproved=1 WHERE  UserId = '$id'";
        $statement= $this->conn->prepare($sql_query);
        $statement->execute();  
    }
    function cancelfromadmin($reqid)
    {
        $sql_query = "UPDATE servicerequest SET Status =3 WHERE  ServiceRequestId = '$reqid'";
        $statement= $this->conn->prepare($sql_query);
        $statement->execute();  
    }
    public function export_service_history($userid)
    {
        $sql_qry = "SELECT servicerequest.ServiceRequestId, CONCAT(user.FirstName, ' ', user.LastName) AS ServiceProvider, servicerequest.ServiceStartDate, servicerequest.ServiceHourlyRate, servicerequest.ServiceHours, servicerequest.ExtraHours, servicerequest.HasPets, servicerequest.SubTotal, servicerequest.Discount, servicerequest.TotalCost, servicerequest.Status 
                    FROM servicerequest INNER JOIN user ON user.UserId = servicerequest.ServiceProviderId WHERE servicerequest.Status IN (2,3) AND servicerequest.UserId = $userid";
        $statement = $this->conn->prepare($sql_qry);
        $statement->execute();
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    function users()
    {
        $sql = " SELECT UserId, CONCAT(FirstName, ' ',LastName) AS User,Email,Mobile,UserTypeId,Gender,DateOfBirth,ZipCode,CreatedDate,IsApproved,IsActive,IsDeleted FROM user WHERE NOT UserTypeId=3 ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $row  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    public function export_service_history_sp($userid)
    {
        $sql_qry = "SELECT servicerequest.ServiceRequestId, CONCAT(user.FirstName, ' ', user.LastName) AS Customer, servicerequest.ServiceStartDate,  CONCAT(useraddress.AddressLine1,' ',useraddress.AddressLine2,' ',useraddress.City,' ',useraddress.PostalCode) AS Addresses
                    FROM servicerequest INNER JOIN user ON user.UserId = servicerequest.UserId INNER JOIN servicerequestaddress on servicerequestaddress.ServiceRequestId=servicerequest.ServiceRequestId INNER JOIN useraddress ON useraddress.AddressId=servicerequestaddress.AddressId  WHERE servicerequest.Status=2 AND servicerequest.ServiceProviderId = $userid";
        $statement = $this->conn->prepare($sql_qry);
        $statement->execute();
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
}
?>