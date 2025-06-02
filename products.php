<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Barbers</title>
    <?php include("components/links.php"); ?>
    <link rel="stylesheet" href="assets/css/services/services.css">
    <link rel="stylesheet" href="assets/css/products/products.css">
    <link rel="stylesheet" href="assets/css/contact-us.css">
</head>
<body>

<?php include("components/nav.php"); ?>

<!-- Booking Form Container -->
<div class="booking-form px-5 mt-4">

        <!-- Row 1: Search, People, Style -->
        <div class="form-row  flex-md-row flex-column">
            <!-- Search Input -->
            <div class="form-field">
                <label class="form-label">Search for barber</label>
                <input type="search" name="q" id="q" class="w-100 border-secondary">
            </div>

            <!-- Style Dropdown -->
            <div class="form-field">
                <label class="form-label">Add style</label>
                <select class="dropdown" name="barber_style" id="barber_style">
                    <option value="">-- Select a Style --</option>
                    <option value="The Executive">The Executive</option>
                    <option value="The Fresh Prince">The Fresh Prince</option>
                    <option value="Gentleman's Fade">Gentleman's Fade</option>
                    <option value="Boss Cut">Boss Cut</option>
                    <option value="Waves & Fade">Waves & Fade</option>
                    <option value="Streetline Design">Streetline Design</option>
                    <option value="Classic Edge">Classic Edge</option>
                    <option value="Golden Fade">Golden Fade</option>
                </select>
            </div>
        </div>

        <!-- Row 2: Service Type -->
        <div class="form-row flex-md-row flex-column">
            <!-- Service Type -->
            <div class="form-field">
                <label class="form-label">Service type</label>
                <select name="user_preference" id="user_preference">
                    <option value="">All</option>
                    <option value="home_service">Home service</option>
                    <option value="shop_owner">Shop owner</option>
                </select>
            </div>

            <!-- Location -->
            <div class="form-field">
                <label class="form-label">Location</label>
                <?php
                require_once("engine/connection.php");
                $states = [];
                $query = "SELECT DISTINCT state FROM states_in_nigeria ORDER BY state ASC";
                $result = $con->query($query);
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $states[] = $row['state'];
                    }
                }
                ?>
                <select name="locationFilter" id="locationFilter" class="form-select bg-dark text-white text-capitalize" required>
                    <option value="">-- Select Your State --</option>
                    <?php foreach ($states as $state): ?>
                        <option value="<?= htmlspecialchars($state) ?>"><?= htmlspecialchars($state) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Row 3: Search Button -->
        <div class="form-row">
            <button type="submit" class="search-button">Search</button>
        </div>
 
</div>

<!-- Price & Filter Section -->
<div class="mt-3 text-white px-3">
    <h4 class="fw-bold">Price</h4>
</div>

<div class="d-flex flex-md-row flex-column ms-md-2">
    <!-- Sidebar Filters -->
    <div class="sidebar px-3">
    <?php 
    require("engine/config.php");
    $getpricing = $conn->prepare("SELECT MIN(user_fee) AS min_price, MAX(user_fee) AS max_price FROM user_profile WHERE verified = 1 AND user_type = 'barber'");
    $getpricing->execute();
    $getpricing->bind_result($min_price, $max_price);
    $getpricing->fetch();
    $getpricing->close();
    ?>

        <!-- Price Filter -->
        <div class="price-filter">
    <div class="filter-row mb-2">
        <label for="price_from" class="form-label text-white">Price From</label>
        <input type="number" name="price_from" id="price_from" class="form-control" placeholder="e.g. 1000" min="<?= htmlspecialchars($min_price)?>" style="background-color:inherit;color:white;">
    </div>
    <div class="filter-row">
        <label for="price_to" class="form-label text-white">Price To</label>
        <input type="number" name="price_to" id="price_to" class="form-control" placeholder="e.g. 10000" max="<?= htmlspecialchars($max_price)?>" style="background-color:inherit;color:white;">
    </div>
</div>

        <!-- Gender Filter -->
        <div class="more-filter mt-4">
            <div class="more-filter-title text-success">More Filter</div>
            <?php 
