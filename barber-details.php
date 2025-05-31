<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require("engine/config.php");

$user_id = isset($_GET['id']) && !empty($_GET['id']) ? (int)$_GET['id'] : 0;

if ($user_id === 0) {
    header('Location: products.php');
    exit;
}

$user = null;

$getUserdetails = $conn->prepare("SELECT * FROM user_profile WHERE verified = 1 AND id = ?");
$getUserdetails->bind_param("i", $user_id);

if ($getUserdetails->execute()) {
    $userResult = $getUserdetails->get_result();
    $user = $userResult->fetch_assoc();
}

if (!$user) {
    header('Location: products.php'); // fallback if no user is found
    exit;
}

// Extract variables
extract($user); // Now variables like $user_name, $user_email, etc., are available
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("components/links.php"); ?>
    <link rel="stylesheet" href="assets/css/barber-details/barber-details.css">
    <link rel="stylesheet" href="assets/css/pricebreak-down.css">
    <link rel="stylesheet" href="assets/css/contact-us.css">
    <link rel="stylesheet" href="assets/css/services/services.css">
    <title><?= htmlspecialchars($user_name) ?> Details</title>
</head>
<body>

<!-- Navigation -->
<?php include("components/nav.php"); ?>

<!-- Hero Section -->
<div class="hero-image">
    <img src="assets/images/background/barber.jpg" alt="Barber cutting hair" data-aos="fade-in">
    <?php if ($payment_status == 1 && $user_type === 'barber'): ?>
        <a style="color:black;" class="request-btn btn-request text-decoration-none">Request</a>
    <?php else: ?>
        <a href='subscription.php' class="request-btn text-decoration-none">Request</a>
    <?php endif; ?>
</div>

<!-- Profile Image -->
<div class="position-absolute profile-image" data-aos="fade-up">
    <img src="<?= htmlspecialchars($user_image) ?>" alt="<?= htmlspecialchars($user_name) ?>">
</div>

<main class="position-relative">
    <!-- Profile Section -->
    <section class="d-flex justify-content-between g-5 body-part flex-md-row flex-column">

        <!-- Bio and Contact Info -->
        <div class="user-bio d-flex flex-row flex-column col-md-6 position-relative px-5" data-aos="fade-up-left">
            <span class="text-white">
                <?= empty($user_bio) 
                    ? "If you are travelling with a group of 16 or more people and are looking for sustainable cost-effective travel, look no further..." 
                    : htmlspecialchars($user_bio) ?>
            </span>

            <div class="contact-section mt-3" data-aos="fade-in">
                <div  class="">
                    <div class="form-group full-width">
                    <?php if($payment_status == 1 && $user_type='barber'): ?>
                        <label for="address">Address</label>
                        <textarea disabled id="address" placeholder="<?= htmlspecialchars($lga . ", " . $user_location) ?>"></textarea>
                        <?php endif ?>
                    </div>
                    
                    <div class="form-group">
                    <?php if($payment_status == 1 && $user_type='barber'): ?>
                        <label for="email">Email</label>
                        <input disabled type="email" id="email" placeholder="<?= htmlspecialchars($user_email) ?>">
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                         <?php if($payment_status == 1 && $user_type='barber'): ?>
                        <label for="phone">Phone No.</label>
                        <input disabled type="tel" id="phone" placeholder="<?= htmlspecialchars($user_phone) ?>">
                         <?php endif ?>
                    </div>
                    <div class="form-group full-width">
                        <label for="preference">Preference</label>
                        <?php 
                           $userprefence = explode(",",$user_preference);
                           foreach ($userprefence as $key) :
                            $key = preg_replace("/_/"," ",$key);
                            ?>
                                <input disabled type="text" class="text-capitalize" id="userpreference" placeholder="<?= htmlspecialchars($key) ?>">
                          <?php endforeach  ?>
            
                    </div>
                </div>
            </div>
        </div>

        <!-- Name, Ratings, and Message -->
        <div class="user-name col-md-6" data-aos="fade-up-right">
            <h1 class="fw-bold px-5 text-center"><?= htmlspecialchars($user_name) ?></h1>
            <div class="rating-text">
                <?= (int)$user_likes ?> likes · <?= (int)$user_shares ?> shares · 0 comments 
                ·  &nbsp;<a style="cursor:pointer;" onclick="toggleMessage()"><i class='bi bi-envelope'></i></a>
            </div>
            <div class="rating">
                <span class="stars">★★★★★</span>
                <span class="rating-text"><?= number_format((float)$user_rating, 2) ?></span>
            </div>

            <!-- Message Compose Window -->
