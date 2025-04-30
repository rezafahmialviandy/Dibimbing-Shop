<?php
session_start();

if (!isset($_SESSION['customer_email'])) {
    echo "<script>window.open('../checkout.php','_self')</script>";
    exit();
}

include("includes/db.php");
include("includes/header.php");
include("functions/functions.php");
include("includes/main.php");

// Jika form submit (POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_payment'])) {
    $order_id = intval($_POST['order_id']);
    $due_amount = $_POST['due_amount'];
    $invoice_no = $_POST['invoice_no'];
    $payment_mode = $_POST['payment_mode'];
    $ref_no = $_POST['ref_no'];
    $code = $_POST['code'];
    $payment_date = $_POST['payment_date'];
    $complete = "Complete";

    $insert_payment = "INSERT INTO payments (invoice_no, amount, payment_mode, ref_no, code, payment_date)
                       VALUES ('$invoice_no', '$due_amount', '$payment_mode', '$ref_no', '$code', '$payment_date')";
    $run_payment = mysqli_query($con, $insert_payment);

    $update_customer_order = "UPDATE customer_orders SET order_status='$complete' WHERE order_id='$order_id'";
    $run_customer_order = mysqli_query($con, $update_customer_order);

    $update_pending_order = "UPDATE pending_orders SET order_status='$complete' WHERE order_id='$order_id'";
    $run_pending_order = mysqli_query($con, $update_pending_order);

    if ($run_payment && $run_customer_order && $run_pending_order) {
        echo "<script>
                Swal.fire({
                  icon: 'success',
                  title: 'Payment Confirmed!',
                  text: 'Your payment has been received. Thank you!',
                  confirmButtonText: 'OK'
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href = 'my_account.php?my_orders';
                  }
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                  icon: 'error',
                  title: 'Payment Failed',
                  text: 'There was an issue processing your payment. Please try again.',
                  confirmButtonText: 'OK'
                });
              </script>";
    }
    exit(); // Penting supaya gak lanjut ke tampilan form lagi
}

// Kalau buka halaman (GET)
if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']);
    $query = "SELECT invoice_no, due_amount, order_date FROM customer_orders WHERE order_id='$order_id'";
    $result = mysqli_query($con, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $invoice_no = $row['invoice_no'];
        $due_amount = $row['due_amount'];
        $order_date = $row['order_date'];
    } else {
        echo "<script>
                Swal.fire({
                  icon: 'warning',
                  title: 'Order Not Found',
                  text: 'We could not find the order you specified.',
                  confirmButtonText: 'Back to Orders'
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href = 'my_account.php?my_orders';
                  }
                });
              </script>";
        exit();
    }
} else {
    echo "<script>
            Swal.fire({
              icon: 'warning',
              title: 'No Order Selected',
              text: 'Please select an order to proceed with payment.',
              confirmButtonText: 'Back to Orders'
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = 'my_account.php?my_orders';
              }
            });
          </script>";
    exit();
}
?>

