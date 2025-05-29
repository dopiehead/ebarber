<?php

require 'config.php';

// Get and sanitize inputs
$sender_email = $_POST['sender_email'];
$sender_name = $_POST['sender_name'];
$comment = $_POST['comment'];
$barber_id = $_POST['barber_id'];
$date = date("D, F d, Y g:iA", strtotime('+1 hours'));

// Basic validation
if (empty($comment . $sender_name . $sender_email)) {
    echo "All fields are required";
} elseif (empty($comment)) {
    echo "Comment field is required";
} elseif (empty($sender_name)) {
    echo "Name field is required";
} elseif (empty($sender_email)) {
    echo "Email field is required";
} else {
    // Check for duplicate/spam comment
    $check_stmt = $conn->prepare("SELECT * FROM barber_comment WHERE sender_email = ? AND sender_name = ? AND sp_id = ? AND comment = ?");
    $check_stmt->bind_param("ssis", $sender_email, $sender_name, $id, $comment);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows >= 1) {
        echo "SPAM";
    } else {
        // Insert comment
        $insert_stmt = $conn->prepare("INSERT INTO barber_comment (sender_email, sender_name, comment, sp_id, barber_id, comment_date) VALUES (?, ?, ?, ?, ?, ?)");
        $insert_stmt->bind_param("sssiss", $sender_email, $sender_name, $comment, $id, $barber_id, $date);
        
        if ($insert_stmt->execute()) {
            echo "1"; // Success
        } else {
            echo "Error in adding comment";
        }
        $insert_stmt->close();
    }
    $check_stmt->close();
}

$conn->close();
?>
