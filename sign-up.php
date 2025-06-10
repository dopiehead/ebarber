<?php session_start();
$page = isset($_GET['page']) && !empty($_GET['page']) ? $_GET['page'] : "";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Barbershop Sign Up</title>
    <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/registration/sign-up.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat|sofia|Trirong|Poppins">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- SweetAlert v1 CSS & JS -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <style>
        /* ===== RESET & BASE STYLES ===== */
     
    </style>
</head>
<body>
    <!-- ===== MAIN CONTAINER ===== -->
    <div class="container">

        <!-- ===== LEFT SIDE - SIGNUP FORM ===== -->
        <div class="signup-section">
            <form id="signupForm" class="signup-form">
                
                <!-- ===== FORM TITLE ===== -->
                <h1 class="form-title">Create Account</h1>
                <p class="form-subtitle">Join our barbershop community today</p>

                <!-- ===== FULL NAME FIELD ===== -->
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" id="fullName" name="user_name" placeholder="John Doe" required>
                    <div class="error-message">Please enter your full name</div>
                </div>

                <!-- ===== EMAIL FIELD ===== -->
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="user_email" placeholder="john.doe@example.com" required>
                    <div class="error-message">Please enter a valid email address</div>
                </div>

                <!-- ===== PHONE NUMBER FIELD ===== -->
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <div class="phone-field">
                      
                        <input type="tel" id="phone" name="user_phone" class="phone-number" inputmode="numeric" placeholder="(555) 123-4567" required>
                    </div>
                    <div class="error-message">Please enter a valid phone number</div>
                </div>

                <!-- ===== PASSWORD FIELD ===== -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-field">
                        <input type="password" id="password" name="user_password" placeholder="••••••••••" required>
                        <button type="button" class="password-toggle" onclick="togglePassword('password', this)">Show</button>
                    </div>
                    <span class="error-message">Password must be at least 8 characters long</span>
                </div>

                <!-- ===== CONFIRM PASSWORD FIELD ===== -->
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <div class="password-field">
                        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="••••••••••" required>
                        <button type="button" class="password-toggle" onclick="togglePassword('confirmPassword', this)">Show</button>
                    </div>
                    <div class="error-message">Passwords do not match</div>
                </div>
                <script>
                    function togglePassword(fieldId, button) {
                      const input = document.getElementById(fieldId);
                    if (!input) return;
                    if (input.type === "password") {
                      input.type = "text";
                      button.textContent = "Hide";
                    } else {
                      input.type = "password";
                       button.textContent = "Show";
                    }
                    }
                </script>

                <div class="form-group">
                 <label for="userType">User Type</label>
                    <select name="user_type" class='text-secondary py-2'>
                        <option <?php if($page=='barber'){echo "selected";} ?>  value="barber">I am a Barber</option>
                        <option <?php if($page=='customer'){echo "selected";} ?> value="customer">I am a Customer</option>
                    </select>
                     <div class="error-message">Select user type</div>
                </div>

                <!-- ===== SIGNUP BUTTON ===== -->
                <div class="form-group">
                    <button name="submit" type="submit" class="signup-btn btn-custom">Create Account</button>
                          <div class="spinner-border text-primary ms-3 d-none" role="status"></div>
                          <small class="signup-note text-muted ms-2 d-none">Processing...</small>
                </div>

                <!-- ===== FORGOT PASSWORD LINK ===== -->
                <div class="forgot-password">
                    <a href="forgot-password.php">Forgot your password?</a>
                </div>

                <!-- ===== LOGIN LINK ===== -->
                <div class="login-link">
                    Already have an account? <a href="sign-in.php">Sign in</a>
                </div>
                
                
            </form>
        </div>

        <!-- ===== RIGHT SIDE - IMAGE SECTION ===== -->
        <div class="image-section">
            <div class="image-overlay"></div>
            
            <!-- ===== FLOATING ELEMENTS ===== -->
            <div class="floating-element small"></div>
            <div class="floating-element medium"></div>
            <div class="floating-element large"></div>
        </div>
        
    </div>

<!-- ===== jQuery for Show/Hide Password, Form Validation and AJAX Submission ===== -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {

    $('#signupForm').on('submit', function (e) {
        e.preventDefault();
        if ($(".btn-custom").prop("disabled")) return;

        const $form = $(this);
        const fullName = $('#fullName');
        const email = $('#email');
        const phone = $('#phone');
        const password = $('#password');
        const confirmPassword = $('#confirmPassword');

        let isValid = true;
        $('.form-group').removeClass('error success');
        $('.error-msg').text('');

        if ($.trim(fullName.val()).length < 2) {
            fullName.closest('.form-group').addClass('error');
            fullName.siblings('.error-msg').text('Full name must be at least 2 characters');
            isValid = false;
        } else {
            fullName.closest('.form-group').addClass('success');
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email.val())) {
            email.closest('.form-group').addClass('error');
            email.siblings('.error-msg').text('Enter a valid email address');
            isValid = false;
        } else {
            email.closest('.form-group').addClass('success');
        }

        const phoneRegex = /^(?:\+234|0)[789][01]\d{8}$/;
        if (!phoneRegex.test(phone.val())) {
            phone.closest('.form-group').addClass('error');
            phone.siblings('.error-msg').text('Enter a valid Nigerian phone number');
            isValid = false;
        } else {
            phone.closest('.form-group').addClass('success');
        }

        if (password.val().length < 8) {
            password.closest('.form-group').addClass('error');
            password.siblings('.error-msg').text('Password must be at least 8 characters');
            isValid = false;
        } else {
            password.closest('.form-group').addClass('success');
        }

        if (password.val() !== confirmPassword.val()) {
            confirmPassword.closest('.form-group').addClass('error');
            confirmPassword.siblings('.error-msg').text('Passwords do not match');
            isValid = false;
        } else {
            confirmPassword.closest('.form-group').addClass('success');
        }

        if (!isValid) {
            $('html, body').animate({ scrollTop: $('.form-group.error').first().offset().top - 100 }, 600);
            return;
        }

        $(".spinner-border").removeClass("d-none");
        $(".signup-note").removeClass("d-none");
        $(".btn-custom").prop("disabled", true);

        const formData = new FormData(this);

        $.ajax({
            url: 'engine/signup-process',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
           success: function (data) {
    $(".spinner-border").addClass("d-none");
    $(".signup-note").addClass("d-none");
    $(".btn-custom").prop("disabled", false);

    if (data.status === "success") {
        swal("Success", data.message, "success");
        $form[0].reset();
        $('.form-group').removeClass('success error');
    } else {
        swal("Failed", data.message, "warning");
    }
},
error: function (xhr) {
    $(".spinner-border").addClass("d-none");
    $(".signup-note").addClass("d-none");
    $(".btn-custom").prop("disabled", false);

    let errMsg = "Something went wrong. Please try again.";
    if (xhr.responseJSON && xhr.responseJSON.message) {
        errMsg = xhr.responseJSON.message;
    } else if (xhr.responseText) {
        try {
            const parsed = JSON.parse(xhr.responseText);
            errMsg = parsed.message || errMsg;
        } catch (e) {
            errMsg = xhr.responseText;
        }
    }

    swal("Error", errMsg, "error");
}

        });
    });
});
</script>
</body>
</html>