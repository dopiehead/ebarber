<?php session_start(); ?>
<div class="header d-flex justify-content-between align-items-center px-3 py-2 bg-white shadow-sm">
    <h1 class="header-title h5 mb-0">Customer Overview</h1>

    <div class="header-right d-flex align-items-center gap-3">
        <?php 
        require("../engine/config.php");
        $numNotifications = 0;

        if (isset($_SESSION['user_id'])) {
            $getnotification = $conn->prepare("SELECT * FROM user_notifications WHERE recipient_id = ? AND pending = 0");
            if ($getnotification) {
                $getnotification->bind_param("i", $_SESSION['user_id']);
                if ($getnotification->execute()) {
                    $notificationResult = $getnotification->get_result();
                    $numNotifications = $notificationResult->num_rows;
                }
            }
        }
        ?>

        <a href="notifications.php" class="position-relative text-decoration-none text-dark">
            <i class="fa fa-bell fa-lg"></i>
            <?php if ($numNotifications > 0): ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?= htmlspecialchars($numNotifications) ?>
                </span>
            <?php endif; ?>
        </a>

        <div class="profile-img rounded-circle bg-secondary" style="width: 36px; height: 36px;"></div>
    </div>
</div>
