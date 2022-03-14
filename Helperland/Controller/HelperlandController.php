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
            $customer = "http://localhost/Helperland/Customer";
            $sp = "http://localhost/Helperland/SP";
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
        {  
            
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
        $list=$this->model->service_history($_SESSION['UserId']);
        $filename='Service_History.csv';
        $file = fopen($filename,"w");
        foreach ($list as $line)
        {
            fputcsv($file,$line);
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
        $list=$this->model->newservicesrequests($_SESSION['UserId']);
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
    }
    public function acceptrequest()
    {
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
            <td ><button id="<?php echo $rq['ServiceRequestId']; ?>" class="cancel-btn">Cancel</button><button id="<?php echo $rq['ServiceRequestId']; ?>" class="complete-btn">Complete</button>
        </td>
        </tr>
        <?php
        }
    }
    public function cancelrequest()
    {
        $SR=$this->model->SRByreqId($_POST['reqId']);
        $SP= $this->model->getUserbyId($SR['ServiceProviderId']);
        $customer=$this->model->getUserbyId($SR['UserId']);

        $this->model->cancelrequest($_POST['reqId']);

        $to_email = $customer['Email'];
        $subject = "Your SERVICE REQUEST is Cancelled";
        $body = "Your Service Request ID  ".$_POST['reqId']." is Cancelled  By " .$SP['FirstName']."  ".$SP['LastName'].". we'll notify you when other sevice provider  will your request ";
        $headers = "From: rohit1parmar11@gmail.com";
        mail($to_email, $subject, $body, $headers);
        
    } 
    public function completerequest()
    {
        $this->model->completerequest($_POST['reqId']);
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
    }
}
?>