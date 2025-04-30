<?php
$c_email = $_SESSION['customer_email'];
?>

<div class="delete-container">
  <h1>Do You Really Want To Delete Your Account?</h1>
  <form action="" method="post">
    <button class="btn btn-danger btn-custom" type="submit" name="yes">Yes, I want to delete</button>
    <button class="btn btn-primary btn-custom" type="submit" name="no">No, I don't want to delete</button>
  </form>
</div>

<?php
  if(isset($_POST['yes'])){
    echo "<script>
            Swal.fire({
              title: 'Are you sure?',
              text: 'Once deleted, you will not be able to recover your account!',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, delete it!',
              cancelButtonText: 'No, keep it'
            }).then((result) => {
              if (result.isConfirmed) {
                // Proceed with the deletion if confirmed
                window.location.href = 'delete_account.php?confirm=true';
              } else {
                // Do nothing if canceled
                window.location.href = 'my_account.php?delete_account';
              }
            });
          </script>";
  }

  if(isset($_GET['confirm']) && $_GET['confirm'] == 'true'){
    // Proceed with deleting the account after confirmation
    $delete_customer = "DELETE FROM customers WHERE customer_email='$c_email'";
    $run_delete = mysqli_query($con, $delete_customer);

    if($run_delete){
      session_destroy();
      echo "<script>
              Swal.fire({
                icon: 'success',
                title: 'Account Deleted!',
                text: 'Your account has been deleted. Goodbye!',
                confirmButtonText: 'OK'
              }).then((result) => {
                if (result.isConfirmed) {
                  window.open('../index.php', '_self');
                }
              });
            </script>";
    }
  }

  if(isset($_POST['no'])){
    echo "<script>window.open('my_account.php?my_orders','_self')</script>";
  }
?>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/limonte-sweetalert2@11.6.16/sweetalert2.min.js"></script>

<style>
  /* Custom Centering and Form Styling */

  .card {
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
  .delete-container {
    text-align: center;
    margin-top: 50px;
  }

  h1 {
    font-size: 32px;
    font-weight: 600;
    color: #333;
    margin-bottom: 30px;
  }

  /* Custom Button Styling */
  .btn-custom {
    padding: 12px 30px;
    font-size: 16px;
    border-radius: 50px;
    width: 200px;
    margin: 10px;
    transition: all 0.3s ease;
    cursor: pointer;
    text-align: center;
  }

  .btn-danger {
    background-color: #e74c3c;
    border: none;
    color: white;
  }

  .btn-danger:hover {
    background-color: #c0392b;
    transform: scale(1.05);
  }

  .btn-primary {
    background-color: #3498db;
    border: none;
    color: white;
  }

  .btn-primary:hover {
    background-color: #2980b9;
    transform: scale(1.05);
  }

  /* Responsive design */
  @media (max-width: 767px) {
    .btn-custom {
      width: 100%;
      padding: 12px;
    }
  }
</style>
