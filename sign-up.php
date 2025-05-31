<?php session_start();
$page = isset($_GET['page']) && !empty($_GET['page']) ? $_GET['page'] : "";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbershop Sign Up</title>
    <link rel="stylesheet" href="assets/css/registration/sign-up.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        /* ===== RESET & BASE STYLES ===== */
     
    </style>
</head>
<body>
    <!-- ===== MAIN CONTAINER ===== -->
    <div class="container">

        <!-- ===== LEFT SIDE - SIGNUP FORM ===== -->
        <div class="signup-section">
            <form class="signup-form">
                
                <!-- ===== FORM TITLE ===== -->
                <h1 class="form-title">Create Account</h1>
                <p class="form-subtitle">Join our barbershop community today</p>

                <!-- ===== FULL NAME FIELD ===== -->
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" id="fullName" name="fullName" placeholder="John Doe" required>
                    <span class="error-message">Please enter your full name</span>
                </div>

                <!-- ===== EMAIL FIELD ===== -->
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="john.doe@example.com" required>
                    <span class="error-message">Please enter a valid email address</span>
                </div>

                <!-- ===== PHONE NUMBER FIELD ===== -->
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <div class="phone-field">
                        <input type="text" class="country-code" placeholder="+1" value="+1">
                        <input type="tel" id="phone" name="phone" class="phone-number" inputmode="numeric" placeholder="(555) 123-4567" required>
                    </div>
                    <span class="error-message">Please enter a valid phone number</span>
                </div>

                <!-- ===== PASSWORD FIELD ===== -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-field">
                        <input type="password" id="password" name="password" placeholder="••••••••••" required>
                        <button type="button" class="password-toggle" onclick="togglePassword('password')">Show</button>
                    </div>
                    <span class="error-message">Password must be at least 8 characters long</span>
                </div>

                <!-- ===== CONFIRM PASSWORD FIELD ===== -->
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <div class="password-field">
                        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="••••••••••" required>
                        <button type="button" class="password-toggle" onclick="togglePassword('confirmPassword')">Show</button>
                    </div>
                    <span class="error-message">Passwords do not match</span>
                </div>

                <div class="form-group">
                 <label for="userType">User Type</label>
                    <select name="user_type">
                        <option <?php if($page=='barber'){echo "selected";} ?>  value="barber">I am a Barber</option>
                        <option <?php if($page=='customer'){echo "selected";} ?> value="customer">I am a Customer</option>
                    </select>
                </div>

                <!-- ===== SIGNUP BUTTON ===== -->
                <div class="form-group">
                    <button type="submit" class="signup-btn">Create Account</button>
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
    // Toggle password visibility
    $('.toggle-password').on('click', function () {
        const $passwordField = $(this).siblings('input');
        const fieldType = $passwordField.attr('type');

        if (fieldType === 'password') {
            $passwordField.attr('type', 'text');
            $(this).text('Hide');
        } else {
            $passwordField.attr('type', 'password');
            $(this).text('Show');
        }
    });

    // User type selection
    $('.btn-outline-secondary').on('click', function (e) {
        e.preventDefault();
        const userType = $(this).attr('id');
        $('#user_type').val(userType);

        $(this)
            .addClass('btn-secondary text-white')
            .siblings('.btn-outline-secondary')
            .removeClass('btn-secondary text-white');
    });

    // Form submission
    $('#signupForm').on('submit', function (e) {
        e.preventDefault();

        const $form = $(this);
        const fullName = $('#fullName');
        const email = $('#email');
        const phone = $('#phone');
        const password = $('#password');
        const confirmPassword = $('#confirmPassword');

        let isValid = true;

        // Reset validation states
        $('.form-group').removeClass('error success');

        // Full name validation
        if ($.trim(fullName.val()).length < 2) {
            fullName.closest('.form-group').addClass('error');
            isValid = false;
        } else {
            fullName.closest('.form-group').addClass('success');
        }

        // Email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email.val())) {
            email.closest('.form-group').addClass('error');
            isValid = false;
        } else {
            email.closest('.form-group').addClass('success');
        }

        // Phone validation
        const phoneRegex = /^[\d\s\-\(\)\+]{10,}$/;
        if (!phoneRegex.test(phone.val())) {
            phone.closest('.form-group').addClass('error');
            isValid = false;
        } else {
            phone.closest('.form-group').addClass('success');
        }

        // Password length
        if (password.val().length < 8) {
            password.closest('.form-group').addClass('error');
            isValid = false;
        } else {
            password.closest('.form-group').addClass('success');
        }

        // Confirm password match
        if (password.val() !== confirmPassword.val()) {
            confirmPassword.closest('.form-group').addClass('error');
            isValid = false;
        } else {
            confirmPassword.closest('.form-group').addClass('success');
        }

        if (!isValid) return;

        // Show spinner, disable button
        $(".spinner-border").show();
        $(".signup-note").addClass("d-none");
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
                $(".spinner-border").hide();
                $(".signup-note").removeClass("d-none");
                $(".btn-custom").prop("disabled", false);

                if (data.status === "success") {
                    swal({
                        icon: "success",
                        title: "Success!",
                        text: data.message
                    });
                    $form[0].reset();
                    $('.form-group').removeClass('success error');
                } else {
                    swal({
                        icon: "warning",
                        title: "Registration Failed",
                        text: data.message
                    });
                }
            },
            error: function (xhr, status, error) {
                $(".spinner-border").hide();
                $(".signup-note").removeClass("d-none");
                $(".btn-custom").prop("disabled", false);

                swal({
                    icon: "error",
                    title: "Registration Failed",
                    text: xhr.responseText || "Something went wrong"
                });
            }
        });
    });
});
</script>


</body>
</html>