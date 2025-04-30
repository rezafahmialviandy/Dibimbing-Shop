<?php
session_start();
header('Content-Type: application/json');
include("includes/db.php");

$customer_email = $_SESSION['customer_email'];
$get_customer = "SELECT * FROM customers WHERE customer_email='$customer_email'";
$run_customer = mysqli_query($con, $get_customer);
$row_customer = mysqli_fetch_array($run_customer);
$customer_id = $row_customer['customer_id'];

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$per_page = isset($_GET['per_page']) ? intval($_GET['per_page']) : 10;
$offset = ($page - 1) * $per_page;

$query = "SELECT * FROM customer_orders WHERE customer_id='$customer_id' ORDER BY order_date DESC LIMIT $offset, $per_page";
$result = mysqli_query($con, $query);

$data = '';
$i = $offset;

while ($row = mysqli_fetch_assoc($result)) {
    $i++;
    $order_id = $row['order_id'];
    $due_amount = $row['due_amount'];
    $invoice_no = $row['invoice_no'];
    $qty = $row['qty'];
    $type = $row['type'];
    $order_date = substr($row['order_date'], 0, 11);
    $order_status = $row['order_status'];

    $badge = ($order_status == 'pending') ?
        "<span class='badge badge-pill badge-danger px-3 py-2'>Unpaid</span>" :
        "<span class='badge badge-pill badge-success px-3 py-2'>Paid</span>";

    $button = ($order_status == 'pending') ? 
        "<a href='confirm.php?order_id=$order_id' target='blank' class='btn btn-outline-primary btn-sm rounded-pill px-3'>
            <i class='fa fa-check-circle mr-1'></i> Confirm Payment
        </a>" : "";

    $data .= "
        <tr>
            <td class='py-3' style='padding-top:20px'>$i</td>
            <td class='py-3 font-weight-bold' style='padding-top:20px'>Rp " . number_format($due_amount, 0, ',', '.') . "</td>
            <td class='py-3' style='padding-top:20px'><span class='text-muted'>#$invoice_no</span></td>
            <td class='py-3' style='padding-top:20px'>$qty</td>
            <td class='py-3' style='padding-top:20px'>$type</td>
            <td class='py-3' style='padding-top:20px'>$order_date</td>
            <td class='py-3' style='padding-top:20px'>$badge</td>
            <td class='py-3'>$button</td>
        </tr>
    ";
}

if ($data == '') {
    $data = "
        <tr>
            <td colspan='8' class='text-center py-5'>
                <div class='my-4'>
                    <i class='fa fa-shopping-cart fa-3x text-muted mb-3'></i>
                    <h5>You haven't placed any orders yet</h5>
                    <p class='text-muted'>When you place orders, they will appear here.</p>
                    <a href='../shop.php' class='btn btn-primary rounded-pill px-4 mt-3'>
                        <i class='fa fa-shopping-bag mr-2'></i> Start Shopping
                    </a>
                </div>
            </td>
        </tr>
    ";
}

// Total order count
$count_result = mysqli_query($con, "SELECT COUNT(*) AS total FROM customer_orders WHERE customer_id='$customer_id'");
$total_orders = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_orders / $per_page);

// Build pagination
$pagination = '<ul class="pagination justify-content-center pagination-sm mb-0">';

if ($page > 1) {
    $pagination .= '<li class="page-item"><a href="#" class="page-link" data-page="1">First</a></li>';
    $pagination .= '<li class="page-item"><a href="#" class="page-link" data-page="' . ($page - 1) . '">Previous</a></li>';
}

for ($p = max(1, $page - 2); $p <= min($total_pages, $page + 2); $p++) {
    $active = ($p == $page) ? 'active' : '';
    $pagination .= "<li class='page-item $active'><a href='#' class='page-link' data-page='$p'>$p</a></li>";
}

if ($page < $total_pages) {
    $pagination .= '<li class="page-item"><a href="#" class="page-link" data-page="' . ($page + 1) . '">Next</a></li>';
    $pagination .= '<li class="page-item"><a href="#" class="page-link" data-page="' . $total_pages . '">Last</a></li>';
}

$pagination .= '</ul>';

// Return as JSON
echo json_encode([
    'orders' => $data,
    'pagination' => $pagination
]);
