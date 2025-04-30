<center class="my-4">
    <h1>My Wishlist</h1>
    <p class="text-muted">All your wishlist products in one place.</p>
</center>

<div class="container py-4">
    <?php if(isset($_SESSION['customer_email'])): ?>
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light py-3">
            <h5 class="mb-0"><i class="fa fa-heart me-2" style="padding-left: 7px"></i> Your Wishlist</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3 ps-4">#</th>
                            <th class="py-3">Wishlist Product</th>
                            <th class="py-3 text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $customer_session = $_SESSION['customer_email'];
                        $get_customer = "SELECT * FROM customers WHERE customer_email='$customer_session'";
                        $run_customer = mysqli_query($con, $get_customer);
                        $row_customer = mysqli_fetch_array($run_customer);
                        $customer_id = $row_customer['customer_id'];
                        $i = 0;
                        $get_wishlist = "SELECT * FROM wishlist WHERE customer_id='$customer_id'";
                        $run_wishlist = mysqli_query($con, $get_wishlist);
                        while ($row_wishlist = mysqli_fetch_array($run_wishlist)) {
                            $wishlist_id = $row_wishlist['wishlist_id'];
                            $product_id  = $row_wishlist['product_id'];
                            $get_products = "SELECT * FROM products WHERE product_id='$product_id'";
                            $run_products = mysqli_query($con, $get_products);
                            $row_products = mysqli_fetch_array($run_products);
                            $product_title = $row_products['product_title'];
                            $product_url   = $row_products['product_url'];
                            $product_img1  = $row_products['product_img1'];
                            $i++;
                        ?>
                            <tr class="wishlist-item">
                            <td class="ps-4" style="text-align: center; vertical-align: middle;"><?php echo $i; ?></td>
                                <td>
                                    <div class="d-flex align-items-center py-2">
                                        <div class="product-img">
                                            <img src="../admin_area/product_images/<?php echo $product_img1; ?>" class="img-fluid rounded" width="70" height="70" alt="<?php echo $product_title; ?>">
                                        </div>
                                        <div class="ms-3">
                                            <a href="../<?php echo $product_url; ?>" class="product-link text-decoration-none">
                                                <h6 class="mb-1"><?php echo $product_title; ?></h6>
                                            </a>
                                            <small class="text-muted">Added on: <?php echo  date("d M Y"); ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-4" style="vertical-align: middle;">
                                    <button class="btn delete-wishlist-btn" onclick="confirmDelete(<?php echo $wishlist_id; ?>)">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php else: ?>
        <div class="alert alert-info">Please <a href="login.php">login</a> to view your wishlist.</div>
    <?php endif; ?>
</div>

<style>
/* Enhanced Wishlist Table Styling */
.table {
    border-collapse: separate;
    border-spacing: 0;
}

.table thead th {
    border-top: none;
    border-bottom: 2px solid #e9ecef;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 13px;
    color: #495057;
}

.wishlist-item {
    transition: all 0.2s ease;
    position: relative;
}

.wishlist-item:hover {
    background-color: #f8f9fa;
    transform: translateY(-1px);
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    z-index: 1;
}

.product-img {
    width: 70px;
    height: 70px;
    border-radius: 8px;
    overflow: hidden;
    background-color: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
}

.product-img img {
    object-fit: cover;
    width: 100%;
    height: 100%;
}

.product-link {
    color: #212529;
    transition: color 0.2s ease;
}

.product-link:hover {
    color: #0d6efd;
}

.delete-wishlist-btn {
    background-color: #ff3b30;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 8px 16px;
    font-size: 14px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(255, 59, 48, 0.2);
}

.delete-wishlist-btn i {
    margin-right: 6px;
    font-size: 15px;
}

.delete-wishlist-btn:hover {
    background-color: #e02d22;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(255, 59, 48, 0.3);
}

.delete-wishlist-btn:active {
    transform: translateY(0);
    box-shadow: 0 1px 2px rgba(255, 59, 48, 0.3);
}


.delete-wishlist-btn {
    background-color: white;
    color: #ff3b30;
    border: 1px solid #ff3b30;
    border-radius: 6px;
    padding: 7px 15px;
    font-size: 14px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.delete-wishlist-btn:hover {
    background-color: #ff3b30;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(255, 59, 48, 0.2);
}

@media (max-width: 767.98px) {
    .table-responsive {
        border: 0;
    }
    
    .wishlist-item td {
        padding: 0.75rem;
    }
    
    .product-img {
        width: 50px;
        height: 50px;
    }
}
</style>

<!-- SweetAlert2 for Delete Confirmation -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(wishlistId) {
    Swal.fire({
        title: 'Remove Item',
        text: 'Are you sure you want to remove this item from your wishlist?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, remove it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'my_account.php?delete_wishlist=' + wishlistId;
        }
    });
}
</script>