<?php
// load_messages.php
require '../engine/config.php'; // your DB connection

session_start();
$sender = "niyialabi10@gmail.com"; // or use $_SESSION['email']

$user_name = isset($_GET['user_name']) ? $conn->real_escape_string($_GET['user_name']) : 'ngnimitech@gmail.com';

$query = $conn->query("SELECT * FROM messages WHERE
    is_sender_deleted = 0 AND 
    ((sender_email = '$sender' AND receiver_email = '$user_name') OR 
    (sender_email = '$user_name' AND receiver_email = '$sender'))
    ORDER BY date ASC");

while ($msg = $query->fetch_assoc()):
    $is_sender = $msg['sender_email'] === $sender;
    $status = $is_sender ? ($msg['has_read'] ? 'Seen' : 'Sent') : 'Received';
    $time = date('M j, Y h:i A', strtotime($msg['date']));
    $text = htmlspecialchars($msg['compose']);
    $class = $is_sender ? 'sender-box' : 'receiver-box';
    echo "<div class='$class'><p>$text</p><small>$status on $time</small></div>";
endwhile;
?>
