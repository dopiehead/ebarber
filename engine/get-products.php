<?php

$counter = "";
require("config.php");

$totalRecords = 0;
$from = 0;
$to = 0;

$gettotal = $conn->prepare("SELECT * FROM user_profile WHERE verified = 1 AND user_type = 'barber'");
if($gettotal->execute()){
    $resultTotal = $gettotal->get_result();
    $totalRecords =  $resultTotal->num_rows;
    $num_per_page = 20;
    $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
    $initial_page = ($page - 1) * $num_per_page;
    $from = $initial_page + 1;
    $to = min($initial_page + $num_per_page, $totalRecords);
}  

echo"
<div style='color:var(--primary-purple);' class='d-flex justify-content-between align-content-center'>
   <span class='fw-bold text-danger'>Total number of record: ". $totalRecords."</span>
    <p> ".$from." - ".$to." of <span class='fw-bold'>".$totalRecords."</span></p>
</div>";

// Build base query
$baseQuery = "SELECT * FROM user_profile WHERE verified = 1 AND user_type = 'barber'";

// Handle search query
if (isset($_POST['q']) && !empty($_POST['q'])) {
    $search = explode(" ", $conn->real_escape_string($_POST['q']));
    foreach ($search as $text) {
        $escaped = $conn->real_escape_string($text);
        $baseQuery .= " AND (
            `user_name` LIKE '%$escaped%' OR
            `user_type` LIKE '%$escaped%' OR
            `user_image` LIKE '%$escaped%' OR
            `user_dob` LIKE '%$escaped%' OR
            `user_phone` LIKE '%$escaped%' OR
            `user_bio` LIKE '%$escaped%' OR
            `user_location` LIKE '%$escaped%' OR
            `lga` LIKE '%$escaped%' OR
            `user_address` LIKE '%$escaped%' OR
            `user_rating` LIKE '%$escaped%' OR
            `user_gender` LIKE '%$escaped%' OR
            `user_likes` LIKE '%$escaped%' OR
            `user_shares` LIKE '%$escaped%' OR
            `user_fee` LIKE '%$escaped%' OR
            `user_preference` LIKE '%$escaped%'
        )";       
    }
}

// Location filter
$locationFilter = isset($_POST['locationFilter']) && !empty($_POST['locationFilter']) ? $conn->real_escape_string($_POST['locationFilter']) : "";
if ($locationFilter) {
     $baseQuery .= " AND user_location LIKE '%".$locationFilter."%'";
}

// Preference filter
$preferenceFilter = !empty($_POST['user_preference']) ? $conn->real_escape_string($_POST['user_preference']) : "";
if ($preferenceFilter) {
    $baseQuery .= " AND user_preference LIKE '%$preferenceFilter%'";
}

// Gender filter
$gender_filter = isset($_POST['gender']) ? explode(',', $_POST['gender']) : [];
if (!empty($gender_filter)) {
    $escaped_genders = array_map(function($g) use ($conn) {
        return "'" . $conn->real_escape_string(trim($g)) . "'";
    }, $gender_filter);
    $baseQuery .= " AND user_gender IN (" . implode(',', $escaped_genders) . ")";
}

// Price filter
$priceFrom = isset($_POST['price_from']) && is_numeric($_POST['price_from']) ? (int)$_POST['price_from'] : null;
$priceTo   = isset($_POST['price_to']) && is_numeric($_POST['price_to']) ? (int)$_POST['price_to'] : null;

if ($priceFrom !== null && $priceTo !== null) {
    $baseQuery .= " AND user_fee BETWEEN $priceFrom AND $priceTo";
} elseif ($priceFrom !== null) {
    $baseQuery .= " AND user_fee >= $priceFrom";
} elseif ($priceTo !== null) {
    $baseQuery .= " AND user_fee <= $priceTo";
}

