<?php
// Fetch customer data
$customer_session = $_SESSION['customer_email'];
$get_customer = "SELECT * FROM customers WHERE customer_email='$customer_session'";
$run_customer = mysqli_query($con, $get_customer);
$row_customer = mysqli_fetch_array($run_customer);

// Store customer data in variables
$customer_id = $row_customer['customer_id'];
$customer_name = $row_customer['customer_name'];
$customer_email = $row_customer['customer_email'];
$customer_country = $row_customer['customer_country'];
$customer_city = $row_customer['customer_city'];
$customer_contact = $row_customer['customer_contact'];
$customer_address = $row_customer['customer_address'];
$customer_image = $row_customer['customer_image'];
?>

<div class="container py-4">
    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-header bg-gradient-primary text-white" style="border-radius: 15px 15px 0 0; height:45px; padding-top: 2px; ">
            <h4 class="mb-0 text-center" style="font-weight: 500;"><i class="fa fa-user-edit mr-2"></i>Edit Your Account</h4>
        </div>
        <div class="card-body p-4">
            <form action="" method="post" enctype="multipart/form-data">
                <br>
                <div class="row">
                    <!-- Personal Information Section -->
                    <div class="col-md-6">
                        <div class="form-group mb-4 customer-Name" style='padding-left : 20px;'>
                            <label for="c_name" class="text-muted"><i class="fa fa-user mr-1"></i> Customer Name:</label>
                            <input type="text" id="c_name" name="c_name" class="form-control form-control-lg border-0 bg-light" required value="<?php echo $customer_name; ?>">
                        </div>
                        
                        <div class="form-group mb-4" style='padding-left : 20px;'>
                            <label for="c_email" class="text-muted"><i class="fa fa-envelope mr-1"></i> Customer Email:</label>
                            <input type="email" id="c_email" name="c_email" class="form-control form-control-lg border-0 bg-light" required value="<?php echo $customer_email; ?>">
                        </div>
                        
                        <div class="form-group mb-4" style='padding-left : 20px;'>
                            <label for="c_contact" class="text-muted"><i class="fa fa-phone mr-1"></i> Customer Contact:</label>
                            <input type="text" id="c_contact" name="c_contact" class="form-control form-control-lg border-0 bg-light" value="<?php echo $customer_contact; ?>">
                        </div>
                    </div>
                    
                    <!-- Location Information Section -->
                    <div class="col-md-6" style='padding-right : 20px;'>
                        <div class="form-group mb-4">
                            <label for="c_country" class="text-muted"><i class="fa fa-globe mr-1"></i> Customer Country:</label>
                            <input type="text" id="c_country" name="c_country" class="form-control form-control-lg border-0 bg-light" value="<?php echo $customer_country; ?>">
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="c_city" class="text-muted"><i class="fa fa-building mr-1"></i> Customer City:</label>
                            <input type="text" id="c_city" name="c_city" class="form-control form-control-lg border-0 bg-light" value="<?php echo $customer_city; ?>">
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="c_address" class="text-muted"><i class="fa fa-map-marker mr-1"></i> Customer Address:</label>
                            <input type="text" id="c_address" name="c_address" class="form-control form-control-lg border-0 bg-light" value="<?php echo $customer_address; ?>">
                        </div>
                    </div>
                    
                    <!-- Profile Image Section - Redesigned -->
                    <div class="col-12" style='padding-left : 40px;'>
                        <div class="form-group mb-4">
                            <label for="c_image" class="text-muted mb-3"><i class="fa fa-image mr-1"></i> Profile Image:</label>
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="custom-file mb-3">
                                        <input type="file" id="c_image" name="c_image" class="custom-file-input">
                                    </div>
                                    <small class="text-muted">Upload a new image to change your profile picture</small>
                                </div>
                                
                                <div class="col-md-4 text-center">
                                    <!-- Current Image now positioned better -->
                                </div>
                            </div>
                            <br>
                            <!-- Current Image Section Moved Below -->
                            
                        </div>
                    </div>
                </div>
                <center>
                <div class="d-flex justify-content-center mt-4" style='padding-left : 20px;'>
                <button type="submit" name="update" class="btn btn-primary btn-sm px-4 py-2" style="border-radius: 50px;">
                    <i class="fa fa-user-md mr-2"></i> Update Account
                </button>

                </div>
                </center>
                <br>
            </form>
        </div>
    </div>
