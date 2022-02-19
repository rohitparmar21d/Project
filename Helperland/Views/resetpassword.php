



<?php include('./header.php');
$base_url = "http://localhost/Helperland/";
if(isset($_SESSION['reset']))
  { 
    echo '<script> alert("Password and Confirm Password should be same"); </script>';
    unset($_SESSION['reset']);
  }
?>

<link rel="stylesheet" href="./assets/css/Customer-Signup.css">
    <title>Reset Password</title>
    
</head>

<body>
    <section class="sec1 ">
    <div class="container">
    <div class="txt" >

            <h3> Reset Password</h3>
    </div>
    <form  method="POST" action=<?= $base_url."./?controller=Helperland&function=resetpass"?>>
      <div class="form-row">
        <div class="col-md-4">
        <label for="Password">New Password</label>
        <input type="password" class="form-control" id="Password" name="Password"  placeholder="Password">
      </div>
      </div>
      <div class="form-row">
      <div class="col-md-4">
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" class="form-control" id="confirmPassword"  name="confirmPassword" placeholder="Confirm Password">
      </div>
      </div>
      <button type="submit" class="btn btn-save">Save</button>
    </form>
    </div>
    </section>
    <section class="footers fixed-bottom">
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
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.2/jquery.twbsPagination.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/table2csv@1.1.6/src/table2csv.min.js"></script>
<script src="./assets/js/Script.js"></script>
</body>

</html>