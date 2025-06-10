<?php
session_start();
$user_id = $_SESSION['user_id'] ?? null;
$counter = "";
require("config.php");

if ($user_id !== null) {
    $buyer_location = $conn->prepare("SELECT * FROM user_profile WHERE id = ?  AND verified = 1 AND user_type = 'barber'");
    $buyer_location->bind_param('i', $user_id);
    if ($buyer_location->execute()) {
        $buyer_result = $buyer_location->get_result();
        while ($buyer_data = $buyer_result->fetch_assoc()) {
            $buyerLocation = trim($buyer_data['user_address'] . ", " . $buyer_data['user_location']) ?? "";
            
        }
    }
}

$totalRecords = 0;
$from = 0;
$to = 0;


if (isset($_SESSION['user_id'])):
    $gettotal = $conn->prepare("SELECT COUNT(*) FROM user_profile WHERE verified = 1 AND user_type = 'barber' AND id != ?");
    $gettotal->bind_param("i", $_SESSION['user_id']);
else:
    $gettotal = $conn->prepare("SELECT COUNT(*) FROM user_profile WHERE verified = 1 AND user_type = 'barber'");
endif;

if ($gettotal->execute()) {
    $gettotal->bind_result($totalRecords);
    $gettotal->fetch();
    $gettotal->close();

    $num_per_page = 20;
    $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
    $initial_page = ($page - 1) * $num_per_page;
    $from = $initial_page + 1;
    $to = min($initial_page + $num_per_page, $totalRecords);
}

echo "
<div style='color:var(--primary-purple);' class='d-flex justify-content-between align-content-center'>
   <span class='fw-bold text-danger'>Total number of record: " . $totalRecords . "</span>
    <p> " . $from . " - " . $to . " of <span class='fw-bold'>" . $totalRecords . "</span></p>
</div>";


$baseQuery = "SELECT * FROM user_profile WHERE verified = 1 AND user_type = 'barber'";

if (!empty($_POST['q'])) {
    $search = explode(" ", $conn->real_escape_string($_POST['q']));
    foreach ($search as $text) {
        $escaped = $conn->real_escape_string($text);
        $baseQuery .= " AND (user_name LIKE '%$escaped%' OR user_type LIKE '%$escaped%' OR user_image LIKE '%$escaped%' OR user_dob LIKE '%$escaped%' OR user_phone LIKE '%$escaped%' OR user_bio LIKE '%$escaped%' OR user_location LIKE '%$escaped%' OR lga LIKE '%$escaped%' OR user_address LIKE '%$escaped%' OR user_rating LIKE '%$escaped%' OR user_gender LIKE '%$escaped%' OR user_likes LIKE '%$escaped%' OR user_shares LIKE '%$escaped%' OR user_fee LIKE '%$escaped%' OR user_preference LIKE '%$escaped%')";
    }
}

if (!empty($_POST['barber_style'])) {
    $barber_style = $conn->real_escape_string($_POST['barber_style']);
    $baseQuery .= " AND user_services LIKE '%$barber_style%'";
}

if (!empty($_POST['locationFilter'])) {
    $locationFilter = $conn->real_escape_string($_POST['locationFilter']);
    $baseQuery .= " AND user_location LIKE '%$locationFilter%'";
}

if (!empty($_POST['user_preference'])) {
    $preferenceFilter = $conn->real_escape_string($_POST['user_preference']);
    $baseQuery .= " AND user_preference LIKE '%$preferenceFilter%'";
}

$gender_filter = isset($_POST['gender']) ? explode(',', $_POST['gender']) : [];

if ($gender_filter) {
    foreach($gender_filter as $g){
    $baseQuery .= " AND user_gender like '%".$g."%'";
    
    }
}

$priceFrom = isset($_POST['price_from']) ? (int)$_POST['price_from'] : null;
$priceTo = isset($_POST['price_to']) ? (int)$_POST['price_to'] : null;

if ($priceFrom !== null && $priceTo !== null) {
    $baseQuery .= " AND user_fee BETWEEN $priceFrom AND $priceTo";
} elseif ($priceFrom !== null) {
    $baseQuery .= " AND user_fee >= $priceFrom";
} elseif ($priceTo !== null) {
    $baseQuery .= " AND user_fee <= $priceTo";
}

if(isset($_SESSION['user_id'])):
    $baseQuery .= " AND id != '".$_SESSION['user_id']."'";
endif;

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
$finalQuery = $baseQuery . " LIMIT $initial_page, $num_per_page";
$counter = $initial_page + 1;

$getlist = $conn->prepare($finalQuery);
if ($getlist->execute()):
    $result = $getlist->get_result();
?>
    <div class='card-grid'>
<?php
    while ($user = $result->fetch_assoc()):
        // Assigning required variables
       include("../contents/profile-content.php");
        // Calculate age
        $age = date_diff(date_create($user_dob), date_create('today'))->y;
        // Google API Distance
        $apiKey = 'AIzaSyCL0LtlReopBM22H3uumKSLK2a5KukPduA';
        $origin = $user_full_address;
        $destination = $buyerLocation ?? "";
        $distance = $duration = 0;
        if (!empty($origin) && !empty($destination)) {
            $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . urlencode($origin) . "&destinations=" . urlencode($destination) . "&mode=driving&units=metric&language=en-US&key=" . $apiKey;
            $response = json_decode(file_get_contents($url), true);
            if ($response && $response['status'] == 'OK') {
                $element = $response['rows'][0]['elements'][0] ?? null;
                if ($element && $element['status'] === 'OK') {
                    $distance = $element['distance']['value']; // in meters
                                 $duration = $element['duration']['value']; // in seconds
                }
            }
        }
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
            <div class="distance"><?= htmlspecialchars(round($distance / 1000, 2)) ?>km away from pickup</div>
        </div>
        <div class="card-stats">
            <div class="stat"><span><?= htmlspecialchars($user_likes) ?> Likes</span></div>
            <div class="share-button"><span><?= htmlspecialchars($user_shares) ?> Shares</span></div>
        </div>
    </div>
<?php
    endwhile;
?>
</div>
<?php else:
    echo '<p>No barbers found.</p>';
endif;

$total_num_page = ceil($totalRecords / $num_per_page);
$radius = 2;
echo "<div class='text-center mt-3'>";
if ($page > 1) {
    $previous = $page - 1;
    echo '<span id="page_num"><a class="btn btn-pagination btn-success mx-1 prev" id="' . $previous . '">&lt;</a></span>';
}
for ($i = 1; $i <= $total_num_page; $i++) {
    if (($i <= $radius) || ($i > $page - $radius && $i < $page + $radius) || ($i > $total_num_page - $radius)) {
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