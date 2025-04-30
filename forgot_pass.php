<?php
session_start();
include("includes/db.php");
include("includes/header.php");
include("functions/functions.php");
include("includes/main.php");
?>

<main>
  <!-- HERO -->
  <div class="nero">
    <p class="nero__text"></p>
  </div>
</main>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        Custom styling for SweetAlert
        .swal2-popup {
          border-radius: 12px;
          padding: 20px;
          font-family: 'Arial', sans-serif;
        }

        .swal2-title {
          font-size: 20px;
          font-weight: bold;
          color: #333;
        }

        .swal2-content {
          font-size: 16px;
          color: #555;
        }

        .swal2-confirm {
          background-color: #6c5ce7;
          color: white;
          border-radius: 5px;
          padding: 12px 24px;
          border: none;
        }

        .swal2-confirm:hover {
          background-color: #5a4bd3;
        }

        .swal2-close {
          font-size: 20px;
          color: #aaa;
          cursor: pointer;
        }

        .form-control {
          margin-bottom: 15px;
          padding: 12px;
          border-radius: 8px;
        }

        .btn-primary {
          width: 80%;
          padding: 5px;
          font-size: 16px;
          background-color: rgb(79, 143, 255);
          border: none;
          border-radius: 5px;
          margin: 0 auto; /* Centers the button horizontally */
          display: block; /* Make sure it's treated as a block element */
        }

        .btn-primary:hover {
          background-color: rgb(38, 98, 217);
        }

        .login-container {
          background-color: #fff;
          padding: 10px;
          border-radius: 10px;
          box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .card-body {
          padding: 20px;
        }

        .login-title {
          font-size: 24px;
          font-weight: 600;
          color: #333;
        }

        /* Centering the container */
        .container1 {
          display: flex;
          justify-content: center;
          align-items: center;
          height: 100vh;
        }

        /* Adjusting the form container */
        .form-container {
          width: 100%;
          max-width: 450px; /* Set a max width for the form */
        }
    </style>
</head>
<body>
 <br> 
<div class="container1">
    <div class="form-container">
        <div class="login-container shadow">
            <div class="card-body">
                <h2 class="text-center mb-3 login-title">Forgot Password</h2>
                <p class="text-center text-muted">Please enter your email to reset your password.</p>

                <form class="forgot-password-form" id="forgot-password-form" action="forgot_pass.php" method="post">  
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" id="email" name="c_email" class="form-control" placeholder="Enter your email" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" name="forgot_pass" class="btn btn-primary">
                            <i class="fa fa-paper-plane"></i> Send Password
                        </button>
                    </div>
                    <br>
                    <p class="text-center mt-3">Remember your password? <a href="index.php?page=login">Login here</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
<br>
</body>
</html>


        <!-- SweetAlert2 and EmailJS Script -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/emailjs-com@3/dist/email.min.js"></script>

        <script>
    emailjs.init("hTbcruThj7TjftSHm");  // Your Public Key

    document.getElementById("forgot-password-form").addEventListener("submit", function(event) {
        event.preventDefault();  // Prevent form submission

        var email = document.getElementById("email").value;

        // Check if email is empty
        if (email === "") {
            Swal.fire("Error", "Please enter a valid email address.", "error");
            return;
        }

        // Send an AJAX request to the backend to get the password
        fetch("functions/fetch_password.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "email=" + encodeURIComponent(email)
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                var password = data.password;  // Get the password from the response
                var customer_name = data.name;  // Get the user's name from the response

                // Create template params for EmailJS
                var templateParams = {
                    to_email: email,
                    subject: "Password Reset Request",
                    message: "Here is your password reset request. Please follow the instructions.",
                    password: password,
                    email: email,
                    name: customer_name
                };

                // Send the email using EmailJS
                emailjs.send("service_dwbmr6v", "template_l4olwir", templateParams)
                    .then(function(response) {
                        console.log('SUCCESS!', response.status, response.text);
                        Swal.fire("Success", "Your password has been sent. Check your email.", "success").then(function() {
                            // Redirect to login.php after the alert is closed
                            window.location.href = "login.php";
                        });
                    }, function(error) {
                        console.error('FAILED...', error);
                        Swal.fire("Error", "There was an issue sending the email. Please try again later.", "error");
                    });
            } else {
                // If no account found with that email
                Swal.fire("Error", data.message, "error");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            Swal.fire("Error", "There was an issue fetching the password. Please try again later.", "error");
        });
    });
</script>


        <!-- Bootstrap JS (Optional for responsive design and interactivity) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

      </div>
    </div>
  </div>
</div>

<?php
include("includes/footer.php");
?>
