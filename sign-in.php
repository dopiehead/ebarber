<?php session_start();
$details = isset($_GET['details']) && !empty($_GET['details']) ? filter_var($_GET['details'],FILTER_SANITIZE_URL): null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/registration/sign-in.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Barbershop Login</title>
</head>
<body>
      <div class="bg-dark">
            <a class='text-dark text-decoration-none' href="index.php"><i class="fa fa-arrow-left"></i></a>
        </div>   
    <!-- ===== MAIN CONTAINER ===== -->
    <div class="container">  
  
        <!-- ===== LEFT SIDE - LOGIN FORM ===== -->
        <div class="login-section">
        <form id="signinForm" class="login-form" method="POST">
    <!-- ===== EMAIL/USERNAME FIELD ===== -->
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter email" required>
    </div>

    <!-- ===== PASSWORD FIELD ===== -->
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="••••••••••" required>
    </div>
    <input type="hidden" name="url" id="url" value="<?= isset($details) ? htmlspecialchars($details) : '' ?>">
    <!-- ===== LOGIN BUTTON ===== -->
    <div class="form-group">
        <button name="submit" type="submit" class="login-btn btn-custom">
            <span class="spinner-border text-dark"></span> <span class="signin-note">Login</span>
        </button>
    </div>

    <!-- ===== SIGN UP LINK ===== -->
    <div class="signup-link">
        Don't have an account? <a href="sign-up.php">Sign up</a>
    </div>
</form>
<div id="error-message"></div>
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
<script>   
   $(document).ready(function() {
    $(".spinner-border").hide();

    $("#signinForm").submit(function(event) {
        event.preventDefault();

        // Explicitly construct form data
        let formData = {
            email: $("#email").val().trim(),
            password: $("#password").val().trim(),
            url: $("#url").val().trim()
        };

        // Log data for debugging
        console.log("Form Data Object:", formData);
        console.log("Serialized Form Data:", $(this).serialize());

        // Client-side validation
        if (!formData.email || !formData.password) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please fill in all required fields.'
            });
            return;
        }

        $(".spinner-border").show();
        $('.btn-custom').prop('disabled', true);

        $.ajax({
            type: "POST",
            url: "engine/login-process",
            data: formData, // Use the explicit object instead of serialize()
            dataType: "json",
            success: function(response) {
                console.log("Server Response:", response);
                $(".spinner-border").hide();
                $('.btn-custom').prop('disabled', false);

                if (response.status === "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Successful',
                        text: 'Redirecting...',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        if (formData.url && formData.url !== "") {
                            window.location.href = formData.url;
                        } else {
                            switch (response.user_role) {
                                case "customer":
                                    window.location.href = "dashboard/profile.php";
                                    break;
                                case "barber":
                                    window.location.href = "dashboard/dashboard.php";
                                    break;
                                default:
                                    window.location.href = "dashboard/index.php";
                            }
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Failed',
                        text: response.message
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("AJAX Error:", textStatus, errorThrown);
                console.log("Response Text:", jqXHR.responseText);
                $(".spinner-border").hide();
                $('.btn-custom').prop('disabled', false);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: `Request failed: ${textStatus}`
                });
            }
        });
    });
});
</script>

</body>
</html>