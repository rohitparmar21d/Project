<?php include('./header.php'); 

$base_url = "http://localhost/Helperland/";
?>


<link rel="stylesheet" href="./assets/css/SP.css">


<title>Service Provider</title>
</head>

<body>
    <header>
        <?php include('./navbar.php'); ?>
    </header>
    <!--Service detail Modal-->
    <div class="modal fade" id="servicedetailmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" id="mod" role="document">
            <div class="modal-content SD">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Service Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="register-inputs  me-0 ms-0">
                            <div class="row">
                                <div><span class="service-datetime">05/10/2021&nbsp;8:00 - 11:30</span></div>
                            </div>
                            <div class="row">
                                <div><span class="service-detail">Duration: </span></div>
                                <div class="service-detail-text"><span> 3.5 Hrs</span></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div><span class="service-detail">Service Id: </span></div>
                                <div class="service-detail-text"><span> 123</span></div>
                            </div>
                            <div class="row">
                                <div><span class="service-detail">Extras: </span></div>
                                <div class="service-detail-text"><span> Inside cabinets</span></div>
                            </div>
                            <div class="row">
                                <div><span class="service-detail">Net Amount: </span></div>
                                <div class="service-detail-euro">span> &euro; 87.5</span></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div><span class="service-detail">Service Address: </span></div>
                                <div class="service-detail-text"><span> rajnagar-5, 360003 Rajkot</span></div>
                            </div>
                            <div class="row">
                                <div><span class="service-detail">Billing Address: </span></div>
                                <div class="service-detail-text"><span> rajnagar-5, 360003 Rajkot</span></div>
                            </div>
                            <div class="row">
                                <div><span class="service-detail">Phone: </span></div>
                                <div class="service-detail-text"><span> 9849389349</span></div>
                            </div>
                            <div class="row">
                                <div><span class="service-detail">Email: </span></div>
                                <div class="service-detail-text"><span> ksfds12@gmail.com</span></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div><span class="service-detail">Comments: </span></div>
                                <div class="service-detail-text"><span> service is good.</span></div>
                            </div>
                            <div class="row">
                                <div><span><i class="fas fa-times-circle"></i> </span></div>
                                <div class="service-detail-text"><span> I don't have pets at home</span></div>
                            </div>
                            <button name="submit" class="btn btn-accept" data-toggle="modal" data-bs-target="#reschedule_modal"><i class="fas fa-solid fa-check"></i></i>&nbsp; Accept</button>
                        </div>
                        <div><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14686.79219931298!2d72.5004358!3d23.0348564!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xdc9d4dae36889fb9!2sTatvaSoft!5e0!3m2!1sen!2sin!4v1639749098244!5m2!1sen!2sin" allowfullscreen="" loading="lazy" class="map"></iframe></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--reschedule modal-->
    <!-- <div class="modal fade" id="reschedule_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">Reschedule Service Request</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="register-inputs me-0 ms-0">
                        <label class="cancel-question "><b>Select New Date and Time</b></label>
                        <div class="row">
                            <div class="col-sm-6">
                                <input class="input-element rescheduledate" type="date" id="formdate" name="formdate" data placeholder="From Date">                   
                            </div>
                            <div class="col-sm-6">
                                <select name="booktime" class="rescheduletime" id="booktime">
                                    <option value=0>00:00</option>
                                    <option value="3:00">3:00 PM</option>
                                    <option value="4:00">4:00 PM</option>
                                    <option value="5:00">5:00 PM</option>
                                    <option value="6:00">6:00 PM</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-update">Update</button>
                </div>
            </div>
        </div>
    </div> -->

    <!--cancel-->
    <!-- <div class="modal fade" id="cancel_bookingrequest_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle"><b>Cancel Service Request</b></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="register-inputs me-0 ms-0">
                        <label class="cancel-question temp"><b>Why you want to cancel the service request?</b></label>
                        <textarea class="why-cancel" name="whycancel"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button name="submit" class="btn btn-cancelnow">Cancel Now</button>
                </div>
            </div>
        </div>
    </div> -->

    <!--Rate SP-->
    <!-- <div class="modal fade" id="ratesp_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content ratesp">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">
                        <div class="d-flex align-items-center justify-content-left">
                            <div>
                                <img class="round-border" src="./assets/Image/forma-1-copy-19.png" alt="cap">
                            </div>
                            <div class="ps-2">
                                <p class="sp-details">Lyum Watson</p>
                                <p class="sp-details">
                                    <img src="./assets/Image/star1.png" alt="star">
                                    <img src="./assets/Image/star1.png" alt="star">
                                    <img src="./assets/Image/star1.png" alt="star">
                                    <img src="./assets/Image/star1.png" alt="star">
                                    <img src="./assets/Image/star2.png" alt="star">
                                    <span>3.67</span>
                                </p>
                            </div>
                        </div>
                    </h3>y
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
                            <img src="./assets/Image/star1.png" alt="star">
                                    <img src="./assets/Image/star1.png" alt="star">
                                    <img src="./assets/Image/star1.png" alt="star">
                                    <img src="./assets/Image/star1.png" alt="star">
                                    <img src="./assets/Image/star2.png" alt="star">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <label class="subtext">Friendly</label>
                            </div>
                            <div class="col-sm-7">
                            <img src="./assets/Image/star1.png" alt="star">
                                    <img src="./assets/Image/star1.png" alt="star">
                                    <img src="./assets/Image/star1.png" alt="star">
                                    <img src="./assets/Image/star1.png" alt="star">
                                    <img src="./assets/Image/star2.png" alt="star">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <label class="subtext">Quality of service</label>
                            </div>
                            <div class="col-sm-7">
                            <img src="./assets/Image/star1.png" alt="star">
                                    <img src="./assets/Image/star1.png" alt="star">
                                    <img src="./assets/Image/star1.png" alt="star">
                                    <img src="./assets/Image/star1.png" alt="star">
                                    <img src="./assets/Image/star2.png" alt="star">
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
                <div class="modal-footer">
                    <button name="submit" class="btn btn-ratesp-submit">Submit</button>
                </div>
            </div>
        </div>
    </div> -->

     <!--section-2-1--> 
     <section class="section-2-1">
     <div class="container">
        <h2 class="text-center">
         Welcome, <strong> <?php echo $_SESSION['name']; ?> !</strong>
        </h2> 
     </div>
    </section>
     <!--section-2-2-->
     <div class="loading d-none">Loading&#8230;</div>
    <section class="section-2-2">
        <div class="row dashboard justify-content-center" id="dashboard">
            <!-- left nav -->
            <div class="col-3">
                <div class="nav flex-column nav-pills leftsidebar" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-newservicerequest-tab" data-toggle="pill" href="#v-pills-newservicerequest" role="tab" aria-controls="v-pills-newservicerequest" aria-selected="true">New Service Requests</a>
                    <a class="nav-link" id="v-pills-upcomingservices-tab" data-toggle="pill" href="#v-pills-upcomingservices" role="tab" aria-controls="v-pills-upcomingservices" aria-selected="false">Upcoming Services</a>
                    <a class="nav-link" id="v-pills-serviceschedule-tab" data-toggle="pill" href="#v-pills-serviceschedule" role="tab" aria-controls="v-pills-serviceschedule" aria-selected="false">Service Schedule</a>
                    <a class="nav-link" id="v-pills-servicehistory-tab" data-toggle="pill" href="#v-pills-servicehistory" role="tab" aria-controls="v-pills-servicehistory" aria-selected="false">Service History</a>
                    <a class="nav-link" id="v-pills-myratings-tab" data-toggle="pill" href="#v-pills-myratings" role="tab" aria-controls="v-pills-myratings" aria-selected="false">My Ratings</a>
                    <a class="nav-link" id="v-pills-bolckcustomer-tab" data-toggle="pill" href="#v-pills-bolckcustomer" role="tab" aria-controls="v-pills-bolckcustomer" aria-selected="false">Block Customer</a>
                    <a class="nav-link" id="v-pills-invoices-tab" data-toggle="pill" href="#v-pills-invoices" role="tab" aria-controls="v-pills-invoices" aria-selected="true">Invoices</a>
                    <a class="nav-link" id="v-pills-notifications-tab" data-toggle="pill" href="#v-pills-notifications" role="tab" aria-controls="v-pills-notifications" aria-selected="false">Notifications</a>
                    <a class="nav-link" id="v-pills-notification-tab" data-toggle="pill" href="#v-pills-notification" role="tab" aria-controls="v-pills-notification" aria-selected="false">Notifications</a>
                    
                </div>
            </div>
            <!-- ended nav -->
            <!-- content -->
            <div class="col-9" id="rightside">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade" id="v-pills-newservicerequest" role="tabpanel" aria-labelledby="v-pills-newservicerequest-tab">
                        <div class="container-fluid row justify-content-right">
                            <div class=" "><span class="serarea">Service Area</span></div>
                            <select name="serareadropdown" class="serareadropdown" id="serareadropdown">
                                <option value=5 >5 KM</option>
                                <option value="10">10 KM</option>
                                <option value="15">15 KM</option>
                                <option value="20">20 KM</option>
                                <option value="25" selected>25 KM</option>
                            </select>
                            <div class="haspet">
                                <input type="checkbox" class="checkbox pet">
                                <label class="checkbox-text" for="pet">Include Pet at home</label>
                            </div>
                        </div>
                        <div class="container-fluid row db" > 
                            <div class="col">
                                <table  class="table table-hover">
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
                                        <!-- 1st row start-->
                                        <!-- <tr class="t-row" data-toggle="modal" data-target="#servicedetailmodal">
                                            <td><p>2323</p></td>
                                            <td>
                                                <p class="date"><img src="./assets/Image/calendar2.png"> 09/04/2018</p>
                                                <p><img src="./assets/Image/layer-14.png"> 12:00 - 18:00</p>
                                            </td>
                                            <td> 
                                                <p>David Bough</p>
                                                <p><img src="./assets/Image/layer-719.png"> Musterstrabe 5,12345 Bonn</p>
                                            </td>
                                            <td>
                                                <p class="euro d-flex justify-content-center">&euro; 63</p>
                                            </td>
                                            <td><p></p></td>
                                            <td ><button  class="btn accept-btn">Accept</button></td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-upcomingservices" role="tabpanel" aria-labelledby="v-pills-upcomingservices-tab">
                        <div class="container-fluid row" id="rightsidebar"> 
                            <div class="col" >
                                <table id="content-table" class="table table-hover">
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
                                    <tbody class="upcoming">
                                        <!--1st row start-->
                                        <!-- <tr class="t-row" data-toggle="modal" data-target="#servicedetailmodal" >
                                            <td><p>2323</p></td>
                                            <td>
                                                <p class="date"><img src="./assets/Image/calendar2.png"> 09/04/2018</p>
                                                <p><img src="./assets/Image/layer-14.png"> 12:00 - 18:00</p>
                                            </td>
                                            <td> 
                                                <p>David Bough</p>
                                                <p><img src="./assets/Image/layer-719.png"> Musterstrabe 5,12345 Bonn</p>
                                            </td>
                                            <td>
                                                <p class="euro d-flex justify-content-center">&euro; 63</p>
                                            </td>
                                            <td><p>15 Km</p></td>
                                            <td ><button  class="cancel-btn">Cancel</button></td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-serviceschedule" role="tabpanel" aria-labelledby="v-pills-serviceschedule-tab">
                        nbfgkjs
                    </div>
                    <div class="tab-pane fade" id="v-pills-servicehistory" role="tabpanel" aria-labelledby="v-pills-servicehistory-tab">
                        <div class="container-fluid row">
                            <div class="mr-auto"><span class="serarea">Payment Status</span></div>
                            <select name="serareadropdown" class="paymentstatus mr-auto" id="PaymentStatus" disabled>
                                <option value=5 >All</option>
                                <option value="10">Pendimg</option>
                                <option value="15">Completed</option>>
                            </select>
                            <a class="btn ml-auto export text-white">Export</a>
                        </div>
                        <div class="container-fluid row" > 
                            <div class="col">
                                <table  class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Service Id </th>
                                            <th >Service Date </th>
                                            <th >Customer Details </th>
                                        </tr>
                                    </thead>
                                    <tbody class=" sphistory">
                                        <!--1st row start-->
                                        <!-- <tr class="t-row">
                                            <td>2323</td>
                                            <td>
                                                <div class="date"><img src="./assets/Image/calendar.png"> 31/03/2018</div>
                                                <div>12:00 - 18:00</div>
                                            </td>
                                            <td>
                                                <div>David Bough</div>
                                                <div><img src="./assets/Image/layer-719.png"> Musterstrabe 5,12345 Bonn</div> 
                                            </td>
                                        </tr> -->
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-myratings" role="tabpanel" aria-labelledby="v-pills-myratings-tab">.ratings..</div>
                    <div class="tab-pane fade" id="v-pills-bolckcustomer" role="tabpanel" aria-labelledby="v-pills-bolckcustomer-tab">..block.</div>
                    <div class="tab-pane fade" id="v-pills-invoices" role="tabpanel" aria-labelledby="v-pills-invoices-tab">.invoice..</div>
                    <div class="tab-pane fade" id="v-pills-notifications" role="tabpanel" aria-labelledby="v-pills-notifications-tab">..notification.</div>
                    <div class="tab-pane fade  show active" id="v-pills-notification" role="tabpanel" aria-labelledby="v-pills-notification-tab">
                        <div class="customer-table mysetting">
                            <div class="d-flex align-items-center justify-content-center">
                                <button class="btn btn-setting details active">My Details</button>
                                <button class="btn btn-setting password">Change Password</button>
                            </div>
                            <div class="button-body">
                                <div class="details-body">
                                    <div class="row">
                                        <div class="col-md-12 tags"><b>Basic Details</b></div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="fname">First name</label><br>
                                            <input type="text" class="input" name="fname" placeholder="First name">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="lname">Last name</label><br>
                                            <input type="text" class="input" name="lname" placeholder="Last name">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email">E-mail address</label><br>
                                            <input type="email" class="input" name="email" placeholder="E-mail address">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="mobile">Mobile number</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">+49</span>
                                                <input type="text" name="mobile" placeholder="Mobile number" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="birthdate">Date of Birth</label><br>
                                            <input class="input-element birthdate" type="date" id="birthdate" name="dob" data placeholder="From Date">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="nationality">Nationality</label><br>
                                            <select name="language" id="nationality" required>
                                                <option value="German">German</option>
                                                <option value="Indian">Indian</option>
                                                <option value="African">African</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="streetname">Gender</label><br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-check gender">
                                            <input class="form-check-input" type="radio" name="male" id="male" value="Male" checked>
                                            <label class="form-check-label" for="male">Male</label>
                                        </div>
                                        <div class="form-check gender">
                                            <input class="form-check-input" type="radio" name="female" id="female" value="Female">
                                            <label class="form-check-label" for="female">Female</label>
                                        </div>
                                        <div class="form-check gender">
                                            <input class="form-check-input" type="radio" name="nottosay" id="nottosay" value="Rather not to say">
                                            <label class="form-check-label" for="nottosay">Rather not to say</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 tags"><b>My Address</b></div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="streetname">Street Name</label><br>
                                            <input type="text" class="input" name="streetname" placeholder="Street Name">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="housenum">House Number</label><br>
                                            <input type="text" class="input" name="housenum" placeholder="House Number">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="postalcode">Postal Code</label><br>
                                            <input type="email" class="input" name="postalcode" placeholder="Postal Code">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="city">City</label><br>
                                            <input type="text" class="input" name="city" placeholder="City">
                                        </div>
                                    </div>
                                    <hr>
                                    <div><button class="details-save">Save</button></div>
                                </div>
                                <div class="password-body">
                                    <div class="password_error text-danger"></div>
                                    <div>
                                        <label class="password-label" for="oldpassword">Old Password</label> <br>
                                        <input class="password-input" type="password" name="oldpassword" placeholder="Current Pasword">
                                    </div>
                                    <div>
                                        <label class="password-label" for="newpassword">New Password</label> <br>
                                        <input class="password-input" type="password" name="newpassword" placeholder="Password">
                                    </div>
                                    <div>
                                        <label class="password-label" for="confirmpassword">Confirm Password</label> <br>
                                        <input class="password-input" type="password" name="confirmpassword" placeholder="Confirm Password">
                                    </div>
                                    <div><button class="password-save">Save</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--content ended -->
        </div>
    </section>
    
    <?php include('./footer.php'); ?>
    <script src="./assets/js/SP.js"></script>
        <script src="./assets/js/session.js"></script>
    
    
</body>
</html>