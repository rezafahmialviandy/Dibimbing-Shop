<div class="container py-4">
    <!-- Header Section -->
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px; overflow: hidden;">
        <div class="card-body text-center p-5">
            <div class="mb-3">
                <i class="fa fa-credit-card fa-3x text-primary mb-3"></i>
                <h2 class="font-weight-bold">Pay Offline</h2>
                <p class="lead text-muted">Multiple payment methods for your convenience</p>
                <!-- <p class="text-muted">
                    If you have any questions, please feel free to <a href="../contact.php" class="text-primary font-weight-bold">contact us</a>, 
                    our customer service center is working for you 24/7.
                </p> -->
            </div>
        </div>
    </div>
<br>
    <!-- Payment Methods Cards -->
    <div class="row">
        <!-- Bank Transfer Card -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
                <div class="card-header bg-gradient-primary text-white py-4 text-center border-0">
                    <i class="fa fa-university fa-2x mb-2" style="padding-top : 10px;"></i>
                    <h5 class="mb-0">Bank Account Details</h5>
                </div>
                <div class="card-body p-4">
                    <ul class="list-unstyled mb-0" style="padding-left : 20px;">
                        <li class="mb-3">
                            <span class="font-weight-bold"><i class="fa fa-bank mr-2 text-primary"></i> Bank Name : </span> 
                            <span class="text-muted">UBL</span>
                        </li>
                        <li class="mb-3">
                            <span class="font-weight-bold"><i class="fa fa-hashtag mr-2 text-primary"></i> Account No : </span> 
                            <span class="text-muted">03333333</span>
                        </li>
                        <li class="mb-3">
                            <span class="font-weight-bold"><i class="fa fa-code mr-2 text-primary"></i> Branch Code : </span> 
                            <span class="text-muted">0342</span>
                        </li>
                        <li>
                            <span class="font-weight-bold"><i class="fa fa-building mr-2 text-primary"></i> Branch Name : </span> 
                            <span class="text-muted">DemoBranch</span>
                        </li>
                    </ul>
                </div>
                <div class="card-footer bg-light border-0 text-center py-3">
                    <button class="btn btn-outline-primary btn-sm rounded-pill px-4" onclick="copyToClipboard('bank-details')">
                        <i class="fa fa-copy mr-1"></i> Copy Details
                    </button>
                    <div id="bank-details" style="display:none;">Bank Name: UBL, Account No: 03333333, Branch Code: 0342, Branch Name: DemoBranch</div>
                </div>
                <br>
            </div>
        </div>

        <!-- Mobile Banking Card -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
                <div class="card-header bg-gradient-success text-white py-4 text-center border-0">
                    <i class="fa fa-mobile fa-2x mb-2" style="padding-top : 10px;"></i>
                    <h5 class="mb-0">UBL Omni, Mobi Cash</h5>
                </div>
                <div class="card-body p-4">
                    <ul class="list-unstyled mb-0" style="padding-left : 20px;">
                        <li class="mb-3">
                            <span class="font-weight-bold"><i class="fa fa-id-card mr-2 text-success"></i> NIC# : </span> 
                            <span class="text-muted">001230006</span>
                        </li>
                        <li class="mb-3">
                            <span class="font-weight-bold"><i class="fa fa-phone mr-2 text-success"></i> Mobile No : </span> 
                            <span class="text-muted">7410000000</span>
                        </li>
                        <li>
                            <span class="font-weight-bold"><i class="fa fa-user mr-2 text-success"></i> Name : </span> 
                            <span class="text-muted">DemoName</span>
                        </li>
                    </ul>
                </div>
                <br>
                <div class="card-footer bg-light border-0 text-center py-3">
                    <button class="btn btn-outline-success btn-sm rounded-pill px-4" onclick="copyToClipboard('mobile-details')">
                        <i class="fa fa-copy mr-1"></i> Copy Details
                    </button>
                    <div id="mobile-details" style="display:none;">NIC#: 001230006, Mobile No: 7410000000, Name: DemoName</div>
                </div>
                <br> 
            </div>
        </div>

        <!-- Western Union Card -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
                <div class="card-header bg-gradient-warning text-white py-4 text-center border-0">
                    <i class="fa fa-globe fa-2x mb-2" style="padding-top : 10px;"></i>
                    <h5 class="mb-0">Western Union Details</h5>
                </div>
                <div class="card-body p-4">
                    <ul class="list-unstyled mb-0" style="padding-left : 20px;">
                        <li class="mb-3">
                            <span class="font-weight-bold"><i class="fa fa-user mr-2 text-warning"></i> Full Name : </span> 
                            <span class="text-muted">Demo Name</span>
                        </li>
                        <li class="mb-3">
                            <span class="font-weight-bold"><i class="fa fa-phone mr-2 text-warning"></i> Mobile No : </span> 
                            <span class="text-muted">7000015000</span>
                        </li>
                        <li class="mb-3">
                            <span class="font-weight-bold"><i class="fa fa-flag mr-2 text-warning"></i> Country : </span> 
                            <span class="text-muted">US</span>
                        </li>
                        <li>
                            <span class="font-weight-bold"><i class="fa fa-id-card mr-2 text-warning"></i> N.I.C No : </span> 
                            <span class="text-muted">011234567</span>
                        </li>
                    </ul>
                </div>
                <div class="card-footer bg-light border-0 text-center py-3">
                    <button class="btn btn-outline-warning btn-sm rounded-pill px-4" onclick="copyToClipboard('wu-details')">
                        <i class="fa fa-copy mr-1"></i> Copy Details
                    </button>
                    <div id="wu-details" style="display:none;">Full Name: Demo Name, Mobile No: 7000015000, Country: US, N.I.C No: 011234567</div>
                </div>
                <br>
            </div>
        </div>
    </div>
    <br>
    <!-- Instructions Card -->
    <div class="card border-0 shadow-sm mt-2" style="border-radius: 15px; overflow: hidden;">
        <div class="card-body p-4">
            <h5><i class="fa fa-info-circle mr-2 text-primary" style="padding-left : 10px;"></i>How to Pay Offline</h5>
            <ol class="pl-3 mb-0">
                <li class="mb-2">Choose your preferred payment method from the options above.</li>
                <li class="mb-2">Make your payment using the provided details.</li>
                <li class="mb-2">Take a screenshot or save transaction ID after completing payment.</li>
                <li class="mb-2">Go to "My Orders" and select "Confirm Payment" next to your order.</li>
                <li class="mb-2">Submit your payment proof and transaction details in the confirmation page.</li>
            </ol>
        </div>
    </div>
