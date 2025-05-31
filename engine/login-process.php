<?php
session_start();
require("config.php");
header('Content-Type: application/json');

$response = [];

$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

if (!empty($email) && !empty($password)) {
    $stmt = $conn->prepare("SELECT id, user_name, user_email, user_password, user_type, user_phone 
                            FROM user_profile 
                            WHERE user_email = ? AND verified = 1");

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['user_password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['user_email'] = $row['user_email'];
                $_SESSION['user_role'] = $row['user_type'];
                $_SESSION['user_phone'] = $row['user_phone'];

                $response = [
                    "status" => "success",
                    "user_role" => $row['user_type']
                ];
            } else {
                $response = [
                    "status" => "error",
                    "message" => "Invalid password."
                ];
            }
        } else {
            $response = [
                "status" => "error",
                "message" => "User not found or not verified."
            ];
        }
        $stmt->close();
    } else {
        $response = [
            "status" => "error",
            "message" => "Database query failed."
        ];
    }
} else {
    $response = [
        "status" => "error",
        "message" => "All fields are required"
    ];
}

$conn->close();
echo json_encode($response);
?>