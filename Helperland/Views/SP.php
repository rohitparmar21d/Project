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
    <div class="modal fade" id="servicedetailmodal_remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <a class="nav-link" id="v-pills-invoices-tab" data-toggle="pill" href="#v-pills-invoices" role="tab" aria-controls="v-pills-invoices" aria-selected="true" disabled>Invoices</a>
                    <a class="nav-link" id="v-pills-notifications-tab" data-toggle="pill" href="#v-pills-notifications" role="tab" aria-controls="v-pills-notifications" aria-selected="false" disabled>Notifications</a>
                </div>
            </div>
            <!-- ended nav -->
            <!-- content -->
            <div class="col-9" id="rightside">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade  show active" id="v-pills-newservicerequest" role="tabpanel" aria-labelledby="v-pills-newservicerequest-tab">
                        <div class="container-fluid row justify-content-right">
                            <div class=" "><span class="serarea">Service Area</span></div>
                            <select name="serareadropdown" class="serareadropdown" id="serareadropdown" disabled>
                                <option value=5 >5 KM</option>
                                <option value="10">10 KM</option>
                                <option value="15">15 KM</option>
                                <option value="20">20 KM</option>
                                <option value="25" selected>25 KM</option>
                            </select>
                            <div class="haspet">
                                <input type="checkbox" class="checkbox pet" id="pet">
                                <label class="checkbox-text" for="pet">Include Pet at home</label>
                            </div>
                        </div>
                        <div class="container-fluid row db" > 
                            <div class="col">
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
                    <div class="tab-pane fade" id="v-pills-serviceschedule" role="tabpanel" aria-labelledby="v-pills-serviceschedule-tab"> nbfgkjs</div>
                    <div class="tab-pane fade" id="v-pills-servicehistory" role="tabpanel" aria-labelledby="v-pills-servicehistory-tab">
                        <div class="container-fluid row">
                            <div class="mr-auto"><span class="serarea">Payment Status</span></div>
                            <select name="serareadropdown" class="paymentstatus mr-auto" id="PaymentStatus" disabled>
                                <option value=5 >All</option>
                                <option value="10">Pendimg</option>
                                <option value="15">Completed</option>>
                            </select>
                            <form method="POST" action="http://localhost/Helperland/?controller=Helperland&function=exporthistory_sp">
                                <button type="submit" class="btn ml-auto export" id="export">Export</button>
                            </form>
                        </div>
                        <div class="container-fluid row" > 
                            <div class="col">
                                <table  class="table table-hover" id="sphistory">
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
                    <div class="tab-pane fade sp-ratings-body" id="v-pills-myratings" role="tabpanel" aria-labelledby="v-pills-myratings-tab">
                        <div class="container-fluid row justify-content-right">
                            <div class=" "><span class="serarea">Ratings</span></div>
                            <select name="serareadropdown" class="serareadropdown" id="serareadropdown" disabled>
                                <option value=5 >5 KM</option>
                                <option value="10">10 KM</option>
                                <option value="15">15 KM</option>
                                <option value="20">20 KM</option>
                                <option value="25" selected>All</option>
                            </select>
                        </div>
                        <table id="tablerating" class="table display">
                            <thead class="d-none"><th>details</th></thead>
                            <tbody class="sprate">
                                <!-- <tr class="mt-20 pt-20">
                                    <td>
                                        <div class="rate-detail">
                                            <div class="rate-content">
                                                <div>2323</div>
                                                <div><b>Rohit Parmar</b></div>
                                            </div>
                                            <div class="rate-content">
                                                <div>
                                                    <img src="./assets/Image/layer-712.png" alt="clock">&nbsp; <span><b>23/12/2020</b></span><br>
                                                    <img src="./assets/Image/calendar2.png" alt="calendar">&nbsp; <span> 19:20 to 19:30 </span>
                                                </div>
                                            </div>
                                            <div class="rate-content">
                                                <div><b>ratings</b></div>
                                                <div class="rate-detail">
                                                    <div class="rateyo pe-0 ps-0" id="rating" data-rateyo-rating="4"></div>
                                                    <div>good</div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div>
                                            <div><b>Customer Comment</b></div>
                                            <div>kjgsdjhgjkfkjsdkf</div>
                                        </div>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade block-card sp-block-customer-body" id="v-pills-bolckcustomer" role="tabpanel" aria-labelledby="v-pills-bolckcustomer-tab">
                        <div class="card-customer">
                            <!-- <div class="card">
                                <div class="customer-image"><img src="./assets/Image/forma-1-copy-19.png" alt=""></div>
                                <div class="customer-name"><b>Rohit Parmar</b></div>
                                <div class="block-unblock-button">
                                    <button class="block-button">Block</button>
                                </div>
                            </div>
                            <div class="card">
                                <div class="customer-image"><img src="./assets/Image/forma-1-copy-19.png" alt=""></div>
                                <div class="customer-name"><b>Rohit Parmar</b></div>
                                <div class="block-unblock-button">
                                    <button class="block-button">Block</button>
                                </div>
                            </div>
                            <div class="card">
                                <div class="customer-image"><img src="./assets/Image/forma-1-copy-19.png" alt=""></div>
                                <div class="customer-name"><b>Rohit Parmar</b></div>
                                <div class="block-unblock-button">
                                    <button class="block-button">Block</button>
                                </div>
                            </div>
                            <div class="card">
                                <div class="customer-image"><img src="./assets/Image/forma-1-copy-19.png" alt=""></div>
                                <div class="customer-name"><b>Rohit Parmar</b></div>
                                <div class="block-unblock-button">
                                    <button class="block-button">Block</button>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-invoices" role="tabpanel" aria-labelledby="v-pills-invoices-tab" disabled>.invoice..</div>
                    <div class="tab-pane fade" id="v-pills-notifications" role="tabpanel" aria-labelledby="v-pills-notifications-tab" disabled>..notification.</div>
                    <div class="tab-pane fade " id="v-pills-notification" role="tabpanel" aria-labelledby="v-pills-notification-tab">
                        <div class="customer-table mysetting">
                            <div class="d-flex align-items-center justify-content-center">
                                <button class="btn btn-setting details active">My Details</button>
                                <button class="btn btn-setting password">Change Password</button>
                            </div>
                            <div class="button-body">
                                <div class="details-body">
                                    <div class="sp-details-body">
                                        <!-- <div class="d-flex align-items-center pb-2">
                                            <div><b>Account Status:</b></div>
                                            <div class="ps-2 active">Active</div>
                                        </div>
                                        <div class="row">
                                            <div class="sp-basic col-md-12">
                                                <b>Basic details</b>
                                                <hr class="sp-breakline">
                                                <div class="sp-avatar"><img src="./assets/Image/cap.png" alt=""></div>
                                            </div>
                                        </div>
                                        <div class="d-none row">
                                            <div class="col-md-12"><label class="label text-danger sp-error-message"></label></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="label" for="spfname">First name</label><br>
                                                <input type="text" class="input" name="spfname" placeholder="First name" required value="">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="label" for="splname">Last name</label><br>
                                                <input type="text" class="input" name="splname" placeholder="Last name" required value="">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="label" for="spemail">E-mail address</label><br>
                                                <input type="email" class="input" name="spemail" disabled placeholder="E-mail address" required value="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="label" for="spmobile">Mobile number</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1">+49</span>
                                                    <input type="text" name="spmobile" placeholder="Mobile number" value="" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="label" for="spdob">Date of Birth</label><br>
                                                <input type="date" class="input" name="spdob" required value="">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="label" for="spnationality">Nationality</label><br>
                                                <select name="spnationality" id="spnationality">
                                                    <option disabled selected value> -- select an option -- </option>
                                                    <option value="1" >German</option>
                                                    <option value="2" >Italian</option>
                                                    <option value="3" >British</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="label" for="splanguage">Language</label><br>
                                                <select name="splanguage" id="splanguage" required>
                                                    <option disabled selected value> -- select an option -- </option>
                                                    <option value="1" >German</option>
                                                    <option value="2" >English</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="label" for="spgender">Gender</label><br>
                                            <div class="gender col-md-6">
                                                <div>
                                                    <input type="radio" id="male" name="male" value="1" checked>
                                                    <label for="male">Male</label>
                                                </div>
                                                <div>
                                                    <input type="radio" id="female" name="female" value="2" >
                                                    <label for="female">Female</label>
                                                </div>
                                                <div>
                                                    <input type="radio" id="notsay" name="notsay" value="0">
                                                    <label for="notsay">Rather not to say</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="label" for="avatar">Select Avatar</label><br>
                                                <div class="choose-avatar">
                                                    <div class="avatar-image"><img id="avatar1" src="./assets/Image/avatar-car.png" alt=""></div>
                                                    <div class="avatar-image"><img id="avatar2" src="./assets/Image/avatar-female.png" alt=""></div>
                                                    <div class="avatar-image"><img id="avatar3" src="./assets/Image/avatar-hat.png" alt=""></div>
                                                    <div class="avatar-image"><img id="avatar4" src="./assets/Image/avatar-iron.png" alt=""></div>
                                                    <div class="avatar-image"><img id="avatar5" src="./assets/Image/avatar-male.png" alt=""></div>
                                                    <div class="avatar-image"><img id="avatar6" src="./assets/Image/avatar-ship.png" alt=""></div>
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
                                                <input type="text" class="input" name="spstreetname" placeholder="street name" required value="">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="label" for="sphousenumber">House number</label><br>
                                                <input type="text" class="input" name="sphousenumber" placeholder="house number" required value="">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="label" for="sppostalcode">Postal code</label><br>
                                                <input type="email" class="input" name="sppostalcode" placeholder="postalcode" required value="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="label" for="spcity">City</label><br>
                                                <input type="text" class="input" name="spcity" placeholder="city" required value="">
                                            </div>
                                        </div>
                                        <div>
                                            <button type="submit" class="sp-details-save">Save</button>
                                        </div> -->
                                    </div>
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