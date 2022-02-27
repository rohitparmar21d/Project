<?php
class HelperlandController
{
    function __construct()
    {
        include('Models/Connection.php');
        $this->model = new Helperland();
        session_start();
        
    }
    public function HomePage()
    {
        include("./Views/homepage.php");
    }
    public function ContactUs()
    {
        if (isset($_POST)){
            $base_url = 'http://localhost/Helperland/Contact';
            $FirstName =  $_POST['FirstName'];
            $LastName =  $_POST['LastName'];
            $array = [
                'Name' => $FirstName . " " . $LastName,
                'Email' => $_POST['Email'],
                'Subject' => $_POST['Subject'],
                'PhoneNumber' => $_POST['PhoneNumber'],
                'Message' => $_POST['Message'],
                'CreatedOn' => date('Y-m-d H:i:s')
            ];
            $this->model->ContactUs('contactus', $array);
            header('Location: ' . $base_url);
        }
        else{
            echo 'Error Occurring in Data';
        }
    }

    public function cSignup()
    {
        if (isset($_POST))
        {    
            if(($_POST['Password']) != ($_POST['confirmPassword']))
            {
                $_SESSION['message'] = "Password and Confirm Password should be same";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }

           $check_email_duplicate_count =   $this->model->CheckEmail('user',$_POST['Email']);
           $check_mobile_duplicate_count =   $this->model->CheckMobile('user',$_POST['Mobile']);

            if($check_email_duplicate_count > 0)
            {
                $_SESSION['message'] = "Email Aleady taken";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }

            if($check_mobile_duplicate_count > 0)
            {
                $_SESSION['message'] = "Mobile Number Aleady taken";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }
            $base_url = "http://localhost/Helperland/#LoginModal'";
            $array = [
                'FirstName' => $_POST['FirstName'],
                'LastName'=>$_POST['LastName'],
                'Email' => $_POST['Email'],
                'Password' =>$_POST['Password'],
                'Mobile' => $_POST['Mobile'],
                'UserTypeId' => 1,
            ];
            $this->model->Signup('user', $array);
            unset($_SESSION['message']);  
            header('Location: ' . $base_url);
        }
    }
    public function spSignup()
    {
        if (isset($_POST))
        {    
            if(($_POST['Password']) != ($_POST['confirmPassword']))
            {
                $_SESSION['message1'] = "Password and Confirm Password should be same";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
                
            }

           $check_email_duplicate_count =   $this->model->CheckEmail('user',$_POST['Email']);
           $check_mobile_duplicate_count =   $this->model->CheckMobile('user',$_POST['Mobile']);

            if($check_email_duplicate_count > 0)
            {
                $_SESSION['message1'] = "Email Aleady taken";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }

            if($check_mobile_duplicate_count > 0)
            {
                $_SESSION['message1'] = "Mobile Number Aleady taken";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }

            


            $base_url = "http://localhost/Helperland/#LoginModal'";
            $array = [
                'FirstName' => $_POST['FirstName'],
                'LastName'=>$_POST['LastName'],
                'Email' => $_POST['Email'],
                'Password' =>$_POST['Password'],
                'Mobile' => $_POST['Mobile'],
                'UserTypeId' => 2,
            ];
            $this->model->Signup('user', $array);
            unset($_SESSION['message1']);  
            header('Location: ' . $base_url);
        }
    }
    public function ForgotPassword()
    {
        if (isset($_POST))
        {
            $is_registerd_mail=   $this->model->CheckEmail('user',$_POST['forgotemail']);
            if($is_registerd_mail!=0)
            {
                $to_email = $_POST['forgotemail'];
                $subject = "RESET PASSWORD";
                $body = "click the link t0 reset password <br> http://localhost/Helperland/resetpassword.php";
                $headers = "From: rohit1parmar11@gmail.com";
                $_SESSION['regmail']=$_POST['forgotemail'];
                
                if (mail($to_email, $subject, $body, $headers)) {
                    $_SESSION['sentstatus'] = "1";
                } else {
                    $_SESSION['sentstatus'] = "2";
                }

                $base_url = "http://localhost/Helperland";
                header('Location: ' . $base_url);
               
            }
            else
            {
                $_SESSION['forgotmail'] = "Enter registerd mail";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }
            
            
        }  
        
    }

