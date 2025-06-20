<?php
session_start();
$txn_ref = time();
$user_id = isset($_SESSION['user_id']) && $_SESSION['user_id'] !== "" ? is_numeric($_SESSION['user_id']): 0;
if($user_id > 0):
   require("engine/config.php");
   $getuser = $conn->prepare("SELECT * FROM user_profile WHERE id = ?");
   $getuser->bind_param("i",$user_id);
   if($getuser->execute()):
     $userResult = $getuser->get_result();
     $user = $userResult->fetch_assoc();
      include("contents/profile-content.php");
   endif;
endif;

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("components/links.php") ?>
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="assets/css/services/services.css">
    <link rel="stylesheet" href="assets/css/subscription.css">
    <link rel="stylesheet" href="assets/css/contact-us.css">
    <link rel="stylesheet" href="assets/css/pricebreak-down.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Subscription</title>
</head>
<body>
   <?php include("components/nav.php")?>
   <br><br>
    <div class="pricing-container">
        <div class="row justify-content-center">
            <!-- Regular Plan -->
            <div class="col-lg-4 col-md-6">
                <div class="pricing-card regular">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-crown"></i>
                        </div>
                        <div>
                            <h5 class="card-title">REGULAR</h5>
                            <p class="card-subtitle">Perfect for people who live alone</p>
                        </div>
                    </div>
                    
                    <div class="features-section">
                        <h6>What's included</h6>
                        <div class="feature-item">
                            <div class="feature-icon"></div>
                            <span class="feature-text">General hair styling</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"></div>
                            <span class="feature-text">General hair styling</span>
                        </div>
                    </div>
                    
                    <div class="price-section">
                        <div class="price">10 NGN <span class="price-period">/per month</span></div>
                    </div>
                    <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] !==""){ ?>
                    <button class="choose-btn btn-basic" id="10" onclick="selectPlan('Regular')">Choose</button>
                    <?php } else{ ?>
                        <a href="sign-in.php?details=subscription.php" class="btn choose-btn  text-decoration-none">Choose</a>
                    <?php } ?>
                </div>
            </div>
            
            <!-- Growing Plan -->
            <div class="col-lg-4 col-md-6">
                <div class="pricing-card growing">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div>
                            <h5 class="card-title">GROWING</h5>
                            <p class="card-subtitle">Perfect for couples (size 2-4)</p>
                        </div>
                    </div>
                    
                    <div class="features-section">
                        <h6>What's included</h6>
                        <div class="feature-item">
                            <div class="feature-icon"></div>
                            <span class="feature-text">General hair styling</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"></div>
                            <span class="feature-text">General hair styling</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"></div>
                            <span class="feature-text">General hair styling</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"></div>
                            <span class="feature-text">General hair styling</span>
                        </div>
                    </div>
                    
                    <div class="price-section">
                        <div class="price">20 NGN <span class="price-period">/per month</span></div>
                    </div>
                    <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] !==""): ?>
                    <button class="choose-btn btn-gold" id="20" onclick="selectPlan('Growing')">Choose</button>
                    <?php  else: ?>
                    <a href="sign-in.php?details=subscription.php" class="btn choose-btn " id="20" onclick="selectPlan('Growing')">Choose</a>
                    <?php endif ?>
                </div>
            </div>
            
            <!-- Prime Plan -->
            <div class="col-lg-4 col-md-6">
                <div class="pricing-card prime">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-gem"></i>
                        </div>
                        <div>
                            <h5 class="card-title">PRIME</h5>
                            <p class="card-subtitle">Perfect for families (size 4+)</p>
                        </div>
                    </div>
                    
                    <div class="features-section">
                        <h6>What's included</h6>
                        <div class="feature-item">
                            <div class="feature-icon"></div>
                            <span class="feature-text">General hair styling</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"></div>
                            <span class="feature-text">General hair styling</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"></div>
                            <span class="feature-text">General hair styling</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"></div>
                            <span class="feature-text">General hair styling</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"></div>
                            <span class="feature-text">General hair styling</span>
                        </div>
                    </div>
                    
                    <div class="price-section">
                        <div class="price">30 NGN <span class="price-period">/per month</span></div>
                    </div>
                    <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] !==""): ?>
                    <button class="choose-btn btn-platinum" id="30" onclick="selectPlan('Prime')">Choose</button>
                    <?php else : ?>
                        <a href="sign-in.php?details=subscription.php" class=" btn choose-btn " id="30" onclick="selectPlan('Prime')">Choose</a>
                     <?php endif; ?>
                </div>
            </div>
        </div> 
    </div>
    <input type="hidden" name="phone" value="<?= htmlspecialchars($user_phone) ?>" id="phone_number">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
    // Ripple effect and selection feedback
    function selectPlan(planName, event) {
        const button = event.currentTarget;
        
        const ripple = document.createElement('div');
        Object.assign(ripple.style, {
            position: 'absolute',
            borderRadius: '50%',
            background: 'rgba(255, 255, 255, 0.6)',
            transform: 'scale(0)',
            animation: 'ripple 0.6s linear',
            left: '50%',
            top: '50%',
            width: '20px',
            height: '20px',
            marginLeft: '-10px',
            marginTop: '-10px'
        });

        button.style.position = 'relative';
        button.appendChild(ripple);

        setTimeout(() => ripple.remove(), 600);

        button.innerHTML = '✓ Selected';
        button.style.transform = 'scale(0.95)';

        setTimeout(() => {
            button.innerHTML = 'Choose';
            button.style.transform = '';
        }, 1500);

        console.log(`Selected plan: ${planName}`);
    }

    // Ripple keyframe animation style
    const rippleStyle = document.createElement('style');
    rippleStyle.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(rippleStyle);

    // Scroll animations for pricing cards
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    document.querySelectorAll('.pricing-card').forEach(card => observer.observe(card));

    // Paystack logic
    let amount; // Global amount variable

    document.addEventListener('DOMContentLoaded', () => {
        // Attach one listener for all pricing buttons
        document.querySelectorAll('.btn-basic, .btn-gold, .btn-platinum').forEach(button => {
            button.addEventListener('click', function () {
                amount = this.id;
               
                paywithPaystack();
            });
        });
    });

    function paywithPaystack() {
        if (!amount) {
            alert("Please select a package first!");
            return;
        }

        const paystack = new PaystackPop();
        const userId = "<?= htmlspecialchars($user_id); ?>";
        const userType = "<?= htmlspecialchars($user_type); ?>";
        const userEmail = "<?= htmlspecialchars($user_email); ?>";
        const phone = document.getElementById('phone_number')?.value || "";
        const txnRef = "<?php echo $txn_ref ?>";

        paystack.newTransaction({
            key: "pk_test_7580449c6abedcd79dae9c1c08ff9058c6618351",
            email: userEmail,
            amount: amount * 100,
            currency: "NGN",
            ref: txnRef,
            metadata: {
                custom_fields: [
                    {
                        display_name: "Mobile Number",
                        variable_name: "mobile_number",
                        value: phone
                    }
                ]
            },
            onSuccess: function (response) {
                if (response.status === "success") {
                    const ref = response.reference;
                    window.location.href = `verify-pay.php?status=success&id=${userId}&reference=${ref}&user_type=${userType}&amount=${amount}`;
                } else {
                    console.log("Payment not successful");
                }
            },
            onCancel: function () {
                console.log("Payment canceled");
            }
        });
    }
</script>

<script src="https://js.paystack.co/v2/inline.js"></script>

</body>
</html>
