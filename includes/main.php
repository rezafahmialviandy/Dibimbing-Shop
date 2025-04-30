</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<body>
<style>


body, html {
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #333333;
    background-color: #f0f0f0;
    overflow-x: hidden;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    height: 100%;
    
    }
</style>





  <header class="page-header">
    <!-- topline -->
    <div class="page-header__topline">
      <div class="container clearfix">



      
        <div class="currency">
          <a class="currency__change" href="customer/my_account.php?my_orders" style="color: white;">
          <?php
          if(!isset($_SESSION['customer_email'])){
          echo "Welcome : Guest"; 
          }
          else
          { 
              echo "Welcome : " . $_SESSION['customer_email'] . "";
            }
?>
          </a>
        </div>



        
        <div class="basket" >
          <a href="cart.php" class="btn btn--basket" style="color: white;">
            <i class="icon-basket" style="color: white; margin-bottom: 7px" ></i>
            <span style="position:relative; top: -5px;"><?php items(); ?> items</span>
          </a>
        </div>
        
        <ul class="login">

          <li class="login__item">
          <?php
          if(!isset($_SESSION['customer_email'])){
            echo '<a href="customer_register.php" class="login__link " style="color: white;">Register</a>';
          } 
            else
            { 
                // echo '<a href="customer/my_account.php?my_orders" class="login__link" style="color: white;">My Account</a>';
            }   
          ?>  
          </li>


          <li class="login__item">
          <?php
          if(!isset($_SESSION['customer_email'])){
            echo '<a href="login.php" class="login__link" style="color: white;">Sign In</a>';
          } 
            else
            { 
                // echo '<a href="./logout.php" class="login__link" style="color: white;">Logout</a>';
            }   
          ?>  
            
          </li>
        </ul>        

      
      </div>
    </div>
    <!-- bottomline -->
    <div class="page-header__bottomline">
      <div class="container clearfix">

        <div class="logo">
          <a class="logo__link" href="index.php">
            <img class="logo__img" src="images/LogoUtama.png" alt="DibimbingShop logotype" width="237" height="19">
          </a>
        </div>

        <nav class="main-nav">
  <ul class="categories">
    <li class="categories__item">
      <a class="categories__link <?php if(basename($_SERVER['PHP_SELF']) == 'shop.php') echo 'categories__link--active'; ?>" href="shop.php">
        Shop
      </a>
    </li>

    <li class="categories__item">
      <a class="categories__link <?php if(basename($_SERVER['PHP_SELF']) == 'localstore.php') echo 'categories__link--active'; ?>" href="localstore.php">
        Local Stores
      </a>
    </li>

    <?php if(isset($_SESSION['customer_email'])): ?>
      <li class="categories__item">
        <a class="categories__link <?php if(basename($_SERVER['PHP_SELF']) == 'my_account.php') echo 'categories__link--active'; ?>" href="customer/my_account.php?my_orders">
          My Account
          <i class="icon-down-open-1"></i>
        </a>

        <div class="dropdown dropdown--lookbook">
          <div class="clearfix">
            <div class="dropdown__half">
              <div class="dropdown__heading">Account Settings</div>
              <ul class="dropdown__items">
                <li class="dropdown__item">
                  <a href="customer/my_account.php?my_wishlist" class="dropdown__link">My Wishlist</a>
                </li>
                <li class="dropdown__item">
                  <a href="customer/my_account.php?my_orders" class="dropdown__link">My Orders</a>
                </li>
                <li class="dropdown__item">
                  <a href="cart.php" class="dropdown__link">View Shopping Cart</a>
                </li>
              </ul>
            </div>
            <div class="dropdown__half">
              <div class="dropdown__heading"></div>
              <ul class="dropdown__items">
                <li class="dropdown__item">
                  <a href="customer/my_account.php?edit_account" class="dropdown__link">Edit Your Account</a>
                </li>
                <li class="dropdown__item">
                  <a href="customer/my_account.php?change_pass" class="dropdown__link">Change Password</a>
                </li>
                <li class="dropdown__item">
                  <a href="customer/my_account.php?delete_account" class="dropdown__link">Delete Account</a>
                </li>
                <li class="dropdown__item">
                        <?php
                        if (!isset($_SESSION['customer_email'])) {
                          echo '<a href="login.php" class="dropdown__link">Sign In</a>';
                        } else {
                          echo '<a href="#" class="dropdown__link" id="logoutBtn">Logout</a>';
                        }
                        ?>
                </li>
              </ul>
            </div>
          </div>
        </div>

      </li>
    <?php endif; ?>

  </ul>
</nav>

      </div>
    </div>
  </header>


  <script>
  document.getElementById('logoutBtn').addEventListener('click', function(e) {
    e.preventDefault(); // Mencegah link untuk langsung redirect

    // SweetAlert konfirmasi logout
    Swal.fire({
      title: 'Are you sure?',
      text: "You will be logged out!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, logout!',
      cancelButtonText: 'No, keep me logged in'
    }).then((result) => {
      if (result.isConfirmed) {
        // Jika konfirmasi logout, arahkan ke logout.php
        window.location.href = './logout.php';
      }
    });
  });
</script>
