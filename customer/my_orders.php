<?php
include("includes/db.php");

$customer_session = $_SESSION['customer_email'];
$get_customer = "SELECT * FROM customers WHERE customer_email='$customer_session'";
$run_customer = mysqli_query($con, $get_customer);
$row_customer = mysqli_fetch_array($run_customer);
$customer_id = $row_customer['customer_id'];
?>

<div class="container py-4">
    <!-- Header Section -->
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px; overflow: hidden;">
        <div class="card-body text-center p-5">
            <div class="mb-4">
                <i class="fa fa-shopping-bag fa-3x text-primary mb-3"></i>
                <h2 class="font-weight-bold">My Orders</h2>
                <p class="lead text-muted">All your orders in one place, easy to track.</p>
                <p class="text-muted">
                    If you have any questions, please feel free to <a href="../contact.php" class="text-primary font-weight-bold">contact us</a>, 
                    our customer service center is working for you 24/7.
                </p>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
        <div class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fa fa-list mr-2" style="padding-left: 10px;"></i>Order History</h5>
            <div class="form-inline">
                <label for="perPage" class="mr-2 mb-0">Rows:</label>
                <select id="perPage" class="form-control form-control-sm">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="15">15</option>
                    <option value="25">25</option>
                </select>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3">#</th>
                            <th class="py-3">Amount</th>
                            <th class="py-3">Invoice</th>
                            <th class="py-3">Qty</th>
                            <th class="py-3">Type</th>
                            <th class="py-3">Order Date</th>
                            <th class="py-3">Status</th>
                            <th class="py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody id="ordersData">
                        <!-- AJAX Data will be inserted here -->
                    </tbody>
                </table>
            </div>
            <div id="paginationLinks" class="p-3 d-flex justify-content-center"></div>
        </div>
    </div>

<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .badge-pill {
        font-weight: 500;
        letter-spacing: 0.5px;
    }
    .badge-danger {
        background-color: #ff6b6b;
    }
    .badge-success {
        background-color: #51cf66;
    }
    .btn-outline-primary {
        border-radius: 50px;
        transition: all 0.3s ease;
    }
    .btn-outline-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,123,255,0.2);
    }
    .table th {
        font-weight: 500;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 1px;
    }
    .table td {
        vertical-align: middle;
    }
    @media (max-width: 767px) {
        .card-body {
            padding: 1.5rem !important;
        }
        .table th {
            font-size: 11px;
        }
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function loadOrders(page = 1, perPage = 10) {
    $.ajax({
        url: 'fetch_orders.php',
        type: 'GET',
        dataType: 'json',
        data: {
            page: page,
            per_page: perPage
        },
        success: function(response) {
            $('#ordersData').html(response.orders);
            $('#paginationLinks').html(response.pagination);
        },
        error: function() {
            $('#ordersData').html('<tr><td colspan="8" class="text-center py-4 text-danger">Failed to load orders.</td></tr>');
        }
    });
}

$(document).ready(function() {
    let currentPage = 1;

    loadOrders(currentPage, $('#perPage').val());

    $('#perPage').change(function() {
        currentPage = 1;
        loadOrders(currentPage, $(this).val());
    });

    $(document).on('click', '.page-link[data-page]', function(e) {
        e.preventDefault();
        currentPage = $(this).data('page');
        loadOrders(currentPage, $('#perPage').val());
    });
});
</script>
