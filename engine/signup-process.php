<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("config.php");
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
// require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and assign POST variables
    $user_name        = trim($_POST['user_name'] ?? '');
    $user_email       = trim($_POST['user_email'] ?? '');
    $user_password    = $_POST['user_password'] ?? '';
    $user_type        = trim($_POST['user_type'] ?? '');
    $user_image       = trim($_POST['user_image'] ?? '');
    $user_dob         = trim($_POST['user_dob'] ?? '');
    $user_bio         = trim($_POST['user_bio'] ?? '');
    $user_phone       = trim($_POST['user_phone'] ?? '');
    $user_location    = trim($_POST['user_location'] ?? '');
    $lga              = trim($_POST['lga'] ?? '');
    $user_address     = trim($_POST['user_address'] ?? '');
    $user_gender      = trim($_POST['user_gender'] ?? '');
    $user_fee         = isset($_POST['user_fee']) ? floatval($_POST['user_fee']) : 0.0;
    $user_preference  = trim($_POST['user_preference'] ?? '');
    $user_services    = trim($_POST['user_services'] ?? '');
    $vkey             = md5(time() . $user_email);
    $verified         = 0; // Default not verified
    $payment_status   = 0; // Default unpaid
    $date_added       = date("Y-m-d H:i:s");

    // Validate required fields
    if (empty($user_name) || empty($user_email) || empty($user_password) || empty($user_type)) {
        echo json_encode(["status" => "error", "message" => "Required fields are missing."]);
        exit;
    }

    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Invalid email address."]);
        exit;
    }

    if (!preg_match('/^(?:\+234|0)[789][01]\d{8}$/', $user_phone)) {
        echo json_encode(["status" => "error", "message" => "Invalid Nigerian phone number."]);
        exit;
    }

    if (strlen($user_password) < 8 || !preg_match('/\d/', $user_password)) {
        echo json_encode(["status" => "error", "message" => "Password must be at least 8 characters and include at least one number."]);
        exit;
    }

    // Check if email already exists
    $checkEmail = $conn->prepare("SELECT id FROM user_profile WHERE user_email = ?");
    if (!$checkEmail) {
        echo json_encode(["status" => "error", "message" => "Database error: " . $conn->error]);
        exit;
    }
    $checkEmail->bind_param("s", $user_email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "Email already exists."]);
        $checkEmail->close();
        exit;
    }
    $checkEmail->close();

    // Hash password
    $hashed_password = password_hash($user_password, PASSWORD_BCRYPT);

    // Prepare insert statement
    $stmt = $conn->prepare("INSERT INTO user_profile (
        user_name, user_email, user_password, user_type, user_image, user_dob, user_bio, user_phone,
        user_location, lga, user_address, user_gender, user_fee, user_preference, user_services, vkey,
        verified, payment_status, date_added
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "SQL error: " . $conn->error]);
        exit;
    }

    $stmt->bind_param(
        "ssssssssssssssssssi",
        $user_name, $user_email, $hashed_password, $user_type, $user_image, $user_dob, $user_bio, $user_phone,
        $user_location, $lga, $user_address, $user_gender, $user_fee, $user_preference, $user_services, $vkey,
        $verified, $payment_status, $date_added
    );

    if ($stmt->execute()) {
        // Optional: send verification email here and handle errors as needed
        /*
        if (!sendVerificationEmail($user_email, $vkey)) {
            echo json_encode(["status" => "error", "message" => "Failed to send verification email."]);
            exit;
        }
        */

        echo json_encode(["status" => "success", "message" => "Registration successful! Kindly check your email to verify your account."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error executing query: " . $stmt->error]);
    }

    $stmt->close();
}

$conn->close();


// function sendVerificationEmail($email, $vkey) {
//     $mail = new PHPMailer(true);
//     try {
//         //Server settings
//         $mail->isSMTP();
//         $mail->Host       = 'smtp.example.com'; // Set the SMTP server to send through
//         $mail->SMTPAuth   = true;
//         $mail->Username   = 'your_email@example.com'; // SMTP username
//         $mail->Password   = 'your_password'; // SMTP password
//         $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//         $mail->Port       = 587;

//         //Recipients
//         $mail->setFrom('from_email@example.com', 'Your Website');
//         $mail->addAddress($email);

//         // Content
//         $mail->isHTML(true);
//         $mail->Subject = 'Email Verification';
//         $mail->Body    = "Please verify your email by clicking the link: <a href='https://yourdomain.com/verify.php?vkey=$vkey'>Verify Account</a>";

//         $mail->send();
//         return true;
//     } catch (Exception $e) {
//         return false;
//     }
// }

?>