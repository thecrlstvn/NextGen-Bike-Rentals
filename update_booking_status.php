<?php
include('../config/dbcon.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['booking_id']) && isset($data['status'])) {
    $booking_id = $data['booking_id'];
    $status = $data['status'];

    // Prepare the SQL statement to update the status
    $query = "UPDATE bookings SET status = ? WHERE booking_id = ?";
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error); // Log error
        echo json_encode(['success' => false, 'message' => 'Prepare failed.']);
        exit;
    }

    $stmt->bind_param("si", $status, $booking_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Check if any rows were affected
        if ($stmt->affected_rows >= 0) { // Allow for 0 rows affected (already confirmed)
            echo json_encode(['success' => true, 'message' => 'Booking status updated.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No rows updated.']);
        }
    } else {
        error_log("Execute failed: " . $stmt->error); // Log error
        echo json_encode(['success' => false, 'message' => 'Execute failed.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input.']);
}

$conn->close();
?>
