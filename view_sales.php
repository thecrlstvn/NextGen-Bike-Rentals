<?php 
include('includes/header.php');

// Get the booking ID from the URL
if (isset($_GET['id'])) {
    $booking_id = intval($_GET['id']); // Convert to integer for security

    // SQL query to fetch the booking details and payment information
    $query = "
        SELECT
            bk.booking_id,
            b.bike_name,
            b.bike_brand,
            b.hourly_rate,
            b.daily_rate,
            bk.booking_date,
            bk.pickup_time,
            bk.return_time,
            bk.quantity,
            bk.rate_type,
            p.downpayment_amount,
            p.total_cost,
            p.payment_status,
            p.created_at AS payment_date,
            p.payment_method
        FROM 
            bookings bk
        JOIN 
            bikes b ON bk.bikeid = b.bikeid
        JOIN 
            payments p ON bk.booking_id = p.booking_id
        WHERE 
            bk.booking_id = $booking_id
    ";

    $result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result === false) {
    // Query failed, display the error
    echo "<div class='alert alert-danger'>Error executing query: " . mysqli_error($conn) . "</div>";
    exit;
} else {
    // Check if the booking was found
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Process the booking data here
    } else {
        // No booking found
        echo "<div class='alert alert-danger'>No booking found for this ID.</div>";
        exit;
    }
}
}
?>

<div class="main-content">
    <div class="container mt-4">
        <h4 class="mb-4" style="color: #005F15;">View Sale Details</h4>
        
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Booking Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Booking ID:</strong> <?php echo htmlspecialchars($row['booking_id']); ?></p>
                <p><strong>Bike Name:</strong> <?php echo htmlspecialchars($row['bike_name']); ?></p>
                <p><strong>Bike Brand:</strong> <?php echo htmlspecialchars($row['bike_brand']); ?></p>
                <p><strong>Quantity:</strong> <?php echo $row['quantity']; ?></p>
                <p><strong>Rate Type:</strong> <?php echo htmlspecialchars($row['rate_type']); ?></p>
                <p><strong>Booking Date:</strong> <?php echo date('l, F j, Y', strtotime($row['booking_date'])); ?></p> <!-- Improved format -->
                <p><strong>Pickup Time:</strong> <?php echo htmlspecialchars(date('g:i A', strtotime($row['pickup_time']))); ?></p> <!-- Improved format -->
                <p><strong>Return Time:</strong> <?php echo htmlspecialchars(date('g:i A', strtotime($row['return_time']))); ?></p> <!-- Improved format -->
            </div>
        </div>

        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Payment Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Downpayment Amount:</strong> <?php echo number_format($row['downpayment_amount'], 2); ?> PHP</p>
                <p><strong>Total Cost:</strong> <?php echo number_format($row['total_cost'], 2); ?> PHP</p>
                <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($row['payment_method']); ?></p>
                <p><strong>Payment Status:</strong> <?php echo htmlspecialchars($row['payment_status']); ?></p>
                <p><strong>Payment Date:</strong> <?php echo date('l, F j, Y g:i A', strtotime($row['payment_date'])); ?></p> <!-- Improved format -->
            </div>
        </div>

        <a href="sales.php" class="btn btn-secondary">Back to Sales Overview</a>
    </div>
</div>

<?php 
include('includes/footer.php'); 
?>
