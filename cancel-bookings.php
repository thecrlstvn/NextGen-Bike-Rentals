<?php
// Include database connection
include('includes/header.php'); 

// Start session to access user ID
session_start();

// Check if user is logged in
if (!isset($_SESSION['auth'])) {
    die("Unauthorized access.");
}

// Fetch the booking ID from the form
$bookingId = $_POST['booking_id'];
$userId = $_SESSION['user_id'];

// Function to cancel booking
function cancelBooking($bookingId, $userId, $cancellationReason = null) {
    global $conn; // Use the global database connection

    // Fetch booking details
    $stmt = $conn->prepare("SELECT * FROM bookings WHERE booking_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $bookingId, $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();

    // Check if the booking exists and is confirmed
    if (!$booking) {
        return "Booking not found or you do not have permission.";
    }
    if ($booking['status'] !== 'confirmed') {
        return "Only confirmed bookings can be cancelled.";
    }

    // Check if the booking start time has not passed
    if (strtotime($booking['start_datetime']) < time()) {
        return "Booking has already started. Cannot cancel.";
    }

    // Update the booking status to cancelled
    $stmt = $conn->prepare("UPDATE bookings SET status = ?, cancellation_date = NOW(), cancellation_reason = ? WHERE id = ?");
    $cancellationStatus = 'cancelled';
    $stmt->bind_param("ssi", $cancellationStatus, $cancellationReason, $bookingId);
    $stmt->execute();

    // Restore bike quantity
    $bikeId = $booking['bike_id'];
    $stmt = $conn->prepare("UPDATE bikes SET quantity = quantity + 1 WHERE id = ?");
    $stmt->bind_param("i", $bikeId);
    $stmt->execute();

    return "Booking cancelled successfully!";
}

// Call the cancellation function
$message = cancelBooking($bookingId, $userId, "User requested cancellation");

// Redirect back with a message
header("Location: bookings.php?message=" . urlencode($message));
exit();
?>
