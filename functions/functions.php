
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php

include(__DIR__ . '/../includes/db.php');

/// IP address code starts ///
function getRealUserIp() {
    switch (true) {
        case (!empty($_SERVER['HTTP_X_REAL_IP'])) :
            return $_SERVER['HTTP_X_REAL_IP'];
        case (!empty($_SERVER['HTTP_CLIENT_IP'])) :
            return $_SERVER['HTTP_CLIENT_IP'];
        case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) :
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        default :
            return $_SERVER['REMOTE_ADDR'];
    }
}
/// IP address code Ends ///

/// items function Starts ///
function items() {
    global $con;

    $ip_add = getRealUserIp();

    $get_items = "SELECT * FROM cart WHERE ip_add='$ip_add'";

    $run_items = mysqli_query($con, $get_items);

    $count_items = mysqli_num_rows($run_items);

    echo $count_items;
}
/// items function Ends ///

/// total_price function Starts ///
function total_price() {
    global $con;

    $ip_add = getRealUserIp();

    $total = 0;

    $select_cart = "SELECT * FROM cart WHERE ip_add='$ip_add'";

    $run_cart = mysqli_query($con, $select_cart);

    while ($record = mysqli_fetch_array($run_cart)) {
        $pro_id = $record['p_id'];
        $pro_qty = $record['qty'];

        $sub_total = $record['p_price'] * $pro_qty;

        $total += $sub_total;
    }

    echo "Rp " . number_format($total, 0, ',', '.');
}
/// total_price function Ends ///

/// getPro function Starts ///
function getPro() {
    global $con;

    $get_products = "SELECT * FROM products ORDER BY 1 DESC LIMIT 0, 8";

    $run_products = mysqli_query($con, $get_products);

    while ($row_products = mysqli_fetch_array($run_products)) {
        $pro_id = $row_products['product_id'];
        $pro_title = $row_products['product_title'];
        $pro_price = $row_products['product_price'];
        $pro_img1 = $row_products['product_img1'];
        $pro_label = $row_products['product_label'];
        $manufacturer_id = $row_products['manufacturer_id'];

        $get_manufacturer = "SELECT * FROM manufacturers WHERE manufacturer_id='$manufacturer_id'";
        $run_manufacturer = mysqli_query($con, $get_manufacturer);
        $row_manufacturer = mysqli_fetch_array($run_manufacturer);

        $manufacturer_name = $row_manufacturer['manufacturer_title'];
        $pro_psp_price = $row_products['product_psp_price'];
        $pro_url = $row_products['product_url'];

        // Format price with number_format for proper currency
        if ($pro_label == "Sale" || $pro_label == "Gift") {
            $product_price = "<del> Rp " . number_format($pro_price, 0, ',', '.') . "</del>";
            $product_psp_price = "| Rp " . number_format($pro_psp_price, 0, ',', '.');
        } else {
            $product_psp_price = "";
            $product_price = "Rp " . number_format($pro_price, 0, ',', '.');
        }

        if ($pro_label != "") {
            $product_label = "
            <a class='label sale' href='#' style='color:black;'>
                <div class='thelabel'>$pro_label</div>
                <div class='label-background'></div>
            </a>";
        }

        echo "
        <div class='col-md-4 col-sm-6 single'>
            <div class='product'>
                <a href='$pro_url'>
                    <img src='admin_area/product_images/$pro_img1' class='img-fluid' alt='$pro_title'>
                </a>
                <div class='text'>
                    <center>
                        <p class='btn btn-warning'> $manufacturer_name </p>
                    </center>
                    <hr>
                    <h3><a href='$pro_url'>$pro_title</a></h3>
                    <p class='price'>$product_price $product_psp_price</p>
                    <p class='buttons'>
                        <a href='$pro_url' class='btn btn-primary'>View Details</a>
                        <a href='$pro_url' class='btn btn-danger'>
                            <i class='fa fa-shopping-cart'></i> Add To Cart
                        </a>
                    </p>
                </div>
                $product_label
            </div>
        </div>";
    }
}
/// getPro function Ends ///

