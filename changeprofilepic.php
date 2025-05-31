<?php
require('engine/config.php');

$id = $_POST['id'] ?? null;
$imageFolder = __DIR__ . '/profiles/';
$allowed_extensions = ['jpg', 'jpeg', 'png'];

// Check if ID is valid and numeric (or whatever your ID type is)
if (empty($id) || !ctype_digit($id)) {
    echo "Invalid user ID.";
    exit;
}

if (!isset($_FILES['fileupload']) || empty($_FILES['fileupload']['name'])) {
    echo "Choose Image file to upload!!!";
    exit;
}

$file = $_FILES['fileupload'];
$file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
$image_temp_name = $file['tmp_name'];

// Check file extension whitelist
if (!in_array($file_extension, $allowed_extensions)) {
    echo "Please upload valid Image in PNG or JPEG only!!!";
    exit;
}

// Check MIME type from file content
$mime = mime_content_type($image_temp_name);
if (!in_array($mime, ['image/jpeg', 'image/png'])) {
    echo "Invalid image format!";
    exit;
}

// Additional check: getimagesize to confirm image validity
$image_info = getimagesize($image_temp_name);
if ($image_info === false) {
    echo "Uploaded file is not a valid image!";
    exit;
}

// Enforce max file size limit (e.g., 2MB)
$maxFileSize = 2 * 1024 * 1024; // 2MB in bytes
if ($file['size'] > $maxFileSize) {
    echo "File size exceeds the 2MB limit.";
    exit;
}

// Generate a secure random filename, avoiding predictable names
$basename = bin2hex(random_bytes(16)) . '.' . $file_extension;
$target_path = $imageFolder . $basename;
$relative_path = 'profiles/' . $basename;

// Use a safer way to move file and double-check
if (!is_uploaded_file($image_temp_name)) {
    echo "Potential file upload attack detected!";
    exit;
}

if (move_uploaded_file($image_temp_name, $target_path)) {
    // Optionally, set restrictive permissions on uploaded file
    chmod($target_path, 0644);

    // Use prepared statements with proper parameter types (id likely int)
    $stmt = $conn->prepare("UPDATE user_profile SET user_image=? WHERE id=?");
    $stmt->bind_param("si", $relative_path, $id);

    if ($stmt->execute()) {
        echo "1";
    } else {
        echo "Database error: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
} else {
    echo "File upload failed!";
}
?>
