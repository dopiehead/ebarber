<?php
require("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $request_id = intval($_POST['id']);

    $stmt = $conn->prepare("UPDATE barber_request SET pending = 0 WHERE id = ?");
    $stmt->bind_param("i", $request_id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Offer rejected"]);
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Failed to reject offer"]);
    }

    $stmt->close();
} else {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
?>
