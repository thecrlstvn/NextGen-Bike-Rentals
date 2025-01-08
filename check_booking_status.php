<?php
include('includes/header.php');

if (isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];

    // Fetch booking status
    $sql = "SELECT status FROM bookings WHERE booking_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $booking = $result->fetch_assoc();
        echo json_encode($booking); // Return status as JSON
    } else {
        echo json_encode(['status' => 'not_found']); // Booking not found
    }
} else {
    echo json_encode(['status' => 'error']); // Error handling
}
?>
