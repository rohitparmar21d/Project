
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--script src="https://www.google.com/recaptcha/api.js" async defer></script-->
    <link rel="stylesheet" href="./assets/css/footer.css">
    <link rel="stylesheet" href="./assets/css/validation.css">
    <?php
    if(!isset($_SESSION))
    {
        session_start();
    }
     if (!isset($_SESSION['loggedin'])) { ?>
        <link rel="stylesheet" href="./assets/css/navbar.css">
    <?php  } ?>
    <?php if (isset($_SESSION['loggedin'])) { ?>
        <link rel="stylesheet" href="./assets/css/loginnav.css">
    <?php
    } ?>


<link rel="stylesheet" href="./assets/css/bookservice.css">

<title>Book Service</title>

</head>
<body>
    <header>
        <?php include('./navbar.php'); ?>
        
    </header>
    <section>
        <img src="./assets/Image/book-service-banner.jpg" class="img-fluid price-banner" alt="Responsive image">
    </section>
    <!--section-2-->
    <section class="section-2 container-fluid">
      <div class="text-center ">
        <h1>Set up your cleaning service</h1>
      </div>
      <div class="row justify-content-center">
        <div class="Rectangle-5-copy-5"></div>
        <img src="./assets/Image/forma-1-copy-5.png" alt="">
        <div class="Rectangle-5-copy-6"></div>
       </div>
    </section> 
    <!--tab and accodian-->


    <section class="book-service" id="book-service">
        <div class="max-width">
            <div class="bookservice-content container">
               
                <div class="bookservice-area row">
                    <div class="bookservice-details col-md-8 col-sm-12">
                        <div class="faq-tab mb-60">
                            <ul class="nav nav-pills nav-fill mb-3 justify-content-center" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active " id="pills-SetupService-tab" data-bs-toggle="pill" 
                                    data-bs-target="#pills-SetupService" type="button" role="tab" aria-controls="pills-SetupService" 
                                    aria aria-selected="true">
                                        <img class="black" src="./assets/Image/setup-service.png" alt="">
                                        <img class="white" src="./assets/Image/setup-service-white.png" alt="">
                                        Setup Service
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link disabled " id="pills-SchedulePlan-tab" data-bs-toggle="pill" 
                                    data-bs-target="#pills-SchedulePlan" type="button" role="tab" aria-controls="pills-SchedulePlan" 
                                    aria aria-selected="false">
                                        <img class="black" src="./assets/Image/schedule.png" alt="">
                                        <img class="white" src="./assets/Image/schedule-white.png" alt="">
                                        Schedule & Plan
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link disabled " id="pills-YourDetails-tab" data-bs-toggle="pill" 
                                    data-bs-target="#pills-YourDetails" type="button" role="tab" aria-controls="pills-YourDetails" 
                                    aria aria-selected="false">
                                        <img class="black" src="./assets/Image/details.png" alt="">
                                        <img class="white" src="./assets/Image/details-white.png" alt="">
                                        Your Details
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link disabled" id="pills-MakePayment-tab" data-bs-toggle="pill" 
                                    data-bs-target="#pills-MakePayment" type="button" role="tab" aria-controls="pills-MakePayment" 
                                    aria aria-selected="false">
                                        <img class="black" src="./assets/Image/payment.png" alt="">
                                        <img class="white" src="./assets/Image/payment-white.png" alt="">
                                        Make Payment
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active " id="pills-SetupService" role="tabpanel" aria-labelledby="pills-SetupService-tab">
                                   <div class="row">
                                    <span class="text-1"><b>Enter your Postal Code</b></span></div>
                                    <div class="row">
                                    <div class="postalcode-check">
                                        <input type="text" class="postalcode mt-3"  name="postalcode" placeholder="Postal code">
                                        <button type="submit" class="check-avail mt-3">Check Availability</button>
                                    </div></div>
                                    <div class="row"><span class="avail-msg "></span></div>
                                </div>
                                <div class="tab-pane fade " id="pills-SchedulePlan" role="tabpanel" aria-labelledby="pills-SchedulePlan-tab">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <span class="text-1"><b>When do you need the cleaner?</b></span>
                                            <div>
                                                <div class="row">
                                                <input class="input-element" type="date" id="formdate" name="formdate" data placeholder="From Date">
                                                <input class="input-element" type="time" id="formtime" name="formtime" data placeholder="From Time"></div>
                                                <!-- <select name="booktime" id="booktime">
                                                    <option value="2:00 PM">2:00 PM</option>
                                                    <option value="3:00 PM">3:00 PM</option>
                                                    <option value="4:00 PM">4:00 PM</option>
                                                    <option value="5:00 PM">5:00 PM</option>
                                                    <option value="6:00 PM">6:00 PM</option>
                                                </select> -->
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <span class="text-1"><b>How long do you need your cleaner to stay?</b></span>
                                            <div>
                                                <select name="servicetime" id="servicetime">
                                                    <option value=3.0>3.0 Hrs</option>
                                                    <option value=4.0>4.0 Hrs</option>
                                                    <option value=5.0>5.0 Hrs</option>
                                                    <option value=6.0>6.0 Hrs</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <span class="text-1"><b>Extra Services</b></span>
                                        <div class="extra-service">
                                            <div class="extra-content ">
                                                <div class="extra-image-1"><img src="./assets/Image/3.png"></div><br>
                                                <label class="extra-text" ><span class="extra-text-1">Inside cabinets</span><br></label>
                                            </div>
                                            <div class="extra-content">
                                                <div class="extra-image-2">
                                                  <img src="./assets/Image/5.png">
                                                </div>
                                                <br>
                                                <div class="extra-text">
                                                    <span class="extra-text-1">Inside fridge</span><br>
                                                    
                                                </div>
                                            </div>
                                            <div class="extra-content">
                                                <div class="extra-image-3">
                                                    <img src="./assets/Image/4.png">
                                                </div>
                                                <br>
                                                <div class="extra-text">
                                                    <span class="extra-text-1">Inside oven</span><br>
                                                    
                                                </div>
                                            </div>
                                            <div class="extra-content">
                                                <div class="extra-image-4">
                                                    <img src="./assets/Image/2.png">
                                                </div>
                                                <br>
                                                <div class="extra-text">
                                                    <span class="extra-text-1">Laundry wash & dry</span><br>
                                                    
                                                </div>
                                            </div>
                                            <div class="extra-content">
                                                <div class="extra-image-5">
                                                    <img src="./assets/Image/1.png">
                                                </div>
                                                <br>
                                                <div class="extra-text">
                                                    <span class="extra-text-1">Interior windows</span><br>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <span class="text-1"><b>Comments</b></span>
                                        <div>
                                            <textarea name="comments" class="service-comment" cols="50" rows="5"></textarea>
                                        </div>
                                        <div>
                                            <input type="checkbox" id="terms-conditions" name="terms-conditions" class="checkbox">
                                            <label class="checkbox-text" for="terms-conditions"> I have pets at home</label><br>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="continue-right">
                                            <button type="submit" class="continue-tab-2 continue mt-3"><b>Continue</b></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane  fade" id="pills-YourDetails" role="tabpanel" aria-labelledby="pills-YourDetails-tab">
                                    <span class="text-1 temp"><b>Please enter your address so that your helper can find you.</b></span>
                                    <div class="row address">
                                        <!-- <label class="area-label">
                                            <input type="radio" class="area-radio" id="age1" name="age" value="30" onclick="getseladd(this.id)">
                                            <span><b>Address:</b></span> Abcd 45, Bonn 53225 <br>
                                            <span><b>Telephone number:</b></span> 9988556644
                                        </label>
                                        <label class="area-label">
                                            <input type="radio" class="area-radio" id="age2" name="age" value="30" onclick="getseladd(this.id)">
                                            <span><b>Address:</b></span> Abcd 45, Bonn 53225 <br>
                                            <span><b>Telephone number:</b></span> 9988556644
                                        </label> -->
                                    </div>
                                    <div class="row">
                                        <div class="address-left">
                                            <button type="submit" class="add-new-address" >+ Add new address</button>
                                        </div>
                                    </div>
                                    <div class="add-address row">
                                    
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="streetname">Street name</label><br>
                                                    <input class="input streetname" type="text" name="streetname" placeholder="Street name">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="housenumber">House number</label><br>
                                                    <input class="input housenumber" type="text" name="housenumber" placeholder="House number">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="postalcode">Postal code</label><br>
                                                    <input class="input postal_code" type="text" name="postalcode" placeholder="360005">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="city">City</label><br>
                                                    <input class="input city" type="text" name="city" placeholder="Bonn">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="phonenumber">Phone number</label><br>
                                                    <div class="input-group">
                                                        <span class="input-group-text" id="basic-addon1">+49</span>
                                                        <input type="text" class="phonenumber" id="phonenumber" name="phonenumber" placeholder="9745643546" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <button type="submit"  class="address-save">Save</button>
                                                <button  class="address-cancel">Cancel</button>
                                            </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="continue-right">
                                            <button type="submit" class="continue continue-tab-3" disabled >Continue</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade " id="pills-MakePayment" role="tabpanel" aria-labelledby="pills-MakePayment-tab">
                                    <span class="text-1"><b>Choose one of the following payment methods.</b></span>
                                    <div>
                                        <label for="promocode">Promo code (optional)</label><br>
                                        <div class="promocode-check">
                                            <input type="text" class="promocode" name="promocode" placeholder="Promo code (optional)">
                                            <button name="submit" class="apply">Apply</button><br>
                                            <label class="text-danger error-msg"></label>
                                        </div>
                                        <hr>
                                        <div class="checkbox-content">
                                            <div class="row">
                                            <input type="checkbox" class="checkboxlast" id="terms-conditions-last" name="terms-conditions">
                                            <label class="checkboxlast-text" for="terms-conditions-last"> I accepted terms and conditions, the cancellation policy and the .privacy policy. I confirm that Helperland starts to execute the contract before the expiry of the withdrawal period and I lose my right of withdrawal as a consumer with full performance of the contract.</label><br>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="continue-right">
                                                <button type="submit" class="complete-booking" disabled><b>Complete Booking</b></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="payment-summary col-md-4 col-sm-12">
                        <div class="payment-card">
                            <div class="payment-header">
                                Payment Summary
                            </div>
                            <div class="payment-text1">
                                <div class="row">
                                    <div class="textline-1">
                                        <p class=" datetime text-1"></p>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="textline-2">
                                        <p class="text-2"><b>Duration</b></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8 text-1">Basic</div>
                                    <div class="basic col-4 text-1"></div>
                                </div>
                                
                                <div class="extraserv">
                                  <div class="row">
                                    <div class="cabinet col-8 text-1">Inside cabinets(extra)</div>
                                    <div class="cabinet-txt col-4 text-1">30 Mins</div>
                                  </div>
                                  <div class="row">
                                    <div class="fridge col-8 text-1">Inside fridge(extra)</div>
                                    <div class="fridge-txt col-4 text-1">30 Mins</div>
                                  </div>
                                  <div class="row">
                                    <div class="oven col-8 text-1">Inside oven(extra)</div>
                                    <div class="oven-txt col-4 text-1">30 Mins</div>
                                  </div>
                                  <div class="row">
                                    <div class="wash col-8 text-1">Laundry wash & dry(extra)</div>
                                    <div class="wash-txt col-4 text-1">30 Mins</div>
                                  </div>
                                  <div class="row">
                                    <div class="window col-8 text-1">Interior windows(extra)</div>
                                    <div class="window-txt col-4 text-1">30 Mins</div>
                                  </div>
                                </div>
                                <hr class="underline mt-2 mb-2">
                                <div class="row">
                                    <div class="col-8 text-1"><b>Total Service Time</b></div>
                                    <div class="totaltime col-4 text-3"><b></b></div>
                                </div>
                            </div>
                            <div class="payment-text2">
                                <div class="row">
                                    <div class=" col-8 text-1">Per cleaning</div>
                                    <div class="charge col-4 text-1"></div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-8 text-1">Discount</div>
                                    <div class="col-4 text-1">- $27</div>
                                </div> -->
                            </div>
                            <div class="payment-text3">
                                <div class="row">
                                    <div class=" text-4 col-8">Total Payment</div>
                                    <div class="totalpayment text-5 col-4"><b></b></div>
                                </div>
                                <!-- <div class="row">
                                    <div class="text-1 col-8 pt-1 pb-1">Effective Price</div>
                                    <div class="text-6 col-4"><b>$50.4</b></div>
                                </div>
                                <div class="row">
                                    <span class="text-7"><span class="text-danger"><b>*</b></span>You will save 20% according to §35a EStG.</span>
                                </div> -->
                            </div>
                            <div class="payment-text4">
                                <img src="./assets/Image/smiley.png" alt="smiley"> 
                                <span class="text-8">
                                    See what is always included
                                </span>
                            </div>
                        </div>
                        <div class="questions">
                            <div class="questions-header">
                                <b>Questions?</b>
                            </div>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            Which Helperland professional will come to my place?
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                            Which Helperland professional will come to my place?
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                            Which Helperland professional will come to my place?
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingFour">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                            Which Helperland professional will come to my place?
                                        </button>
                                    </h2>
                                    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingFive">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                            Which Helperland professional will come to my place?
                                        </button>
                                    </h2>
                                    <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingSix">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                            Which Helperland professional will come to my place?
                                        </button>
                                    </h2>
                                    <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingSeven">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                                            Which Helperland professional will come to my place?
                                        </button>
                                    </h2>
                                    <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="for-more-help">
                                <b>For more help</b>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>





    <!--tab and accodian ended-->

    <!--get newsletter-->
    <section class="section-5 container-fluid  justify-content-center">
      <div class=" msg-box">
        <span class="GET-OUR-NEWSLETTER">GET OUR NEWSLETTER</span>
        <div class="msg-foam d-flex flex-row flex-wrap">
            <input type="text" class="Rounded-Rectangle-649" placeholder="YOUR EMAIL">
            <button class="Rounded-Rectangle-649-copy">Submit</button>
        </div>
      </div>
    </section>
    <section class="footers">
    <footer>
        <div class="row footer">
            <div class="col-lg-2 logo1">
                <a href="#">
                    <img src="./assets/image/white-logo-transparent-background.png" alt="helperland" class="logos">
                </a>
            </div>
            <div class="col-lg-8 links">
                <nav>
                    <div class="nav menus">
                        <a href="./index.php" class="btn btn3">HOME</a>
                        <a href="./About.php" class="btn btn3">ABOUT</a>
                        <a href="#" class="btn btn3">TESTIMONIALS</a>
                        <a href="./Faq.php" class="btn btn3">FAQS</a>
                        <a href="#" class="btn btn3">INSURANCE POLICY</a>
                        <a href="#" class="btn btn3">IMPRESSUM</a>

                    </div>
                </nav>
            </div>
            <div class="col-lg-2 social">
                <nav>
                    <div class="nav icons">
                        <a href="#" class="btn facebook"><i class="fa fa-facebook fb"></i></a>
                        <a href="#" class="btn instagram"><i class="fa fa-instagram insta"></i></a>
                    </div>
                </nav>
            </div>
        </div>

        <div class="row privacy-policy">
            <p>©2018 Helperland. All rights reserved. <span>Terms and Conditions | Privacy Policy</span></p>
        </div>
    </footer>
</section>

<!--Bootstrap Bundle with Popper -->
<!--script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script-->
<!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.2/jquery.twbsPagination.min.js"></script>
<!--script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script-->
<script src="https://cdn.jsdelivr.net/npm/table2csv@1.1.6/src/table2csv.min.js"></script>
<script src="./assets/js/Script.js"></script>
<script src="./assets/js/bookservice.js"></script>
</body>

</html>