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
                'IsApproved' => 1,
                'IsActive' =>1,
                'CreatedDate' =>date('Y-m-d H:i:s')
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
                'IsApproved' => 0,
                'IsActive' => 0,
                'CreatedDate' =>date('Y-m-d H:i:s')
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
            $customer = "http://localhost/Helperland/Customer";
            $sp = "http://localhost/Helperland/SP";
            $admin="http://localhost/Helperland/Admin";
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
                    if($row['IsApproved']==1)
                    {
                        if($row['IsActive']==1)
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
                            if($usertypeid == 3){
                             header('Location:' . $admin);
                            }
                        }
                        else
                        {
                            $_SESSION['login_wrong']="3";
                            $base_url ="http://localhost/Helperland";
                            header('Location:' . $base_url);

                        }
                        
                    }
                    else
                    {
                        $_SESSION['login_wrong']="2";
                        $base_url ="http://localhost/Helperland";
                        header('Location:' . $base_url);
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
    
        $servicetimedate =$_POST['date']." ".$_POST['time'];
        $selectextraserviceid=$_POST['extraserv'];
            $array = [
                'UserId' => $_SESSION['UserId'],
                'ServiceStartDate'=>$servicetimedate,
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

            if($selectextraserviceid != null)
            {
                for($i=0; $i<sizeof($selectextraserviceid) ; $i++)
                {
                    $array2 = [
                          'reqid' => $reqid,
                         'selectextraserviceid' => $selectextraserviceid[$i]
                     ];
                    $this->model->add_extraservice($array2);
                }
            }
            if($_POST['selsp']!= NULL)
            {
                $SP=$this->model->getUserbyId($_POST['selsp']);
                    
                $to_email = $SP['Email'];
                $subject = "NEW SERVICE REQUEST";
                $body = "we got new service request for you, accept if you are available";
                $headers = "From: rohit1parmar11@gmail.com";
                mail($to_email, $subject, $body, $headers);
            }
            else
            {
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
    public function service_history()
    {
        $list=$this->model->service_history($_SESSION['UserId']);
        function HourMinuteToDecimal($hour_minute) {
            $t = explode(':', $hour_minute);
            return $t[0] * 60 + $t[1];
        }
        function DecimalToHoursMins($mins)
        {
            $h=(int)($mins/60);
            $m=round($mins%60);
            if($h<10){$h="0".$h;}
            if($m<10){$m="0".$m;}
            return $h.":".$m;
        }
        ?>
            <table id="history" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ServiceId</th>
                                            <th>Service Details </th>
                                            <th id="sd">Service Provider</th>
                                            <th id="cd">Payment</th>
                                            <th >Status</th>
                                            <th>Rate SP</th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
            <?php
        if($list != NULL)
        {
                foreach($list as $history)
           {
            $SP = $this->model->getUserbyId($history['ServiceProviderId']);
            $dt=substr($history['ServiceStartDate'],0,10);
            $tm=substr($history['ServiceStartDate'],11,5);
            $totalmins=HourMinuteToDecimal($tm)+ (($history['ServiceHours']+$history['ExtraHours'])*60);
            $totime=DecimalToHoursMins($totalmins);
            $rates=$this->model->rateByreqId($history['ServiceRequestId']);
            if($rates == NULL)
            {
                $rates['Ratings']=0;
            }    
             ?>
            <tr class="t-row" >
                <td><p><?php echo $history['ServiceRequestId']; ?></p></td>
                <td>
                    <p class="date"><img src="./assets/Image/calendar.png"> <?php echo $dt; ?></p>
                    <p><?php echo $tm."-".$totime ?></p>
                </td>
                <td> 
                    <div class="a flex-wrap row"> 
                        <?php
                        if(isset($SP['FirstName']))
                        {
                        ?>
                            <div class=""><img src="./assets/Image/forma-1-copy-19.png"></div>
                            <div>
                                <p class="lum-watson"><?php if(isset($SP['FirstName'])){echo $SP['FirstName'];} ?> </p>
                                <div class="row">
                                    <div class="rateyo" id= "rating"  data-rateyo-rating=" <?php echo $rates['Ratings']; ?>"></div>
                                    <div><?php echo $rates['Ratings']; ?></div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </td>
                <td>
                    <p class="euro d-flex justify-content-center">&euro; <?php echo $history['TotalCost']; ?></p>
                </td>
                <td><?php 
                if(isset($history['Status']))
                {
                    if($history['Status']==2)
                    {?>
                        <div class="status-completed text-center" >Completed</div> <?php
                    }
                    else
                    {?>
                        <div class="status-cancelled text-center" >Cancelled</div>
                    <?php

                    }
                }
                ?>
                </td>
                <td><button type="button" id="<?php echo $history['ServiceRequestId']; ?>"  class="btn rate-sp" data-toggle="modal" data-target="#ratesp_modal" <?php if($history['Status']==3){ echo "disabled";} ?> >Rate SP</button></td>
            </tr>
            
            <?php
             
           }
        }
        else
        { ?>
          <div class="text-center"><h4>No history Found</h4></div>
        <?php
        }
        ?>
          </tbody>
                                </table>
        <?php
        
    }
    public function dboard()
    {
        $list=$this->model->dboard($_SESSION['UserId']);
        function HourMinuteToDecimal($hour_minute) {
            $t = explode(':', $hour_minute);
            return $t[0] * 60 + $t[1];
        }
        function DecimalToHoursMins($mins)
        {
            $h=(int)($mins/60);
            $m=round($mins%60);
            if($h<10){$h="0".$h;}
            if($m<10){$m="0".$m;}
            return $h.":".$m;
        }
        if($list != NULL)
        {  ?>
         <table  class="table table-hover" id="dboard">
                                    <thead>
                                        <tr>
                                            <th>Service Id </th>
                                            <th >Service Date </th>
                                            <th >Sevice Provider </th>
                                            <th >Payment</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="">

        <?php
            
            foreach($list as $history)
            {
                $SP = $this->model->getUserbyId($history['ServiceProviderId']);
                $dt=substr($history['ServiceStartDate'],0,10);
                 $tm=substr($history['ServiceStartDate'],11,5);
                $totalmins=HourMinuteToDecimal($tm)+ (($history['ServiceHours']+$history['ExtraHours'])*60);
                $totime=DecimalToHoursMins($totalmins);
                $rates=$this->model->rate($history['ServiceProviderId']);
                $j=0;
                $totalrate=0;
                if($rates==NULL)
                {
                    $avrrate=0;
                }
                else
                {
                    foreach($rates as $rate)
                    {
                        $totalrate+=$rate['Ratings'];
                        $j++;
                    }
                    if($j == 0)
                    {
                        $avrrate=$totalrate;
                    }
                    else
                    {
                        $avrrate=$totalrate/$j;
                    }
                }
                ?>
                    <tr class="t-row" id="<?php echo $history['ServiceRequestId']; ?>">
                        <td class="td" id="<?php echo $history['ServiceRequestId']; ?>"><p><?php echo $history['ServiceRequestId']; ?></p></td>
                        <td class="td" id="<?php echo $history['ServiceRequestId']; ?>">
                            <p class="date"><img src="./assets/Image/calendar.png"> <?php echo $dt; ?></p>
                            <p><?php echo $tm."-".$totime ?></p>
                        </td>
                        <td class="td"  id="<?php echo $history['ServiceRequestId']; ?>"> 
                            <div class="a flex-wrap row"> 
                                <?php
                                if(isset($SP['FirstName']))
                                {
                                   ?>
                                    <div class=""><img src="./assets/Image/forma-1-copy-19.png"></div>
                                    <div>
                                        <p class="lum-watson"><?php if(isset($SP['FirstName'])){echo $SP['FirstName'];} ?> </p>
                                        <div class="row">
                                            <div class="rateyo" id= "rating"  data-rateyo-rating=" <?php echo $avrrate; ?>"></div>
                                            <div><?php echo round($avrrate,1); ?></div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </td>
                        <td class="td" id="<?php echo $history['ServiceRequestId']; ?>"><p class="euro d-flex justify-content-center">&euro; <?php echo $history['TotalCost']; ?></p></td>
                        <td id="<?php echo $history['ServiceRequestId']; ?>">
                            <button type="button" id="<?php echo $history['ServiceRequestId']; ?>" class="btn reschedule" data-toggle="modal" data-target="#reschedule_modal">Reschedule</button>
                            <button type="button" class="btn cancel"  id="<?php echo $history['ServiceRequestId']; ?>" data-toggle="modal" data-target="#cancel_bookingrequest_modal">Cancel</button>
                        </td>
                    </tr>
                <?php
            }
           ?>
           </tbody>
                                </table>
           <?php
        }
        else
        { ?>
          <div class="text-center"><h4>No history Found</h4></div>
        <?php
        }



    }
    public function rate_sp() 
    { 
         $SR=$this->model->SRByreqId($_POST['reqId']);
         $rt=$this->model->rateByreqId($_POST['reqId']);
         $SP=$this->model->getUserbyId($SR['ServiceProviderId']);
         $rates=$this->model->rate($SR['ServiceProviderId']);
         $j=0;
         $totalrate=0;
         if($rates==NULL)
         {
             $avrrate=0;
         }
         else
         {
             foreach($rates as $rate)
             {
                 $totalrate+=$rate['Ratings'];
                 $j++;
             }
             if($j == 0)
             {
                 $avrrate=$totalrate;
             }
             else
             {
                 $avrrate=$totalrate/$j;
             }
         }
        ?>
    
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLongTitle">
                <div class="d-flex align-items-center justify-content-left">
                    <div><img class="round-border" src="./assets/Image/forma-1-copy-19.png" alt="cap"></div>
                    <div class="ps-2">
                        <p class="sp-details"><?php echo $SP['FirstName']." ".$SP['LastName']; ?></p>
                        <p class="sp-details">
                            <div class="row">
                                <div class="rateyo rate_modal_head" id= "rating"  data-rateyo-rating=" <?php echo $avrrate; ?>"></div>
                                <span class="sp-details"><?php echo round($avrrate,1); ?></span>
                            </div>    
                        </p>
                    </div>
                </div>
            </h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="register-inputs me-0 ms-0">
                <label class="rate-service-text">Rate your service provider</label>
                <div class="row">
                    <div class="col-sm-5">
                        <label class="subtext">On time arrival</label>
                    </div>
                    <div class="col-sm-7">
                        <div class="rateyo on_time_arrrival r1" id= ""  data-rateyo-rating="<?php if($rt!=NULL){ echo $rt['OnTimeArrival']; } else{ echo 0; } ?>"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <label class="subtext">Friendly</label>
                    </div>
                    <div class="col-sm-7">
                        <div class="rateyo friendly r1" id= ""  data-rateyo-rating="<?php if($rt!=NULL){ echo $rt['Friendly']; } else{ echo 0; } ?>"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <label class="subtext">Quality of service</label>
                    </div>
                    <div class="col-sm-7">
                        <div class="rateyo quality r1" id= ""  data-rateyo-rating="<?php if($rt!=NULL){ echo $rt['QualityOfService']; } else{ echo 0; } ?>"></div>
                    </div>
                </div>
                <div class="row">
                    <label class="subtext">Feedback on service provider</label>
                </div>
                <div class="row me-0 ms-0">
                    <textarea class="rate-feedback" name="feedback"></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer rateft">
            <button name="submit" id="<?php echo $_POST['reqId'] ?>" class="btn btn-ratesp-submit">Submit</button>
        </div> 
        <?php 
    }
    public function reschedule()
    {
       $datetime=$_POST['rescheduledate']." ".$_POST['rescheduletime'];
       $this->model->reschedule($datetime,$_POST['reqId']);
       
    }
    public function cancel()
    {
        $this->model->cancel($_POST['comment'],$_POST['reqId']);
      
    }
    public function SDmodal()
    {
        $SR=$this->model->SRByreqId($_POST['requId']);
        $SP= $this->model->getUserbyId($SR['ServiceProviderId']);
        $SRAddress=$this->model->getSRAddbySRId($_POST['requId']);
        $customerAdd=$this->model->getUserAddbyAddId($SRAddress['AddressId']);
        $extras=$this->model->getextrabySRId($_POST['requId']);
        
        function HourMinuteToDecimal($hour_minute) 
        {
            $t = explode(':', $hour_minute);
            return $t[0] * 60 + $t[1];
        }
        function DecimalToHoursMins($mins)
        {
            $h=(int)($mins/60);
            $m=round($mins%60);
            if($h<10){$h="0".$h;}
            if($m<10){$m="0".$m;}
            return $h.":".$m;
        }
        $dt=substr($SR['ServiceStartDate'],0,10);
        $tm=substr($SR['ServiceStartDate'],11,5);
        $totalmins=HourMinuteToDecimal($tm)+ (($SR['ServiceHours']+$SR['ExtraHours'])*60);
        $totime=DecimalToHoursMins($totalmins);
        ?>
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Service Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body ">
            <div class="register-inputs mod me-0 ms-0">
                <div class="row">
                    <div><span class="service-datetime"><?php echo $dt." ".$tm."-".$totime ?></span></div>
                </div>
                <div class="row">
                    <div><span class="service-detail">Duration: </span></div>
                    <div class="service-detail-text"><span><?php echo $SR['ServiceHours']+$SR['ExtraHours']." Hrs"; ?></span></div>
                </div>
                <hr>
                <div class="row">
                    <div><span class="service-detail">Service Id: </span></div>
                    <div class="service-detail-text"><span><?php echo $_POST['requId'] ?></span></div>
                </div>
                <div class="row">
                    <div><span class="service-detail">Extras: </span></div>
                    <div class="service-detail-text"><span><?php
                   if($extras!=NULL)
                   {
                    foreach($extras as $extra)
                    {
                        $extraname=$this->model->getextrasbyextraId($extra['ServiceExtraId']);
                        echo $extraname['ServiceExtra'].",";
                    }
                   }
                    ?></span></div>
                </div>
                <div class="row">
                    <div><span class="service-detail">Net Amount: </span></div>
                    <div class="service-detail-euro"><span> &euro; <?php echo $SR['TotalCost']; ?></span></div>
                </div>
                <hr>
                <div class="row">
                    <div><span class="service-detail">Service Address: </span></div>
                    <div class="service-detail-text"><span><?php echo $customerAdd['AddressLine1']."  ".$customerAdd['AddressLine2'].", ".$customerAdd['City']."  ".$customerAdd['State']." - ".$customerAdd['PostalCode'];  ?></span></div>
                </div>
                <div class="row">
                    <div><span class="service-detail">Billing Address: </span></div>
                    <div class="service-detail-text"><span> Same as cleaning Address</span></div>
                </div>
                <div class="row">
                    <div><span class="service-detail">Phone: </span></div>
                    <div class="service-detail-text"><span><?php if($SP!=NULL){echo $SP['Mobile'];} ?></span></div>
                </div>
                <div class="row">
                    <div><span class="service-detail">Email: </span></div>
                    <div class="service-detail-text"><span><?php if($SP!=NULL){echo $SP['Email'];} ?></span></div>
                </div>
                <hr>
                <div class="row">
                    <div><span class="service-detail">Comments: </span></div>
                    <div class="service-detail-text"><span> <?php echo $SR['Comments']; ?> </span></div>
                </div>
                <div class="row"> <?php if(!$SR['HasPets']){ ?>
                    <div><span><i class="fas fa-times-circle"></i> </span></div>
                    <div class="service-detail-text"><span> I don't have pets at home</span></div><?php } ?>
                </div>
            </div>
        </div>
        <div class="modal-footer ft">
            <button name="submit" id="<?php echo $_POST['requId']; ?>" class="btn btn-reschedule" data-toggle="modal" data-target="#reschedule_modal"><i class="fas fa-history"></i>&nbsp; Reschedule</button>
            <button name="submit" id="<?php echo $_POST['requId']; ?>" class="btn btn-cancel" data-toggle="modal" data-target="#cancel_bookingrequest_modal"><i class="fas fa-times"></i>&nbsp; Cancel</button>
        </div>
        <?php
        
    }
    public function submitrate()
    {
        $israted=$this->model->israted($_POST['SRId']);
        $SR=$this->model->SRByreqId($_POST['SRId']);
        $avr=($_POST['friendly']+$_POST['quality']+$_POST['ontimearrival'])/3;
        $array = [
            'ServiceRequestId' => $_POST['SRId'],
            'RatingFrom'=>$_SESSION['UserId'],
            'RatingTo' => $SR['ServiceProviderId'],
            'Ratings' =>$avr,
            'Comments' => $_POST['feedback'],
            'RatingDate' =>date('Y-m-d H:i:s'),
            'OnTimeArrival' => $_POST['ontimearrival'],
            'QualityOfService' => $_POST['quality'],
            'Friendly'=>$_POST['friendly']
        ];
        $this->model->submitrate($array,$israted);
    }
    public function update_password()
    {
        $user = $this->model->getUserbyId($_SESSION['UserId']);
        $email = $user['Email'];
        $oldpassword = $_POST['oldpassword'];
        $newpassword = $_POST['newpassword'];
        $confirmpassword = $_POST['confirmpassword'];

        $count = $this->model->check_password($email, $oldpassword);

        if($count == 1)
        {
            if($newpassword == $confirmpassword)
            {
                $this->model->update_password($email, $newpassword);
            }
            else
            {
                echo 1;
            }
            
        }
        else 
        {
            echo 2;
        }
        
    }
    public function mydetails()
    {
        $userdetail = $this->model->getUserbyId($_SESSION['UserId']);
        ?>
            <div class="row">
                <div class="col-md-12">
                    <label class="text-danger error-message"></label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="fname">First name</label><br>
                    <input type="text" class="input" name="fname" placeholder="First name" reqiured value="<?php echo $userdetail['FirstName']; ?>">
                </div>
                <div class="col-md-4">
                    <label for="lname">Last name</label><br>
                    <input type="text" class="input" name="lname" placeholder="Last name" required value="<?php echo $userdetail['LastName']; ?>">
                </div>
                <div class="col-md-4">
                    <label for="email">E-mail address</label><br>
                    <input type="email" class="input" name="email" placeholder="E-mail address" disabled value="<?php echo $userdetail['Email']; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="mobile">Mobile number</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">+49</span>
                        <input type="text" name="mobile" placeholder="Mobile number" value="<?php echo $userdetail['Mobile'] ?>" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="birthdate">Date of Birth</label><br>
                    <input class="input-element birthdate" type="date" id="birthdate" name="dob" data placeholder="From Date" value="<?php if(isset($userdetail['DateOfBirth'])){ echo $userdetail['DateOfBirth']; } ?>">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <label for="language">Language</label><br>
                    <select name="language" id="language" required>
                        <option value="Gujarati">English</option>
                        <option value="Maths">Hindi</option>
                        <option value="Science">Gujarati</option>
                    </select>
                </div>
            </div>
            <div><button class="details-save">Save</button></div>
        <?php
        
    }
    public function updatemydetails()
    {
        $array = [
            'FirstName' => $_POST['fname'],
            'LastName' => $_POST['lname'],
            'Mobile' => $_POST['mobile'],
            'DateOfBirth' => $_POST['birthdate'],
            'UserId'=>$_SESSION['UserId'],
        ];
        $this->model->updatemydetails($array);
    }
    public function addressesinsettings()
    {
        $list = $this->model->UserAdresses($_SESSION['UserId']);

        foreach($list as $Add)
        {
            ?>
            <tr>
                <td>
                    <div class="addressline">
                        <div><b>Address:</b></div>&nbsp;
                        <div><?php echo $Add['AddressLine1']."  ".$Add['AddressLine2'].", ".$Add['City']."  ".$Add['State']." - ".$Add['PostalCode']." ";  ?></div>
                    </div>
                    <div class="addressline">
                        <div><b>Phone Number:</b></div>&nbsp;
                        <div><?php echo $Add['Mobile']; ?></div>
                    </div>
                </td>
                <td class="text-right">
                    <div>
                        <i id="<?php echo $Add['AddressId']; ?>" class="address-edit fas fa-edit"></i>&nbsp;
                        <i id="<?php echo $Add['AddressId']; ?>" class="fas fa-trash-alt"></i>
                    </div>
                </td>
            </tr>
            <?php
        }
    }
    public function deleteaddressesinsettings()
    {
        $this->model->deleteaddressesinsettings($_POST['AddId']);
        echo "hhii";
    }
    public function addmodal()
    {
        if(isset($_POST['Addnum']))
        {
            $add=$this->model->getAddressbyId($_POST['Addnum']);
        }
        ?>
        <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">Edit Address</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="text-danger err"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="addresslable" for="streetname">Street name</label><br>
                                <input class="input" type="text" name="streetname" placeholder="Street name" value="<?php if(isset($_POST['Addnum'])){ echo $add['AddressLine2']; } ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="addresslable" for="housenumber">House number</label><br>
                                <input class="input" type="text" name="housenumber" placeholder="House number" value="<?php if(isset($_POST['Addnum'])){ echo $add['AddressLine1']; } ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="addresslable" for="postalcode">Postal code</label><br>
                                <input class="input" type="text" name="postal_code" placeholder="360005" value="<?php if(isset($_POST['Addnum'])){ echo $add['PostalCode']; } ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="addresslable" for="city">City</label><br>
                                <input class="input" type="text" name="city" placeholder="Bonn" value="<?php if(isset($_POST['Addnum'])){ echo $add['City']; } ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="addresslable" for="phonenumber">Phone number</label><br>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">+49</span>
                                    <input type="text" id="phonenumber" name="phonenumber" placeholder="9745643546" value="<?php if(isset($_POST['Addnum'])){ echo $add['Mobile']; } ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button name="submit" id="<?php echo $add['AddressId'] ?>" class="btn btn-addresssave">save</button>
                </div>
        <?php
    }
    public function editadd()
    {
        if(isset($_POST['adid']))
        {
            $edittype=1;//to update
            $array = [
                'AddressLine1' => $_POST['addline1'],
                'AddressLine2' => $_POST['addline2'],
                'City' => $_POST['city'],
                'PostalCode' => $_POST['postalcode'],
                'Mobile'=>$_POST['mobile'],
                'AddressId'=>$_POST['adid'],
            ];
        }
        else
        {
            $edittype=0;//to insert
            $array = [
                'AddressLine1' => $_POST['addline1'],
                'AddressLine2' => $_POST['addline2'],
                'City' => $_POST['city'],
                'PostalCode' => $_POST['postalcode'],
                'Mobile'=>$_POST['mobile'],
                'UserId'=>$_SESSION['UserId'],
            ];

        }
        
        $this->model->editadd($array,$edittype);
    }
    public function exporthistory()
    {
        $userid = $_SESSION['UserId'];
        $list = $this->model->export_service_history($userid);
        $haspetArray = [0 => 'No', 1 => 'Yes'];
        $statusArray = [1 => 'Pending', 2 => 'Completed', 3 => 'Cancelled'];

        $filename = 'Service_History.csv';
        $file = fopen($filename,"w");

        $fields = array('ServiceRequest Id', 'ServiceProvider Name', 'Service Date-Time', 'Service Rate(/hour)', 'Service Hours', 'ExtraService Hours', 'HasPets', 'SubTotal', 'Discount', 'TotalCost', 'Status');
        fputcsv($file, $fields);

        foreach ($list as $line)
        {
            $csvHasPets = $haspetArray[$line['HasPets']];
            $csvStatus = $statusArray[$line['Status']];
            $line['HasPets'] = $csvHasPets;
            $line['Status'] = $csvStatus;

            fputcsv($file, $line);
        }
        fclose($file);

        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=".$filename);
        header("Content-Type: application/csv; "); 

        readfile($filename);

       // deleting file
       unlink($filename);
       exit();   
    }
    public function exporthistory_sp()
    {
        $userid = $_SESSION['UserId'];
        $list = $this->model->export_service_history_sp($userid);

        $filename = 'Service_History.csv';
        $file = fopen($filename,"w");

        $fields = array('ServiceRequest Id', 'Customer Name', 'Service Date-Time','Service Address');
        fputcsv($file, $fields);

        foreach ($list as $line)
        {
            fputcsv($file, $line);
        }
        fclose($file);

        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=".$filename);
        header("Content-Type: application/csv; "); 

        readfile($filename);

       // deleting file
       unlink($filename);
       exit();   
    }
    public function exportuserlist()
    {
        $list = $this->model->users();
        $usertype = [1 => 'Customer', 2 => 'ServiceProvider'];
        $approve = [0 => 'Approved', 1 => 'Not Approved'];
        $active = [0 => 'Active', 1 => 'InActive'];
        $delete = [0 => '-', 1 => 'Deleted'];
        $gender = [1 => 'Male', 2 => 'Female', 3 => 'Rather Not to Say'];

        $filename = 'Users.csv';
        $file = fopen($filename,"w");

        $fields = array('User Id', 'User Name', 'Email', 'Mobile', 'UserType', 'Gender', 'DOB', 'ZipCode', 'CreateDate', 'IsApprove', 'IsActive','IsDelete');
        fputcsv($file, $fields);

        foreach ($list as $line)
        {
            $line['UserTypeId'] = $usertype[$line['UserTypeId']];
            if(isset($line['Gender']))
            {
                $line['Gender'] = $gender[$line['Gender']];
            }
            $line['IsApproved'] = $approve[$line['IsApproved']];
            $line['IsActive'] = $active[$line['IsActive']];
            $line['IsDeleted'] = $delete[$line['IsDeleted']];
            fputcsv($file, $line);
        }
        fclose($file);

        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=".$filename);
        header("Content-Type: application/csv; "); 

        readfile($filename);

       // deleting file
       unlink($filename);
       exit();   
    }
    public function newservicesrequests()
    {
        $user= $this->model->getUserbyId($_SESSION['UserId']);
        $list=$this->model->newservicesrequests($_SESSION['UserId'],$user['ZipCode'],$_POST['pet']);
        function HourMinuteToDecimal($hour_minute) 
        {
            $t = explode(':', $hour_minute);
            return $t[0] * 60 + $t[1];
        }
        function DecimalToHoursMins($mins)
        {
            $h=(int)($mins/60);
            $m=round($mins%60);
            if($h<10){$h="0".$h;}
            if($m<10){$m="0".$m;}
            return $h.":".$m;
        }
        ?>
        <table  class="table table-hover" id="newrequest">
                                    <thead>
                                        <tr>
                                            <th>Service Id </th>
                                            <th >Service Date </th>
                                            <th >Customer's Details</th>
                                            <th >Payment</th>
                                            <th >Time Conflict</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="newrequest">
        <?php
        foreach($list as $rq)
        {
            $customer= $this->model->getUserbyId($rq['UserId']);
            $SRAddress=$this->model->getSRAddbySRId($rq['ServiceRequestId']);
            $customerAdd=$this->model->getUserAddbyAddId($SRAddress['AddressId']);
            $dt=substr($rq['ServiceStartDate'],0,10);
            $tm=substr($rq['ServiceStartDate'],11,5);
            $totalmins=HourMinuteToDecimal($tm)+ (($rq['ServiceHours']+$rq['ExtraHours'])*60);
            $totime=DecimalToHoursMins($totalmins);
            ?>
            <tr class="t-row" data-toggle="modal" data-target="#servicedetailmodal">
                <td><p><?php echo $rq['ServiceRequestId']; ?></p></td>
                <td>
                    <div class="date"><img src="./assets/Image/calendar2.png"><?php echo $dt; ?></div>
                    <div><img src="./assets/Image/layer-14.png"><?php echo $tm."-".$totime; ?></div>
                </td>
                <td> 
                    <div><?php echo $customer['FirstName'] ?></div>
                    <div><img src="./assets/Image/layer-719.png"><?php echo $customerAdd['AddressLine1']."  ".$customerAdd['AddressLine2'].", " ?></div>
                    <div><?php echo $customerAdd['City']." - ".$customerAdd['PostalCode']; ?></div>
                </td>
                <td><p class="euro d-flex justify-content-center">&euro;<?php echo $rq['TotalCost'] ?></p></td>
                <td><p></p></td>
                <td ><button id="<?php echo $rq['ServiceRequestId']; ?>"  class="btn accept-btn">Accept</button></td>
            </tr>
        <?php   
        }
        ?>
        </tbody>
                                </table>
        <?php
    }
    public function acceptrequest()
    {
        $row = $this->model->fill_selected_pending_request($_POST['reqId']);

        $date = substr($row['ServiceStartDate'], 0, 10);
        $nextdate = date("Y-m-d H-i-s", strtotime($date . '+1 day'));

        $timecomplete = "+" . ($row['ServiceHours'] + $row['ExtraHours']) . " " . "hours";
        $newserviceenddate = date("Y-m-d H-i-s", strtotime($row['ServiceStartDate'] . $timecomplete));

        $allrequests = $this->model->get_requests_for_that_date($_SESSION['UserId'], $date, $nextdate);
        $count = true;
        // print_r($date.$nextdate);

        foreach ($allrequests as $request) {
            // for old request

            $oldstartdate = date("Y-m-d H-i-s", strtotime($request['ServiceStartDate'] . '-1 hour'));
            $totaltimeforcompletion = "+" . ($request['ServiceHours'] + $request['ExtraHours'] + 1) . " " . "hours";
            $oldenddate = date("Y-m-d H-i-s", strtotime($request['ServiceStartDate'] . $totaltimeforcompletion));

            
            if ($oldstartdate >= $date && $newserviceenddate <= $oldenddate) {
                global $count;
                $count = false;
                break;
            }
            
        }
        if ($count != false) {
            $array = [
                'ServiceRequestId' => $_POST['reqId'],
                'ServiceProviderId' => $_SESSION['UserId'],
                'SPAcceptedDate' => date('Y-m-d H:i:s'),
            ];
    
            $this->model->acceptrequest($array);
            
            $SR=$this->model->SRByreqId($_POST['reqId']);
            $SP= $this->model->getUserbyId($SR['ServiceProviderId']);
            $customer=$this->model->getUserbyId($SR['UserId']);
            
            $to_email = $customer['Email'];
            $subject = "SERVICE REQUEST ACCEPTED";
            $body = "Your Service Request ID  ".$_POST['reqId']."  Accepted By " .$SP['FirstName']."  ".$SP['LastName'].". Check out your Upcoming Services";
            $headers = "From: rohit1parmar11@gmail.com";
            mail($to_email, $subject, $body, $headers);
        } 
        else
        {
            echo 1;
        }
    }
    public function upcoming()
    {
        $list=$this->model->upcoming($_SESSION['UserId']);
        function HourMinuteToDecimal($hour_minute) 
        {
            $t = explode(':', $hour_minute);
            return $t[0] * 60 + $t[1];
        }
        function DecimalToHoursMins($mins)
        {
            $h=(int)($mins/60);
            $m=round($mins%60);
            if($h<10){$h="0".$h;}
            if($m<10){$m="0".$m;}
            return $h.":".$m;
        }
        ?>
        <table id="upcoming" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ServiceId</th>
                                            <th>Service Date </th>
                                            <th id="sd">Customer Details</th>
                                            <th id="cd">Payment</th>
                                            <th >Distance</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
        <?php

        foreach($list as $rq)
        {
            $customer= $this->model->getUserbyId($rq['UserId']);
            $SRAddress=$this->model->getSRAddbySRId($rq['ServiceRequestId']);
            $customerAdd=$this->model->getUserAddbyAddId($SRAddress['AddressId']);
            $dt=substr($rq['ServiceStartDate'],0,10);
            $tm=substr($rq['ServiceStartDate'],11,5);
            $totalmins=HourMinuteToDecimal($tm)+ (($rq['ServiceHours']+$rq['ExtraHours'])*60);
            $totime=DecimalToHoursMins($totalmins);
            $timecomplete = "+".($rq['ServiceHours'] + $rq['ExtraHours'])." "."hours";
            $previousdate = date('Y-m-d H-i-s', strtotime($rq['ServiceStartDate'] .'-1 day'));
            $serviceenddate = date("Y-m-d H-i-s", strtotime($rq['ServiceStartDate'] .$timecomplete));
                        
        ?>
        <tr class="t-row" data-toggle="modal" data-target="#servicedetailmodal" >
            <td><p><?php echo $rq['ServiceRequestId']; ?></p></td>
            <td>
                <div class="date"><img src="./assets/Image/calendar2.png"><?php echo $dt; ?></div>
                <div><img src="./assets/Image/layer-14.png"><?php echo $tm."-".$totime; ?></div>
            </td>
            <td> 
                <div><?php echo $customer['FirstName']." ".$customer['LastName'] ?></div>
                <div><img src="./assets/Image/layer-719.png"><?php echo $customerAdd['AddressLine1']."  ".$customerAdd['AddressLine2'].", " ?></div>
                <div><?php  echo $customerAdd['City']." - ".$customerAdd['PostalCode']; ?></div>
            </td>
            <td><p class="euro d-flex justify-content-center">&euro;<?php echo $rq['TotalCost'] ?></p></td>
            <td><p></p></td>
            <td >
                <?php if($serviceenddate < date('Y-m-d H-i-s')) { ?>
                    <button id="<?php echo $rq['ServiceRequestId']; ?>" class="complete-btn">Complete</button>
                    <?php } if($previousdate > date('Y-m-d H-i-s')) { ?>
                    <button id="<?php echo $rq['ServiceRequestId']; ?>" class="cancel-btn">Cancel</button>
                    <?php  } ?>
        </td>
        </tr>
        <?php
        }
        ?>
        </tbody>
                                </table>
        <?php
    }
    public function cancelrequest()
    {
        $row = $this->model->fill_selected_pending_request($_POST['reqId']);
        $previousdate = date('Y-m-d H-i-s', strtotime($row['ServiceStartDate'] .'-1 day'));
        $SR=$this->model->SRByreqId($_POST['reqId']);
        $SP= $this->model->getUserbyId($SR['ServiceProviderId']);
        $customer=$this->model->getUserbyId($SR['UserId']);

        if($previousdate > date('Y-m-d H-i-s'))
        {
            $this->model->cancelrequest($_POST['reqId']);

            $to_email = $customer['Email'];
            $subject = "Your SERVICE REQUEST is Cancelled";
            $body = "Your Service Request ID  ".$_POST['reqId']." is Cancelled  By " .$SP['FirstName']."  ".$SP['LastName'].". we'll notify you when other sevice provider  will your request ";
            $headers = "From: rohit1parmar11@gmail.com";
            mail($to_email, $subject, $body, $headers);
        }
        else
        {
            echo 1;
        }
    } 
    public function completerequest()
    {
        $row = $this->model->fill_selected_pending_request($_POST['reqId']);
        $timecomplete = "+".($row['ServiceHours'] + $row['ExtraHours'])." "."hours";
        $serviceenddate = date("Y-m-d H-i-s", strtotime($row['ServiceStartDate'] .$timecomplete));

        if($serviceenddate < date('Y-m-d H-i-s'))
        {
            $this->model->completerequest($_POST['reqId']);
        }
    }
    public function sphistory()
    {
        $list=$this->model->sphistory($_SESSION['UserId']);
        function HourMinuteToDecimal($hour_minute) 
        {
            $t = explode(':', $hour_minute);
            return $t[0] * 60 + $t[1];
        }
        function DecimalToHoursMins($mins)
        {
            $h=(int)($mins/60);
            $m=round($mins%60);
            if($h<10){$h="0".$h;}
            if($m<10){$m="0".$m;}
            return $h.":".$m;
        }
        ?>
        <table  class="table table-hover" id="sphistory">
                                    <thead>
                                        <tr>
                                            <th>Service Id </th>
                                            <th >Service Date </th>
                                            <th >Customer Details </th>
                                        </tr>
                                    </thead>
                                    <tbody class=" ">
        <?php
        foreach($list as $history)
        {
            $customer= $this->model->getUserbyId($history['UserId']);
            $SRAddress=$this->model->getSRAddbySRId($history['ServiceRequestId']);
            $customerAdd=$this->model->getUserAddbyAddId($SRAddress['AddressId']);
            $dt=substr($history['ServiceStartDate'],0,10);
            $tm=substr($history['ServiceStartDate'],11,5);
            $totalmins=HourMinuteToDecimal($tm)+ (($history['ServiceHours']+$history['ExtraHours'])*60);
            $totime=DecimalToHoursMins($totalmins);
        ?>
            <tr class="t-row">
                <td><?php echo $history['ServiceRequestId'] ?></td>
                <td>
                    <div class="date"><img src="./assets/Image/calendar2.png"><?php echo $dt; ?></div>
                    <div><?php echo $tm."-".$totime; ?></div>
                </td>
                <td>
                    <div><?php echo $customer['FirstName']." ".$customer['LastName'] ?></div>
                    <div><img src="./assets/Image/layer-719.png"><?php echo $customerAdd['AddressLine1']."  ".$customerAdd['AddressLine2'].", " ?></div>
                    <div><?php  echo $customerAdd['City']." - ".$customerAdd['PostalCode']; ?></div> 
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
                                </table>
        <?php
    }
    public function sprate()
    {
        $rates=$this->model->rate($_SESSION['UserId']);
        function HourMinuteToDecimal($hour_minute) 
        {
            $t = explode(':', $hour_minute);
            return $t[0] * 60 + $t[1];
        }
        function DecimalToHoursMins($mins)
        {
            $h=(int)($mins/60);
            $m=round($mins%60);
            if($h<10){$h="0".$h;}
            if($m<10){$m="0".$m;}
            return $h.":".$m;
        }
        ?>
        <table id="tablerating" class="table display">
                            <thead class="d-none"><th>details</th></thead>
                            <tbody class="">
        <?php
        foreach($rates as $rate)
        {
            $customer = $this->model->getUserbyId($rate['RatingFrom']);
            $rq=$this->model->SRByreqId($rate['ServiceRequestId']);
            $dt=substr($rq['ServiceStartDate'],0,10);
            $tm=substr($rq['ServiceStartDate'],11,5);
            $totalmins=HourMinuteToDecimal($tm)+ (($rq['ServiceHours']+$rq['ExtraHours'])*60);
            $totime=DecimalToHoursMins($totalmins);
            ?>
            <tr class="mt-20 pt-20">
                <td>
                    <div class="rate-detail">
                        <div class="rate-content">
                            <div><?php echo $rate['ServiceRequestId']; ?></div>
                            <div><b><?php echo $customer['FirstName'] . " " . $customer['LastName']; ?></b></div>
                        </div>
                        <div class="rate-content">
                            <div>
                                <img src="./assets/Image/layer-712.png" alt="clock">&nbsp; <span><?php echo $dt; ?></span><br>
                                <img src="./assets/Image/calendar2.png" alt="calendar">&nbsp; <span><?php echo $tm."-".$totime; ?></span>
                            </div>
                            </div>
                                <div class="rate-content">
                                    <div><b>Ratings</b></div>
                                    <div class="rate-detail">
                                        <div class="rateyo pe-0 ps-0" id="rating" data-rateyo-rating="<?php echo $rate['Ratings']; ?>"></div>
                                        <div>
                                        <?php
                                                if(0 < $rate['Ratings'] && $rate['Ratings'] <= 1)
                                                {
                                                    echo 'bad';
                                                }
                                                else if(1 < $rate['Ratings'] && $rate['Ratings'] <= 2)
                                                {
                                                    echo 'not bad';
                                                }
                                                else if(2 < $rate['Ratings'] && $rate['Ratings'] <= 3)
                                                {
                                                    echo 'good';
                                                }
                                                else if(3 < $rate['Ratings'] && $rate['Ratings'] <= 4)
                                                {
                                                    echo 'very good';
                                                }
                                                else if(4 < $rate['Ratings'] && $rate['Ratings'] <= 5)
                                                {
                                                    echo 'excellent';
                                                }
                                                ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div>
                                <div><b>Customer Comment</b></div>
                                <div><?php echo $rate['Comments']; ?></div>
                            </div>
                        </td>
                    </tr>
            <?php
        }
        ?>
        </tbody>
                        </table>
        <?php
    }
    public function blockcard()
    {
        $data = $this->model->blockcard($_SESSION['UserId']);
        foreach($data as $rq)
        {
            $customer = $this->model->getUserbyId($rq['UserId']);
            ?>
            <div class="card">
                <div class="customer-image"><img src="./assets/Image/forma-1-copy-19.png" alt=""></div>
                <div class="customer-name"><b> <?php echo $customer['FirstName'] . " " . $customer['LastName']; ?> </b></div>
                <div class="block-unblock-button">
                    <?php
                    $checkblockunblock = $this->model->checkblocked($rq['UserId'], $_SESSION['UserId']);
                    if ($checkblockunblock == null) {
                    ?>
                        <button class="block-button" id="<?php echo $rq['UserId']; ?>">Block</button>
                    <?php
                    } else {
                    ?>
                        <button class="unblock-button" id="<?php echo $rq['UserId']; ?>">Unblock</button>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
    }
    public function blockcustomer()
    {
        $this->model->blockcustomer($_POST['userid'], $_SESSION['UserId']);
        $this->model->unfavcustomer($_POST['userid'], $_SESSION['UserId']);
    }
    public function unblockcustomer()
    {
        $this->model->unblockcustomer($_POST['userid'], $_SESSION['UserId']);
    }
    public function favcustomer()
    {
        $this->model->favcustomer($_POST['userid'], $_SESSION['UserId']);
        $this->model->unblockcustomer($_POST['userid'], $_SESSION['UserId']);
    }
    public function unfavcustomer()
    {
        $this->model->unfavcustomer($_POST['userid'], $_SESSION['UserId']);
    }
    public function spdetails()
    {
        $SP = $this->model->getUserbyId($_SESSION['UserId']);
        $SPAdd=$this->model->UserAddress($_SESSION['UserId']);
        ?>
         <div class="d-flex align-items-center pb-2">
            <div><b>Account Status:</b></div>
            <div class="ps-2 <?php if($SP['IsActive'] == 1) { echo 'active'; } else { echo ' notactive'; } ?>"><?php if($SP['IsActive'] == 1) { echo 'Active'; } else { echo 'Not Active'; } ?></div>
        </div>
        <div class="row">
            <div class="sp-basic col-md-12">
                <b>Basic details</b>
                <hr class="sp-breakline">
                <div class="sp-avatar"><img src="<?php if($SP['UserProfilePicture'] != null) { echo $SP['UserProfilePicture']; } ?>" alt=""></div>
            </div>
        </div>
        <div class="error-line row">
            <div class="col-md-12"><label class="label text-danger sp-error-message"></label></div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="label" for="spfname">First name</label><br>
                <input type="text" class="input" name="spfname" placeholder="First name" required value="<?php echo $SP['FirstName'] ?>">
            </div>
            <div class="col-md-4">
                <label class="label" for="splname">Last name</label><br>
                <input type="text" class="input" name="splname" placeholder="Last name" required value="<?php echo $SP['LastName'] ?>">
            </div>
            <div class="col-md-4">
                <label class="label" for="spemail">E-mail address</label><br>
                <input type="email" class="input" name="spemail" disabled placeholder="E-mail address" required value="<?php echo $SP['Email'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="label" for="spmobile">Mobile number</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">+49</span>
                    <input type="text" name="spmobile" placeholder="Mobile number" value="<?php echo $SP['Mobile'] ?>" required>
                </div>
            </div>
            <div class="col-md-4">
                <label class="label" for="spdob">Date of Birth</label><br>
                <input type="date" class="input" name="spdob" required value="<?php echo $SP['DateOfBirth'] ?>">
            </div>
            <div class="col-md-4">
                <label class="label" for="spnationality">Nationality</label><br>
                <select name="spnationality" id="spnationality">
                    <option disabled selected value> -- select an option -- </option>
                    <option value="1" <?php echo ($SP['NationalityId']==1)?'selected="selected"':'' ?>>German</option>
                    <option value="2" <?php echo ($SP['NationalityId']==2)?'selected="selected"':'' ?>>Italian</option>
                    <option value="3" <?php echo ($SP['NationalityId']==3)?'selected="selected"':'' ?>>British</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="label" for="splanguage">Language</label><br>
                <select name="splanguage" id="splanguage" required>
                    <option disabled selected value> -- select an option -- </option>
                    <option value="1" <?php echo ($SP['LanguageId']==1)?'selected="selected"':'' ?>>German</option>
                    <option value="2" <?php echo ($SP['LanguageId']==2)?'selected="selected"':'' ?>>English</option>
                </select>
            </div>
        </div>
        <div class="row">
            <label class="label" for="spgender">Gender</label><br>
            <div class="gender col-md-6">
                <div>
                    <input type="radio" id="male" name="spgender" value="1" <?php echo ($SP['Gender']==1)?'checked':'' ?>>
                    <label for="male">Male</label>
                </div>
                <div>
                    <input type="radio" id="female" name="spgender" value="2" <?php echo ($SP['Gender']==2)?'checked':'' ?>>
                    <label for="female">Female</label>
                </div>
                <div>
                    <input type="radio" id="notsay" name="spgender" value="0" <?php echo ($SP['Gender']==null)?'checked':'' ?>>
                    <label for="notsay">Rather not to say</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="label" for="avatar">Select Avatar</label><br>
                <div class="choose-avatar">
                    <div class="avatar-image"><img id="avatar1" <?php if($SP['UserProfilePicture'] == "./assets/Image/avatar-car.png") { echo 'class="active"'; } ?> src="./assets/Image/avatar-car.png" alt=""></div>
                    <div class="avatar-image"><img id="avatar2" <?php if($SP['UserProfilePicture'] == "./assets/Image/avatar-female.png") { echo 'class="active"'; } ?> src="./assets/Image/avatar-female.png" alt=""></div>
                    <div class="avatar-image"><img id="avatar3" <?php if($SP['UserProfilePicture'] == "./assets/Image/avatar-hat.png") { echo 'class="active"'; } ?> src="./assets/Image/avatar-hat.png" alt=""></div>
                    <div class="avatar-image"><img id="avatar4" <?php if($SP['UserProfilePicture'] == "./assets/Image/avatar-iron.png") { echo 'class="active"'; } ?> src="./assets/Image/avatar-iron.png" alt=""></div>
                    <div class="avatar-image"><img id="avatar5" <?php if($SP['UserProfilePicture'] == "./assets/Image/avatar-male.png") { echo 'class="active"'; } ?> src="./assets/Image/avatar-male.png" alt=""></div>
                    <div class="avatar-image"><img id="avatar6" <?php if($SP['UserProfilePicture'] == "./assets/Image/avatar-ship.png") { echo 'class="active"'; } ?> src="./assets/Image/avatar-ship.png" alt=""></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <b>My address</b>
                <hr class="sp-breakline">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="label" for="spstreetname">Street name</label><br>
                <input type="text" class="input" name="spstreetname" placeholder="street name" required value="<?php if($SPAdd == null) { echo ''; } else { echo $SPAdd['AddressLine1']; } ?>">
            </div>
            <div class="col-md-4">
                <label class="label" for="sphousenumber">House number</label><br>
                <input type="text" class="input" name="sphousenumber" placeholder="house number" required value="<?php if($SPAdd == null) { echo ''; } else { echo $SPAdd['AddressLine2']; } ?>">
            </div>
            <div class="col-md-4">
                <label class="label" for="sppostalcode">Postal code</label><br>
                <input type="email" class="input" name="sppostalcode" placeholder="postalcode" required value="<?php if($SPAdd == null) { echo ''; } else { echo $SPAdd['PostalCode']; } ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="label" for="spcity">City</label><br>
                <input type="text" class="input" name="spcity" placeholder="city" required value="<?php if($SPAdd == null) { echo ''; } else { echo $SPAdd['City']; } ?>">
            </div>
        </div>
        <div>
            <button type="submit" id="<?php if($SPAdd == null) { echo ''; } else { echo $SPAdd['AddressId']; } ?>" class="sp-details-save">Save</button>
        </div>
        <?php
    }
    public function savespdetails()
    {
        $userid = $_SESSION['UserId'];
        $spfname = $_POST['spfname'];
        $splname = $_POST['splname'];
        $spmobile = $_POST['spmobile'];
        $spemail = $_POST['spemail'];
        $spdob = $_POST['spdob'];
        $spnationality = $_POST['spnationality'];
        $splanguage = $_POST['splanguage'];
        $spgender = $_POST['spgender'];
        $spstreetname = $_POST['spstreetname'];
        $sphousenumber = $_POST['sphousenumber'];
        $sppostalcode = $_POST['sppostalcode'];
        $spcity = $_POST['spcity'];

        if($_POST['selectedavatar'][0] == 1)
        {
            $selectedavatar = "./assets/Image/avatar-car.png";
        }
        else if($_POST['selectedavatar'][0] == 2)
        {
            $selectedavatar = "./assets/Image/avatar-female.png";
        }
        else if($_POST['selectedavatar'][0] == 3)
        {
            $selectedavatar = "./assets/Image/avatar-hat.png";
        }
        else if($_POST['selectedavatar'][0] == 4)
        {
            $selectedavatar = "./assets/Image/avatar-iron.png";
        }
        else if($_POST['selectedavatar'][0] == 5)
        {
            $selectedavatar = "./assets/Image/avatar-male.png";
        }
        else if($_POST['selectedavatar'][0] == 6)
        {
            $selectedavatar = "./assets/Image/avatar-ship.png";
        }

        $array = [
            'spfname' => $spfname,
            'splname' => $splname,
            'spmobile' => $spmobile,
            'spdob' => $spdob,
            'spnationality' => $spnationality,
            'splanguage' => $splanguage,
            'spgender' => $spgender,
            'selectedavatar' => $selectedavatar,
        ];
        $this->model->update_sp_details('user', $userid, $array);

        if(isset($_POST['selectedaddressid']))
        {
            $edit = 1;
            $array2 = [
                'AddressId' => $_POST['selectedaddressid'],
                'AddressLine1' => $spstreetname,
                'AddressLine2' => $sphousenumber,
                'PostalCode' => $sppostalcode,
                'City' => $spcity,
            ];
        }
        else
        {
            $edit = 0;
            $array2 = [
                'UserId' => $userid,
                'AddressLine1' => $spstreetname,
                'AddressLine2' => $sphousenumber,
                'PostalCode' => $sppostalcode,
                'City' => $spcity,
                'Mobile' => $spmobile,
                'Email' => $spemail,
            ];
        }
        $this->model->insert_update_spaddress('useraddress', $array2, $edit);
    
    }
    public function adminservicesrequests()
    {
        $SRs=$this->model->getallservicerequest();
        function HourMinuteToDecimal($hour_minute) 
        {
            $t = explode(':', $hour_minute);
            return $t[0] * 60 + $t[1];
        }
        function DecimalToHoursMins($mins)
        {
            $h=(int)($mins/60);
            $m=round($mins%60);
            if($h<10){$h="0".$h;}
            if($m<10){$m="0".$m;}
            return $h.":".$m;
        }
        ?>
        <table class="table table-hover" id="tblSRreq">
                                <thead id="headings">
                                    <tr>
                                        <th scope="col">Service Id</th>
                                        <th scope="col">Service Date</th>
                                        <th scope="col"> Customer Details</th>
                                        <th scope="col">Service Provider</th>
                                        <th scope="col">Net Amount</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Payment Status </th>
                                        <th scope="col " >Actions </th>
                                    </tr>
                                </thead>
                                <tbody class="">
        <?php
        foreach($SRs as $SR)
        {
            $dt=substr($SR['ServiceStartDate'],0,10);
            $tm=substr($SR['ServiceStartDate'],11,5);
            $totalmins=HourMinuteToDecimal($tm)+ (($SR['ServiceHours']+$SR['ExtraHours'])*60);
            $totime=DecimalToHoursMins($totalmins);
            $SRAdd=$this->model->getSRAddbySRId($SR['ServiceRequestId']);
            $customer=$this->model->getUserbyId($SR['UserId']);
            $SP=$this->model->getUserbyId($SR['ServiceProviderId']);
            $customeraddress=$this->model->getAddressbyId($SRAdd['AddressId']);
            ?>
                <tr>
                    <td><?php echo $SR['ServiceRequestId']; ?></td>
                    <td>
                        <div><img src="./assets/Image/calendar2.png"><?php echo $dt; ?></div>
                        <div><img src="./assets/Image/layer-14.png"><?php echo $tm."-".$totime; ?></div>
                    </td>
                    <td>
                        <div><?php echo $customer['FirstName']." ".$customer['LastName']; ?></div>
                        <divp><img src="./assets/Image/layer-719.png"><?php echo $customeraddress['AddressLine1'].",".$customeraddress['AddressLine2'].","; ?></divp>
                        <div><?php echo $customeraddress['City'].",".$customeraddress['PostalCode']."."; ?></div>
                    </td>
                    <td><?php if(isset($SR['ServiceProviderId'])){ echo $SP['FirstName']." ".$SP['LastName'];} ?></td>
                    <td>&euro;<?php echo $SR['TotalCost']; ?></td>
                    <td class="action">
                        <?php  
                         if($SR['Status']==1)
                         {?>
                            <button class="btn pending"><b>New</b></button>
                         <?php
                         }
                         elseif($SR['Status']==2)
                         {?>
                             <button class="btn complete"><b>Completed</b></button>
                         <?php
                         }
                         elseif($SR['Status']==3)
                         {?>
                              <button class="btn cancel"><b>Cancelled</b></button>
                         <?php
                         }
                        ?>
                    </td>
                    <td class="action"></td>
                    <td class="action">
                        <a class="dropdown-toggle Actions " href="#" id="navbarDropdowns" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu tooltiptext" aria-labelledby="navbarDropdowns">
                            <?php if($SR['Status']==1) {  ?>
                                <a class="dropdown-item editreschedule" id="<?php echo $SR['ServiceRequestId']; ?>"  data-toggle="modal" data-target="#editreschedule">Edit & Reschedule</a>
                                <a class="dropdown-item cancelrq" id="<?php echo $SR['ServiceRequestId']; ?>" href="#" >Cancel SR By Customer</a>
                            <?php }  ?>
                            <a class="dropdown-item editreschedule" href="#" >Inquiry</a>
                            <a class="dropdown-item editreschedule" href="#" >History Log</a>
                            <a class="dropdown-item editreschedule" href="#" >Download Invoice</a>
                            <a class="dropdown-item editreschedule" href="#" >Other Transactions</a>
                        </div>
                    </td>
                </tr>
            <?php
        }
        ?>
        </tbody>
                            </table>
        <?php
    }
    public function usermanagement()
    {
        $users=$this->model->usermanagement();
        function HourMinuteToDecimal($hour_minute) 
        {
            $t = explode(':', $hour_minute);
            return $t[0] * 60 + $t[1];
        }
        function DecimalToHoursMins($mins)
        {
            $h=(int)($mins/60);
            $m=round($mins%60);
            if($h<10){$h="0".$h;}
            if($m<10){$m="0".$m;}
            return $h.":".$m;
        }
        ?>
        <table class="table table-hover" id="tblusermanagement">
                                <thead id="headings">
                                    <tr>
                                        <th scope="col">User Name</th>
                                        <th scope="col">Role </th>
                                        <th scope="col"> Date of Registration</th>
                                        <th scope="col">User Type</th>
                                        <th scope="col">Phone </th>
                                        <th scope="col">Postal Code</th>
                                        <th scope="col" class="action">Status </th>
                                        <th scope="col " class="action" >Actions </th>
                                    </tr>
                                </thead>
                                <tbody class="">
        <?php
        foreach($users as $user)
        {
            ?>
                <tr>
                    <td><?php echo $user['FirstName']." ".$user['LastName']; ?></td>
                    <td></td>
                    <td><img class="calender" src="./assets/Image/calendar2.png"><?php echo substr($user['CreatedDate'],0,10) ?></td>
                    <td><?php if($user['UserTypeId']==1){ echo "Customer";} elseif($user['UserTypeId']==2){ echo "Service Provider"; } ?></td>
                    <td><?php echo $user['Mobile']; ?></td>
                    <td><?php echo $user['ZipCode']; ?></td>
                    <td class="action">
                        <?php 
                        if($user['IsActive']==0 && $user['IsApproved']==1)
                        {?>
                            <button class="btn inactive">Inactive</button>
                        <?php
                        }
                        elseif($user['IsActive']==1 && $user['IsApproved']==1)
                        {?>
                            <button class="btn active">Active</button>
                        <?php
                        }
                        elseif($user['IsApproved']==0){
                        ?>
                        <button class="btn approve">Not Approved</button>
                        <?php
                        }?>
                    </td>
                    <td class="action">
                        <a class="dropdown-toggle Actions " href="#" id="navbarDropdowns" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu tooltiptext" aria-labelledby="navbarDropdowns">
                            <?php 
                                if($user['IsActive']==0 && $user['IsApproved']==1)
                                {?>
                                    <a class="dropdown-item letactive" id="<?php echo $user['UserId']; ?>" href="#">Activate</a>
                                <?php
                                }
                                elseif($user['IsActive']==1 && $user['IsApproved']==1)
                                {?>
                                    <a class="dropdown-item letdeactive" id="<?php echo $user['UserId']; ?>" href="#">Deactivate</a>
                                <?php
                                }
                            ?>
                            <?php 
                                if($user['UserTypeId']==2 && $user['IsApproved']==0)
                                {?>
                                <a class="dropdown-item letapprove" id="<?php echo $user['UserId']; ?>" href="#">Approve</a>
                                <?php
                                }
                            ?>
                        </div>
                    </td>          
                </tr>
            <?php
        }
        ?>
        </tbody>
                            </table>
        <?php
    }
    public function activeuser()
    {
        $this->model->activeuser($_POST['userid']);
        $user=$this->model->getUserbyId($_POST['userid']);

        $to_email = $user['Email'];
        $subject = "Account activated";
        $body = "Your Account with UserId:".$user['UserId']." is Activated by Admin";
        $headers = "From: rohit1parmar11@gmail.com";
        mail($to_email, $subject, $body, $headers);
        
    }
    public function deactiveuser()
    {
        $this->model->deactiveuser($_POST['userid']);
        $user=$this->model->getUserbyId($_POST['userid']);

        $to_email = $user['Email'];
        $subject = "Account deactivated";
        $body = "Your Account with UserId:".$user['UserId']." is Activated by Admin";
        $headers = "From: rohit1parmar11@gmail.com";
        mail($to_email, $subject, $body, $headers);
    }
    public function approvesp()
    {
        $this->model->approvesp($_POST['userid']);
        $user=$this->model->getUserbyId($_POST['userid']);

        $to_email = $user['Email'];
        $subject = "Registration Approved";
        $body = "Your Registration Request approved with  UserId:".$user['UserId']." by Admin";
        $headers = "From: rohit1parmar11@gmail.com";
        mail($to_email, $subject, $body, $headers);
    }
    public function cancelfromadmin()
    {
        $this->model->cancelfromadmin($_POST['reqid']);
        $SR=$this->model->SRByreqId($_POST['reqid']);

        if(isset($SR['ServiceProviderId']))
        {
            $user=$this->model->getUserbyId($SR['ServiceProviderId']);

            $to_email = $user['Email'];
            $subject = "Service Cancelled";
            $body = "The Service (Service RequestId =".$_POST['reqid']." DateTime: ".$SR['ServiceStartDate'].")  Assigned to you is cancelled by Customer";
            $headers = "From: rohit1parmar11@gmail.com";
            mail($to_email, $subject, $body, $headers);
        }
        
    }
    public function fill_reschedule_servicerequest_detail()
    {
        $SR=$this->model->SRByreqId($_POST['selectedrequestid']);
        $date = substr($SR['ServiceStartDate'], 0, 10);
        $time = substr($SR['ServiceStartDate'], 11, 5);
        $SRAddId=$this->model->getSRAddbySRId($_POST['selectedrequestid']);
        $SRAdd=$this->model->getUserAddbyAddId($SRAddId['AddressId']);
        ?>
                    <div class="modal-header">
                        <h5 class="modal-title temp" id="exampleModalLongTitle">Edit Service Request</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="reschedule-inputs fill-selected-request mr-0 ml-0">
                            <div>
                                <label class="admin-error" for="admin-error"></label>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="srdate"><b>Date</b></label>
                                    <div class="date-group position-relative">
                                        <input class="input" type="date" id="srdate" name="srdate" value="<?php echo $date; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="srtime"><b>Time</b></label><br>
                                    <div class="date-group position-relative">
                                        <input class="input" type="time" id="srdate" name="srtime" value="<?php echo $time; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row address-heading">
                                <span class="pr-0 pl-0"><b>Service Address</b></span>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="streetname">Street name</label><br>
                                    <input class="input" type="text" name="streetname" placeholder="Street name" value="<?php echo $SRAdd['AddressLine1']; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="housenumber">House number</label><br>
                                    <input class="input" type="text" name="housenumber" placeholder="House number" value="<?php echo $SRAdd['AddressLine2']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="postalcode">Postal code</label><br>
                                    <input class="input" type="text" name="postalcode" placeholder="360005" value="<?php echo $SRAdd['PostalCode']; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="city">City</label><br>
                                    <input class="input" type="text" name="city" placeholder="Bonn" value="<?php if(isset($_POST['selectedrequestid'])) { echo $SRAdd['City']; } ?>">
                                </div>
                            </div>
                            <div class="row address-heading">
                                <span class="pr-0 pl-0"><b>Invoice Address</b></span>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="streetname">Street name</label><br>
                                    <input class="input" type="text" placeholder="Street name" value="<?php echo $SRAdd['AddressLine1']; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="housenumber">House number</label><br>
                                    <input class="input" type="text" placeholder="House number" value="<?php echo $SRAdd['AddressLine2']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="postalcode">Postal code</label><br>
                                    <input class="input" type="text" placeholder="360005" value="<?php echo $SRAdd['PostalCode']; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="city">City</label><br>
                                    <input class="input" type="text" placeholder="Bonn" value="<?php if(isset($_POST['selectedrequestid'])) { echo $SRAdd['City']; } ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="reschedulereason"><b>Why do you want to reschedule service request?</b></label><br>
                                    <textarea class="reschedulereason" name="reschedulereason" placeholder="Why do you want to reschedule service request?"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="emp-notes"><b>Call Center EMP Notes</b></label><br>
                                    <textarea class="reschedulereason" name="emp-notes" placeholder="Enter Notes"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" class="btn button-update admin-sr-update" id="<?php echo $_POST['selectedrequestid']; ?>">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
        <?php
    }
    public function reschedule_selected_service_request()
    {
        
        $selectedrequestid = $_POST['selectedrequestid'];
        $row =$this->model->SRByreqId($selectedrequestid);
        $Address=$this->model->getSRAddbySRId($_POST['selectedrequestid']);
        $previousdate = date('Y-m-d H-i-s', strtotime($row['ServiceStartDate'] . '-1 day'));

        $streetname = $_POST['streetname'];
        $housenumber = $_POST['housenumber'];
        $postalcode = $_POST['postalcode'];
        $city = $_POST['city'];
        $srdate = $_POST['srdate'];
        $srtime = $_POST['srtime'];
        $comment = $_POST['comment'];

        if ($previousdate > date('Y-m-d H-i-s')) {

            $array = [
                "ServiceRequestId" => $selectedrequestid,
                "ServiceStartDate" => $srdate.' '.$srtime,
                "Comments" => $comment
            ];
    
            $array2 = [
                "AddressId" => $Address['AddressId'],
                "AddressLine1" => $streetname,
                "AddressLine2" => $housenumber,
                "PostalCode" => $postalcode,
                "City" => $city
            ];
            
            $this->model->reschedule_selected_service_request($array, $array2);
        } else {
            echo 1;
        }
    }
    public function fill_option()
    {
        $typeid1 = $_POST['typeid1'];
        $typeid2 = $_POST['typeid2'];
        $ans = $this->model->get_filter_option($typeid1, $typeid2);
        foreach ($ans as $row) {
        ?>
            <option value="<?php echo $row['FirstName'] . ' ' . $row['LastName'] ?>"><?php echo $row['FirstName'] . ' ' . $row['LastName'] ?></option>
        <?php
        }

    }
    public function service_schedule_sp()
    {
        $events=$this->model->getSPScheduledetail($_SESSION['UserId']);
        $data = array();
        function HourMinuteToDecimal($hour_minute) 
        {
            $t = explode(':', $hour_minute);
            return $t[0] * 60 + $t[1];
        }
        function DecimalToHoursMins($mins)
        {
            $h=(int)($mins/60);
            $m=round($mins%60);
            if($h<10){$h="0".$h;}
            if($m<10){$m="0".$m;}
            return $h.":".$m;
        }
        foreach ($events as $row) {

            $starttime=substr($row['ServiceStartDate'],11,5);
            $totalmins=HourMinuteToDecimal($starttime)+ (($row['ServiceHours']+$row['ExtraHours'])*60);
            $totaltime=DecimalToHoursMins($totalmins);

            if ($row['Status'] == '1') {
                $color = "#1d7a8c";
            }
            if ($row['Status'] == '2') {
                $color = "#5fec0e";
            }
            if ($row['Status'] == '3') {
                $color = "#db4c53";
            }
            $data[] = array(
                'id' => $row['ServiceId'],
                'title' => "$starttime" . " - " . "$totaltime",
                'start' => date("Y-m-d", strtotime($row['ServiceStartDate'])),
                'end' => date("Y-m-d", strtotime($row['ServiceStartDate'])),
                'color' => "$color"
            );
        }
        echo json_encode($data);
    }
    public function userfilter()
    {
        if($_POST['username']!='')
        {
            $username=explode(' ',$_POST['username']);
            $FirstName=$username[0];
            $LastName=$username[1];
        }
        else
        {
            $FirstName="";
            $LastName="";
        }
        $fromdate=$_POST['fromdate'];
        $todate=$_POST['todate'];
        $array=[
            "FirstName" => $FirstName,
            "LastName" => $LastName,
            "UserTypeId" => $_POST['usertype'],
            "Mobile" => $_POST['mobile'],
            "ZipCode" => $_POST['postalcode'],
            "fromdate" => $fromdate,
            "todate" => $todate
        ];
        $rows=$this->model->userfilter($array);
        function HourMinuteToDecimal($hour_minute) 
        {
            $t = explode(':', $hour_minute);
            return $t[0] * 60 + $t[1];
        }
        function DecimalToHoursMins($mins)
        {
            $h=(int)($mins/60);
            $m=round($mins%60);
            if($h<10){$h="0".$h;}
            if($m<10){$m="0".$m;}
            return $h.":".$m;
        }
        ?>
        <table class="table table-hover" id="tblusermanagement">
            <thead id="headings">
                <tr>
                    <th scope="col">User Name</th>
                    <th scope="col">Role </th>
                    <th scope="col"> Date of Registration</th>
                    <th scope="col">User Type</th>
                    <th scope="col">Phone </th>
                    <th scope="col">Postal Code</th>
                    <th scope="col" class="action">Status </th>
                    <th scope="col " class="action" >Actions </th>
                </tr>
            </thead>
        <tbody class="">
        <?php
        foreach($rows as $user)
        {
            ?>
                <tr>
                    <td><?php echo $user['FirstName']." ".$user['LastName']; ?></td>
                    <td></td>
                    <td><img class="calender" src="./assets/Image/calendar2.png"><?php echo substr($user['CreatedDate'],0,10) ?></td>
                    <td><?php if($user['UserTypeId']==1){ echo "Customer";} elseif($user['UserTypeId']==2){ echo "Service Provider"; } ?></td>
                    <td><?php echo $user['Mobile']; ?></td>
                    <td><?php echo $user['ZipCode']; ?></td>
                    <td class="action">
                        <?php 
                        if($user['IsActive']==0 && $user['IsApproved']==1)
                        {?>
                            <button class="btn inactive">Inactive</button>
                        <?php
                        }
                        elseif($user['IsActive']==1 && $user['IsApproved']==1)
                        {?>
                            <button class="btn active">Active</button>
                        <?php
                        }
                        elseif($user['IsApproved']==0){
                        ?>
                        <button class="btn approve">Not Approved</button>
                        <?php
                        }?>
                    </td>
                    <td class="action">
                        <a class="dropdown-toggle Actions " href="#" id="navbarDropdowns" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu tooltiptext" aria-labelledby="navbarDropdowns">
                            <?php 
                                if($user['IsActive']==0 && $user['IsApproved']==1)
                                {?>
                                    <a class="dropdown-item letactive" id="<?php echo $user['UserId']; ?>" href="#">Activate</a>
                                <?php
                                }
                                elseif($user['IsActive']==1 && $user['IsApproved']==1)
                                {?>
                                    <a class="dropdown-item letdeactive" id="<?php echo $user['UserId']; ?>" href="#">Deactivate</a>
                                <?php
                                }
                            ?>
                            <?php 
                                if($user['UserTypeId']==2 && $user['IsApproved']==0)
                                {?>
                                <a class="dropdown-item letapprove" id="<?php echo $user['UserId']; ?>" href="#">Approve</a>
                                <?php
                                }
                            ?>
                        </div>
                    </td>          
                </tr>
            <?php
        }
        ?>
            </tbody>
        </table>
        <?php

    }
    public function requestfilter()
    {
        $customer=$_POST['customer'];
        $sp=$_POST['sp'];
        $fromdate=$_POST['fromdate'];
        $todate=$_POST['todate'];
        $array=[
            "ServiceRequestId" => $_POST['serviceid'],
            "ZipCode" => $_POST['postalcode'],
            "Customer" => $customer,
            "SP" => $sp,
            "Status" => $_POST['status'],
            "fromdate" => $fromdate,
            "todate" => $todate
        ];
        $rows=$this->model->requestfilter($array);
        function HourMinuteToDecimal($hour_minute) 
        {
            $t = explode(':', $hour_minute);
            return $t[0] * 60 + $t[1];
        }
        function DecimalToHoursMins($mins)
        {
            $h=(int)($mins/60);
            $m=round($mins%60);
            if($h<10){$h="0".$h;}
            if($m<10){$m="0".$m;}
            return $h.":".$m;
        }
        ?>
        <table class="table table-hover" id="tblSRreq">
            <thead id="headings">
                <tr>
                    <th scope="col">Service Id</th>
                    <th scope="col">Service Date</th>
                    <th scope="col"> Customer Details</th>
                    <th scope="col">Service Provider</th>
                    <th scope="col">Net Amount</th>
                    <th scope="col">Status</th>
                    <th scope="col">Payment Status </th>
                    <th scope="col " >Actions </th>
                </tr>
            </thead>
            <tbody class="">
        <?php
        foreach($rows as $SR)
        {
            $dt=substr($SR['ServiceStartDate'],0,10);
            $tm=substr($SR['ServiceStartDate'],11,5);
            $totalmins=HourMinuteToDecimal($tm)+ (($SR['ServiceHours']+$SR['ExtraHours'])*60);
            $totime=DecimalToHoursMins($totalmins);
            $SRAdd=$this->model->getSRAddbySRId($SR['ServiceRequestId']);
            $customer=$this->model->getUserbyId($SR['UserId']);
            $SP=$this->model->getUserbyId($SR['ServiceProviderId']);
            $customeraddress=$this->model->getAddressbyId($SRAdd['AddressId']);
            ?>
                <tr>
                    <td><?php echo $SR['ServiceRequestId']; ?></td>
                    <td>
                        <div><img src="./assets/Image/calendar2.png"><?php echo $dt; ?></div>
                        <div><img src="./assets/Image/layer-14.png"><?php echo $tm."-".$totime; ?></div>
                    </td>
                    <td>
                        <div><?php echo $customer['FirstName']." ".$customer['LastName']; ?></div>
                        <divp><img src="./assets/Image/layer-719.png"><?php echo $customeraddress['AddressLine1'].",".$customeraddress['AddressLine2'].","; ?></divp>
                        <div><?php echo $customeraddress['City'].",".$customeraddress['PostalCode']."."; ?></div>
                    </td>
                    <td><?php if(isset($SR['ServiceProviderId'])){ echo $SP['FirstName']." ".$SP['LastName'];} ?></td>
                    <td>&euro;<?php echo $SR['TotalCost']; ?></td>
                    <td class="action">
                        <?php  
                         if($SR['Status']==1)
                         {?>
                            <button class="btn pending"><b>New</b></button>
                         <?php
                         }
                         elseif($SR['Status']==2)
                         {?>
                             <button class="btn complete"><b>Completed</b></button>
                         <?php
                         }
                         elseif($SR['Status']==3)
                         {?>
                              <button class="btn cancel"><b>Cancelled</b></button>
                         <?php
                         }
                        ?>
                    </td>
                    <td class="action"></td>
                    <td class="action">
                        <a class="dropdown-toggle Actions " href="#" id="navbarDropdowns" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu tooltiptext" aria-labelledby="navbarDropdowns">
                            <?php if($SR['Status']==1) {  ?>
                                <a class="dropdown-item editreschedule" id="<?php echo $SR['ServiceRequestId']; ?>"  data-toggle="modal" data-target="#editreschedule">Edit & Reschedule</a>
                                <a class="dropdown-item cancelrq" id="<?php echo $SR['ServiceRequestId']; ?>" href="#" >Cancel SR By Customer</a>
                            <?php }  ?>
                            <a class="dropdown-item editreschedule" href="#" >Inquiry</a>
                            <a class="dropdown-item editreschedule" href="#" >History Log</a>
                            <a class="dropdown-item editreschedule" href="#" >Download Invoice</a>
                            <a class="dropdown-item editreschedule" href="#" >Other Transactions</a>
                        </div>
                    </td>
                </tr>
            <?php
        }
        ?>
            </tbody>
        </table>
        <?php
    }
    public function favpro()
    {
        $row=$this->model->custhistory($_SESSION['UserId']);
        foreach($row as $rq)
        {
            $sp= $this->model->getUserbyId($rq['ServiceProviderId']);
            $num_of_cleanings=$this->model->cleanings($_SESSION['UserId'],$rq['ServiceProviderId']);
            $rates=$this->model->rate($rq['ServiceProviderId']);
                $j=0;
                $totalrate=0;
                if($rates==NULL)
                {
                    $avrrate=0;
                }
                else
                {
                    foreach($rates as $rate)
                    {
                        $totalrate+=$rate['Ratings'];
                        $j++;
                    }
                    if($j == 0)
                    {
                        $avrrate=$totalrate;
                    }
                    else
                    {
                        $avrrate=$totalrate/$j;
                    }
                }
            ?>
            <div class="card">
                <div class="customer-image"><img src="<?php echo $sp['UserProfilePicture']; ?>" alt=""></div>
                <div class="customer-name"><b><?php echo $sp['FirstName']." ".$sp['LastName']; ?></b></div>
                <div class="row rates justify-content-center">
                    <div class="rateyo fav" id= "rating"  data-rateyo-rating="<?php echo $avrrate; ?>"></div>
                    <div><?php echo round($avrrate,1); ?></div>
                </div>
                <div class="cleanings text-center mb-2"><span><?php echo $num_of_cleanings; ?> Cleanings</span></div>
                <div class="block-unblock-button">
                    <?php
                    $checkfav = $this->model->checkfav($_SESSION['UserId'],$rq['ServiceProviderId']);
                    if ($checkfav== null) {
                    ?>
                        <button class="add-button addfav" id="<?php echo $rq['ServiceProviderId']; ?>">Add</button>
                    <?php
                    } else {
                    ?>
                        <button class="remove-button removefav" id="<?php echo $rq['ServiceProviderId']; ?>">Remove</button>
                    <?php
                    }
                    $checkblock = $this->model->checkblocked($rq['ServiceProviderId'],$_SESSION['UserId']);
                    if ($checkblock == null) {
                    ?>
                        <button class="block-button" id="<?php echo $rq['ServiceProviderId']; ?>">Block</button>
                    <?php
                    } else {
                    ?>
                        <button class="unblock-button" id="<?php echo $rq['ServiceProviderId']; ?>">Unblock</button>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php
        }
    }
    public function favpro_booking()
    {
        $row=$this->model->favpro_list($_SESSION['UserId']);
        foreach($row as $data)
        {
            $SP=$this->model->getUserbyId($data['TargetUserId']);
        ?>
        <div class="card">
            <div class="customer-image"><img src="<?php echo $SP['UserProfilePicture']; ?>" alt=""></div>
            <div class="customer-name"><b><?php echo $SP['FirstName']." ".$SP['LastName']; ?></b></div>
            <div class="block-unblock-button">
                <button class="add-button" id="<?php echo $data['TargetUserId']; ?>">Select</button>
            </div>
        </div>
        <?php
        }
        
    }
}
?>