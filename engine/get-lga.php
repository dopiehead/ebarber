<?php
require 'connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['location'])) {
    $location = trim($_POST['location']);

    $sql = "SELECT lga FROM states_in_nigeria WHERE state = ?";
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("s", $location);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<select name='lga' id='lga' class='lga address_details form-control mt-1'>";
                while ($row = $result->fetch_assoc()) {
                    $lga = htmlspecialchars($row['lga']);
                    echo "<option value='{$lga}'>{$lga}</option>";
                }
                echo "</select><br>";
            } else {
                echo "<p class='text-muted'>No LGAs found for this state.</p>";
            }
        } else {
            echo "<p class='text-danger'>Error executing query.</p>";
        }

        $stmt->close();
    } else {
        echo "<p class='text-danger'>Error preparing statement.</p>";
    }
} else {
    echo "<p class='text-warning'>State not provided.</p>";
}
$con->close();
?>