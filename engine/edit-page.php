<?php
session_start();
require 'config.php'; // Assumes $conn (not $con) is the MySQLi connection

header('Content-Type: application/json'); // For AJAX compatibility

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !ctype_digit((string)$_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access.']);
    exit;
}

$user_id = (int)$_SESSION['user_id'];
$user_role = $_SESSION['user_role'] ?? ''; // Fallback for role

// Helper function to sanitize and validate input
function sanitize($input, $conn) {
    return mysqli_real_escape_string($conn, trim($input));
}

// Collect and sanitize input
$user_name = sanitize($_POST['user_name'] ?? '', $conn);
$user_email = sanitize($_POST['user_email'] ?? '', $conn);
$user_password = sanitize($_POST['user_password'] ?? '', $conn);
$user_dob = sanitize($_POST['user_dob'] ?? '', $conn);
$user_bio = sanitize($_POST['user_bio'] ?? '', $conn);
$user_phone = sanitize($_POST['user_phone'] ?? '', $conn);
$user_location = sanitize($_POST['user_location'] ?? '', $conn);
$lga = sanitize($_POST['lga'] ?? '', $conn);
$user_address = sanitize($_POST['user_address'] ?? '', $conn);
$user_gender = sanitize($_POST['user_gender'] ?? '', $conn);
$user_fee = sanitize($_POST['user_fee'] ?? '', $conn);
$user_preference = sanitize($_POST['user_preference'] ?? '', $conn);
$user_services = sanitize($_POST['user_services'] ?? '', $conn);

// Validate required fields
$required_fields = ['user_name', 'user_email'];
foreach ($required_fields as $field) {
    if (empty($$field)) {
        echo json_encode(['status' => 'error', 'message' => ucfirst(str_replace('_', ' ', $field)) . ' is required.']);
        exit;
    }
}

// Validate email format
if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid email format.']);
    exit;
}

// Validate role-specific fields
if ($user_role === 'barber' && empty($user_fee)) {
    echo json_encode(['status' => 'error', 'message' => 'Fee is required for barbers.']);
    exit;
}

// Handle password hash only if provided
$pass_sql = '';
$params = [
    $user_name,
    $user_email,
    $user_dob,
    $user_bio,
    $user_phone,
    $user_location,
    $lga,
    $user_address,
    $user_gender,
    $user_fee,
    $user_preference,
    $user_services,
    $user_id
];
$types = 'ssssssssssssi';

if (!empty($user_password)) {
    $hashed_password = password_hash($user_password, PASSWORD_BCRYPT);
    $pass_sql = ', user_password = ?';
    $params[] = $hashed_password;
    $types .= 's';
}

// Prepare SQL
$sql = "
    UPDATE user_profile SET
        user_name = ?,
        user_email = ?,
        user_dob = ?,
        user_bio = ?,
        user_phone = ?,
        user_location = ?,
        lga = ?,
        user_address = ?,
        user_gender = ?,
        user_fee = ?,
        user_preference = ?,
        user_services = ?
        $pass_sql
    WHERE id = ?
";

// Create prepared statement
$stmt = $conn->prepare($sql);
if (!$stmt) {
    error_log('Prepare failed: ' . $conn->error);
    echo json_encode(['status' => 'error', 'message' => 'Database query failed.']);
    exit;
}

// Bind parameters dynamically
$stmt->bind_param($types, ...$params);

// Execute
if ($stmt->execute()) {
    // Update session variables
    $_SESSION['user_name'] = $user_name;
    $_SESSION['user_email'] = $user_email;
    $_SESSION['user_phone'] = $user_phone;
    echo json_encode(['status' => 'success', 'message' => 'Details updated successfully.']);
} else {
    error_log('Execute failed: ' . $stmt->error);
    echo json_encode(['status' => 'error', 'message' => 'Error updating details: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>