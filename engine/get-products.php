<?php 
require("config.php");

header('Content-Type: application/json');

$response = [
    'totalRecords' => 0,
    'from' => 0,
    'to' => 0,
    'page' => 1,
    'totalPages' => 0,
    'barbers' => [],
    'pagination' => []
];

$num_per_page = 20;
$page = isset($_POST['page']) && is_numeric($_POST['page']) && $_POST['page'] > 0 ? (int)$_POST['page'] : 1;
$initial_page = ($page - 1) * $num_per_page;

// Get total count
$gettotal = $conn->prepare("SELECT COUNT(*) as total FROM user_profile WHERE verified = 1 AND user_type = 'barber'");
$gettotal->execute();
$gettotal->bind_result($totalRecords);
$gettotal->fetch();
$gettotal->close();

$response['totalRecords'] = $totalRecords;
$response['from'] = $initial_page + 1;
$response['to'] = min($initial_page + $num_per_page, $totalRecords);
$response['page'] = $page;
$response['totalPages'] = ceil($totalRecords / $num_per_page);

// Build main query
$baseQuery = "SELECT id, user_name, user_email, user_type, user_image, user_dob, user_phone, user_bio, user_location, lga, user_address, user_rating, user_gender, user_likes, user_shares, user_fee, user_preference, vkey, verified, payment_status, date_added FROM user_profile WHERE verified = 1 AND user_type = 'barber' ";

if (!empty($_POST['q'])) {
    $search = explode(" ", $_POST['q']);
    foreach ($search as $text) {
        $text = $conn->real_escape_string($text);
        $baseQuery .= " AND (
            `user_name` LIKE '%$text%' OR
            `user_type` LIKE '%$text%' OR
            `user_image` LIKE '%$text%' OR
            `user_dob` LIKE '%$text%' OR
            `user_phone` LIKE '%$text%' OR
            `user_bio` LIKE '%$text%' OR
            `user_location` LIKE '%$text%' OR
            `lga` LIKE '%$text%' OR
            `user_address` LIKE '%$text%' OR
            `user_rating` LIKE '%$text%' OR
            `user_gender` LIKE '%$text%' OR
            `user_likes` LIKE '%$text%' OR
            `user_shares` LIKE '%$text%' OR
            `user_fee` LIKE '%$text%' OR
            `user_preference` LIKE '%$text%'
        )";
    }
}

$locationFilter = !empty($_POST['locationFilter']) ? $conn->real_escape_string($_POST['locationFilter']) : "";
if ($locationFilter) {
    $baseQuery .= " AND user_location LIKE '%$locationFilter%'";
}

$preferenceFilter = !empty($_POST['user_preference']) ? $conn->real_escape_string($_POST['user_preference']) : "";
if ($preferenceFilter) {
    $baseQuery .= " AND user_preference LIKE '%$preferenceFilter%'";
}

$priceFrom = isset($_POST['price_from']) && is_numeric($_POST['price_from']) ? (int)$_POST['price_from'] : null;
$priceTo   = isset($_POST['price_to']) && is_numeric($_POST['price_to']) ? (int)$_POST['price_to'] : null;

if ($priceFrom !== null && $priceTo !== null) {
    $baseQuery .= " AND user_fee BETWEEN $priceFrom AND $priceTo";
} elseif ($priceFrom !== null) {
    $baseQuery .= " AND user_fee >= $priceFrom";
} elseif ($priceTo !== null) {
    $baseQuery .= " AND user_fee <= $priceTo";
}

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
$getuser = $conn->query($finalQuery);

if ($getuser && $getuser->num_rows > 0) {
    while ($user = $getuser->fetch_assoc()) {
        $user_dob = $user['user_dob'];
        $age = "N/A";
        if (!empty($user_dob)) {
            $dobDate = DateTime::createFromFormat('Y-m-d', $user_dob);
            if ($dobDate) {
                $age = $dobDate->diff(new DateTime())->y;
            }
        }

        $response['barbers'][] = [
            'id' => (int)$user['id'],
            'user_name' => $user['user_name'],
            'user_image' => !empty($user['user_image']) ? $user['user_image'] : "https://placehold.co/600x400",
            'user_gender' => $user['user_gender'],
            'user_location' => trim($user['lga'] . ", " . $user['user_location']),
            'user_likes' => (int)$user['user_likes'],
            'user_shares' => (int)$user['user_shares'],
            'age' => $age
        ];
    }
}

echo json_encode($response);