<div class="email-compose-window d-none">
    <form id="message-form" method="POST">
        <div class="email-header">
            <h5 class="email-title">New message</h5>
            <div class="header-controls">
                <button type="button" onclick="toggleMessage()" class="header-btn"><i class="fas fa-times"></i></button>
            </div>
        </div>

        <div class="email-form">
            <div class="form-row d-none">
                <label class="form-label">To</label>
                <div class="form-input-container">
                    <input type="email" class="form-control d-none" name="to_email" value="<?= htmlspecialchars($user_email) ?>" readonly>
                    <div class="form-actions">
                        <button type="button" class="form-action-btn" id="copyBtn">Copy</button>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <!-- <label class="form-label">Subject</label>-->
                  <div class="form-input-container">
                    <input name="subject" type="text" class="form-control" required placeholder="Subject">
                </div> 
            </div>
        </div>

        <div class="email-body w-100">
            <textarea class="message-input form-control" name="message" id="copyText" style="color:black" placeholder="Write a message..." required></textarea>
        </div>

        <div class="result" style="display:none;"></div> <!-- Feedback message -->

        <div class="email-footer">
            <div class="footer-left">
                <div class="send-button-group">
                <?php if($payment_status == 1 && $user_type='barber'): ?>
                    <button type="submit" class="btn-send">Send</button>
                <?php endif ?>
                </div>
            </div>
            <div class="footer-right">
                <i id="resetForm" class="footer-icon far fa-trash-alt"></i>
            </div>
        </div>
    </form>
</div>

        </div>
    </section>

    <div class="divider"></div>

    <!-- Sections -->
    <?php include("components/barber-details/gallery-section.php") ?>
    <?php include("components/pricebreak-down.php"); ?>
    <?php include("components/barber-details/comment-section.php") ?>
    <?php include("components/contact.php") ?>

    <div id="request-container" style="transform:translate(-50%,-50%);left:50%;top:50%;" class="position-fixed d-none">
        <?php include("components/popRequest.php") ?>
    </div>
</main>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Toggle request popup
    $(document).on("click", ".btn-request", function(e) {
        e.preventDefault();
        $("#request-container").toggleClass("d-none");
    });

    // Toggle message popup
    function toggleMessage() {
        const composeWindow = document.querySelector(".email-compose-window");
        if (composeWindow) {
            composeWindow.classList.toggle("d-none");
        }
    }

    // Copy message content
    $(document).ready(function () {
        $('#copyBtn').on('click', function () {
            const copyText = $('#copyText');
            const showText =  $('#copyText').val();
            copyText.select();
            document.execCommand("copy");

            swal({
                title: "Success",
                text: "Copied: " + showText,
                icon: "success"
            });
        });
    });
</script>

<script>
$(document).ready(function() {
    $('#message-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "engine/message-process.php",
            data: $('#message-form').serialize(),
            dataType: "json",
            success: function(response) {
                if (response.status === "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });

                    $('.message-input').val(''); // clear input
                    setTimeout(() => {
                        document.querySelector(".email-compose-window").classList.add("d-none");
                    }, 2000);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error Status:", status);
                console.error("AJAX Error Thrown:", error);
                console.error("Server Response:", xhr.responseText);

                let message = "Server error. Please try again.";
                try {
                    const res = JSON.parse(xhr.responseText);
                    if (res.message) message = res.message;
                } catch (e) {
                    // Fail silently
                }

                Swal.fire({
                    icon: 'error',
                    title: 'AJAX Error',
                    text: message
                });
            }
        });
    });
});
</script>
<script>
   $(document).on("click","#resetForm",function(){
    $("#message-form")[0].reset();
   });
</script>

</body>
</html>
