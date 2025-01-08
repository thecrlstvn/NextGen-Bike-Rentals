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

$userId = $_SESSION['auth_user']['user_id']; // Get user ID
if (!$userId) {
    die("User ID is not set. Redirecting to login.");
}

// Determine the filter for booking types
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all'; // Default to 'all'

// Fetch bookings based on the selected filter
$bookings = getFilteredBookings($userId, $filter);

ob_end_flush(); // Flush the output buffer
?>

<div class="container mt-5">
    <h2 class="text-center">My Bookings</h2>

    <!-- Filter Options -->
    <div class="text-center mb-4">
        <a href="?filter=all" class="btn btn-primary">All</a>
        <a href="?filter=past" class="btn btn-secondary">Past</a>
        <a href="?filter=active" class="btn btn-success">Active</a>
    </div>

    <div class="row">
        <?php if (count($bookings) > 0): ?>
            <?php foreach ($bookings as $booking): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?= htmlspecialchars($booking['image'] ?? 'assets/images/placeholder.png'); ?>" class="card-img-top" alt="Product image">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo isset($booking['bike_name']) ? htmlspecialchars($booking['bike_name']) : 'Bike name not available'; ?>
                            </h5>
                            <p class="card-text">
                                <strong>Booking ID:</strong> <?php echo htmlspecialchars($booking['booking_id']); ?><br>
                                <strong>Booking Date:</strong> <?php echo date('Y-m-d', strtotime($booking['booking_date'])); ?><br>
                                <strong>Status:</strong> 
                                <span class="<?php echo getStatusClass($booking['status']); ?>">
                                    <?php echo ucfirst(htmlspecialchars($booking['status'])); ?>
                                </span>
                            </p>
                            <div class="d-flex justify-content-between">
                                <?php if ($booking['status'] === 'active'): ?>
                                    <a href="cancel_booking.php?id=<?php echo $booking['booking_id']; ?>" class="btn btn-danger btn-sm">Cancel</a>
                                <?php else: ?>
                                    <span class="text-muted">
                                        <?php echo $booking['status'] === 'past' ? 'Past Booking' : 'Booked'; ?>
                                    </span>
                                <?php endif; ?>
                                <a href="view_booking.php?id=<?php echo $booking['booking_id']; ?>" class="btn btn-info btn-sm">View Booking</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">You have no bookings in this category.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Footer Section -->
<div class="py-5" style="background-color: #005F15;">
    <div class="container">
        <div class="row">
            <!-- Column 1: Company Info -->
            <div class="col-12 col-md-3 mb-4">
                <h4 class="text-white fs-5 fw-bold">NextGen Bike Rentals</h4>
                <a href="terms-of-use.php" class="text-white d-block">Terms of Use</a>
                <a href="privacy-policy.php" class="text-white d-block">Privacy Policy</a>
            </div>
            <!-- Column 3: Social Media Links -->
            <div class="col-12 col-md-3 mb-4">
                <h4 class="text-white fs-5 fw-bold">Get in touch</h4>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fi fi-brands-facebook me-2"></i><a href="#" class="text-white">Facebook</a>
                    </li>
                    <li class="mb-2">
                        <i class="fi fi-brands-instagram me-2"></i><a href="#" class="text-white">Instagram</a>
                    </li>
                    <li class="mb-2">
                        <i class="fi fi-brands-twitter me-2"></i><a href="#" class="text-white">X (Formerly Twitter)</a>
                    </li>
                    <li class="mb-2">
                        <i class="fi fi-sr-circle-envelope me-2"></i><a href="#" class="text-white">Email Us</a>
                    </li>
                </ul>
            </div>

            <!-- Column 2: Learn More -->
            <div class="col-12 col-md-3 mb-4">
                <h4 class="text-white fs-5 fw-bold">Store Location</h4>
                <div class="text-white d-block">
                    <i class="fas fa-map-marker-alt"></i> Quezon City Memorial Circle, Elliptical Rd, Diliman, Quezon City, Metro Manila
                </div>
            </div>

            <!-- Column 4: Footer Image -->
            <div class="col-12 col-md-3 d-flex justify-content-md-end justify-content-center">
                <img src="assets/images/img-footer.png" alt="Footer Image" class="img-fluid" style="max-width: 60%; height: auto; border-radius: 8px;">
            </div>
        </div>
    </div>
</div>

<div class="py-2 bg-white">
    <div class="container">
        <div class="text-center">
            <p class="mb-1 text-black" style="font-size: 1.1rem;">NextGen Bicycle Rental and Tracking System | © Design by Karl Creatives | Inspect Portfolio 2024</p>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<?php
// Function to determine the status class for styling
function getStatusClass($status) {
    switch (strtolower($status)) {
        case 'active':
            return 'text-success'; // Green for active
        case 'past':
            return 'text-secondary'; // Grey for past
        default:
            return 'text-muted'; // Default muted text
    }
}
?>
