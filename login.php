<?php

session_start();

include("includes/db.php");
include("includes/header.php");
include("functions/functions.php");
include("includes/main.php");

?>


  <!-- MAIN -->
  <main >
    <!-- HERO -->
    <div class="nero" >
    <p class="nero__text">
      </p>
    </div>
  


    <?php

if(!isset($_SESSION['customer_email'])){

include("customer/customer_login.php");


}else{

include("checkout.php");

}

?>

</main>



<div id="content" ><!-- content Starts -->
<div class="container" ><!-- container Starts -->




<div class="col-md-12" ><!-- col-md-12 Starts -->




</div><!-- col-md-12 Ends -->


</div><!-- container Ends -->
</div><!-- content Ends -->



<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- Information Section -->
            <div class="col-12 col-sm-6 col-md-3 mb-4">
                <h5 class="footer-heading">Information</h5>
                <ul class="list-unstyled">
                    <li><a href="#">The Brand</a></li>
                    <li><a href="#">Local Stores</a></li>
                    <li><a href="#">Customer Service</a></li>
                    <li><a href="#">Privacy & Cookies</a></li>
                </ul>
            </div>

            <!-- Why Buy from Us Section -->
            <div class="col-12 col-sm-6 col-md-3 mb-4">
                <h5 class="footer-heading">Why Buy from Us</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Shipping & Returns</a></li>
                    <li><a href="#">Secure Shipping</a></li>
                    <li><a href="#">Testimonials</a></li>
                </ul>
            </div>

            <!-- Your Account Section -->
            <div class="col-12 col-sm-6 col-md-3 mb-4">
                <h5 class="footer-heading">Your Account</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Sign In</a></li>
                    <li><a href="#">Register</a></li>
                    <li><a href="#">View Cart</a></li>
                    <li><a href="#">Update Information</a></li>
                </ul>
            </div>

            <!-- Contact Us Section -->
            <div class="col-12 col-sm-6 col-md-3 mb-4">
                <h5 class="footer-heading">Contact Us</h5>
                <address>
                    DibimbingShop<br>
                    12510, Plaza City View lv.2<br>
                    South Jakarta, Indonesia
                </address>
                <p>
                    <strong>Tel:</strong> <a href="tel:081227741541">+62 812-2774-1541</a><br>
                    <strong>Email:</strong> <a href="mailto:info@dibimbing.id">info@dibimbing.id</a>
                </p>
                <div class="social-icons">
                    <a href="https://www.facebook.com/dibimbing.id"><i class="fab fa-facebook"></i></a>
                    <a href="https://twitter.com/DibimbingId"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/dibimbing.id/"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/school/dibimbing-id/"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
    <center>
    <div class="footer-bottom  justify-content-between align-items-center mt-4">
      <div>&copy; <?php echo date("Y"); ?> Dibimbing Shop™</div>
      <div>Developed & Designed by <a href="https://dibimbing.id" class="text-gray">Dibimbing.id</a></div>
    </div>
</center>
  </div>
</footer>

<script src="js/jquery.min.js"> </script>

<script src="js/bootstrap.min.js"></script>

</body>
</html>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

body, html {
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #333333;
    background-color: #f0f0f0;
    overflow-x: hidden;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    height: 100%;
    
    }
main {
  flex-grow: 1;
}

.footer {
  background-color: #343a40;
  color: #ffffff;
  padding-top: 40px;
  padding-bottom: 20px;
}

.footer a {
  color: #adb5bd;
  text-decoration: none;
  transition: color 0.2s ease-in-out;
}

.footer a:hover {
  color: #ffffff;
}

.footer-heading {
  font-weight: 600;
  margin-bottom: 15px;
  color: #ffffff;
}

.footer-bottom {
  padding-top: 20px;
  border-top: 1px solid #495057;
  font-size: 0.9rem;
}

.footer-bottom a {
  color: #adb5bd;
}

.footer-bottom a:hover {
  color: #ffffff;
}

.social-icons a {
  font-size: 1.2rem;
  margin-right: 15px;
  color: #adb5bd;
}

.social-icons a:hover {
  color: #ffffff;
}

/* Responsive adjustments */
@media (max-width: 767px) {
  .footer .col-md-3 {
    margin-bottom: 20px;
  }

  .footer .social-icons a {
    font-size: 1.5rem;
  }

  .footer-bottom {
    text-align: center;
  }
}
</style>