/// getProducts function Starts ///
function getProducts() {
    global $con;

    $aWhere = array();

    // Manufacturers
    if (isset($_REQUEST['man']) && is_array($_REQUEST['man'])) {
        foreach ($_REQUEST['man'] as $sKey => $sVal) {
            if ((int)$sVal != 0) {
                $aWhere[] = 'manufacturer_id=' . (int)$sVal;
            }
        }
    }

    // Product Categories
    if (isset($_REQUEST['p_cat']) && is_array($_REQUEST['p_cat'])) {
        foreach ($_REQUEST['p_cat'] as $sKey => $sVal) {
            if ((int)$sVal != 0) {
                $aWhere[] = 'p_cat_id=' . (int)$sVal;
            }
        }
    }

    // Categories
    if (isset($_REQUEST['cat']) && is_array($_REQUEST['cat'])) {
        foreach ($_REQUEST['cat'] as $sKey => $sVal) {
            if ((int)$sVal != 0) {
                $aWhere[] = 'cat_id=' . (int)$sVal;
            }
        }
    }

    $per_page = 6;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start_from = ($page - 1) * $per_page;

    $sLimit = " ORDER BY 1 DESC LIMIT $start_from, $per_page";
    $sWhere = (count($aWhere) > 0 ? ' WHERE ' . implode(' OR ', $aWhere) : '') . $sLimit;

    $get_products = "SELECT * FROM products " . $sWhere;

    $run_products = mysqli_query($con, $get_products);

    while ($row_products = mysqli_fetch_array($run_products)) {
        $pro_id = $row_products['product_id'];
        $pro_title = $row_products['product_title'];
        $pro_price = $row_products['product_price'];
        $pro_img1 = $row_products['product_img1'];
        $pro_label = $row_products['product_label'];
        $manufacturer_id = $row_products['manufacturer_id'];

        $get_manufacturer = "SELECT * FROM manufacturers WHERE manufacturer_id='$manufacturer_id'";
        $run_manufacturer = mysqli_query($con, $get_manufacturer);
        $row_manufacturer = mysqli_fetch_array($run_manufacturer);

        $manufacturer_name = $row_manufacturer['manufacturer_title'];
        $pro_psp_price = $row_products['product_psp_price'];
        $pro_url = $row_products['product_url'];

        // Format price with number_format for proper currency
        if ($pro_label == "Sale" || $pro_label == "Gift") {
            $product_price = "<del> Rp " . number_format($pro_price, 0, ',', '.') . "</del>";
            $product_psp_price = "| Rp " . number_format($pro_psp_price, 0, ',', '.');
        } else {
            $product_psp_price = "";
            $product_price = "Rp " . number_format($pro_price, 0, ',', '.');
        }

        if ($pro_label != "") {
            $product_label = "
            <a class='label sale' href='#' style='color:black;'>
                <div class='thelabel'>$pro_label</div>
                <div class='label-background'></div>
            </a>";
        }

        echo "
        <div class='col-md-4 col-sm-6 center-responsive'>
            <div class='product'>
                <a href='$pro_url'>
                    <img src='admin_area/product_images/$pro_img1' class='img-fluid' alt='$pro_title'>
                </a>
                <div class='text'>
                    <center>
                        <p class='btn btn-warning btn-sm'> $manufacturer_name </p>
                    </center>
                    <hr>
                    <h3><a href='$pro_url'>$pro_title</a></h3>
                    <p class='price'>$product_price $product_psp_price</p>
                    <p class='buttons'>
                        <a href='$pro_url' class='btn btn-default'>View Details</a>
                        <a href='$pro_url' class='btn btn-danger'>
                            <i class='fa fa-shopping-cart'></i> Add To Cart
                        </a>
                    </p>
                </div>
                $product_label
            </div>
        </div>";
    }
}
/// getProducts function Ends ///

/// getPaginator function Starts ///
function getPaginator() {
  global $con;

  $per_page = 6;
  $aWhere = array();
  $aPath = '';

  // Manufacturers
  if (isset($_REQUEST['man']) && is_array($_REQUEST['man'])) {
      foreach ($_REQUEST['man'] as $sKey => $sVal) {
          if ((int)$sVal != 0) {
              $aWhere[] = 'manufacturer_id=' . (int)$sVal;
              $aPath .= 'man[]=' . (int)$sVal . '&';
          }
      }
  }

  // Product Categories
  if (isset($_REQUEST['p_cat']) && is_array($_REQUEST['p_cat'])) {
      foreach ($_REQUEST['p_cat'] as $sKey => $sVal) {
          if ((int)$sVal != 0) {
              $aWhere[] = 'p_cat_id=' . (int)$sVal;
              $aPath .= 'p_cat[]=' . (int)$sVal . '&';
          }
      }
  }

  // Categories
  if (isset($_REQUEST['cat']) && is_array($_REQUEST['cat'])) {
      foreach ($_REQUEST['cat'] as $sKey => $sVal) {
          if ((int)$sVal != 0) {
              $aWhere[] = 'cat_id=' . (int)$sVal;
              $aPath .= 'cat[]=' . (int)$sVal . '&';
          }
      }
  }

  $sWhere = (count($aWhere) > 0 ? ' WHERE ' . implode(' OR ', $aWhere) : '');

  $query = "SELECT * FROM products " . $sWhere;
  $result = mysqli_query($con, $query);
  $total_records = mysqli_num_rows($result);
  $total_pages = ceil($total_records / $per_page);

  // Start pagination with container divs
  echo '<div class="pagination-wrapper">';
  echo '<ul class="pagination justify-content-center">';
  
  echo "<li class='page-item'><a class='page-link' href='shop.php?page=1" . (!empty($aPath) ? "&" . $aPath : '') . "'>First Page</a></li>";

  for ($i = 1; $i <= $total_pages; $i++) {
      $active = isset($_GET['page']) && $_GET['page'] == $i ? 'active' : '';
      echo "<li class='page-item $active'><a class='page-link' href='shop.php?page=$i" . (!empty($aPath) ? "&" . $aPath : '') . "'>$i</a></li>";
  }

  echo "<li class='page-item'><a class='page-link' href='shop.php?page=$total_pages" . (!empty($aPath) ? "&" . $aPath : '') . "'>Last Page</a></li>";
  
  // Close pagination container
  echo '</ul>';
  echo '</div>';
}
/// getPaginator function Ends ///

?>