<!-- Custom CSS -->
<style>
    /* Reset dan base styling */
    * {
        box-sizing: border-box;
    }
    
    body {
        background-color: #f5f7fb;
    }
    
    /* Container styling */
    .payment-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 15px;
    }
    
    /* Card dan header styling */
    .payment-card {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 25px;
        overflow: hidden;
        border: none;
    }
    
    .payment-header {
        color: #333;
        font-weight: 700;
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 15px;
        position: relative;
    }
    
    .payment-header:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 180px;
        height: 3px;
        background: #4361ee;
    }
    
    /* Info box styling */
    .info-box {
        padding: 20px;
        background-color: #f8f9fc;
        border-radius: 12px;
        margin-bottom: 25px;
        border-bottom: 3px solid #4361ee;
    }
    
    .info-row {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        margin: 0 -10px;
    }
    
    .info-item {
        flex: 1;
        min-width: 160px;
        padding: 0 10px;
        margin-bottom: 10px;
    }
    
    .info-label {
        font-size: 14px;
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 5px;
    }
    
    .info-value {
        font-size: 16px;
        font-weight: 700;
        color: #333;
        margin: 0;
    }
    
    .amount-value {
        color: #e63946;
    }
    
    /* Form styling */
    .form-section {
        padding: 0 20px;
    }
    
    .form-row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px 15px;
    }
    
    .form-group {
        flex: 1;
        min-width: 250px;
        padding: 0 10px;
        margin-bottom: 20px;
    }
    
    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #4361ee;
        margin-bottom: 8px;
    }
    
    .form-control {
        width: 100%;
        height: 48px;
        padding: 10px 15px;
        font-size: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        transition: all 0.2s ease;
    }
    
    .form-control:focus {
        border-color: #4361ee;
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        outline: none;
    }
    
    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%234361ee' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        padding-right: 40px;
    }
    
    /* Button styling */
    .btn-container {
        text-align: center;
        padding: 10px 20px 30px;
    }
    
    .btn-confirm {
        background-color: #4361ee;
        color: white;
        border: none;
        border-radius: 50px;
        padding: 14px 35px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
    }
    
    .btn-confirm:hover {
        background-color: #3a56d4;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(67, 97, 238, 0.4);
    }
    
    .btn-icon {
        margin-right: 8px;
    }
    
    /* Instructions box */
    .instructions-card {
        background-color: #fff;
        border-radius: 12px;
        border-left: 4px solid #4361ee;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    
    .instructions-title {
        display: flex;
        align-items: center;
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
    }
    
    .instructions-icon {
        color: #4361ee;
        margin-right: 10px;
    }
    
    .instructions-list {
        margin: 0;
        padding-left: 20px;
    }
    
    .instructions-list li {
        margin-bottom: 8px;
        color: #6c757d;
        font-size: 14px;
    }
    
    /* Date input styling */
    input[type="date"] {
        position: relative;
    }
    
    input[type="date"]::-webkit-calendar-picker-indicator {
        background: transparent;
        color: transparent;
        cursor: pointer;
        height: 100%;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        width: 100%;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .info-row {
            flex-direction: column;
        }
        
        .info-item {
            margin-bottom: 15px;
        }
        
        .form-group {
            flex: 0 0 100%;
        }
    }
</style>

<!-- Content Starts -->
<main>
  <div class="payment-container mt-5 mb-5">
    <div class="payment-card">
      <div class="p-4 p-md-5">
        <h1 class="payment-header">Confirm Your Payment</h1>
          
        <div class="info-box">
          <div class="info-row">
            <div class="info-item">
              <div class="info-label">Invoice Number</div>
              <p class="info-value">#<?php echo $invoice_no; ?></p>
            </div>
            <div class="info-item">
              <div class="info-label">Amount Due</div>
              <p class="info-value amount-value">Rp <?php echo number_format($due_amount, 0, ',', '.'); ?></p>
            </div>
            <div class="info-item">
              <div class="info-label">Order Date</div>
              <p class="info-value"><?php echo date('d M Y', strtotime($order_date)); ?></p>
            </div>
          </div>
        </div>

        <form action="confirm.php" method="post" enctype="multipart/form-data" class="form-section">
          <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
          <input type="hidden" name="due_amount" value="<?php echo $due_amount; ?>">
          <input type="hidden" name="invoice_no" value="<?php echo $invoice_no; ?>">

          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Payment Method</label>
              <select name="payment_mode" class="form-control" required>
                <option value="">-- Select Payment Mode --</option>
                <option value="Bank Code">Bank Transfer</option>
                <option value="UBL/Omni">UBL/Omni Payment</option>
                <option value="Western Union">Western Union</option>
              </select>
            </div>

            <div class="form-group">
              <label class="form-label">Transaction/Reference ID</label>
              <input type="text" class="form-control" name="ref_no" placeholder="Enter transaction reference number" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Confirmation Code</label>
              <input type="text" class="form-control" name="code" placeholder="Enter confirmation code" required>
            </div>

            <div class="form-group">
              <label class="form-label">Payment Date</label>
              <input type="date" class="form-control" name="payment_date" value="<?php echo date('Y-m-d'); ?>">
            </div>
          </div>

          <div class="btn-container">
            <button type="submit" name="confirm_payment" class="btn-confirm">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="btn-icon"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
              Confirm Payment
            </button>
          </div>
        </form>
      </div>
    </div>
    
    <div class="instructions-card">
      <div class="instructions-title">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="instructions-icon"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
        Payment Instructions
      </div>
      <ul class="instructions-list">
        <li>Please make sure all payment details are correct before confirming.</li>
        <li>Your order will be processed once payment is verified.</li>
        <li>For any issues, please contact our customer support.</li>
      </ul>
    </div>
  </div>
</main>

<?php include("includes/footer.php"); ?>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Feather Icons untuk icon yang lebih modern -->
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<!-- Bootstrap and jQuery -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
// Initialize Feather Icons
document.addEventListener('DOMContentLoaded', function() {
    // Replace SVG with Feather icons
    feather.replace();
    
    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        var isValid = true;
        
        this.querySelectorAll('[required]').forEach(function(field) {
            if (field.value === '') {
                isValid = false;
                field.classList.add('is-invalid');
                field.style.borderColor = '#dc3545';
            } else {
                field.classList.remove('is-invalid');
                field.classList.add('is-valid');
                field.style.borderColor = '#28a745';
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Form Incomplete',
                text: 'Please fill all required fields',
                confirmButtonText: 'OK'
            });
        }
    });
    
    // Add focus effects
    document.querySelectorAll('.form-control').forEach(function(input) {
        input.addEventListener('focus', function() {
            this.style.borderColor = '#4361ee';
            this.style.boxShadow = '0 0 0 3px rgba(67, 97, 238, 0.15)';
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.style.borderColor = '#ddd';
                this.style.boxShadow = 'none';
            }
        });
    });
});
</script>

</body>
</html>