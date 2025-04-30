<?php
session_start();
include("includes/db.php");
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | DibimbingShop</title>
    <link rel="shortcut icon" href="admin_images/dibimbinglogo.jpg" type="image/jpg">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background-color: rgba(0, 0, 0, 0.05);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .login-container {
            width: 900px;
            height: 550px;
            background-color: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
            display: flex;
            position: fixed; /* Change to fixed to maintain position */
            z-index: 10;
        }
        
        .login-form {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
        }
        
        .login-image {
            flex: 1;
            background-color: #7762fb;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .brand {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .brand-logo {
            width: 35px;
            height: 35px;
            background-color: #7762fb;
            border-radius: 8px;
            margin-right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        .brand-name {
            font-weight: 600;
            font-size: 18px;
            color: #333;
        }
        
        .welcome-back {
            font-size: 28px;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }
        
        .please-enter {
            font-size: 14px;
            color: #777;
            margin-bottom: 30px;
        }
        
        .form-label {
            font-size: 14px;
            font-weight: 500;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #7762fb;
            box-shadow: 0 0 0 3px rgba(119, 98, 251, 0.2);
            outline: none;
        }
        
        .btn-login {
            width: 100%;
            padding: 14px;
            background-color: #7762fb;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }
        
        .btn-login:hover {
            background-color: #6652eb;
            transform: translateY(-2px);
        }
        
        .illustration {
            width: 100%;
            height: 100%;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
        }
        
        .illustration-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: #7762fb;
            opacity: 0.1;
            z-index: 0;
        }
        
        .illustration-icons {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIHZpZXdCb3g9IjAgMCAxMDAgMTAwIj48ZyBmaWxsPSJub25lIiBzdHJva2U9IiNmZmYiIHN0cm9rZS13aWR0aD0iMC41IiBzdHJva2Utb3BhY2l0eT0iMC4xIj48Y2lyY2xlIGN4PSIyMCIgY3k9IjMwIiByPSI4Ii8+PHJlY3QgeD0iNDAiIHk9IjEwIiB3aWR0aD0iMTIiIGhlaWdodD0iMTIiIHJ4PSIyIi8+PHBhdGggZD0iTTYwLDI1IEw3MCwzNSBMNjAsNDUgTDUwLDM1IFoiLz48Y2lyY2xlIGN4PSI4MCIgY3k9IjIwIiByPSIxMCIvPjxwYXRoIGQ9Ik0yMCw3MCBMMzAsNjAgTDQwLDgwIFoiLz48cmVjdCB4PSI1MCIgeT0iNjAiIHdpZHRoPSIxNSIgaGVpZ2h0PSIxNSIgcng9IjMiLz48Y2lyY2xlIGN4PSI4MCIgY3k9IjcwIiByPSI4Ii8+PC9nPjwvc3ZnPg==');
            opacity: 0.4;
        }
        
        .illustration-person {
            position: relative;
            z-index: 2;
            width: 60%;
            height: auto;
        }
        
        .circle {
            position: absolute;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        .circle-1 {
            width: 100px;
            height: 100px;
            top: 10%;
            left: 10%;
        }
        
        .circle-2 {
            width: 150px;
            height: 150px;
            bottom: 10%;
            right: 10%;
        }
        
        /* Custom modal styles */
        .custom-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .custom-modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .custom-modal {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 400px;
            max-width: 90%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
        }
        
        .custom-modal-close {
            width: 70px;
            height: 70px;
            background-color: #f8f8f8;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        
        .custom-modal-close i {
            color: #ff4d4d;
            font-size: 24px;
        }
        
        .custom-modal-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }
        
        .custom-modal-message {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }
        
        .custom-modal-button {
            background-color: #7762fb;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .custom-modal-button:hover {
            background-color: #6652eb;
        }
        
        @media (max-width: 768px) {
            .login-container {
                width: 95%;
                height: auto;
                flex-direction: column;
            }
            
            .login-form {
                padding: 30px;
            }
            
            .login-image {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Custom Modal for Error -->
    <div class="custom-modal-overlay" id="errorModal">
        <div class="custom-modal">
            <div class="custom-modal-close">
                <i class="fas fa-times-circle"></i>
            </div>
            <h3 class="custom-modal-title">Error!</h3>
            <p class="custom-modal-message">Email or Password is Wrong</p>
            <button class="custom-modal-button" onclick="closeModal()">Try Again</button>
        </div>
    </div>
    
    <!-- Custom Modal for Success -->
    <div class="custom-modal-overlay" id="successModal">
        <div class="custom-modal">
            <div class="custom-modal-close">
                <i class="fas fa-check-circle" style="color: #4CAF50;"></i>
            </div>
            <h3 class="custom-modal-title">Success!</h3>
            <p class="custom-modal-message">You are Logged in to the admin panel</p>
            <button class="custom-modal-button" onclick="redirectToDashboard()">OK</button>
        </div>
    </div>

    <div class="login-container">
        <div class="login-form">
            <div class="brand">
                <div class="brand-logo">A</div>
                <div class="brand-name">AdminPanel</div>
            </div>
            
            <h2 class="welcome-back">Welcome back</h2>
            <p class="please-enter">Please enter your details</p>
            
            <form action="" method="post" id="loginForm">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" name="admin_email" placeholder="Enter your email" required>
                
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="admin_pass" placeholder="Enter your password" required>
                
                <button class="btn-login" type="submit" name="admin_login">
                    Sign in
                </button>
            </form>
        </div>
        
        <div class="login-image">
            <div class="illustration">
                <div class="illustration-bg"></div>
                <div class="illustration-icons"></div>
                <div class="circle circle-1"></div>
                <div class="circle circle-2"></div>
                <svg class="illustration-person" viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#FFFFFF" fill-opacity="0.3" d="M200 300c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"/>
                    <circle cx="200" cy="200" r="70" fill="#FFFFFF" fill-opacity="0.8"/>
                    <path fill="#FFFFFF" fill-opacity="0.9" d="M125 350c0-41.421 33.579-75 75-75s75 33.579 75 75H125z"/>
                    <circle cx="160" cy="190" r="10" fill="#7762FB"/>
                    <circle cx="240" cy="190" r="10" fill="#7762FB"/>
                    <path stroke="#7762FB" stroke-width="5" d="M170 230c10 10 50 10 60 0" fill="none" stroke-linecap="round"/>
                    <path fill="#FFFFFF" fill-opacity="0.2" d="M80 260c30-10 50-40 50-40s10 40 40 40c30 0 30-30 50-30s30 30 60 30c30 0 40-40 40-40s20 30 50 40" stroke="#FFFFFF" stroke-opacity="0.5" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
        </div>
    </div>

    <script>
        function closeModal() {
            document.getElementById('errorModal').classList.remove('active');
            document.getElementById('successModal').classList.remove('active');
        }
        
        function redirectToDashboard() {
            window.location.href = 'index.php?dashboard';
        }
        
        // Handling the form submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            // This prevents double form submission
            if (this.submitting) return;
            this.submitting = true;
        });
    </script>
    
    <?php
    if (isset($_POST['admin_login'])) {
        $admin_email = mysqli_real_escape_string($con, $_POST['admin_email']);
        $admin_pass = mysqli_real_escape_string($con, $_POST['admin_pass']);
        // Query the database to verify the login credentials
        $get_admin = "SELECT * FROM admins WHERE admin_email='$admin_email' AND admin_pass='$admin_pass'";
        $run_admin = mysqli_query($con, $get_admin);
        $count = mysqli_num_rows($run_admin);
        // Check if login is successful or failed
        if ($count == 1) {
            $_SESSION['admin_email'] = $admin_email;
            echo "
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('successModal').classList.add('active');
                    });
                </script>
            ";
        } else {
            echo "
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('errorModal').classList.add('active');
                    });
                </script>
            ";
        }
    }
    ?>
</body>
</html>