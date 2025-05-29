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
            <form id="signinForm" class="login-form">                
                <!-- ===== EMAIL/USERNAME FIELD ===== -->
                <div class="form-group">
                    <label for="email">Email or username</label>
                    <input type="text" id="email" name="email" placeholder="Enter name" required>
                </div>

                <!-- ===== PASSWORD FIELD ===== -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••••" required>
                </div>

                <!-- ===== LOGIN BUTTON ===== -->
                <div class="form-group">
                    <button name="submit" type="submit" class="login-btn btn-custom"><span class="spinner-border text-dark"></span> <span class="signin-note">Login</span></button>
                </div>

                <!-- ===== SIGN UP LINK ===== -->
                <div class="signup-link">
                    Don't have an account? <a href="sign-up.php">Sign up</a>
                </div>
                
            </form>
            <div id="error-message">

            </div>
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
    <input type="hidden" name='url' id='url' value = "<?= htmlspecialchars($details) ?>">
    <script>
    $(document).ready(function() {
        $(".spinner-border").hide();
        
        $("#signinForm").submit(function(event) {
            event.preventDefault();
            $(".spinner-border").show();
            $(".signin-note").hide();
            $('.btn-custom').prop('disabled', true);
            
            let email = $("#email").val();
            let password = $("#password").val();
            let url = $("#url").val().trim(); // Trim URL to ensure it's not empty
            
            $.ajax({
                type: "POST",
                url: "engine/login-process.php",
                data: { email: email, password: password },
                dataType: "json",
                success: function(response) {
                    $(".spinner-border").hide();
                    $(".signin-note").show();
                    $('.btn-custom').prop('disabled', false);
                    
                    if (response.status === "success") {
                        if (url && url !== "") {
                            window.location.href = url;
                        } else {
                            switch (response.user_role) {
                                case "Customer":
                                    window.location.href = "dashboard/profile.php";
                                    break;
                                case "Barber":
                                    window.location.href = "dashboard/dashboard.php";
                                    break;
                            }
                        }
                    } else {
                        $("#error-message").text(response.message);
                    }
                },
                error: function() {
                    $(".spinner-border").hide();
                    $(".signin-note").show();
                    $('.btn-custom').prop('disabled', false);
                    $("#error-message").text("Something went wrong. Please try again.");
                }
            });
        });
    });
</script>
</body>
</html>