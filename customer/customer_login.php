<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Custom styling for SweetAlert */
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

        .rounded-img {
          width: 380px;
          height: auto;
          padding-top: 10%;
          display: block;
          margin: 0 auto;
          animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
          0% {
            transform: translateY(-10px);
          }
          50% {
            transform: translateY(10px);
          }
          100% {
            transform: translateY(-10px);
          }
        }

        .form-control {
          margin-bottom: 15px;
          padding: 12px;
          border-radius: 8px;
        }

        .btn-primary {
          width: 100%;
          padding: 12px;
          font-size: 16px;
          background-color:rgb(79, 143, 255);
          border: none;
          border-radius: 5px;
        }

        .btn-primary:hover {
          background-color:rgb(38, 98, 217);
        }

        .login-container {
          background-color: #fff;
          padding: 30px;
          border-radius: 10px;
          box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
        }

        .card-body {
          padding: 20px;
        }

        .login-title {
          font-size: 24px;
          font-weight: 600;
          color: #333;
        }
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
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        
        <!-- Left Column (Form) -->
        <div class="col-md-6">
        <br>
            <div class="login-container shadow">
                <div class="card-body">
                    <h2 class="text-center mb-3 login-title">Welcome Back!</h2>
                    <p class="text-center text-muted">Already our customer? Sign in below.</p>
                    <br>
                    <form action="login.php" method="post">
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="c_email" class="form-control" placeholder="Enter your email" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="c_pass" class="form-control" placeholder="Enter your password" required>
                        </div>
                        
                        <div class="mb-3 text-center">
                            <a href="forgot_pass.php">Forgot Password?</a>
                        </div>
                        <br>
                        <div class="d-grid">
                            <button type="submit" name="login" class="btn btn-primary">
                                <i class="fa fa-sign-in-alt"></i> Log In
                            </button>
                        </div>

                        <p class="text-center mt-3">New user? <a href="customer_register.php">Register here</a></p>
                    </form>
                </div>
            </div>
            <br>
        </div>

        <!-- Right Column (Logo) -->
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <img src="images/logodibimbing.png" alt="Logo" class="img-fluid rounded-img">
        </div>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_email = mysqli_real_escape_string($con, $_POST['c_email']);
    $customer_pass = mysqli_real_escape_string($con, $_POST['c_pass']);

    $select_customer = "SELECT * FROM customers WHERE customer_email='$customer_email' AND customer_pass='$customer_pass'";
    $run_customer = mysqli_query($con, $select_customer);

    $get_ip = getRealUserIp();
    $check_cart = mysqli_num_rows(mysqli_query($con, "SELECT * FROM cart WHERE ip_add='$get_ip'"));

    if (mysqli_num_rows($run_customer) == 0) {
        echo "<script>Swal.fire('Error', 'Invalid email or password.', 'error');</script>";
    } else {
        $_SESSION['customer_email'] = $customer_email;

        if ($check_cart == 0) {
            echo "<script>Swal.fire('Success', 'You are logged in successfully.', 'success').then(() => window.location.href='customer/my_account.php?my_orders');</script>";
        } else {
            echo "<script>Swal.fire('Success', 'You are logged in! Proceeding to checkout.', 'success').then(() => window.location='customer/my_account.php?my_orders');</script>";
        }
    }
}
?>

</body>
</html>
