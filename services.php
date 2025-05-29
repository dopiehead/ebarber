<html lang="en">
<head>
    <meta charset="UTF-8">
     <?php include("components/links.php") ?>
     <link rel="stylesheet" href="assets/css/services/services.css">
     <link rel="stylesheet" href="assets/css/discount-banner.css">
     <link rel="stylesheet" href="assets/css/client-review.css">
     <link rel="stylesheet" href="assets/css/blog.css">
     <link rel="stylesheet" href="assets/css/contact-us.css">
     <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>ebarber - Services</title>
</head>
<body>
    <!-- Header and Navigation -->
   <?php include("components/nav.php") ?>

    <!-- Banner Section with Services Heading -->
    <section class="banner">
        <h1>SERVICES</h1>
    </section>

    <!-- Services Grid Section -->
    <section class="services-container">
        <div class="services-grid">
            <!-- Service Card 1 -->
            <div class="service-card" data-aos="fade-up">
                <div class="service-icon scissors-icon"></div>
                <h3 class="service-title">HAIRCUT & BEARD TRIM</h3>
            </div>
            
            <!-- Service Card 2 -->
            <div class="service-card" data-aos="fade-up">
                <div class="service-icon razor-icon"></div>
                <h3 class="service-title">SHAVES & HAIRCUT</h3>
            </div>
            
            <!-- Service Card 3 -->
            <div class="service-card" data-aos="fade-up">
                <div class="service-icon beard-icon"></div>
                <h3 class="service-title">FACIAL & SHAVE</h3>
            </div>
            
            <!-- Service Card 4 -->
            <div class="service-card">
                <div class="service-icon face-icon" data-aos="fade-up"></div>
                <h3 class="service-title">FACIAL</h3>
            </div>
            
            <!-- Service Card 5 -->
            <div class="service-card">
                <div class="service-icon mustache-icon" data-aos="fade-up"></div>
                <h3 class="service-title">MUSTACHE TRIMMING</h3>
            </div>
            
            <!-- Service Card 6 -->
            <div class="service-card">
                <div class="service-icon hair-icon" data-aos="fade-up"></div>
                <h3 class="service-title">HAIR STYLING</h3>
            </div>
        </div>
    </section>

     <div class='p-5 d-flex align-items-center justify-content-center'>
        <?php include("components/discount-banner.php") ?>
       
    </div>
    <?php include("components/client-review.php") ?>
    <?php include("components/blog.php") ?>
    <?php include("components/contact.php") ?>
 
</body>
</html>