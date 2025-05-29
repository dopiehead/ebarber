      <?php require("engine/config.php") ?>
      <style>
        .object-fit-contain{
            object-fit:cover;
        }
      </style>
    <!-- Review Header Section -->
    <div class="reviews-header">
        <h3 class="subtitle">What people say about us</h3>
        <h2 class="main-title">CLIENTS REVIEWS</h2>
    </div>
        <!-- Testimonials Section -->

   <div class="testimonials-container w-100 overflow-auto">

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$query = "SELECT client_review.id AS client_id,
                 client_review.client_name AS client_name,
                 client_review.comment AS comment,
                 client_review.date AS client_date,
                 user_profile.id AS id,
                 user_profile.user_image AS user_image
          FROM client_review
          JOIN user_profile ON client_review.id = user_profile.id";

$getreview = $conn->prepare($query);
if($getreview->execute()):
    $reviewResult = $getreview->get_result(); 
    while($clientRow = $reviewResult->fetch_assoc()): ?>
    
    <div class="testimonial-item" data-aos="fade-up">
        <div class="profile-image">
            <img class="w-100 h-100 rounded rounded-circle img-fluid" 
                 src="<?= htmlspecialchars($clientRow['user_image'] ?? 'https://placehold.co/400') ?>" 
                 alt="">
        </div>
        <p class="testimonial-text"><?= htmlspecialchars($clientRow['comment']) ?></p>
        <div class="client-name"><?= htmlspecialchars($clientRow['client_name']) ?></div>
    </div>

<?php
    endwhile;
endif;
?>  

</div>


