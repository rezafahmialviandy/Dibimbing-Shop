<?php
// Start the session
session_start();
include("includes/db.php");
include("includes/header.php");
include("functions/functions.php");
include("includes/main.php");

if (isset($_SESSION['customer_email'])) {
    // User is logged in, continue processing the order

    $session_email = $_SESSION['customer_email'];
    $select_customer = "SELECT * FROM customers WHERE customer_email='$session_email'";
    $run_customer = mysqli_query($con, $select_customer);
    $row_customer = mysqli_fetch_array($run_customer);
    $customer_id = $row_customer['customer_id'];

    // Initialize order variables
    $ip_add = getRealUserIp();
    $status = "pending";
    $invoice_no = mt_rand();

    // Select cart items
    $select_cart = "SELECT * FROM cart WHERE ip_add='$ip_add'";
    $run_cart = mysqli_query($con, $select_cart);

    while ($row_cart = mysqli_fetch_array($run_cart)) {
        $pro_id = $row_cart['p_id'];
        $pro_type = $row_cart['type'];
        $pro_qty = $row_cart['qty'];
        $sub_total = $row_cart['p_price'] * $pro_qty;

        // Insert customer order into database
        $insert_customer_order = "INSERT INTO customer_orders (customer_id, due_amount, invoice_no, qty, type, order_date, order_status) 
                                  VALUES ('$customer_id', '$sub_total', '$invoice_no', '$pro_qty', '$pro_type', NOW(), '$status')";
        $run_customer_order = mysqli_query($con, $insert_customer_order);

        // Insert pending order into database
        $insert_pending_order = "INSERT INTO pending_orders (customer_id, invoice_no, product_id, qty, type, order_status) 
                                 VALUES ('$customer_id', '$invoice_no', '$pro_id', '$pro_qty', '$pro_type', '$status')";
        $run_pending_order = mysqli_query($con, $insert_pending_order);

        // Delete items from cart
        $delete_cart = "DELETE FROM cart WHERE ip_add='$ip_add'";
        $run_delete = mysqli_query($con, $delete_cart);
    }

    // Show SweetAlert after the order is processed
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Order Submitted',
            text: 'Your order has been submitted, Thank you!',
            showConfirmButton: false,
            timer: 3000
        }).then(() => {
            // Redirect to my orders page after SweetAlert
            window.location.href = 'customer/my_account.php?my_orders';
        });
    </script>";
} else {
    // If the customer is not logged in, show the login form
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Login Required',
            text: 'You must be logged in to proceed with the checkout.',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'customer/customer_login.php';
        });
    </script>";
}

include("includes/footer.php");
?>
