<?php
session_start();
include("includes/db.php");
include("functions/functions.php");

// Hanya proses jika user sudah login
if (isset($_SESSION['customer_email'])) {

    $session_email = $_SESSION['customer_email'];
    $select_customer = "SELECT * FROM customers WHERE customer_email='$session_email'";
    $run_customer = mysqli_query($con, $select_customer);
    $row_customer = mysqli_fetch_array($run_customer);
    $customer_id = $row_customer['customer_id'];

    $ip_add = getRealUserIp();
    $status = "pending";
    $invoice_no = mt_rand();

    $select_cart = "SELECT * FROM cart WHERE ip_add='$ip_add'";
    $run_cart = mysqli_query($con, $select_cart);

    while ($row_cart = mysqli_fetch_array($run_cart)) {
        $pro_id = $row_cart['p_id'];
        $pro_type = $row_cart['type'];
        $pro_qty = $row_cart['qty'];
        $sub_total = $row_cart['p_price'] * $pro_qty;

        // Insert orders
        $insert_customer_order = "INSERT INTO customer_orders (customer_id, due_amount, invoice_no, qty, type, order_date, order_status) 
                                  VALUES ('$customer_id', '$sub_total', '$invoice_no', '$pro_qty', '$pro_type', NOW(), '$status')";
        mysqli_query($con, $insert_customer_order);

        $insert_pending_order = "INSERT INTO pending_orders (customer_id, invoice_no, product_id, qty, type, order_status) 
                                 VALUES ('$customer_id', '$invoice_no', '$pro_id', '$pro_qty', '$pro_type', '$status')";
        mysqli_query($con, $insert_pending_order);

        $delete_cart = "DELETE FROM cart WHERE ip_add='$ip_add'";
        mysqli_query($con, $delete_cart);
    }

    // Output hanya SweetAlert, tanpa layout lain
    echo "
    <html>
    <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Order Submitted',
                text: 'Your order has been submitted, Thank you!',
                showConfirmButton: false,
                timer: 1000
            }).then(() => {
                window.location.href = 'customer/my_account.php?my_orders';
            });
        </script>
    </body>
    </html>
    ";

} else {
    // User belum login
    echo "
    <html>
    <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Required',
                text: 'You must be logged in to proceed with the checkout.',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'login.php';
            });
        </script>
    </body>
    </html>
    ";
}
?>
