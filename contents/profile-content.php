
<?php

$id               = isset($user['id']) && !empty($user['id']) ? $user['id'] : "N/A";
$user_name        = isset($user['user_name']) && !empty($user['user_name']) ? $user['user_name'] : "N/A";
$user_email       = isset($user['user_email']) && !empty($user['user_email']) ? $user['user_email'] : "N/A";
$user_password    = isset($user['user_password']) && !empty($user['user_password']) ? $user['user_password'] : "N/A";
$user_type        = isset($user['user_type']) && !empty($user['user_type']) ? $user['user_type'] : "N/A";
$user_image       = isset($user['user_image']) && !empty($user['user_image']) ? $user['user_image'] : "https://placehold.co/600x400";
$user_dob         = isset($user['user_dob']) && !empty($user['user_dob']) ? $user['user_dob'] : "N/A";
$user_phone       = isset($user['user_phone']) && !empty($user['user_phone']) ? $user['user_phone'] : "N/A";
$user_bio         = isset($user['user_bio']) && !empty($user['user_bio']) ? $user['user_bio'] : "";
$user_location    = isset($user['user_location']) && !empty($user['user_location']) ? $user['user_location'] : "N/A";
$lga              = isset($user['lga']) && !empty($user['lga']) ? $user['lga'] : "N/A";
$age = "N/A";
if (!empty($user_dob)) {
    $dobDate = DateTime::createFromFormat('Y-m-d', $user_dob);
    if ($dobDate) {
        $age = $dobDate->diff(new DateTime('today'))->y;
    }
}
$user_address     = isset($user['user_address']) && !empty($user['user_address']) ? $user['user_address'] : "N/A";
$user_rating      = isset($user['user_rating']) && !empty($user['user_rating']) ? $user['user_rating'] : "N/A";
$user_gender      = isset($user['user_gender']) && !empty($user['user_gender']) ? $user['user_gender'] : "N/A";
$user_likes       = isset($user['user_likes']) && !empty($user['user_likes']) ? $user['user_likes'] : "N/A";
$user_shares      = isset($user['user_shares']) && !empty($user['user_shares']) ? $user['user_shares'] : "N/A";
$user_fee         = isset($user['user_fee']) && !empty($user['user_fee']) ? $user['user_fee'] : "N/A";
$user_preference  = isset($user['user_preference']) && !empty($user['user_preference']) ? $user['user_preference'] : "N/A";
$vkey             = isset($user['vkey']) && !empty($user['vkey']) ? $user['vkey'] : "N/A";
$verified         = isset($user['verified']) && $user['verified'] !== '' ? $user['verified'] : "N/A";
$payment_status    = isset($user['payment_status']) && $user['payment_status'] !== '' ? $user['payment_status'] : 0;
$date_added       = isset($user['date_added']) && !empty($user['date_added']) ? $user['date_added'] : "N/A";

?>
