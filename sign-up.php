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

    <!-- ===== JAVASCRIPT FOR SHOW/HIDE PASSWORD ===== -->
    <script>
    // Toggle password visibility
    function togglePassword(fieldId) {
        const passwordField = document.getElementById(fieldId);
        const toggleButton = passwordField.nextElementSibling;

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleButton.textContent = 'Hide';
        } else {
            passwordField.type = 'password';
            toggleButton.textContent = 'Show';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('#signupForm');

        // User type selection
        document.querySelectorAll('.btn-outline-secondary').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const userType = this.id;
                document.getElementById('user_type').value = userType;

                this.classList.add('btn-secondary', 'text-white');
                this.parentElement.querySelectorAll('.btn-outline-secondary').forEach(sibling => {
                    if (sibling !== this) sibling.classList.remove('btn-secondary', 'text-white');
                });
            });
        });

        // Form validation and AJAX submission
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const fullName = document.getElementById('fullName');
            const email = document.getElementById('email');
            const phone = document.getElementById('phone');
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirmPassword');

            let isValid = true;

            // Reset error/success states
            document.querySelectorAll('.form-group').forEach(group => {
                group.classList.remove('error', 'success');
            });

            // Validation logic
            if (fullName.value.trim().length < 2) {
                fullName.closest('.form-group').classList.add('error');
                isValid = false;
            } else {
                fullName.closest('.form-group').classList.add('success');
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value)) {
                email.closest('.form-group').classList.add('error');
                isValid = false;
            } else {
                email.closest('.form-group').classList.add('success');
            }

            const phoneRegex = /^[\d\s\-\(\)\+]{10,}$/;
            if (!phoneRegex.test(phone.value)) {
                phone.closest('.form-group').classList.add('error');
                isValid = false;
            } else {
                phone.closest('.form-group').classList.add('success');
            }

            if (password.value.length < 8) {
                password.closest('.form-group').classList.add('error');
                isValid = false;
            } else {
                password.closest('.form-group').classList.add('success');
            }

            if (password.value !== confirmPassword.value) {
                confirmPassword.closest('.form-group').classList.add('error');
                isValid = false;
            } else {
                confirmPassword.closest('.form-group').classList.add('success');
            }

            if (!isValid) return;

            // If valid, proceed with AJAX submission
            document.querySelector(".spinner-border").style.display = 'inline-block';
            document.querySelector('.signup-note')?.classList.add('d-none');
            document.querySelector('.btn-custom').disabled = true;

            const formData = new FormData(form);

            fetch('engine/signup-process.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                document.querySelector(".spinner-border").style.display = 'none';
                document.querySelector('.signup-note')?.classList.remove('d-none');

                if (data.status === "success") {
                    swal({
                        icon: "success",
                        title: "Success!!",
                        text: data.message
                    });
                    form.reset();
                } else {
                    swal({
                        icon: "warning",
                        title: "Registration Failed",
                        text: data.message
                    });
                }
                document.querySelector('.btn-custom').disabled = false;
            })
            .catch(err => {
                document.querySelector(".spinner-border").style.display = 'none';
                swal({
                    icon: "error",
                    title: "Registration Failed",
                    text: err.message || "Something went wrong"
                });
                document.querySelector('.btn-custom').disabled = false;
                document.querySelector('.signup-note')?.classList.remove('d-none');
            });
        });
    });
</script>


</body>
</html>