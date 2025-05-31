<?php
// Include the database connection
require 'config.php';
// Set the header to accept JSON
header("Content-Type: application/json");
// Read the raw input
$input = file_get_contents("php://input");
// Decode JSON into an associative array
$data = json_decode($input, true);

// Check if decoding was successful and required fields exist
if (
    isset($data['id']) &&
    isset($data['barber_id']) &&
    isset($data['customer_id']) &&
    isset($data['number_of_people_barbing']) &&
    isset($data['barber_style']) &&
    isset($data['user_preference']) &&
    isset($data['location']) &&
    isset($data['date'])
) {
    // Sanitize and assign variables
    $id = $data['id'];
    $barber_id = $data['barber_id'];
    $customer_id = $data['customer_id'];
    $number_of_people_barber = $data['number_of_people_barber'];
    $barber_style = implode(",",$data['barber_style']);
    $user_preference = $data['user_preference'];
    $location = $data['location'];
    $date = $data['date'];

    // Prepare the SQL statement
    $sql = "INSERT INTO barber_request (id, barber_id, customer_id, number_of_people_barber, barber_style, user_preference, location, date) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("iiisssss", $id, $barber_id, $customer_id, $number_of_people_barber, $barber_style, $user_preference, $location, $date);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Request inserted successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Query execution failed.", "error" => $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Statement preparation failed.", "error" => $conn->error]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid or missing JSON data."]);
}

// Close connection
$conn->close();
?>