    public function resetpass()
    {
        if (isset($_POST))
        {    
            if(($_POST['Password']) == ($_POST['confirmPassword']))
            {
                $new_password=$_POST['Password'];
                $email= $_SESSION['regmail'];
                $this->model->resetpass('user', $email,$new_password);
                unset($_SESSION['regmail']);
                $base_url = "http://localhost/Helperland";
                header('Location: ' . $base_url);
            } 
            else
            {
                $_SESSION['reset']="Password and Confirm Password should be same";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }
           
        }
        
    }
    public function Login()
    {
        if (isset($_POST))
        {
            $customer = "http://localhost/Helperland/service_history";
            $sp = "http://localhost/Helperland/upcoming_service";
            if(($_POST['Email'] == "") || ($_POST['Password'] == "")){
                
                $base_url ="http://localhost/Helperland/#LoginModal'";
                header('Location:' . $base_url);
                
            } else{
                $email = $_POST['Email'];
                $Password = $_POST['Password'];
                $row = $this->model->userData($email,$Password);
                if($row == NULL)
                {
                    $_SESSION['login_wrong']="1";
                    $base_url ="http://localhost/Helperland/#LoginModal";
                    header('Location:' . $base_url);
                }
                else
                {
                    $usertypeid = $row['UserTypeId'];
                    $_SESSION['UserId'] = $row['UserId'];
                    $_SESSION['name'] = $row['FirstName'];
                    $_SESSION['loggedin'] = $usertypeid;
                    if($usertypeid == 1){
                    
                    header('Location:' . $customer);
                    }
                    if($usertypeid == 2){
                    
                    header('Location:' . $sp);
                    }
                    else{
                    echo "Admin";
                    }
                }
                
            }
        }
    }
    public function gotobookservicepage()
    {
        if(isset($_SESSION['loggedin']))
        {
            if($_SESSION['loggedin'] == 1)
            {
                $base_url ="http://localhost/Helperland/bookservice";
                header('Location:' . $base_url);
            }
            else
            {
                $_SESSION['login_alert']="0";
                $base_url ="http://localhost/Helperland/#LoginModal";
                header('Location:' . $base_url);
            }
        }
        else
        {
            $_SESSION['login_alert']="1";
            $base_url ="http://localhost/Helperland/#LoginModal";
            header('Location:' . $base_url);
        }
    }
    public function logout()
    {
        $base_url = "http://localhost/Helperland/";
        session_unset();
        session_destroy();
        header('Location:' . $base_url);

    }
    public function checkavail()
    {
       $zipcode =$_POST['zipcode'];
       $avail = $this->model->checkavail($zipcode);
       if($avail != 0)
       {
           echo 1;
       }
       else
       {
           echo 0;
       }
    }
    public function add_addresses()
    {
        $zipcode =$_POST['zipcode'];
        $userid = $_SESSION['UserId'];
        $list = $this->model->addresslist($zipcode,$userid);
         $i=0;
        foreach($list as $address)
        {
            ?>
            <label class="area-label">
                <input type="radio" class="area-radio" id="age<?php echo $i?>" name="age" value="<?php echo $address['AddressId'] ?>" >
                <span><b>Address:</b></span><?php echo " ".$address['AddressLine1']."  ".$address['AddressLine2'].", ".$address['City']."  ".$address['State']." - ".$address['PostalCode']." ";  ?><br>
                <span><b>Telephone number:</b></span><?php echo " ".$address['Mobile']." "; ?>
                </label>
        <?php
        $i++; }

    }
    public function insert_address()
    {
        
            $array = [
                'UserId' => $_SESSION['UserId'],
                'AddressLine1'=>$_POST['housenumber'],
                'AddressLine2' => $_POST['streetname'],
                'City' =>$_POST['city'],
                'PostalCode' => $_POST['postalcode'],
                'Mobile' => $_POST['phonenumber']
            ];
            $this->model->insert_address($array);

    
    }
    public function add_service_request()
    {
    
            $array = [
                'UserId' => $_SESSION['UserId'],
                'ServiceStartDate'=>$_POST['servicedatetime'],
                'ZipCode' => $_POST['postalcode'],
                'ServiceHours' =>$_POST['servicehours'],
                'ExtraHours' => $_POST['extraservicehours'],
                'SubTotal' => $_POST['subtotal'],
                'TotalCost' => $_POST['totalpayment'],
                'Comments' => $_POST['comments'],
                'HasPets'=>$_POST['haspet'],
                'CreatedDate' =>date('Y-m-d H:i:s')
            ];
        
            $reqid = $this->model->add_service_request($array);
            $seladdid =$_POST['seladdid'];
            $reqAdd = [
                'reqid' =>$reqid,
                'addid' => $seladdid,
            ];
            $this->model->add_service_request_address($reqAdd);
            $SPList=$this->model->getSPById($_POST['postalcode']);

            foreach($SPList as $SPs)
            {
                $to_email = $SPs['Email'];
                $subject = "NEW SERVICE REQUEST";
                $body = "we got new service request for you, accept if you are available";
                $headers = "From: rohit1parmar11@gmail.com";
                mail($to_email, $subject, $body, $headers);
            }

            

    
    }


}
?>