</div>

<br>
<?php
// Process form submission
if(isset($_POST['update'])) {
    $update_id = $customer_id;
    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_country = $_POST['c_country'];
    $c_city = $_POST['c_city'];
    $c_contact = $_POST['c_contact'];
    $c_address = $_POST['c_address'];
    
    // Handle image upload
    $c_image = $_FILES['c_image']['name'];
    
    // Only process image if a new one was uploaded
    if(!empty($c_image)) {
        $c_image_tmp = $_FILES['c_image']['tmp_name'];
        move_uploaded_file($c_image_tmp, "customer_images/$c_image");
        $image_update = ", customer_image='$c_image'";
    } else {
        $image_update = ""; // Don't update image if no new image
    }
    
    // Update customer data in database
    $update_customer = "UPDATE customers SET 
                        customer_name='$c_name',
                        customer_email='$c_email',
                        customer_country='$c_country',
                        customer_city='$c_city',
                        customer_contact='$c_contact',
                        customer_address='$c_address'
                        $image_update 
                        WHERE customer_id='$update_id'";
                        
    $run_customer = mysqli_query($con, $update_customer);
    
    if($run_customer) {
        echo "<script>
            Swal.fire({
                title: 'Success!',
                text: 'Your account has been updated. Please login again.',
                icon: 'success',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn-primary btn-lg',
                    popup: 'animated fadeInDown'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'logout.php';
                }
            });
        </script>";
    }
}
?>

<!-- Optional: Add SweetAlert and Bootstrap JS CDN if not already included in your project -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Custom file input label
document.querySelector('.custom-file-input').addEventListener('change', function(e) {
    var fileName = e.target.files[0].name;
    var nextSibling = e.target.nextElementSibling;
    nextSibling.innerText = fileName;
});
</script>

<style>

/* Custom styling for the update button */
.btn-primary.btn-sm {
    font-size: 12px; /* Membuat ukuran font lebih kecil */
    padding: 5px 40px; /* Menyesuaikan padding untuk tombol lebih kecil */
    border-radius: 30px; /* Membuat border tombol lebih bulat */
}

/* Label hover effect */
.form-group label {
    transition: all 0.3s ease;
}

.form-group:hover label {
    color: #4a89dc;
    transform: translateX(3px);
}

/* Input field hover effect */
.form-control {
    transition: all 0.9s ease;
}

.form-control:hover {
    background-color: white !important;
    border-left: 1.2px solid #4a89dc;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
}

/* Icon hover effect - zoom animation */
.form-group i.fa {
    transition: all 0.3s ease;
}

.form-group:hover i.fa {
    transform: scale(1.2);
    color: #4a89dc;
}
    /* Softer UI Styles */
    .card {
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(45deg, #4a89dc, #5d9cec);
    }
    
    .form-control {
        border-radius: 10px;
        padding: 12px 15px;
        transition: all 0.3s;
    }
    
    .form-control:focus {
        box-shadow: 0 0 15px rgba(0, 123, 255, 0.15);
        transform: translateY(-2px);
        border: none;
    }
    
    label {
        font-weight: 500;
        margin-bottom: 8px;
    }
    
    .btn-primary {
        background: linear-gradient(45deg, #4a89dc, #5d9cec);
        border: none;
        box-shadow: 0 4px 15px rgba(74, 137, 220, 0.3);
        padding: 12px 30px;
        transition: all 0.3s;
    }
    
    .btn-primary:hover {
        background: linear-gradient(45deg, #5d9cec, #4a89dc);
        box-shadow: 0 6px 20px rgba(74, 137, 220, 0.4);
        transform: translateY(-3px);
    }
    
    .custom-file-label {
        border-radius: 10px;
        padding: 12px 15px;
        height: auto;
        line-height: 1.5;
    }
    
    .custom-file-label::after {
        height: 100%;
        border-radius: 0 10px 10px 0;
        display: flex;
        align-items: center;
        background: linear-gradient(45deg, #4a89dc, #5d9cec);
        color: white;
    }

    .img-thumbnail {
        border: 3px solid white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }
    
    .img-thumbnail:hover {
        transform: scale(1.05);
    }
    
    /* Responsive adjustments */
    @media (max-width: 767px) {
        .form-control {
            padding: 10px 12px;
        }
        
        .btn-primary {
            padding: 10px 20px;
        }
    }
</style>