// Order By handling
$orderBy = $_POST['orderBy'] ?? 'date_added_DESC';
switch ($orderBy) {
    case 'date_added_DESC': $baseQuery .= " ORDER BY date_added DESC"; break;
    case 'date_added_ASC': $baseQuery .= " ORDER BY date_added ASC"; break;
    case 'user_name_ASC': $baseQuery .= " ORDER BY user_name ASC"; break;
    case 'user_name_DESC': $baseQuery .= " ORDER BY user_name DESC"; break;
    case 'age_ASC': $baseQuery .= " ORDER BY user_dob ASC"; break;
    case 'age_DESC': $baseQuery .= " ORDER BY user_dob DESC"; break;
    case 'user_rating_DESC': $baseQuery .= " ORDER BY user_rating DESC"; break;
    case 'user_rating_ASC': $baseQuery .= " ORDER BY user_rating ASC"; break;
    case 'user_fee_ASC': $baseQuery .= " ORDER BY user_fee ASC"; break;
    case 'user_fee_DESC': $baseQuery .= " ORDER BY user_fee DESC"; break;
    default: $baseQuery .= " ORDER BY date_added DESC"; break;
}

// Pagination
$finalQuery = $baseQuery . " LIMIT $initial_page, $num_per_page";
$counter = $initial_page + 1;

// Execute query
$getlist = $conn->prepare($finalQuery);
if ($getlist->execute()) :
    $result = $getlist->get_result(); 
    echo"<div class='card-grid'>";
    while($user = $result->fetch_assoc()): 
        include("../contents/profile-content.php");
?>

    <div class="card">
        <div class="purple-highlight"></div>
        <div class="card-image">
            <a href="barber-details?id=<?= htmlspecialchars($id) ?>">
                <img src="<?= htmlspecialchars($user_image) ?>" alt="<?= htmlspecialchars($user_name) ?>">
            </a>
        </div>
        <div class="card-details">
            <div class="card-info"><span class="name">Name:</span> 
                <a href="barber-details?id=<?= htmlspecialchars($id) ?>" class="text-white"><?= htmlspecialchars($user_name) ?></a>
            </div>
            <div class="card-info"><span class="name">Age:</span> <?= htmlspecialchars($age) ?></div>
            <div class="card-info"><span class="name">Gender:</span> <?= htmlspecialchars($user_gender) ?></div>
            <div class="card-info"><span class="name">Location:</span> <?= htmlspecialchars($user_location) ?></div>
            <div class="distance">34km away from pickup</div>
        </div>
        <div class="card-stats">
            <div class="stat"><span><?= htmlspecialchars($user_likes) ?> Likes</span></div>
            <div class="share-button"><span><?= htmlspecialchars($user_shares) ?> Shares</span></div>
        </div>
    </div>


<?php 
    endwhile;
else:
    echo '<p>No barbers found.</p>';
endif;
?>
</div>
<?php
// Pagination display
$total_num_page = ceil($totalRecords / $num_per_page);
$radius = 2;
echo "<div class='text-center mt-3'>";
if ($page > 1) {
     $previous = $page - 1;
     echo '<span id="page_num"><a class="btn btn-pagination btn-success mx-1 prev" id="' . $previous . '">&lt;</a></span>';
}

for ($i = 1; $i <= $total_num_page; $i++) {
    if (($i >= 1 && $i <= $radius) || ($i > $page - $radius && $i < $page + $radius) || ($i <= $total_num_page && $i > $total_num_page - $radius)) {
        if ($i == $page) {
            echo '<a class="btn btn-pagination btn-success active-button mx-1" id="' . $i . '">' . $i . '</a>';
        } else {
            echo '<a class="btn btn-pagination btn-outline-success mx-1" id="' . $i . '">' . $i . '</a>';
        }
    } elseif ($i == $page - $radius || $i == $page + $radius) {
        echo "... ";
    }
}

if ($page < $total_num_page) {
    $next = $page + 1;
    echo '<span id="page_num"><a class="btn btn-pagination btn-success mx-1 next" id="' . $next . '">&gt;</a></span>';
}
echo "</div>";
?>
<?php
function encryptId($id) {
    $secret = 73829; // A secret multiplier (prime number is a good choice)
    $offset = 123456789; // Optional additive offset
    return ($id * $secret) + $offset;
}

function decryptId($encrypted) {
    $secret = 73829;
    $offset = 123456789;
    return (int)(($encrypted - $offset) / $secret);
}
?>


