<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/Become_a_pro.css">
    <title>Service</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <div class="wrapper">
          <?php include('Homenav.php'); ?><menu>
            <section class="banner" style=" background-image: url('./assets/image/become-a-pro-banner.png'); background-size: cover; ">
                <div class="card register">
                    <h1>Register Now!</h1>
                    <?php if(isset($_SESSION['message1'])){ ?>
                <div class="form-row mb-3">
                    <p class="text-center bg-danger text-white px-4 py-2 mx-auto my-auto">
                    <?php echo $_SESSION['message1']; ?>
                    </p>
                </div>
                <?php } ?>
                    <form method="POST"  action=<?= $base_url."./?controller=Helperland&function=spSignup"?>>
                    
                     <div class="form-group">
                       <input type="text" class="form-control" name="FirstName"placeholder="First name" required>
                     </div>
                     <div class="form-group">
                         <input type="text" class="form-control" name="LastName" placeholder="Last name" required>
                       </div>
                       <div class="form-group">
                         <input type="email" class="form-control" name="Email" placeholder="Email Address" required>
                       </div>
                       <div class="form-group phonenum">
                         <div class="input-group ">
                           <div class="input-group-prepend">
                             <div class="input-group-text">+49</div>
                           </div>
                           <input type="tel" class="form-control" name="Mobile" placeholder="Phone Number" required>
                         </div>
                       </div>
                       <div class="form-group">
                         <input type="password" class="form-control" name="Password" placeholder="Password" required>
                       </div>
                       <div class="form-group">
                         <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password" required>
                       </div>
                       <div class="form-check">
                         <input type="checkbox" class="form-check-input" id="exampleCheck1">
                         <label class="form-check-label " for="exampleCheck1">Send me newsletters from Helperland</label>
                       </div>
                       <div class="form-check">
                         <input type="checkbox" class="form-check-input" id="exampleCheck2">
                         <label class="form-check-label " for="exampleCheck2">I accept <a href="#">terms and conditions</a> & <a href="#">privacy policy</a></label>
                       </div>
                       <div class="form-group recaptcha">
                         <div class="g-recaptcha" data-sitekey="6LfZFLAdAAAAALdjt9qtcojiy2xEMk7gY4gXAeUS"></div>
                        
                     </div>
                     <div class="form-group sbmtbtn">
                         <button type="submit" class="btn sbmtbtns" id="register" disabled>Get Started<i class="fa fa-long-arrow-right fa-lg right-arrow"></i></button>
                     </div>
                     </form>
                     
                   </div>
                   <a class="scroll-down" href="#blog-section">
                    <div class="dwn">
                      
                      <img src="assets/image/ellipse-525.svg" class="eclipce">
                      <div class="download">
                        <img src="assets/Image/shape-1.svg" alt="" class="download1">
                      </div>
                    </div>
          </a>
              
            </section>
            <section class="blog-section" id="blog-section">
              <div class="blogs ">
                 <h2>How it works</h2>
                 <div class="blog1 d-flex">
                  <div class="content1 align-self-center">
                
                    <h3 class="title">
                      Register yourself          </h3>
                    <p class="paragraph">
                      Provide your basic information to register
                      yourself as a service provider.
                    </p>
                    <p>Read More <i class="fa fa-long-arrow-right fa-lg"></i></p>
                  </div>
                  <img src="assets/Image/blog-1.png" class="image1 ml-auto" />
          
                </div>
                <div class="blog2 d-flex">
                  <img src="assets/Image/blog-2.png" class="image2" />
          
                  <div class="content2 ml-auto align-self-center">
                
                    <h3 class="title">
                      Get service requests         </h3>
                    <p class="paragraph">
                      You will get service requests from
                      customes depend on service area and profile.
                    </p>
                    <p>Read More <i class="fa fa-long-arrow-right fa-lg"></i></p>
                  </div>
          
                </div>
                <div class="blog3 d-flex">
          
                  <div class="content3 align-self-center ">
                
                    <h3 class="title">
                      Complete service         </h3>
                    <p class="paragraph">
                      Accept service requests from your customers
          and complete your work.
                    </p>
                    <p>Read More <i class="fa fa-long-arrow-right fa-lg"></i></p>
                  </div>
                  <img src="assets/Image/blog-3.png" class="image3 ml-auto" />
          
                </div>
                </div>
                <div class="newsletter">
                  <div class="container">
                    <h3 class="ournews ">GET OUR NEWSLETTER</h3>
                    <form action="#" method="Post" class="newsform">
                      <input type="text" name="text" placeholder="YOUR EMAIL">
                      <button type="button" class="btn btn5"><p>Subscribe</p></button>
                    </form>
                  </div>
                </div>
                </section>
        </menu>
    </div>
    <?php include('./footer.php'); ?>
 
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" ></script> 
    <script src="./assets/js/Become_a_pro.js"></script>
    
</body>

</html>