// Use conditional COUNT for accurate gender breakdown
$getgender = $conn->prepare("
    SELECT 
        COUNT(CASE WHEN user_gender = 'male' THEN 1 END) AS numMale, 
        COUNT(CASE WHEN user_gender = 'female' THEN 1 END) AS numFemale 
    FROM user_profile 
    WHERE verified = 1 AND user_type = 'barber'
");
$getgender->execute();
$getgender->bind_result($numMale, $numFemale);
$getgender->fetch();
$getgender->close();
?>
            <div class="filter-row"><span style="cursor:pointer;" name="gender[]" class='gender' id="male">Male</span><span><?= htmlspecialchars($numMale ?? 0) ?></span></div>
            <div class="filter-row"><span style="cursor:pointer;" name="gender[]" class='gender' id="female">Female</span><span><?= htmlspecialchars($numFemale ?? 0) ?></span></div>
        </div>

    <label class="more-filter-title text-success">Sort By</label>
    <select name="orderBy" id="orderBy" class="form-select bg-dark text-white">
        <option value="date_added_DESC">Newest First</option>
        <option value="date_added_ASC">Oldest First</option>
        <option value="user_name_ASC">Name A-Z</option>
        <option value="user_name_DESC">Name Z-A</option>
        <option value="age_ASC">Youngest First</option>
        <option value="age_DESC">Oldest First</option>
        <option value="user_rating_DESC">Highest Rated</option>
        <option value="user_rating_ASC">Lowest Rated</option>
        <option value="user_fee_ASC">Lowest Fee</option>
        <option value="user_fee_DESC">Highest Fee</option>
    </select>
</div>

    <!-- Separator -->
    <div class="content-separator"></div>

    <!-- Main Content Area -->
    <div class="content" data-aos="fade-up">
         <div style="display: none;" class="text-warning fs-3"><span class="spinner-border text-warning"></span></div>
        <div id="product-content"></div>
    </div>
  
</div>


<br><br>
<!-- Contact Section -->
<?php include("components/contact.php"); ?>

<!-- Product Load Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
   $("#product-content").load("engine/get-products");

    // Search input
    $('#q').on('keyup', function(e) {
        const x = $('#q').val();
        e.preventDefault();
        fetchData(x);
    });

    // Filter: barber_style
    $('#barber_style').on('change', function(e) {
        const x = $('#q').val();
        const barber_style = $('#barber_style').val();
        alert(barber_style);
        e.preventDefault();
        fetchData(x,barber_style);
    });

    // Filter: location
    $('#locationFilter').on('change', function(e) {
        e.preventDefault();
        const x = $('#q').val();
        const barber_style = $('#barber_style').val();
        const locationFilter = $('#locationFilter').val();
        fetchData(x, barber_style, locationFilter);
    });

    // Filter: user_preference (on click)
    $('#user_preference').on('change', function(e) {
        e.preventDefault();
        const x = $('#q').val();
        const user_preference = $('#user_preference').val();
        const barber_style = $('#barber_style').val();
        const locationFilter = $('#locationFilter').val();       
        fetchData(x, barber_style, locationFilter, user_preference);
    });


    $('.gender').on('click', function(e) {
         $(".gender").removeClass("active");
         $(this).addClass("active");
        e.preventDefault();
        const x = $('#q').val();
        const user_preference = $('#user_preference').val();
        const barber_style = $('#barber_style').val();
        const locationFilter = $('#locationFilter').val();  
        const gender = $(this).attr("id");     
        fetchData(x, barber_style, locationFilter, user_preference, gender);
    });



    // Price range filters
    $('#price_from').on('keyup', function(e) {
        e.preventDefault();
        const user_preference = $('#user_preference').val();
        const x = $('#q').val();
        const barber_style = $('#barber_style').val();
        const locationFilter = $('#locationFilter').val();   
        const price_from = $('#price_from').val();    
        const gender = $('.gender').attr("id");  
        fetchData(x, barber_style, locationFilter, user_preference, gender, price_from);
    });

    $('#price_to').on('keyup', function(e) {
        e.preventDefault();
        const user_preference = $('#user_preference').val();
        const x = $('#q').val();
        const barber_style = $('#barber_style').val();
        const locationFilter = $('#locationFilter').val();   
        const price_from = $('#price_from').val(); 
        const price_to = $('#price_to').val(); 
        const gender = $('.gender').attr("id");  
        fetchData(x, barber_style, locationFilter, user_preference, gender, price_from, price_to);
    });

    // Order by filter
    $('#orderBy').on('change', function(e) {
        e.preventDefault();
        const user_preference = $('#user_preference').val();
        const x = $('#q').val();
        const barber_style = $('#barber_style').val();
        const locationFilter = $('#locationFilter').val();   
        const price_from = $('#price_from').val(); 
        const price_to = $('#price_to').val(); 
        const orderBy = $('#orderBy').val(); 
        const gender = $('.gender').attr("id");  
        fetchData(x, barber_style, locationFilter, user_preference, gender,price_from, price_to, orderBy);
    });

    // Pagination
    $(document).on("click", ".btn-pagination", function(e) {
        e.preventDefault();
        const x = $('#q').val();
        const page = $(this).attr("id");
        const user_preference = $('#user_preference').val();
        const barber_style = $('#barber_style').val();
        const locationFilter = $('#locationFilter').val();   
        const price_from = $('#price_from').val(); 
        const price_to = $('#price_to').val(); 
        const orderBy = $('#orderBy').val(); 
        const gender = $('.gender').attr("id"); 
        fetchData(x, barber_style, locationFilter, user_preference, gender, price_from, price_to, orderBy, page);
    });

    // Main AJAX function
    function fetchData(x, barber_style, locationFilter, user_preference, gender, price_from, price_to, orderBy, page) {
        $(".spinner-border").show();

        $.ajax({
            url: "engine/get-products",
            type: "POST",
            data: {
                q: x,
                barber_style: barber_style,
                locationFilter: locationFilter,
                user_preference: user_preference,
                gender: gender,
                price_from: price_from,
                price_to: price_to,
                orderBy: orderBy,
                page: page
            },
            success: function(data) {
                $(".spinner-border").hide();
                $("#product-content").html(data).show();
            },
            error: function(xhr, status, error) {
                $(".spinner-border").hide();
                console.error("AJAX Error:", status, error);
                $("#product-content").html("<div class='alert alert-danger w-100'>An error occurred while loading the data. Please try again later.</div>");
            }
        });
    }

});
</script>

</body>
</html>
