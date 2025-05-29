<?php
session_start();
// Clear all session variables
$_SESSION = [];
// Destroy the session
session_destroy();
// Optional: Ensure headers are not already sent
if (!headers_sent()) {
    header("Location: ../sign-in.php");
    exit;
} else {
    echo "<script>window.location.href='../sign-in.php';</script>";
    exit;
}
?>