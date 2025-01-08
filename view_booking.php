<?php
ob_start(); // Start output buffering
session_start();
include('includes/header.php');
include('functions/userfunctions.php');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in
if (!isset($_SESSION['auth_user']['user_id'])) {
    header('Location: login.php'); // Redirect if user is not logged in
    exit();
}

// Get the booking ID from the URL
$bookingId = isset($_GET['id']) ? intval($_GET['id']) : 0; // Get booking ID and convert to integer

if ($bookingId <= 0) {
    die("Invalid booking ID.");
}

// Fetch booking details from the database
$bookingDetails = getBookingDetails($bookingId); // Make sure this function is defined in userfunctions.php

ob_end_flush(); // Flush the output buffer
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Booking Details</h2>

    <?php if ($bookingDetails): ?>
        <div class="card shadow-lg mb-5">
            <div class="row g-0">
                <div class="col-md-4">
                    <?php if (!empty($bookingDetails['image'])): ?>
                        <img src="<?= htmlspecialchars($bookingDetails['image']); ?>" class="card-img-top" alt="Product image">
                    <?php else: ?>
                        <img src="assets/images/placeholder.png" class="img-fluid rounded-start" alt="No image available">
                    <?php endif; ?>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h4 class="card-title text-primary">Bike Rent Details</h4>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Bike Name:</strong> <?php echo htmlspecialchars($bookingDetails['bike_name'] ?? 'N/A'); ?></p>
                                <p><strong>Bike Brand:</strong> <?php echo htmlspecialchars($bookingDetails['bike_brand'] ?? 'N/A'); ?></p>
                                <p><strong>Quantity:</strong> <?php echo htmlspecialchars($bookingDetails['quantity'] ?? 'N/A'); ?></p>
                                <p><strong>Rate Type:</strong> <?php echo htmlspecialchars($bookingDetails['rate_type'] ?? 'N/A'); ?></p>
                                <p><strong>Booking Date:</strong> <?php echo date('Y-m-d', strtotime($bookingDetails['booking_date'] ?? '')); ?></p>
                            </div>
                            <div class="col-md-6">
                                <?php if (strtolower($bookingDetails['rate_type'] ?? '') != 'daily'): ?>
                                    <p><strong>Pickup Time:</strong> <?php echo htmlspecialchars($bookingDetails['pickup_time'] ?? 'N/A'); ?></p>
                                    <p><strong>Return Time:</strong> <?php echo htmlspecialchars($bookingDetails['return_time'] ?? 'N/A'); ?></p>
                                <?php endif; ?>
                                <p><strong>Customer Name:</strong> <?php echo htmlspecialchars($bookingDetails['customer_name'] ?? 'N/A'); ?></p>
                                <p><strong>Customer Email:</strong> <?php echo htmlspecialchars($bookingDetails['customer_email'] ?? 'N/A'); ?></p>
                                <!-- Add Status Field with Badge -->
                                <p><strong>Status:</strong> 
                                    <span class="badge <?php echo getStatusClass($bookingDetails['status']); ?>">
                                        <?php echo ucfirst(htmlspecialchars($bookingDetails['status'] ?? 'N/A')); ?>
                                    </span>
                                </p>
                            </div>
                        </div>

                        <h4 class="card-title text-success">Payment Details</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($bookingDetails['payment_method'] ?? 'N/A'); ?></p>
                                <p><strong>Total Amount:</strong> <?php echo htmlspecialchars($bookingDetails['total_amount'] ?? 'N/A'); ?></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Downpayment:</strong> <?php echo htmlspecialchars($bookingDetails['downpayment_amount'] ?? 'N/A'); ?></p>
                                <p><strong>Remaining Amount:</strong> <?php echo htmlspecialchars($bookingDetails['remaining_amount'] ?? 'N/A'); ?></p>
                                <p><strong>Payment Status:</strong> 
                                    <span class="badge <?php echo getStatusClass($bookingDetails['payment_status']); ?>">
                                        <?php echo htmlspecialchars($bookingDetails['payment_status'] ?? 'N/A'); ?>
                                    </span>
                                </p>
                            </div>
                        </div>

                        <a href="mybookings.php" class="btn btn-primary btn-block mt-4">Back to My Bookings</a>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger text-center mt-5">No booking details found for this ID.</div>
    <?php endif; ?>
</div>

<?php include('includes/footer.php'); ?>

<?php
// Function to determine the status class for styling with Bootstrap badge classes
function getStatusClass($status) {
    switch (strtolower($status ?? '')) {
        case 'active':
            return 'badge-success'; // Green for active
        case 'past':
            return 'badge-secondary'; // Grey for past
        case 'paid':
            return 'badge-success'; // Green for paid
        case 'unpaid':
            return 'badge-warning'; // Yellow for unpaid
        default:
            return 'badge-light'; // Default muted badge
    }
}
?>
