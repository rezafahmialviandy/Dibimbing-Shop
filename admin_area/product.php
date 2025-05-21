
<!DOCTYPE html>
<html>
<head>
    <title>Products Dashboard</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>
    <!-- TinyMCE -->
    <script src="https://cdn.tinymce.com/5/tinymce.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        tinymce.init({ selector:'#product_desc,#product_features' });
    </script>

    <style>
        .table > tbody > tr:hover {
            background-color: #f5f5f5;
            cursor: pointer;
        }
        .btn-sm {
            padding: 4px 8px;
            font-size: 12px;
        }
    </style>
</head>
<body>


<?php

if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
    exit;
}



// Proses Insert Product
if (isset($_POST['submit'])) {
    $product_title = mysqli_real_escape_string($con, $_POST['product_title']);
    $product_url = mysqli_real_escape_string($con, $_POST['product_url']);
    $manufacturer_id = mysqli_real_escape_string($con, $_POST['manufacturer']);
    $cat = mysqli_real_escape_string($con, $_POST['cat']);
    $product_price = mysqli_real_escape_string($con, $_POST['product_price']);
    $psp_price = mysqli_real_escape_string($con, $_POST['psp_price']);
    $product_keywords = mysqli_real_escape_string($con, $_POST['product_keywords']);
    $product_desc = mysqli_real_escape_string($con, $_POST['product_desc']);
    $product_features = mysqli_real_escape_string($con, $_POST['product_features']);
    $product_video = mysqli_real_escape_string($con, $_POST['product_video']);
    $product_label = mysqli_real_escape_string($con, $_POST['product_label']);
    $status = "product";

    $images = [];
    for ($i = 1; $i <= 3; $i++) {
        $img_key = "product_img{$i}";
        if (!empty($_FILES[$img_key]['name'])) {
            $img_name = basename($_FILES[$img_key]['name']);
            $img_tmp = $_FILES[$img_key]['tmp_name'];
            move_uploaded_file($img_tmp, "product_images/$img_name");
            $images[$img_key] = $img_name;
        } else {
            echo "
            <script>
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Please upload all product images!',
                confirmButtonText: 'OK'
            });
            </script>
            ";
            exit;
        }
    }

    $insert_product = "
        INSERT INTO products (
            p_cat_id, cat_id, manufacturer_id, date, product_title, product_url, 
            product_img1, product_img2, product_img3, product_price, product_psp_price, 
            product_desc, product_features, product_video, product_keywords, product_label, status
        ) VALUES (
            '$cat', '$cat', '$manufacturer_id', NOW(), '$product_title', '$product_url', 
            '{$images['product_img1']}', '{$images['product_img2']}', '{$images['product_img3']}', 
            '$product_price', '$psp_price', '$product_desc', '$product_features', '$product_video', 
            '$product_keywords', '$product_label', '$status'
        )
    ";

    $run_product = mysqli_query($con, $insert_product);

    if ($run_product) {
        echo "
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Success', 
            text: 'Product has been inserted successfully',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'index.php?product','_self';
        });
        </script>
        ";
        exit;
    } else {
        $error_msg = mysqli_real_escape_string($con, mysqli_error($con));
        echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error inserting product: {$error_msg}',
            confirmButtonText: 'OK'
        });
        </script>
        ";
        exit;
    }
}

