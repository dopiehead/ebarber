<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and assign POST variables
    $user_name        = trim($_POST['user_name']);
    $user_email       = trim($_POST['user_email']);
    $user_password    = $_POST['user_password'];
    $user_type        = trim($_POST['user_type']);
    $user_image       = trim($_POST['user_image'] ?? "");
    $user_dob         = trim($_POST['user_dob'] ?? "");
    $user_bio         = trim($_POST['user_bio'] ?? "");
    $user_phone       = trim($_POST['user_phone'] ?? "");
    $user_location    = trim($_POST['user_location'] ?? "");
    $lga              = trim($_POST['lga'] ?? "");
    $user_address     = trim($_POST['user_address'] ?? "");
    $user_rating      = 0;
    $user_gender      = trim($_POST['user_gender'] ?? "");
    $user_likes       = 0;
    $user_shares      = 0;
    $user_fee         = isset($_POST['user_fee']) ? floatval($_POST['user_fee']) : 0.0;
    $user_preference  = trim($_POST['user_preference'] ?? "");
    $user_services    = trim($_POST['user_services'] ?? "");
    $verified         = 0;
    $payment_status   = 0;
    $vkey             = md5(time() . $user_email);
    $date_added       = date("Y-m-d H:i:s");

    // Validate required fields
    if (!empty($user_name) && !empty($user_email) && !empty($user_password) && !empty($user_type)) {

        if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(["status" => "error", "message" => "Invalid email format."]);
            exit;
        }

        if (strlen($user_password) < 8 || !preg_match('/[0-9]/', $user_password)) {
            echo json_encode(["status" => "error", "message" => "Password must be at least 8 characters and include a number."]);
            exit;
        }

        // Check if email exists
        $checkEmail = $conn->prepare("SELECT id FROM user_profile WHERE user_email = ?");
        $checkEmail->bind_param("s", $user_email);
        $checkEmail->execute();
        $checkEmail->store_result();

        if ($checkEmail->num_rows > 0) {
            echo json_encode(["status" => "error", "message" => "Email already exists."]);
        } else {
            $hashed_password = password_hash($user_password, PASSWORD_BCRYPT);

            $stmt = $conn->prepare("INSERT INTO user_profile (
                user_name, user_email, user_password, user_type, user_image, user_dob, user_bio, user_phone,
                user_location, lga, user_address, user_rating, user_gender, user_likes, user_shares, user_fee,
                user_preference, user_services, vkey, verified, payment_status, date_added
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            if (!$stmt) {
                die("SQL Error: " . $conn->error);
            }

            $stmt->bind_param("sssssssssssdsiiidsssiss",
                $user_name, $user_email, $hashed_password, $user_type, $user_image, $user_dob, $user_bio, $user_phone,
                $user_location, $lga, $user_address, $user_rating, $user_gender, $user_likes, $user_shares, $user_fee,
                $user_preference, $user_services, $vkey, $verified, $payment_status, $date_added
            );

            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Registration successful!"]);
            } else {
                error_log("Error executing query: " . $stmt->error);
                echo json_encode(["status" => "error", "message" => "Something went wrong."]);
            }

            $stmt->close();
        }

        $checkEmail->close();
    } else {
        echo json_encode(["status" => "error", "message" => "All required fields must be filled."]);
    }
}

$conn->close();
?>
