<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <!-- Only Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.12/sweetalert2.min.css" rel="stylesheet">
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        .card {
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }

        
        /* Main container */
        .password-container {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            transition: transform 0.3s ease;
        }
        
        /* Card effect on hover */
        .password-card {
            border-radius: 6px;
            overflow: hidden;
            /* box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); */
            transition: all 0.3s ease;
        }
        
        .password-card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transform: translateY(-3px);
        }
        
        /* Header */
        .password-header {
            background-color: #4285F4;
            color: white;
            border-radius: 5px 5px 0 0;
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }
        
        .password-card:hover .password-header {
            background-color: #3b78e7; /* Slightly darker blue on hover */
        }
        
        .password-header i {
            margin-right: 8px;
            transition: transform 0.3s ease;
        }
        
        .password-card:hover .password-header i {
            transform: rotate(15deg);
        }
        
        /* Form container */
        .password-form-container {
            background-color: white;
            border-radius: 0 0 5px 5px;
            padding: 25px;
        }
        
        /* Form rows */
        .form-row {
            margin-bottom: 20px;
            position: relative;
            transition: transform 0.2s ease;
        }
        
        .form-row:hover {
            transform: translateX(5px);
        }
        
        .form-label {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            color: #555;
            font-weight: 500;
            font-size: 14px;
            transition: color 0.3s ease;
        }
        
        .form-row:hover .form-label {
            color: #4285F4;
        }
        
        .form-label i {
            margin-right: 8px;
            color: #666;
            transition: transform 0.3s ease, color 0.3s ease;
        }
        
        .form-row:hover .form-label i {
            color: #4285F4;
            transform: scale(1.2);
        }
        
        /* Input fields */
        .password-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .password-input:hover {
            border-color: #aaa;
        }
        
        .password-input:focus {
            outline: none;
            border-color: #4285F4;
            box-shadow: 0 0 0 3px rgba(66, 133, 244, 0.1);
        }
        
        /* Password visibility toggle */
        .password-wrapper {
            position: relative;
        }
        
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .toggle-password:hover {
            color: #4285F4;
            transform: translateY(-50%) scale(1.1);
        }
        
        /* Update button */
        .update-btn-container {
            text-align: left;
            margin-top: 30px;
        }
        
        .update-btn {
            background-color: #4285F4;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(66, 133, 244, 0.3);
        }
        
        .update-btn:hover {
            background-color: #3367d6;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(66, 133, 244, 0.4);
        }
        
        .update-btn:active {
            transform: translateY(0);
            box-shadow: 0 1px 3px rgba(66, 133, 244, 0.4);
        }
        
        .update-btn i {
            margin-right: 8px;
            transition: transform 0.3s ease;
        }
        
        .update-btn:hover i {
            transform: rotate(180deg);
        }
        
        /* Responsive styles */
        @media (max-width: 768px) {
            .password-container {
                padding: 10px;
            }
            
            .password-form-container {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="password-container">
        <div class="password-card">
            <div class="password-header">
                <i class="fas fa-user-shield"></i> Change Password
            </div>
            <div class="password-form-container">
                <form id="changePasswordForm" action="" method="post">
                    <div class="form-row">
                        <label class="form-label">
                            <i class="fas fa-key"></i> Current Password:
                        </label>
                        <div class="password-wrapper">
                            <input type="password" name="old_pass" id="old_pass" class="password-input" required>
                            <span class="toggle-password" data-target="old_pass">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <label class="form-label">
                            <i class="fas fa-lock"></i> New Password:
                        </label>
                        <div class="password-wrapper">
                            <input type="password" name="new_pass" id="new_pass" class="password-input" required>
                            <span class="toggle-password" data-target="new_pass">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <label class="form-label">
                            <i class="fas fa-check-circle"></i> Confirm New Password:
                        </label>
                        <div class="password-wrapper">
                            <input type="password" name="new_pass_again" id="new_pass_again" class="password-input" required>
                            <span class="toggle-password" data-target="new_pass_again">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="update-btn-container">
                        <center>
                        <button type="submit" name="submit" class="update-btn">
                            <i class="fas fa-sync-alt"></i> Update Password
                        </button>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- SweetAlert2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.12/sweetalert2.min.js"></script>
    
    <script>
        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(item => {
            item.addEventListener('click', event => {
                const target = document.getElementById(item.getAttribute('data-target'));
                const icon = item.querySelector('i');
                
                if (target.type === 'password') {
                    target.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    target.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
        
        // Form submission with SweetAlert
        document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const oldPass = document.getElementById('old_pass').value;
            const newPass = document.getElementById('new_pass').value;
            const confirmPass = document.getElementById('new_pass_again').value;
            
            if (newPass !== confirmPass) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Your new password does not match.',
                    icon: 'error',
                    confirmButtonText: 'Try Again',
                    confirmButtonColor: '#4285F4'
                });
                return;
            }
            
            // In real usage, this would be handled by the PHP
            Swal.fire({
                title: 'Success!',
                text: 'Your password has been updated successfully.',
                icon: 'success',
                confirmButtonText: 'Continue',
                confirmButtonColor: '#4285F4'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Normally would submit the form here
                    // this.submit();
                }
            });
        });
    </script>
    
    <?php
    if(isset($_POST['submit'])){
        $c_email = $_SESSION['customer_email'];
        $old_pass = $_POST['old_pass'];
        $new_pass = $_POST['new_pass'];
        $new_pass_again = $_POST['new_pass_again'];
        
        $sel_old_pass = "select * from customers where customer_pass='$old_pass'";
        $run_old_pass = mysqli_query($con,$sel_old_pass);
        $check_old_pass = mysqli_num_rows($run_old_pass);
        
        if($check_old_pass==0){
            echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Your Current Password is not valid try again',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#4285F4'
                });
            </script>";
            exit();
        }
        
        if($new_pass!=$new_pass_again){
            echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Your New Password does not match',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#4285F4'
                });
            </script>";
            exit();
        }
        
        $update_pass = "update customers set customer_pass='$new_pass' where customer_email='$c_email'";
        $run_pass = mysqli_query($con,$update_pass);
        
        if($run_pass){
            echo "<script>
                Swal.fire({
                    title: 'Success!',
                    text: 'Your Password Has been Changed Successfully',
                    icon: 'success',
                    confirmButtonText: 'Continue',
                    confirmButtonColor: '#4285F4'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'my_account.php?my_orders';
                    }
                });
            </script>";
        }
    }
    ?>
</body>
</html>