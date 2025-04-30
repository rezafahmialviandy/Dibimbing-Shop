<?php

session_start();

include("includes/db.php");
include("includes/header.php");
include("functions/functions.php");
include("includes/main.php");

?>

<style>
  .hero .btn1 {
  text-decoration: none;
  text-align: center;
  color: gray;
  font-size: 14px;
  font-family: Roboto, sans-serif;
  border: 1.5px solid gray;
  background-color: #f8f8f8;
  position: relative;
  line-height: 40px;
  display: inline-block;
  padding-left: 10px;
  padding-right: 10px;
  border-radius: 50px; /* Add rounded corners */
  transition: all 0.3s ease; /* Smooth transitions for hover effects */
}

.hero .btn1:hover {
  background-color: #2d7cf3;
  color: white;
  border-color: #009595; /* Change border color on hover */
  transform: translateY(-5px); /* Button lifts up on hover */
}

.hero .btn1:focus {
  outline: none;
  box-shadow: 0 0 8px rgba(0, 149, 149, 0.5); /* Add focus effect */
}

/* Position adjustments for responsiveness */
@media (max-width: 767px) {
  .hero .btn1 {
    right: 20px; /* Adjust right positioning for small screens */
    top: 50px; /* Adjust top positioning for small screens */
    font-size: 16px; /* Increase font size on smaller screens */
    padding-left: 15px;
    padding-right: 15px;
  }
}

@media (min-width: 768px) {
  .hero .btn1 {
    right: 210px;
    top: 80px;
  }
}

</style>

<!-- Cover -->
<main>
  <div class="hero">
    <a href="shop.php" class="btn1">View all products</a>
  </div>
  <!-- Main -->
  <div class="wrapper">
    <h1>Featured Collection</h1>
  </div>

  <div id="content" class="container"><!-- container Starts -->

    <div class="row"><!-- row Starts -->

      <?php
      getPro();
      ?>

    </div><!-- row Ends -->

  </div><!-- container Ends -->
</main>

<!-- FOOTER -->
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
    <div class="footer-bottom d-flex justify-content-between align-items-center mt-4">
      <div>&copy; <?php echo date("Y"); ?> Dibimbing Shop™</div>
      <div>Developed & Designed by <a href="https://dibimbing.id" class="text-white">Dibimbing.id</a></div>
    </div>
</center>
  </div>
</footer>

<!-- FontAwesome for Social Icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js"></script>

</body>

</html>



<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

body, html {
  font-family: 'Poppins', sans-serif;
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: column;
  height: 100%;
}

.btn-view-all {
    background-color: #3498db;
    color: #ffffff;
    font-size: 18px;
    font-weight: 600;
    text-decoration: none;
    padding: 12px 40px;
    border-radius: 50px;
    transition: all 0.3s ease;
    display: inline-block;
    text-align: center;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(52, 152, 219, 0.2);
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
