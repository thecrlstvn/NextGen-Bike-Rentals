<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session if not already started
}

include('../config/dbcon.php'); // Include your database connection file

// Fetch admin ID from session
if (isset($_SESSION['admin_id'])) {
    $adminId = $_SESSION['admin_id'];
} else {
    // Handle the case where admin ID is not set, e.g., redirect to login
    header("Location: index.php");
    exit();
}

// Prepare and execute the query to fetch admin details
$stmt = $conn->prepare("SELECT admin_name, admin_image FROM adminlogin WHERE id = ?");
$stmt->bind_param("i", $adminId); // Bind the admin ID parameter
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $admin = $result->fetch_assoc();
    $admin_name = $admin['admin_name'];
    $admin_image = $admin['admin_image'];
} else {
    // Fallback values in case of failure
    $admin_name = "NextGen Admin"; // Default name
    $admin_image = "https://default-image-url.com/default.png"; // Default image
}

// Close the statement
$stmt->close();
?>

<!-- Sidebar -->
<div id="sidebar" class="d-flex flex-column flex-shrink-0 p-3 text-white" style="background-color: #00831D; min-height: 100vh; overflow-y: auto;">
    <!-- Logo -->
    <a href="" class="d-flex align-items-center mb-3 text-white text-decoration-none">
        <img src="assets/img/admin-logo.png" class="sidebar-logo me-4" alt="Logo" style="width: 80%; height: auto;">
    </a>

    <!-- Navigation -->
    <ul class="nav flex-column mb-auto">
        <!-- Dashboard Item -->
        <li class="nav-item mb-1">
            <a href="dashboard.php" class="nav-link d-flex align-items-center" style="font-size: 1.1rem;">
                <img src="assets/img/dash.png" class="nav-icon me-2" alt="Dashboard Logo" style="width: 24px; height: 24px;">
                Dashboard
            </a>
        </li>

        <!-- Bookings Item (Collapsible) -->
        <li class="nav-item mb-1">
            <a class="nav-link d-flex align-items-center" data-bs-toggle="collapse" href="#collapseBookings" role="button" aria-expanded="false" aria-controls="collapseBookings" style="font-size: 1.1rem;">
                <img src="assets/img/biking.png" class="nav-icon me-2" alt="Bookings Logo" style="width: 24px; height: 24px;">
                Bookings
            </a>
            <div class="collapse" id="collapseBookings">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link" href="allbookings.php">All Bookings</a>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link" href="add-booking.php">Add Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="booking_availability.php">Booking Availability</a>
                    </li>-->
                </ul>
            </div>
        </li>

        <!-- Content Management Item (Collapsible) -->
        <li class="nav-item mb-1">
            <a class="nav-link d-flex align-items-center collapsed" data-bs-toggle="collapse" href="#collapseContentManagement" role="button" aria-expanded="false" aria-controls="collapseContentManagement" style="font-size: 1.1rem;">
                <img src="assets/img/bike-admin.png" class="nav-icon me-2" alt="Content Management Logo" style="width: 24px; height: 24px;">
                Bikes
            </a>
            <div class="collapse" id="collapseContentManagement">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link" href="bikes.php">View All Bikes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add-bikes.php">Add New Bikes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="category.php">All Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add-category.php">Add New Categories</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Static Items -->
        <li class="nav-item mb-1">
            <a href="sales.php" class="nav-link d-flex align-items-center" style="font-size: 1.1rem;">
                <img src="assets/img/sales-admin.png" class="nav-icon me-2" alt="Sales Logo" style="width: 24px; height: 24px;">
                Sales Revenues
            </a>
        </li>
                <!-- Content Management Item (Collapsible) -->
                <li class="nav-item mb-1">
            <a class="nav-link d-flex align-items-center collapsed" data-bs-toggle="collapse" href="#collapseAccounts" role="button" aria-expanded="false" aria-controls="collapseContentManagement" style="font-size: 1.1rem;">
                <img src="assets/img/circle-user.png" class="nav-icon me-2" alt="Content Management Logo" style="width: 24px; height: 24px;">
                Accounts
            </a>
            <div class="collapse" id="collapseAccounts">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link" href="user.php">User Accounts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_accounts.php">Admin Accounts</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item mb-1">
            <a href="reports.php" class="nav-link d-flex align-items-center" style="font-size: 1.1rem;">
                <img src="assets/img/reports.png" class="nav-icon me-2" alt="Reports Logo" style="width: 24px; height: 24px;">
                Reports
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="reviews.php" class="nav-link d-flex align-items-center" style="font-size: 1.1rem;">
                <img src="assets/img/review.png" class="nav-icon me-2" alt="Reviews Logo" style="width: 24px; height: 24px;">
                Reviews
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="biketracking.php" class="nav-link d-flex align-items-center" style="font-size: 1.1rem;">
                <img src="assets/img/mouse-clicker.png" class="nav-icon me-2" alt="Reviews Logo" style="width: 24px; height: 24px;">
                Bike Tracking
            </a>
        </li>

        <li class="nav-item mb-1">
            <a class="nav-link d-flex align-items-center collapsed" data-bs-toggle="collapse" href="#collapseQR" role="button" aria-expanded="false" aria-controls="collapseContentManagement" style="font-size: 1.1rem;">
                <img src="assets/img/qr-code.png" class="nav-icon me-2" alt="QR Logo" style="width: 24px; height: 24px;">
                QR Code Scanner
            </a>
            <div class="collapse" id="collapseQR">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link" href="qr-scan.php">Booking Bike Confirmation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="return-bike-scan.php">Return Bike Confirmation</a>
                    </li>
                </ul>
            </div>
        </li>

        <hr class="bg-white">

        <!-- User Dropdown -->
        <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?php echo htmlspecialchars($admin_image); ?>" alt="Admin Image" width="32" height="32" class="rounded-circle me-2">
                <strong><?php echo htmlspecialchars($admin_name); ?></strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item text-white" href="logout.php">Sign out</a></li>
            </ul>
        </div>
    </div>
