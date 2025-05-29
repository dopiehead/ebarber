<?php include("checkSession.php");
require 'engine/config.php';

// Initialize user variables safely
$user_id      = $_SESSION['id'];
$user_email   = $_SESSION['email'] ?? null;
$user_name    = $_SESSION['name'] ?? null;
$user_contact = $_SESSION['phone'] ?? null;
$user_type    = 'user';
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"  rel="stylesheet"/>
     <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;700&family=Roboto&display=swap" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
     <link rel="stylesheet" href="../assets/css/verify-pay.css">
  </head>
   <body class="bg-light d-flex align-items-center justify-content-center bg-light" style="height: 100vh; margin: 0;">

   <?php

// Ensure necessary GET parameters are provided
if (isset($_GET['status']) && isset($_GET['reference']) && isset($_GET['id']) && isset($_GET['user_type']) && isset($_GET['amount'])) {
    $reference = htmlspecialchars($_GET['reference']);
    $status = htmlspecialchars($_GET['status']);
    $amount = (float)$_GET['amount'];
    $user_type = htmlspecialchars($_GET['user_type']);
    $user_id = (int)$_GET['id']; // Ensure we get user_id from GET or session

    // Check if user_id is set properly (you may want to get it from session or similar)
    if (!$user_id) {
        echo "<p>User ID is not valid. Please check your login status.</p>";
        exit;
    }

    if ($status == 'success') {

            // Update payment status for logged-in user (could be a client or admin, depending on your structure)
            $update = $conn->prepare("UPDATE user_profile SET payment_status = 1 WHERE id = ?");
            $update->bind_param("i", $user_id);
            $update->execute();
            $update->close();
     

        // Determine subscription duration based on amount
        $duration = 'null'; // default value
        if ($amount == 1000) {
            $duration = '1 day';
        } elseif ($amount == 2500) {
            $duration = '1 week';
        } elseif ($amount == 4000) {
            $duration = '1 month';
        }

        $expiry_date = date('Y-m-d H:i:s'); // Set expiry date

        // Check if a subscription already exists for the user
        $check = $conn->prepare("SELECT id FROM subscriptions WHERE user_id = ? AND user_type = ? AND price = ?");
        $check->bind_param("isi", $user_id, $user_type, $amount);
        $check->execute();
        $result = $check->get_result();
        
        if ($result->num_rows > 0) {
            $check->close();
            echo "";
        } else {
            // Insert subscription details into the database
            $insert = $conn->prepare("INSERT INTO subscriptions (price, user_id, user_type, reference, duration, expiry_date) VALUES (?, ?, ?, ?, ?, ?)");
            $insert->bind_param("idsss", $amount, $user_id, $user_type, $reference, $duration, $expiry_date);
            $insert->execute();
            $insert->close();
        }

        // Assuming user_name is available from the GET or session
        if (isset($user_name) && isset($amount)) {
            ?>
            <div class='container-fluid checkmark-container d-flex justify-content-center align-items-center gap-2 p-5 h-100'>
                <div class='card shadow bg-white px-4 py-2 d-flex flex-column gap-2' style="max-width: 500px; width: 100%;">
                    <!-- Animated Checkmark Icon -->
                    <div class='text-center d-flex justify-content-center'>
                        <span class='border border-success border-3 rounded-circle fs-3 px-3 py-2 text-success checkmark-circle'>
                            <i class="fa fa-check"></i>
                        </span>
                    </div>

                    <!-- Transaction Details -->
                    <div class='d-flex justify-content-between'>
                        <span>Transaction Reference</span>
                        <span class='fw-bold'><?php echo htmlspecialchars($reference); ?></span>
                    </div>

                    <div class='d-flex justify-content-between'>
                        <span>Client's Name</span>
                        <span class='text-capitalize fw-bold'><?php echo htmlspecialchars($user_name); ?></span>
                    </div>

                    <!-- <div class='d-flex justify-content-between'>
                        <span>User type</span>
                        <span></span>
                    </div> -->

                    <div class='d-flex justify-content-between'>
                        <span>Subscription Duration</span>
                        <span class='fw-bold'><?php echo  htmlspecialchars($duration); ?></span>
                    </div>

                    <!-- Additional message -->
                    <p class='mt-4 text-secondary'>
                        Your payment has been processed successfully. Your ads will now be active.
                    </p>
                    
                    <?php if($user_type != "firm"){ ?>
                    <p class='text-center text-secondary'><a href='dashboard/mydashboard.php' class='text-secondary text-decoration-none'>Back to Dashboard</a></p>
                     <?php } else { ?>
                        <p class='text-center text-secondary'><a href='dashboard/firm-dashboard.php' class='text-secondary text-decoration-none'>Back to Dashboard</a></p>
                    <?php } ?>
                </div>
            </div>
            <?php
        } else {
            echo "<p>No products found for this order.</p>";
        }

    } else {
        // Handle the case where payment status is not 'success'
        echo "<p>Payment failed or was canceled. Please try again.</p>";
    }
} else {
    // Handle case where 'status' or 'reference' is not provided
    echo "<p>Invalid request. Please check your payment details and try again.</p>";
}

// Close the database connection
$conn->close();
?>


</body>
</html>

