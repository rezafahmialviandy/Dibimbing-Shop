<?php
session_start();
include("includes/db.php");
include("includes/header.php");
include("functions/functions.php");
include("includes/main.php");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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
  background-color: #6c5ce7; /* Color of the confirm button */
  color: white;
  border-radius: 5px;
  padding: 12px 24px;
  border: none;
}

.swal2-confirm:hover {
  background-color: #5a4bd3; /* Darker shade when hovered */
}

.swal2-close {
  font-size: 20px;
  color: #aaa;
  cursor: pointer;
}

.rounded-img {
  width: 380px;
  height: auto;
  padding-top: 15%;
  /* border-radius: 50%; Membuat gambar menjadi bulat */
  display: block;
  margin: 0 auto;
  /* Animasi untuk efek melayang */
  animation: float 3s ease-in-out infinite;
}


@keyframes float {
  0% {
    transform: translateY(-10px); /* Posisi pertama */
  }
  50% {
    transform: translateY(10px); /* Posisi turun */
  }
  100% {
    transform: translateY(-10px); /* Kembali ke posisi awal */
  }
}


.login-title {
  font-family: 'Poppins', sans-serif;
  font-size: 24px;
  font-weight: 600;
  color: #333;
}

/* Additional styling for form elements */
.form-control {
  margin-bottom: 15px;
  padding: 12px;
  border-radius: 8px;
}

body, html {
  font-family: 'Poppins', sans-serif;
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: column;
  height: 100%;
}

.btn-primary {
  width: 90%;
  padding: 10px;
  font-size: 16px;
  background-color: rgb(79, 143, 255);
  border: none;
  border-radius: 5px;
  margin: 0 auto; /* Centers the button horizontally */
  display: block; /* Make sure it's treated as a block element */
}

.btn-primary:hover {
  background-color:rgb(38, 98, 217);
}
</style>

<!-- MAIN -->
<main>
  <div class="nero">
    <div class="nero__heading">
    </div>
    <p class="nero__text"></p>
  </div>
</main>

<div id="content">
  <div class="container">
    <div class="row">
      <!-- Left Column (Image) -->
      <div class="col-md-6">
        <img src="images/logodibimbing.png" alt="Image" class="img-fluid rounded-img">
      </div>

      <br>
      <!-- Right Column (Form) -->
      <div class="col-md-6">
        <div class="box" style="border-radius: 5%; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);">
          <div>
            <center>
              <h2 class="text-center mb-3 login-title"> Register A New Account </h2>
              <p class="text-center text-muted">Join and experience the ease of transacting on DibimbingShop.</p>
            </center>
          </div>
          <br>
          <form action="customer_register.php" method="post" enctype="multipart/form-data" id="registrationForm">
            <div class="form-group">
              <label for="c_name">Name</label>
              <input type="text" class="form-control" name="c_name" id="c_name" required>
            </div>

            <div class="form-group">
              <label for="c_email">Email</label>
              <input type="email" class="form-control" name="c_email" id="c_email" required>
            </div>

            <div class="form-group">
              <label for="c_pass">Password</label>
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-check tick1" style="color: green"></i>
                  <i class="fa fa-times cross1"></i>
                </span>
                <input type="password" class="form-control" id="pass" name="c_pass" required>
                <span class="input-group-addon">
                  <div id="meter_wrapper" style="height:20px" >
                    <span id="pass_type"></span>
                    <div id="meter"></div>
                  </div>
                </span>
              </div>
            </div>

            <div class="form-group">
              <label for="con_pass">Confirm Password</label>
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-check tick2" style="color: green"></i>
                  <i class="fa fa-times cross2"></i>
                </span>
                <input type="password" class="form-control confirm" id="con_pass" required>
              </div>
            </div>
            <div class="form-group text-center">
              <button type="submit" name="register" class="btn btn-primary">
                <i class="fa fa-user-md"></i> Register
              </button>
              <br>
              <p style="padding-top:2px" class="text-center mt-3">Already Have An Account DibimbingShop?<a href="login.php"> login here</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include("includes/footer.php"); ?>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
  $('.tick1').hide();
  $('.cross1').hide();
  $('.tick2').hide();
  $('.cross2').hide();

  // Confirm password check
  $('.confirm').focusout(function() {
    var password = $('#pass').val();
    var confirmPassword = $('#con_pass').val();

    if (password == confirmPassword) {
      $('.tick1').show();
      $('.cross1').hide();
      $('.tick2').show();
      $('.cross2').hide();
    } else {
      $('.tick1').hide();
      $('.cross1').show();
      $('.tick2').hide();
      $('.cross2').show();
    }
  });

  // Password strength meter
  $("#pass").keyup(function() {
    check_pass();
  });

  function check_pass() {
    var val = $("#pass").val();
    var meter = $("#meter");
    var no = 0;

    if (val != "") {
      if (val.length <= 6) no = 1;
      if (val.length > 6 && (val.match(/[a-z]/) || val.match(/\d+/) || val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))) no = 2;
      if (val.length > 6 && ((val.match(/[a-z]/) && val.match(/\d+/)) || (val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) || (val.match(/[a-z]/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)))) no = 3;
      if (val.length > 6 && val.match(/[a-z]/) && val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) no = 4;

      if (no == 1) {
        $("#meter").animate({ width: '50px' }, 300);
        meter.css("background-color", "red");
        $("#pass_type").text("Very Weak");
      }
      if (no == 2) {
        $("#meter").animate({ width: '100px' }, 300);
        meter.css("background-color", "#F5BCA9");
        $("#pass_type").text("Weak");
      }
      if (no == 3) {
        $("#meter").animate({ width: '150px' }, 300);
        meter.css("background-color", "#FF8000");
        $("#pass_type").text("Good");
      }
      if (no == 4) {
        $("#meter").animate({ width: '200px' }, 300);
        meter.css("background-color", "#00FF40");
        $("#pass_type").text("Strong");
      }
    } else {
      meter.css("background-color", "");
      $("#pass_type").text("");
    }
  }

  // SweetAlert for missing fields and validations
  $("#registrationForm").submit(function(event) {
    var formValid = true;

    // Check if all required fields are filled
    $("input[required]").each(function() {
      if ($(this).val() == "") {
        formValid = false;
        $(this).addClass("is-invalid");  // Add invalid class for empty inputs
      } else {
        $(this).removeClass("is-invalid");  // Remove invalid class if input is filled
      }
    });

    // If the form is not valid, show SweetAlert
    if (!formValid) {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Please fill out all required fields!',
        confirmButtonColor: '#3085d6',
        background: '#fff',
        showCloseButton: true,
        closeButtonAriaLabel: 'Close',
        customClass: {
          popup: 'swal2-popup',
          title: 'swal2-title',
          content: 'swal2-content',
          confirmButton: 'swal2-confirm'
        }
      }).then(function() {
        // Now prevent form submission after showing SweetAlert
        event.preventDefault(); // Prevent form submission
      });
    }
  });
});
</script>


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->