// Proses Update Product
if (isset($_POST['edit_submit'])) {
    $edit_product_id = intval($_POST['edit_product_id']);
    $edit_product_title = mysqli_real_escape_string($con, $_POST['edit_product_title']);
    $edit_product_url = mysqli_real_escape_string($con, $_POST['edit_product_url']);
    $edit_manufacturer = mysqli_real_escape_string($con, $_POST['edit_manufacturer']);
    $edit_cat = mysqli_real_escape_string($con, $_POST['edit_cat']);
    $edit_product_price = mysqli_real_escape_string($con, $_POST['edit_product_price']);
    $edit_psp_price = mysqli_real_escape_string($con, $_POST['edit_psp_price']);
    $edit_product_keywords = mysqli_real_escape_string($con, $_POST['edit_product_keywords']);
    $edit_product_label = mysqli_real_escape_string($con, $_POST['edit_product_label']);
    $edit_product_desc = mysqli_real_escape_string($con, $_POST['edit_product_desc']);
    $edit_product_features = mysqli_real_escape_string($con, $_POST['edit_product_features']);
    $edit_product_video = mysqli_real_escape_string($con, $_POST['edit_product_video']);

    // Update images jika ada upload baru
    $update_img_sql = "";
    for ($i = 1; $i <= 3; $i++) {
        $img_key = "edit_product_img{$i}";
        if (!empty($_FILES[$img_key]['name'])) {
            $img_name = basename($_FILES[$img_key]['name']);
            $img_tmp = $_FILES[$img_key]['tmp_name'];
            move_uploaded_file($img_tmp, "product_images/$img_name");
            $update_img_sql .= "product_img{$i} = '$img_name', ";
        }
    }

    $update_sql = "
        UPDATE products SET 
            p_cat_id = '$edit_cat',
            cat_id = '$edit_cat',
            manufacturer_id = '$edit_manufacturer',
            product_title = '$edit_product_title',
            product_url = '$edit_product_url',
            product_price = '$edit_product_price',
            product_psp_price = '$edit_psp_price',
            product_desc = '$edit_product_desc',
            product_features = '$edit_product_features',
            product_video = '$edit_product_video',
            product_keywords = '$edit_product_keywords',
            product_label = '$edit_product_label',
            {$update_img_sql}
            date = NOW()
        WHERE product_id = '$edit_product_id'
    ";

    // Setelah update berhasil
    if (mysqli_query($con, $update_sql)) {
        echo "
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Product updated successfully',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'index.php?product','_self';
        });
        </script>
        ";
        exit;
    } else {
        $error_msg = mysqli_real_escape_string($con, mysqli_error($con));
        echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error updating product: {$error_msg}',
            confirmButtonText: 'OK'
        });
        </script>
        ";
        exit;
    }
}
?>
<div class="container" style="margin-top:20px;">
    <h2>Products Dashboard</h2>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insertProductModal" style="margin-bottom:20px;">
        Insert Product
    </button>

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped table-condensed">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Sold</th>
                    <th>Keywords</th>
                    <th>Date</th>
                    <th>Delete</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $get_pro = "SELECT * FROM products WHERE status='product'";
                $run_pro = mysqli_query($con, $get_pro);

                while ($row_pro = mysqli_fetch_array($run_pro)) {
                    $pro_id = $row_pro['product_id'];
                    $pro_title = $row_pro['product_title'];
                    $pro_image = $row_pro['product_img1'];
                    $pro_price = $row_pro['product_price'];
                    $pro_keywords = $row_pro['product_keywords'];
                    $pro_date = $row_pro['date'];
                    $i++;

                    $get_sold = "SELECT * FROM pending_orders WHERE product_id='$pro_id'";
                    $run_sold = mysqli_query($con, $get_sold);
                    $count = mysqli_num_rows($run_sold);

                    // Prepare data attributes safely
                    $data_attrs = [
                        'id' => $pro_id,
                        'title' => htmlspecialchars($pro_title, ENT_QUOTES),
                        'url' => htmlspecialchars($row_pro['product_url'] ?? '', ENT_QUOTES),
                        'manufacturer' => $row_pro['manufacturer_id'] ?? '',
                        'cat' => $row_pro['cat_id'] ?? '',
                        'price' => $pro_price,
                        'psp_price' => $row_pro['product_psp_price'] ?? '',
                        'keywords' => htmlspecialchars($pro_keywords, ENT_QUOTES),
                        'label' => htmlspecialchars($row_pro['product_label'] ?? '', ENT_QUOTES),
                        'desc' => htmlspecialchars($row_pro['product_desc'] ?? '', ENT_QUOTES),
                        'features' => htmlspecialchars($row_pro['product_features'] ?? '', ENT_QUOTES),
                        'video' => htmlspecialchars($row_pro['product_video'] ?? '', ENT_QUOTES),
                        'img1' => htmlspecialchars($pro_image, ENT_QUOTES),
                        'img2' => htmlspecialchars($row_pro['product_img2'] ?? '', ENT_QUOTES),
                        'img3' => htmlspecialchars($row_pro['product_img3'] ?? '', ENT_QUOTES),
                    ];
                    $data_attr_string = '';
                    foreach ($data_attrs as $key => $val) {
                        $data_attr_string .= " data-$key=\"$val\"";
                    }
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo htmlspecialchars($pro_title); ?></td>
                    <td><img src="product_images/<?php echo htmlspecialchars($pro_image); ?>" width="60" height="60" alt="<?php echo htmlspecialchars($pro_title); ?>"></td>
                    <td>Rp <?php echo number_format($pro_price, 2, ',', '.'); ?></td>
                    <td><?php echo $count; ?></td>
                    <td><?php echo htmlspecialchars($pro_keywords); ?></td>
                    <td><?php echo htmlspecialchars($pro_date); ?></td>
                    <td>
                        <a href="index.php?delete_product=<?php echo $pro_id; ?>" class="btn btn-danger btn-sm btn-delete" data-title="<?php echo htmlspecialchars($pro_title); ?>">
                            <i class="fa fa-trash-o"></i> Delete
                        </a>
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm btn-edit"<?php echo $data_attr_string; ?>>
                            <i class="fa fa-pencil"></i> Edit
                        </button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Insert Product Modal -->
<div id="insertProductModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="insertProductLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
          <h4 class="modal-title" id="insertProductLabel">Insert Product</h4>
        </div>
        <div class="modal-body">
            <!-- form fields seperti sebelumnya (untuk insert) -->
            <!-- Product Title -->
            <div class="form-group">
                <label class="col-md-3 control-label">Product Title</label>
                <div class="col-md-8">
                    <input type="text" name="product_title" class="form-control" required>
                </div>
            </div>
            <!-- Product Url -->
            <div class="form-group">
                <label class="col-md-3 control-label">Product Url</label>
                <div class="col-md-8">
                    <input type="text" name="product_url" class="form-control" required>
                    <br>
                    <p style="font-size:15px; font-weight:bold;">Product Url Example : poco-f7-pro</p>
                </div>
            </div>
            <!-- Manufacturer -->
            <div class="form-group">
                <label class="col-md-3 control-label">Select A Manufacturer</label>
                <div class="col-md-8">
                    <select class="form-control" name="manufacturer" required>
                        <option value="">Select A Manufacturer</option>
                        <?php
                        $get_manufacturer = "SELECT * FROM manufacturers";
                        $run_manufacturer = mysqli_query($con, $get_manufacturer);
                        while ($row_manufacturer = mysqli_fetch_assoc($run_manufacturer)) {
                            echo "<option value='{$row_manufacturer['manufacturer_id']}'>" . htmlspecialchars($row_manufacturer['manufacturer_title']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <!-- Category -->
            <div class="form-group">
                <label class="col-md-3 control-label">Category</label>
                <div class="col-md-8">
                    <select name="cat" class="form-control" required>
                        <option value="">Select a Category</option>
                        <?php
                        $get_cat = "SELECT * FROM categories";
                        $run_cat = mysqli_query($con, $get_cat);
                        while ($row_cat = mysqli_fetch_assoc($run_cat)) {
                            echo "<option value='{$row_cat['cat_id']}'>" . htmlspecialchars($row_cat['cat_title']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <!-- Product Images -->
            <?php for ($i = 1; $i <= 3; $i++): ?>
                <div class="form-group">
                    <label class="col-md-3 control-label">Product Image <?php echo $i; ?></label>
                    <div class="col-md-8">
                        <input type="file" name="product_img<?php echo $i; ?>" class="form-control" required>
                    </div>
                </div>
            <?php endfor; ?>
            <!-- Product Price -->
            <div class="form-group">
                <label class="col-md-3 control-label">Product Price</label>
                <div class="col-md-8">
                    <input type="text" name="product_price" class="form-control" required>
                </div>
            </div>
            <!-- Product Sale Price -->
            <div class="form-group">
                <label class="col-md-3 control-label">Product Sale Price</label>
                <div class="col-md-8">
                    <input type="text" name="psp_price" class="form-control" required>
                </div>
            </div>
            <!-- Product Keywords -->
            <div class="form-group">
                <label class="col-md-3 control-label">Product Keywords</label>
                <div class="col-md-8">
                    <input type="text" name="product_keywords" class="form-control" required>
                </div>
            </div>
            <!-- Product Tabs -->
            <div class="form-group">
                <label class="col-md-3 control-label">Product Tabs</label>
                <div class="col-md-8">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#description">Product Description</a></li>
                        <li><a data-toggle="tab" href="#features">Product Features</a></li>
                        <li><a data-toggle="tab" href="#video">Sounds And Videos</a></li>
                    </ul>
                    <div class="tab-content" style="margin-top: 10px;">
                        <div id="description" class="tab-pane fade in active">
                            <textarea name="product_desc" class="form-control" rows="10" id="product_desc"></textarea>
                        </div>
                        <div id="features" class="tab-pane fade">
                            <textarea name="product_features" class="form-control" rows="10" id="product_features"></textarea>
                        </div>
                        <div id="video" class="tab-pane fade">
                            <textarea name="product_video" class="form-control" rows="10"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product Label -->
            <div class="form-group">
                <label class="col-md-3 control-label">Product Label</label>
                <div class="col-md-8">
                    <input type="text" name="product_label" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" name="submit" value="Insert Product" class="btn btn-primary">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Product Modal -->
<div id="editProductModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editProductLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="editProductForm" class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
          <h4 class="modal-title" id="editProductLabel">Edit Product</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" name="edit_product_id" id="edit_product_id">

          <!-- Form fields mirip insert, tapi dengan id prefix edit_ -->
          <div class="form-group">
              <label class="col-md-3 control-label">Product Title</label>
              <div class="col-md-8">
                  <input type="text" name="edit_product_title" id="edit_product_title" class="form-control" required>
              </div>
          </div>

          <div class="form-group">
              <label class="col-md-3 control-label">Product Url</label>
              <div class="col-md-8">
                  <input type="text" name="edit_product_url" id="edit_product_url" class="form-control" required>
              </div>
          </div>

          <div class="form-group">
              <label class="col-md-3 control-label">Select A Manufacturer</label>
              <div class="col-md-8">
                  <select class="form-control" name="edit_manufacturer" id="edit_manufacturer" required>
                    <option value="">Select A Manufacturer</option>
                    <?php
                    $get_manufacturer = "SELECT * FROM manufacturers";
                    $run_manufacturer = mysqli_query($con, $get_manufacturer);
                    while ($row_manufacturer = mysqli_fetch_assoc($run_manufacturer)) {
                        echo "<option value='{$row_manufacturer['manufacturer_id']}'>" . htmlspecialchars($row_manufacturer['manufacturer_title']) . "</option>";
                    }
                    ?>
                  </select>
              </div>
          </div>

          <div class="form-group">
              <label class="col-md-3 control-label">Category</label>
              <div class="col-md-8">
                  <select name="edit_cat" id="edit_cat" class="form-control" required>
                    <option value="">Select a Category</option>
                    <?php
                    $get_cat = "SELECT * FROM categories";
                    $run_cat = mysqli_query($con, $get_cat);
                    while ($row_cat = mysqli_fetch_assoc($run_cat)) {
                        echo "<option value='{$row_cat['cat_id']}'>" . htmlspecialchars($row_cat['cat_title']) . "</option>";
                    }
                    ?>
                  </select>
              </div>
          </div>

          <!-- Image preview dan upload -->
          <div class="form-group">
              <label class="col-md-3 control-label">Current Image 1</label>
              <div class="col-md-8">
                  <img id="edit_img1_preview" src="" alt="Image 1" style="max-width:100px; max-height:100px;">
              </div>
          </div>
          <div class="form-group">
              <label class="col-md-3 control-label">Change Image 1</label>
              <div class="col-md-8">
                  <input type="file" name="edit_product_img1" id="edit_product_img1" class="form-control">
                  <small class="text-muted">Leave empty if you don't want to change</small>
              </div>
          </div>

          <div class="form-group">
              <label class="col-md-3 control-label">Current Image 2</label>
              <div class="col-md-8">
                  <img id="edit_img2_preview" src="" alt="Image 2" style="max-width:100px; max-height:100px;">
              </div>
          </div>
          <div class="form-group">
              <label class="col-md-3 control-label">Change Image 2</label>
              <div class="col-md-8">
                  <input type="file" name="edit_product_img2" id="edit_product_img2" class="form-control">
                  <small class="text-muted">Leave empty if you don't want to change</small>
              </div>
          </div>

          <div class="form-group">
              <label class="col-md-3 control-label">Current Image 3</label>
              <div class="col-md-8">
                  <img id="edit_img3_preview" src="" alt="Image 3" style="max-width:100px; max-height:100px;">
              </div>
          </div>
          <div class="form-group">
              <label class="col-md-3 control-label">Change Image 3</label>
              <div class="col-md-8">
                  <input type="file" name="edit_product_img3" id="edit_product_img3" class="form-control">
                  <small class="text-muted">Leave empty if you don't want to change</small>
              </div>
          </div>

          <div class="form-group">
              <label class="col-md-3 control-label">Product Price</label>
              <div class="col-md-8">
                  <input type="text" name="edit_product_price" id="edit_product_price" class="form-control" required>
              </div>
          </div>

          <div class="form-group">
              <label class="col-md-3 control-label">Product Sale Price</label>
              <div class="col-md-8">
                  <input type="text" name="edit_psp_price" id="edit_psp_price" class="form-control" required>
              </div>
          </div>

          <div class="form-group">
              <label class="col-md-3 control-label">Product Keywords</label>
              <div class="col-md-8">
                  <input type="text" name="edit_product_keywords" id="edit_product_keywords" class="form-control" required>
              </div>
          </div>

          <!-- Product Tabs (sama seperti insert) -->
            <div class="form-group">
                <label class="col-md-3 control-label">Product Tabs</label>
                <div class="col-md-8">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#edit_description">Product Description</a></li>
                        <li><a data-toggle="tab" href="#edit_features">Product Features</a></li>
                        <li><a data-toggle="tab" href="#edit_video">Sounds And Videos</a></li>
                    </ul>

                    <div class="tab-content" style="margin-top: 10px;">
                        <div id="edit_description" class="tab-pane fade in active">
                            <textarea name="edit_product_desc" class="form-control" rows="10" id="edit_product_desc"></textarea>
                        </div>

                        <div id="edit_features" class="tab-pane fade">
                            <textarea name="edit_product_features" class="form-control" rows="10" id="edit_product_features"></textarea>
                        </div>

                        <div id="edit_video" class="tab-pane fade">
                            <textarea name="edit_product_video" class="form-control" rows="10" id="edit_product_video"></textarea>
                        </div>
                    </div>
                </div>
            </div>


          <div class="form-group">
              <label class="col-md-3 control-label">Product Label</label>
              <div class="col-md-8">
                  <input type="text" name="edit_product_label" id="edit_product_label" class="form-control" required>
              </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" name="edit_submit" value="Update Product" class="btn btn-primary">
        </div>
      </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    // Edit button click handler
    $('.btn-edit').click(function() {
        let btn = $(this);

        // Isi value form dari data-attributes
        $('#edit_product_id').val(btn.data('id'));
        $('#edit_product_title').val(btn.data('title'));
        $('#edit_product_url').val(btn.data('url'));
        $('#edit_manufacturer').val(btn.data('manufacturer'));
        $('#edit_cat').val(btn.data('cat'));
        $('#edit_product_price').val(btn.data('price'));
        $('#edit_psp_price').val(btn.data('psp_price'));
        $('#edit_product_keywords').val(btn.data('keywords'));
        $('#edit_product_label').val(btn.data('label'));
        $('#edit_product_desc').val(btn.data('desc'));
        $('#edit_product_features').val(btn.data('features'));
        $('#edit_product_video').val(btn.data('video'));


        $('#edit_img1_preview').attr('src', 'product_images/' + btn.data('img1'));
        $('#edit_img2_preview').attr('src', 'product_images/' + btn.data('img2'));
        $('#edit_img3_preview').attr('src', 'product_images/' + btn.data('img3'));

        // Tampilkan modal
        $('#editProductModal').modal('show');

        // Inisialisasi ulang TinyMCE untuk edit modal
        tinymce.remove('#edit_product_desc,#edit_product_features');
        tinymce.init({ selector:'#edit_product_desc,#edit_product_features' });
    });

    // Inisialisasi TinyMCE untuk insert modal
    tinymce.init({ selector:'#product_desc,#product_features' });
});

$(document).ready(function() {
    $('.btn-delete').click(function(e) {
        e.preventDefault(); // cegah redirect default

        let link = $(this).attr('href');
        let title = $(this).data('title');

        Swal.fire({
            title: `Delete "${title}"?`,
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link; // baru redirect ke delete handler
            }
        });
    });
});

</script>

</body>
</html>
