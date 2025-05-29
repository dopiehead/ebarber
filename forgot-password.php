<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/registration/sign-in.css">
    <title>Forgot password</title>
    <style>
      
    </style>
</head>
<body>
    <!-- ===== MAIN CONTAINER ===== -->
    <div class="container">

    <div style="padding:20px 25px;" class='container'>
         <a onclick="history.go(-1)">
         <div class="line"></div>
         <div class="line2"></div>
           <i class="fas fa-chevron-left">

           </i>
        </a>
     </div>
        
        <!-- ===== LEFT SIDE - LOGIN FORM ===== -->
        <div class="login-section">
            <form class="login-form">
                
                <!-- ===== EMAIL/USERNAME FIELD ===== -->
                <div class="form-group">
                    <label for="email">Email or username</label>
                    <input type="text" id="email" name="email" placeholder="James Johnson" required>
                </div>

                <!-- ===== PASSWORD FIELD ===== -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter new Password" required>
                </div>

                <!-- ===== LOGIN BUTTON ===== -->
                <div class="form-group">
                    <button type="submit" class="login-btn">Change Password</button>
                </div>


                <!-- ===== SIGN UP LINK ===== -->              
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
</body>
</html>