<?php
header('Content-Type: application/json');
require 'config.php';

$response = [];

// Sanitize input
$sender_email = mysqli_real_escape_string($conn, $_POST['sentby'] ?? '');
$name = mysqli_real_escape_string($conn, $_POST['name'] ?? '');
$subject = mysqli_real_escape_string($conn, $_POST['subject'] ?? 'barber');
$compose = mysqli_real_escape_string($conn, $_POST['message'] ?? '');
$receiver_email = mysqli_real_escape_string($conn, $_POST['sentto'] ?? '');
$has_read = 0;
$is_sender_deleted = 0;
$is_receiver_deleted = 0;

// Validate required fields
if (empty($compose)) {
    $response = ['status' => 'error', 'message' => 'Message field is required'];
} elseif (empty($subject)) {
    $response = ['status' => 'error', 'message' => 'Subject field is required'];
} else {
    // SQL insert
    $insert_query = "INSERT INTO messages 
        (sender_email, name, subject, compose, receiver_email, has_read, is_sender_deleted, is_receiver_deleted, date)
        VALUES (
            '" . htmlspecialchars($sender_email) . "',
            '" . htmlspecialchars($name) . "',
            '" . htmlspecialchars($subject) . "',
            '" . htmlspecialchars($compose) . "',
            '" . htmlspecialchars($receiver_email) . "',
            '$has_read',
            '$is_sender_deleted',
            '$is_receiver_deleted',
            NOW()
        )";

    $result = mysqli_query($conn, $insert_query);

    if ($result) {
        $response = ['status' => 'success', 'message' => 'Message sent and email delivered'];
        // require '../PHPMailer-master/PHPMailer-master/PHPMailerAutoload.php';
        // include("../components/mailer-info.php");

        // // Email setup
        // $mail->isHTML(true);
        // $mail->Subject = $subject;
        // $mail->MsgHTML("
        //     <html>
        //     <body>
        //         <div style='text-align:center;'>
        //             <img src='https://estores.ng/assets/icons/logo_e_stores.png' alt='Logo' height='50' width='50'>
        //         </div>
        //         <p>You have a message from <strong>{$name}</strong> regarding <strong>{$subject}</strong>.</p>
        //         <p>{$compose}</p>
        //         <p><a href='https://estores.ng/chat.php?user_name={$sender_email}'>Login to view message</a></p>
        //     </body>
        //     </html>
        // ");

        // if (!$mail->send()) {
        //     $response = ['status' => 'error', 'message' => 'Email sending failed: ' . $mail->ErrorInfo];
        // } else {
        //     $response = ['status' => 'success', 'message' => 'Message sent and email delivered'];
        // }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Database insert failed',
            'sql_error' => mysqli_error($conn) // Remove in production
        ];
    }
}

echo json_encode($response);
exit;
?>
