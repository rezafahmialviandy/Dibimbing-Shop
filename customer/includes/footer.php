<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Footer</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        /* Make the body take at least the full height of the screen */
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        /* Footer style */
        .footer {
            background-color: #343a40;
            color: #ffffff;
            padding-top: 40px;
            padding-bottom: 20px;
            margin-top: auto; /* Push footer to the bottom */
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
        }

        /* Responsive styles */
        @media (max-width: 767px) {
            .social-icons a {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

<!-- Content goes here -->

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
            <div>&copy; 2024 Dibimbing Shop™</div>
            <div>Developed & Designed by <a href="https://dibimbing.id" class="text-white">Dibimbing.id</a></div>
        </div>
        </center>
    </div>
</footer>

</body>
</html>
