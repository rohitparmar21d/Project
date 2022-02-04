<?php include('./header.php');?>

<link rel="stylesheet" href="./assets/css/Customer-Signup.css">
    <title>Customer Signup</title>
    
</head>

<body>

    <header> <?php include('navbar.php'); ?></header>
    <section>
      <div class="pricewrapper">
            <p class="contactext text-center">Customer SignUp</p>
            <div class="container">
                <div class="sepimg">
                    <img src="./assets/Image/separator.png" class="sepretor">

                </div>
            </div>
       </div>
    </section>
           
    <section class="contactus">
        <div class="container forms">
            <form class="cntfm" method="POST" action=<?= $base_url."./?controller=Helperland&function=cSignup"?>>
              <?php if(isset($_SESSION['message'])){ ?>
                <div class="form-row mb-3">
                    <p class="text-center bg-danger text-white px-4 py-2 mx-auto my-auto">
                    <?php echo $_SESSION['message']; ?>
                    </p>
                </div>
                <?php } ?>
                <div class="form-row">
                    <div class="col-md-6 mb-2">
                        <input type="text" class="form-control" id="firstName" name="FirstName" placeholder="First name" required>
                        <div class="first-name-msg"></div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" class="form-control" id="lastname" name="LastName" placeholder="Last name" required>
                        <div class="last-name-msg"></div>
                    </div>
                </div>
                <div class="form-row part2">
                    <div class="col-md-6">
                        <input type="email" class="form-control" id="useremail" name="Email" placeholder="Email address" required>
                        <div class="email-msg "></div>
                    </div>
                    <div class="col-md-6 mb-1">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">+49</div>
                            </div>
                            <input type="text" class="form-control" id="mobilenum" name="Mobile"  placeholder="Mobile Number" maxlength="10" size="10" required>
                        </div>
                        <div class="mobile-msg"></div>
                    </div>
                </div>
                <div class="form-row part3">
                    <div class="col-md-6 mb-2">
                        <input type="password" class="form-control" id="password" name="Password" placeholder="Password" required>
                        <div class="Password-msg"></div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="password" class="form-control" id="confirmpassword" name="confirmPassword" placeholder="Confirm Password" required>
                        <div class="confirm_password-msg"></div>
                    </div>
                </div>
                <div class="form-row part4">
                   <div class="col-md-6 mb-2">
                   <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="check1" >
                       <label class="form-check-label" for="check1">i have read the <a href="#" class="text-primary">privacy policy</a> </label>
                    </div>
                   </div>
                </div>

                <div class="form-row sbmt">
                    <input class="btn btn-sbt" type="submit" value="Register" disabled id="submitButton"><br>
                </div>
                <div class="form-row part5 justify-content-center">
                  <div class="col-md-4 mb-2">
                    <div class="txtlogin">
                        <p>Already registered? <a href=".#LoginModal'" class="text-primary">Log In</a></p>
                    </div>
                  </div>
                </div>

            </form>
        </div>
    </section>
    
    
       
    <?php include("footer.php"); ?>
</body>

</html>