<!-- Add SweetAlert2 CDN link in your <head> section if not already added -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="card shadow-sm border-0 sidebar-menu">
    <!-- Sidebar Header -->
    <div class="card-header bg-primary text-white">
        <?php
        $customer_session = $_SESSION['customer_email'];
        $get_customer = "SELECT * FROM customers WHERE customer_email='$customer_session'";
        $run_customer = mysqli_query($con, $get_customer);
        $row_customer = mysqli_fetch_array($run_customer);

        $customer_image = $row_customer['customer_image'];
        $customer_name = $row_customer['customer_name'];

        if (isset($_SESSION['customer_email'])) {
            if (!empty($customer_image) && file_exists("customer_images/$customer_image")) {
                $image_path = "customer_images/$customer_image";
            } else {
                $image_path = "customer_images/user.png";
            }

            echo "
            <div class='text-center mb-3'>
            <center>
                <img src='$image_path' class='img-fluid rounded-circle profile-img' style='width: 150px; height: 200px;padding-top : 20px;'>
                <h5 class='mt-3 mb-0'><i class='fa fa-user-circle mr-2' style='padding-bottom : 20px;padding-top : 10px;'></i> $customer_name</h5>
            </center>
            </div>
            ";
        }
        ?>
    </div>

    <!-- Sidebar Body -->
    <div class="card-body p-0">
        <div class="list-group list-group-flush">
            <a href="my_account.php?my_orders" class="list-group-item list-group-item-action d-flex align-items-center <?php if(isset($_GET['my_orders'])){ echo "active"; } ?>">
                <i class="fa fa-list fa-fw mr-3"></i> <span>My Orders</span>
            </a>
            
            <a href="my_account.php?pay_offline" class="list-group-item list-group-item-action d-flex align-items-center <?php if(isset($_GET['pay_offline'])){ echo "active"; } ?>">
                <i class="fa fa-bolt fa-fw mr-3"></i> <span>Pay Offline</span>
            </a>
            
            <a href="my_account.php?edit_account" class="list-group-item list-group-item-action d-flex align-items-center <?php if(isset($_GET['edit_account'])){ echo "active"; } ?>">
                <i class="fa fa-pencil fa-fw mr-3"></i> <span>Edit Account</span>
            </a>
            
            <a href="my_account.php?change_pass" class="list-group-item list-group-item-action d-flex align-items-center <?php if(isset($_GET['change_pass'])){ echo "active"; } ?>">
                <i class="fa fa-user fa-fw mr-3"></i> <span>Change Password</span>
            </a>
            
            <a href="my_account.php?my_wishlist" class="list-group-item list-group-item-action d-flex align-items-center <?php if(isset($_GET['my_wishlist'])){ echo "active"; } ?>">
                <i class="fa fa-heart fa-fw mr-3"></i> <span>My Wishlist</span>
            </a>
            
            <a href="javascript:void(0);" onclick="confirmDeleteAccount()" class="list-group-item list-group-item-action d-flex align-items-center <?php if(isset($_GET['delete_account'])){ echo "active"; } ?>">
                <i class="fa fa-trash fa-fw mr-3"></i> <span>Delete Account</span>
            </a>
            
            <!-- Logout with SweetAlert popup -->
            <a href="javascript:void(0);" onclick="confirmLogout()" class="list-group-item list-group-item-action d-flex align-items-center text-danger">
                <i class="fa fa-sign-out fa-fw mr-3"></i> <span>Logout</span>
            </a>
        </div>
    </div>
</div>

<!-- Custom CSS untuk responsivitas tambahan -->
<style>
    @media (max-width: 767px) {
        .sidebar-menu {
            margin-bottom: 10px;
        }
        
        .profile-img {
            width: 100px !important;
            height: 100px !important;
        }
    }
    
    .list-group-item-action:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
        transition: all 0.2s;
    }
    
    .list-group-item-action.active {
        background-color: #007bff;
        border-color: #007bff;
    }
    
    .card {
        border-radius: 8px;
        overflow: hidden;
    }
</style>

<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, logout!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'logout.php';
            }
        });
    }


    function confirmDeleteAccount() {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Once deleted, you will not be able to recover your account!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, keep it'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the delete account page to handle the deletion
                window.location.href = 'delete_account.php';
            }
        });
    }

</script>
