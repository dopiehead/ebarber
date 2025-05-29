<?php
error_reporting(E_ALL); // Report all types of errors
ini_set('display_errors', 1); 
session_start();

$user_id = isset($_GET['id']) && !empty($_GET['id']) ? $_GET['id']: 0;

if($user_id === 0){
    header('Location:products.php');
}
if($user_id):

    require("engine/config.php");
    $getUserdetails = $conn->prepare("SELECT * FROM user_profile WHERE verified = 1 AND id = ?");
    $getUserdetails->bind_param("i",$user_id);

    if($getUserdetails->execute()) :
       $userResult = $getUserdetails->get_result();

       while($user = $userResult->fetch_assoc()):
         include ("contents/profile-content.php");
        
       endwhile;

    endif;

endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <?php include("components/links.php"); ?>
     <link rel="stylesheet" href="assets/css/barber-details/barber-details.css">
     <link rel="stylesheet" href="assets/css/pricebreak-down.css">
     <link rel="stylesheet" href="assets/css/contact-us.css">
     <link rel="stylesheet" href="assets/css/services/services.css">
    <title><?= htmlspecialchars($user_name) ?>  Details</title>

</head>
<body>
            <!-- Header Navigation -->
     <?php include("components/nav.php") ?>

            <!-- Main Content -->
     <div class="hero-image">
         <img src="assets/images/background/barber.jpg" alt="Barber cutting hair" data-aos="fade-in">
          <?php if($payment_status===1 && $user_type ==='barber'): ?>
         <a  style="color:black;" class="request-btn btn-request text-decoration-none">Request</a>
          <?php else: ?>
         <a href='subscription.php' class="request-btn text-decoration-none">Request</a>
          <?php endif ?>
     </div>
    
     <div class="position-absolute profile-image" data-aos="fade-up">
         <img src="<?= htmlspecialchars($user_image) ?>" alt="<?= htmlspecialchars($user_name) ?>">
     </div> 

     <main class="position-relative">
             <!-- about-profile -->                    
<section class="d-flex justify-content-between g-5 body-part flex-md-row flex-column">

     <div class="user-bio d-flex flex-row flex-column col-md-6 position-relative px-5"  data-aos="fade-up-left">

         <span class="text-white"><?php if(empty($user_bio)){echo"If you are travelling with a group of 16 or more people and are looking for sustainable cost-effective travel, look no further. When hiring a coach and a driver, you have complete control over your travel itinerary, making changes and stops as you wish, ensuring a tailor-made journey for everyone on board.";}else{echo htmlspecialchars($user_bio);}?></span>   
          <div class="contact-section mt-3"  data-aos="fade-in">
             <div class="form-container">
                 <div class="form-group full-width">
                     <label for="address">Address</label>
                     <textarea disabled id="address" placeholder="<?= htmlspecialchars($lga.",".$user_location) ?>"></textarea>
                 </div>
                 <div class="form-group">
                     <label for="email">email</label>
                     <input disabled type="email" id="email" placeholder="<?= htmlspecialchars($user_email) ?>">
                 </div>
                 <div class="form-group">
                     <label for="phone">phone no.</label>
                     <input disabled type="tel" id="phone" placeholder="<?= htmlspecialchars($user_phone) ?>">
                 </div>
             </div>
          </div>

     </div>

     <div class="user-name col-md-6" data-aos="fade-up-right">

         <h1  class="fw-bold px-5 text-center"><?= htmlspecialchars($user_name) ?></h1>
         <div class="rating-text"><?= htmlspecialchars($user_likes) ?> likes · <?= htmlspecialchars($user_shares) ?> shares · 0 comments</div>
         <div class="rating">
            <span class="stars">★★★★★</span>
            <span class="rating-text">4.34</span>
         </div>
     </div>
  

</section>
       
         <div class="divider"></div>
              <!-- Gallery Section -->
         <?php include("components/barber-details/gallery-section.php") ?>  
            <!-- price break down -->
         <?php include("components/pricebreak-down.php"); ?>  
             <!-- Comments Container -->   
         <?php include ("components/barber-details/comment-section.php") ?>
               <!-- footer section -->
         <?php include("components/contact.php") ?>

         <div id="request-container" style="transform:translate(-50%,-50%);left:50%;top:50%;" class="position-fixed d-none">
            <?php include("components/popRequest.php") ?>
         </div>

     </main>




     <script>
        $(document).on("click",".btn-request",function(e){
          e.preventDefault();
          $("#request-container").toggleClass("d-none")
        });


     </script>
</body>
</html>

