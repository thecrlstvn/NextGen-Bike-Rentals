<?php
session_start(); // Start the session

// Include database connection and functions
include 'config/dbcon.php';
include 'functions/userfunctions.php';

// Check if the user is logged in
if (!isset($_SESSION['auth_user']['user_id'])) {
    header('Location: login.php'); // Redirect if user is not logged in
    exit();
}

$userId = $_SESSION['auth_user']['user_id']; // Get user ID
if (!$userId) {
    die("User ID is not set. Redirecting to login.");
}

// Get input values from the form submission and sanitize them
$bike_id = htmlspecialchars($_POST['bikeid']);
$booking_date = htmlspecialchars($_POST['booking_date']);
$rate_type = htmlspecialchars($_POST['rate_type']);
$quantity = (int) $_POST['qty'];
$pickup_time = isset($_POST['pickup_time']) ? htmlspecialchars($_POST['pickup_time']) : null;
$return_time = isset($_POST['return_time']) ? htmlspecialchars($_POST['return_time']) : null;

// Check availability and deduct quantity if available
if ($rate_type === 'hourly' || $rate_type === 'daily') {
    // Query to check if the bike is available
    $query = "SELECT qty FROM bikes WHERE bikeid = ? AND qty >= ?";
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        die("Query preparation failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("si", $bike_id, $quantity);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Bike is available, deduct the quantity
        $row = $result->fetch_assoc();
        $current_qty = (int) $row['qty'];

        // Calculate new quantity
        $new_qty = $current_qty - $quantity;

        // Update the quantity in the database
        $update_query = "UPDATE bikes SET qty = ? WHERE bikeid = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("is", $new_qty, $bike_id);
        
        if ($update_stmt->execute()) {
            // Construct the redirect URL
            $redirect_url = "booking_details.php?bikeid=" . urlencode($bike_id) .
                            "&booking_date=" . urlencode($booking_date) .
                            "&quantity=" . urlencode($quantity) .
                            "&rate_type=" . urlencode($rate_type);
            
            // Include pickup and return times for hourly bookings
            if ($rate_type === 'hourly') {
                $redirect_url .= "&pickup_time=" . urlencode($pickup_time) .
                                 "&return_time=" . urlencode($return_time);
            }

            // Redirect to booking details
            header("Location: $redirect_url");
            exit();
        } else {
            echo "Error updating quantity: " . $conn->error;
        }
    } else {
        // Not enough quantity, redirect with an error
        header("Location: view_product.php?bikeid=" . urlencode($bike_id) . "&error=not_available_" . ($rate_type === 'hourly' ? 'hourly' : 'daily'));
        exit();
    }
} else {
    // Invalid rate type, redirect with error
    header("Location: view_product.php?bikeid=" . urlencode($bike_id) . "&error=invalid_rate_type");
    exit();
}
?>
