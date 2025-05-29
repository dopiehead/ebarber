<?php
function time_ago($date_string) {
    $comment_time = DateTime::createFromFormat("D, F d, Y g:ia", strtolower($date_string));
    $now = new DateTime();

    if (!$comment_time) {
        return "Invalid date";
    }

    $diff = $now->getTimestamp() - $comment_time->getTimestamp();

    if ($diff < 60) {
        return "just now";
    } elseif ($diff < 3600) {
        $minutes = floor($diff / 60);
        return $minutes . " minute" . ($minutes > 1 ? "s" : "") . " ago";
    } elseif ($diff < 86400) {
        $hours = floor($diff / 3600);
        return $hours . " hour" . ($hours > 1 ? "s" : "") . " ago";
    } elseif ($diff < 604800) {
        $days = floor($diff / 86400);
        return $days . " day" . ($days > 1 ? "s" : "") . " ago";
    } elseif ($diff < 2592000) { // approx 30 days
        $weeks = floor($diff / 604800);
        return $weeks . " week" . ($weeks > 1 ? "s" : "") . " ago";
    } elseif ($diff < 31536000) { // approx 365 days
        $months = floor($diff / 2592000);
        return $months . " month" . ($months > 1 ? "s" : "") . " ago";
    } else {
        $years = floor($diff / 31536000);
        return $years . " year" . ($years > 1 ? "s" : "") . " ago";
    }
}

?>