<?php
if(isset($_POST['register'])){
  $remoteip = $_SERVER['REMOTE_ADDR'];

  if($result['success'] == 0){
    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_pass = $_POST['c_pass'];

    $get_email = "select * from customers where customer_email='$c_email'";
    $run_email = mysqli_query($con,$get_email);
    $check_email = mysqli_num_rows($run_email);

    if($check_email == 1){
      echo "<script>
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'This email is already registered, try another one',
          confirmButtonColor: '#d33', 
          background: '#fff', 
          showCloseButton: true
        });
      </script>";
      exit();
    }

    $customer_confirm_code = mt_rand();
    $subject = "Email Confirmation Message";
    $from = "fahmi@cakrawala.ac.id";
    $message = "
      <h2>Email Confirmation By DibimbingShop.com $c_name</h2>
      <a href='localhost/ecom_store/customer/my_account.php?$customer_confirm_code'>Click Here To Confirm Email</a>";
    
    $headers = "From: $from \r\n";
    $headers .= "Content-type: text/html\r\n";
    mail($c_email,$subject,$message,$headers);

    $insert_customer = "insert into customers (customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image,customer_ip,customer_confirm_code) values ('$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image','$c_ip','$customer_confirm_code')";
    $run_customer = mysqli_query($con,$insert_customer);

    $sel_cart = "select * from cart where ip_add='$c_ip'";
    $run_cart = mysqli_query($con,$sel_cart);
    $check_cart = mysqli_num_rows($run_cart);

    if($check_cart > 0){
      $_SESSION['customer_email'] = $c_email;
      echo "<script>
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'You have been Registered Successfully',
          confirmButtonColor: '#3085d6',
          background: '#fff',
          showCloseButton: true
        }).then(function(result){
          if(result.isConfirmed){
            window.location='login.php';
          }
        });
      </script>";
    } else {
      $_SESSION['customer_email'] = $c_email;
      echo "<script>
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'You have been Registered Successfully',
          confirmButtonColor: '#3085d6',
          background: '#fff',
          showCloseButton: true
        }).then(function(result){
          if(result.isConfirmed){
            window.location='index.php';
          }
        });
      </script>";
    }
  } else {
    echo "<script>Swal.fire('Error', 'Please Select Captcha, Try Again', 'error');</script>";
  }
}
?>
</body>
</html>
