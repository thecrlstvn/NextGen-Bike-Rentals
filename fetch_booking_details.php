<?php
include('../config/dbcon.php'); // Include your database connection

if (isset($_GET['booking_id'])) {
    $booking_id = intval($_GET['booking_id']);

    // Fetch the booking details based on the booking ID
    $sql = "SELECT booking_id, customer_name, customer_email, bikeid, booking_date, pickup_time, return_time, quantity, rate_type, status, bike_size
            FROM bookings
            WHERE booking_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $booking = $result->fetch_assoc();
        echo json_encode($booking);
    } else {
        echo json_encode(['error' => 'Booking not found']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'Invalid request']);
}
