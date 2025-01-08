<?php 
include('includes/header.php');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if booking_id is set in the URL
if (isset($_GET['booking_id'])) {
    $booking_id = intval($_GET['booking_id']); // Get booking ID from URL and sanitize

    // Prepare SQL query to fetch booking details
    $sql = "SELECT 
                b.booking_id, 
                b.customer_name, 
                bi.bike_name, 
                bi.image,   -- Include bike_image from bikes table
                bc.name AS category_name,
                b.start_date, 
                b.start_time, 
                b.end_date, 
                b.end_time, 
                b.quantity, 
                b.total_amount, 
                p.downpayment_amount, 
                p.remaining_amount, 
                p.payment_status, 
                b.qr_code_status, 
                b.booking_source 
            FROM bookings b
        JOIN 
            bikes bi ON b.bikeid = bi.bikeid
        JOIN 
            categories bc ON bi.category_id = bc.id
        JOIN 
            payments p ON b.booking_id = p.booking_id  -- Join with payments table
        WHERE 
            b.booking_id = ?";
    
    // Prepare statement
    $stmt = $conn->prepare($sql);

    // Check if statement preparation was successful
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error); // Output error message
    }

    // Bind the booking ID parameter
    $stmt->bind_param("i", $booking_id); 
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if booking exists
    if ($result->num_rows > 0) {
        $booking = $result->fetch_assoc(); // Fetch booking details
    } else {
        echo "<div class='alert alert-danger'>Booking not found.</div>";
        exit();
    }
} else {
    echo "<div class='alert alert-danger'>Invalid booking ID.</div>";
    exit();
}
?>

<div class="main-content">
  <div class="container mt-2">
    <div class="header">
      <div class="logo">
        <img src="assets/img/nextgen.png" alt="Logo" style="height: 27px;">
      </div>
      <div class="title">
        View Booking Details
      </div>
    </div>

    <div class="container mt-5">
      <div class="card shadow">
        <div class="card-header bg-dark text-white">
          <h3 class="mb-0 text-center">Booking Receipt</h3>
        </div>
        <div class="card-body">
            <div class="text-center mb-4">
                <img src="assets/img/login-side.png" alt="Small Logo" style="height: 50px;">
                <h4 class="mt-2">NextGen Bike Rentals</h4>
                <p>Tel No: 415-1111 | 924-2684</p>
                <p>Follow us on: 
                    <a href="https://facebook.com/nextgen" target="_blank">
                        <img src="assets/img/facebook.png" alt="Facebook" style="height: 25px; margin: 0 5px;">
                    </a>
                    <a href="https://instagram.com/nextgen" target="_blank">
                        <img src="assets/img/instagram.png" alt="Instagram" style="height: 25px; margin: 0 5px;">
                    </a>
                    <a href="https://twitter.com/nextgen" target="_blank">
                        <img src="assets/img/twitter.png" alt="Twitter" style="height: 25px; margin: 0 5px;">
                    </a>
                </p>
            </div>
            <div class="receipt">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Customer Information</h5>
                        <hr>
                        <p><strong>Name:</strong> <?php echo htmlspecialchars($booking['customer_name']); ?></p>
                        <p><strong>Bike Name:</strong> <?php echo htmlspecialchars($booking['bike_name']); ?></p>
                        <p><strong>Category:</strong> <?php echo htmlspecialchars($booking['category_name']); ?></p>
                    </div>
                    <div class="col-md-6 text-right">
                        <img src="<?php echo htmlspecialchars($booking['image']); ?>" alt="Bike Image" style="max-width: 150px; height: auto;" class="img-fluid rounded">
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5>Booking Duration</h5>
                        <hr>
                        <p><strong>Start:</strong> <?php echo date('F j, Y, g:i A', strtotime($booking['start_date'] . ' ' . $booking['start_time'])); ?></p>
                        <p><strong>End:</strong> <?php echo date('F j, Y, g:i A', strtotime($booking['end_date'] . ' ' . $booking['end_time'])); ?></p>
                    </div>
                    <div class="col-md-6 text-right">
                        <h5>Payment Details</h5>
                        <hr>
                        <p><strong>Quantity:</strong> <?php echo htmlspecialchars($booking['quantity']); ?></p>
                        <p><strong>Total Amount:</strong> <?php echo htmlspecialchars($booking['total_amount']); ?></p>
                        <p><strong>Downpayment:</strong> <?php echo htmlspecialchars($booking['downpayment_amount']); ?></p>
                        <p><strong>Remaining Amount:</strong> <?php echo htmlspecialchars($booking['remaining_amount']); ?></p>
                        <p><strong>Payment Status:</strong> <?php echo htmlspecialchars($booking['payment_status']); ?></p>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5>QR Code Status</h5>
                        <hr>
                        <span class="badge <?php echo ($booking['qr_code_status'] == 'Active') ? 'bg-success' : 'bg-danger'; ?>">
                            <?php echo htmlspecialchars($booking['qr_code_status']); ?>
                        </span>
                    </div>
                    <div class="col-md-6 text-right">
                        <h5>Booking Source</h5>
                        <hr>
                        <span class="badge <?php echo ($booking['booking_source'] == 'Online') ? 'bg-info' : 'bg-secondary'; ?>">
                            <?php echo htmlspecialchars($booking['booking_source']); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <a href="allbookings.php" class="btn btn-secondary">Back to Bookings</a>
        </div>
    </div>
  </div>
</div>

<?php include('includes/footer.php'); ?>