</div>
<br>
<!-- Copy to clipboard functionality -->
<script>
function copyToClipboard(elementId) {
    var aux = document.createElement("input");
    aux.setAttribute("value", document.getElementById(elementId).innerHTML);
    document.body.appendChild(aux);
    aux.select();
    document.execCommand("copy");
    document.body.removeChild(aux);
    
    // Show "Copied" toast notification
    var toast = document.createElement("div");
    toast.style.position = "fixed";
    toast.style.bottom = "20px";
    toast.style.left = "50%";
    toast.style.transform = "translateX(-50%)";
    toast.style.backgroundColor = "#333";
    toast.style.color = "#fff";
    toast.style.padding = "10px 20px";
    toast.style.borderRadius = "50px";
    toast.style.zIndex = "9999";
    toast.innerHTML = "✓ Copied to clipboard";
    document.body.appendChild(toast);
    
    setTimeout(function(){
        toast.style.opacity = "0";
        toast.style.transition = "opacity 0.5s";
        setTimeout(function(){
            document.body.removeChild(toast);
        }, 500);
    }, 2000);
}
</script>

<style>
    /* Soft UI Elements */
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #4a89dc 0%, #5d9cec 100%);
    }
    
    .bg-gradient-success {
        background: linear-gradient(135deg, #28a745 0%, #48d368 100%);
    }
    
    .bg-gradient-warning {
        background: linear-gradient(135deg, #ff9500 0%, #ffbd4a 100%);
    }
    
    .btn-outline-primary, .btn-outline-success, .btn-outline-warning {
        border-radius: 50px;
        transition: all 0.3s ease;
    }
    
    .btn-outline-primary:hover, .btn-outline-success:hover, .btn-outline-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .text-primary {
        color: #4a89dc !important;
    }
    
    .text-success {
        color: #28a745 !important;
    }
    
    .text-warning {
        color: #ff9500 !important;
    }
    
    /* Responsive styles */
    @media (max-width: 767px) {
        .card-body {
            padding: 1rem !important;
        }
        
        .card-header {
            padding: 1.5rem 1rem !important;
        }
    }
</style>