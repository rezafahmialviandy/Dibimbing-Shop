<?php
session_start();
include("includes/db.php");
include("includes/header.php");
include("functions/functions.php");
include("includes/main.php");

$product_url = $_GET['pro_id'] ?? null;
if (!$product_url) {
    echo "<script>window.open('index.php','_self')</script>";
    exit();
}

function getProductByUrl($url) {
    global $con;
    $stmt = $con->prepare("SELECT * FROM products WHERE product_url = ?");
    $stmt->bind_param("s", $url);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function getProductCategory($id) {
    global $con;
    $stmt = $con->prepare("SELECT * FROM product_categories WHERE p_cat_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function renderProductLabel($label) {
    if (!$label) return "";
    return "<a class='label sale' href='#'><div class='thelabel'>$label</div><div class='label-background'></div></a>";
}

function displayPrice($price, $psp_price, $label, $type) {
    if (in_array($label, ["Sale", "Gift"])) {
        return "<p class='price'>$type Price: <del>Rp " . number_format($price, 0, ',', '.') . "</del><br> Rp " . number_format($psp_price, 0, ',', '.') . "</p>";
    }
    return "<p class='price'>$type Price: Rp " . number_format($price, 0, ',', '.') . "</p>";
}

function renderProductImages($product) {
    $imgs = [$product['product_img1'], $product['product_img2'], $product['product_img3']];
    $html = '';
    foreach ($imgs as $i => $img) {
        $active = $i === 0 ? 'active' : '';
        $html .= "<div class='item $active'><center><img src='admin_area/product_images/$img' class='img-responsive'></center></div>";
    }
    return $html;
}

$product = getProductByUrl($product_url);
if (!$product) {
    echo "<script>window.open('index.php','_self')</script>";
    exit();
}

$p_cat = getProductCategory($product['p_cat_id']);
$product_label_html = renderProductLabel($product['product_label']);

if (isset($_POST['add_cart'])) {
  $ip_add = getRealUserIp();
  $p_id = $product['product_id'];
  $product_qty = $_POST['product_qty'] ?? 1;
  $product_type = $_POST['product_type'] ?? 'Default';
  $product_price = $_POST['product_price'] ?? $product['product_price'];  // Get the updated price from the form

  $check_cart = mysqli_query($con, "SELECT * FROM cart WHERE ip_add='$ip_add' AND p_id='$p_id'");
  if (mysqli_num_rows($check_cart) > 0) {
      echo "<script>
          Swal.fire({
              icon: 'warning',
              title: 'Already in Cart',
              text: 'This product is already added to your cart!',
              showConfirmButton: true
          }).then(() => {
              window.location.href = '$product_url';
          });
      </script>";
  } else {
      mysqli_query($con, "INSERT INTO cart (p_id, ip_add, qty, p_price, Type) VALUES ('$p_id', '$ip_add', '$product_qty', '$product_price', '$product_type')");
      echo "<script>
          Swal.fire({
              icon: 'success',
              title: 'Product Added',
              text: 'The product has been added to your cart!',
              showConfirmButton: true
          }).then(() => {
              window.location.href = '$product_url';
          });
      </script>";
  }
}

// Add to Wishlist
if (isset($_POST['add_wishlist'])) {
  if (!isset($_SESSION['customer_email'])) {
      echo "<script>
          Swal.fire({
              icon: 'error',
              title: 'Login Required',
              text: 'You must be logged in to add a product to your wishlist!',
              showConfirmButton: true
          }).then(() => {
              window.location.href = 'login.php';
          });
      </script>";
  } else {
      $email = $_SESSION['customer_email'];
      $customer = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM customers WHERE customer_email='$email'"));
      $customer_id = $customer['customer_id'];
      $pro_id = $product['product_id'];

      $check = mysqli_query($con, "SELECT * FROM wishlist WHERE customer_id='$customer_id' AND product_id='$pro_id'");
      if (mysqli_num_rows($check) > 0) {
          echo "<script>
              Swal.fire({
                  icon: 'warning',
                  title: 'Already in Wishlist',
                  text: 'This product is already in your wishlist!',
                  showConfirmButton: true
              }).then(() => {
                  window.location.href = '$product_url';
              });
          </script>";
      } else {
          mysqli_query($con, "INSERT INTO wishlist (customer_id, product_id) VALUES ('$customer_id','$pro_id')");
          echo "<script>
              Swal.fire({
                  icon: 'success',
                  title: 'Added to Wishlist',
                  text: 'This product has been added to your wishlist!',
                  showConfirmButton: true
              }).then(() => {
                  window.location.href = '$product_url';
              });
          </script>";
      }
  }
}
?>
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<main><div class="nero"><p class="nero__text"></p></div></main>
<div id="content"><div class="container"><br><div class="col-md-12">
<div class="row" id="productMain">
  <div class="col-sm-6">
    <div id="mainImage">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <?= renderProductImages($product) ?>
        </div>
        <a href="#myCarousel" class="left carousel-control" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
    <?= $product_label_html ?>
  </div>

  <div class="col-sm-6">
    <div class="box">
      <h1 class="text-center"> <?= $product['product_title'] ?> </h1>

      <form method="post" class="form-horizontal">
        <div class="form-group">
          <label class="col-md-5 control-label">Quantity</label>
          <div class="col-md-7">
            <select name="product_qty" class="form-control">
              <?php for ($i = 1; $i <= 5; $i++) echo "<option>$i</option>"; ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-5 control-label">Type</label>
          <div class="col-md-7">
            <select name="product_type" class="form-control" onchange="updateCartPrice()">
              <option>Brand New</option>
              <option>Second (Unit Only)</option>
            </select>
          </div>
        </div>

        <p class="price" id="updatedPrice">Product Price: Rp <?= number_format($product['product_price'], 0, ',', '.') ?></p>

        <input type="hidden" name="product_price" id="hiddenPrice" value="<?= $product['product_price'] ?>" />

        <p class="text-center buttons">
          <button class="btn btn-danger" type="submit" name="add_cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
          <button class="btn btn-warning" type="submit" name="add_wishlist"><i class="fa fa-heart"></i> Add to Wishlist</button>
        </p>
      </form>
    </div>

    <div class="row" id="thumbs">
      <?php foreach ([$product['product_img1'], $product['product_img2'], $product['product_img3']] as $img): ?>
      <div class="col-xs-4">
        <a href="#" class="thumb"><img src="admin_area/product_images/<?= $img ?>" class="img-responsive"></a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<div class="box" id="details">
  <a class="btn btn-info tab" href="#description" data-toggle="tab">Description</a>
  <a class="btn btn-info tab" href="#features" data-toggle="tab">Features</a>
  <a class="btn btn-info tab" href="#video" data-toggle="tab">Sounds and Videos</a>
  <hr>
  <div class="tab-content">
    <div id="description" class="tab-pane fade in active" style="margin-top:7px;"> <?= $product['product_desc'] ?> </div>
    <div id="features" class="tab-pane fade in" style="margin-top:7px;"> <?= $product['product_features'] ?> </div>
    <div id="video" class="tab-pane fade in" style="margin-top:7px;"> <?= $product['product_video'] ?> </div>
  </div>
</div>

<div class="row same-height-row">
    <div class="col-md-3 col-sm-6">
        <div class="box same-height headline">
            <h3 class="text-center">You may also like these Products:</h3>
        </div>
    </div>

    <?php
    $related = mysqli_query($con, "SELECT * FROM products ORDER BY rand() LIMIT 3");
    while ($rel = mysqli_fetch_assoc($related)) {
        $manufacturer_id = $rel['manufacturer_id'];
        $manufacturer = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM manufacturers WHERE manufacturer_id='$manufacturer_id'"));
        $manufacturer_name = $manufacturer['manufacturer_title'];

        $label = $rel['product_label'];
        $label_html = $label ? "
            <a class='label sale' href='#' style='color:black;'>
                <div class='thelabel'>$label</div>
                <div class='label-background'></div>
            </a>" : '';

        echo "
        <div class='col-md-3 col-sm-6 center-responsive'>
            <div class='product'>
                <a href='{$rel['product_url']}'>
                    <img src='admin_area/product_images/{$rel['product_img1']}' class='img-responsive'>
                </a>
                <div class='text'>
                    <center><p class='btn btn-warning'>$manufacturer_name</p></center>
                    <hr>
                    <h3><a href='{$rel['product_url']}'>{$rel['product_title']}</a></h3>
                    <p class='price'>Rp " . number_format($rel['product_price'], 0, ',', '.') . "</p>
                    <p class='buttons'>
                        <a href='{$rel['product_url']}' class='btn btn-default'>View Details</a>
                        <a href='{$rel['product_url']}' class='btn btn-danger'><i class='fa fa-shopping-cart'></i> Add To Cart</a>
                    </p>
                </div>
                $label_html
            </div>
        </div>";
    }
    ?>

</div>

</div></div></div>
<?php include("includes/footer.php"); ?>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    function updateCartPrice() {
        var productType = $("select[name='product_type']").val(); // Get selected product type
        var price = <?= $product['product_price'] ?>; // Original product price
        var newPrice;

        if (productType === "Second (Unit Only)") {
            // Apply 40% discount for second-hand products
            newPrice = price * 0.60;
        } else {
            newPrice = price; // For "Brand New", keep the original price
        }

        // Update the displayed price
        $("#updatedPrice").html("Product Price: Rp " + newPrice.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, "."));
        
        // Update the hidden input to reflect the new price
        $("#hiddenPrice").val(newPrice);
    }

    // Trigger price update when page loads
    updateCartPrice();
</script>
</body></html>
