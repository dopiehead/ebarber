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
    <form method="POST" action="">
        <!-- Row 1: Search, People, Style -->
        <div class="form-row  flex-md-row flex-column">
            <!-- Search Input -->
            <div class="form-field">
                <label class="form-label">Search for barber</label>
                <input type="search" name="q" id="q" class="w-100 border-secondary">
            </div>

            <!-- People Count -->
            <div class="form-field">
                <label class="form-label">How many people are barbing</label>
                <select class="dropdown" name="people_count">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endfor; ?>
                </select>
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
    </form>
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
            <div class="filter-row"><span>Male</span><span>10</span></div>
            <div class="filter-row"><span>Female</span><span>10</span></div>
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
        <div id="product-content"></div>
    </div>
  
</div>

<div id="pagination" class="text-center mt-3"></div>


<br><br>
<!-- Contact Section -->
<?php include("components/contact.php"); ?>

<!-- Product Load Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    function loadBarbers(filters = {}) {
        $.ajax({
            url: 'engine/get-products.php', // Replace with your PHP file path
            type: 'POST',
            data: filters,
            dataType: 'json',
            beforeSend: function () {
                $('#product-content').html('<p>Loading...</p>');
            },
            success: function (response) {
                let html = `<div class='card-grid'>`;
                if (response.barbers.length > 0) {
                    $.each(response.barbers, function (i, barber) {
                        html += `
                       
                        <div class="card">
                            <div class="purple-highlight"></div>
                            <div class="card-image">
                                <a href="barber-details?id=${barber.id}">
                                    <img src="${barber.user_image}" alt="${barber.user_name}">
                                </a>
                            </div>
                            <div class="card-details">
                                <div class="card-info"><span class="name">Name:</span> 
                                    <a href="barber-details?id=${barber.id}" class="text-white">${barber.user_name}</a>
                                </div>
                                <div class="card-info"><span class="name">Age:</span> ${barber.age}</div>
                                <div class="card-info"><span class="name">Gender:</span> ${barber.user_gender}</div>
                                <div class="card-info"><span class="name">Location:</span> ${barber.user_location}</div>
                                <div class="distance">34km away from pickup</div>
                            </div>
                            <div class="card-stats">
                                <div class="stat"><span>${barber.user_likes} Likes</span></div>
                                <div class="share-button"><span>${barber.user_shares} Shares</span></div>
                            </div>
                        </div>`;
                    });
                } else {
                    html = '<p>No barbers found.</p>';
                }

                $('#product-content').html(html);
                renderPagination(response.page, response.totalPages);
            },
            error: function () {
                $('#product-content').html('<p>Error loading data.</p>');
            }
        });
    }

    function renderPagination(current, total) {
        let paginationHTML = '';
        let radius = 2;

        if (current > 1) {
            paginationHTML += `<a  class="page-link" data-page="${current - 1}">&lt;</a>`;
        }

        for (let i = 1; i <= total; i++) {
            if (i === current) {
                paginationHTML += `<a  class="page-link active" data-page="${i}">${i}</a>`;
            } else if (i <= radius || i > total - radius || (i >= current - radius && i <= current + radius)) {
                paginationHTML += `<a  class="page-link" data-page="${i}">${i}</a>`;
            } else if (i === current - radius || i === current + radius) {
                paginationHTML += `<span>...</span>`;
            }
        }

        if (current < total) {
            paginationHTML += `<a  class="page-link" data-page="${current + 1}">&gt;</a>`;
        }

        $('#pagination').html(paginationHTML);
    }

    // Initial load
    loadBarbers();

    // Pagination click
    $(document).on('click', '.page-link', function (e) {
        e.preventDefault();
        const page = $(this).data('page');
        const filters = getFilters();
        filters.page = page;
        loadBarbers(filters);
    });

    // Search/filter form handler
    $('#filterForm').on('submit', function (e) {
        e.preventDefault();
        const filters = getFilters();
        loadBarbers(filters);
    });

    function getFilters() {
        return {
            q: $('#q').val(),
            locationFilter: $('#locationFilter').val(),
            user_preference: $('#preferenceFilter').val(),
            price_from: $('#priceFrom').val(),
            price_to: $('#priceTo').val(),
            orderBy: $('#orderBy').val()
        };
    }
});
</script>
</body>
</html>
