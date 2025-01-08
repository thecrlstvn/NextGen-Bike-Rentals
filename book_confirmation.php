<?php
session_start(); // Start the session at the very top
// confirmation.php

include 'config/dbcon.php';
include('includes/header.php');

// Unset the session variable so it can't be accessed again
unset($_SESSION['booking_confirmed']);

$booking_id = $_GET['booking_id'];

// Get booking details along with payment info and bike information
$query = "
    SELECT b.*, p.total_cost, p.payment_method, p.transaction_id, p.payment_status,
           bk.bike_name, bk.bike_brand, bk.bike_size, bk.image, bk.description,
           c.category_name AS category
    FROM bookings b
    LEFT JOIN payments p ON b.booking_id = p.booking_id
    LEFT JOIN bikes bk ON b.bikeid = bk.bikeid
    LEFT JOIN categories c ON bk.category_id = c.category_id
    WHERE b.booking_id = ?
";

$stmt = $conn->prepare($query);

// Check if the preparation failed
if ($stmt === false) {
    die("SQL prepare error: " . $conn->error);
}

$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("No booking found with the provided ID.");
}

$booking = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f4f8; /* Light background for contrast */
            font-family: 'Arial', sans-serif;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }
        .card-header {
            background-color: #00831D; /* Green color for header */
            color: white;
            padding: 20px;
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
        }
        .card-footer {
            background-color: #e9ecef; /* Light footer */
            padding: 15px;
        }
        .highlight {
            color: #00831D; /* Green highlight for important text */
            font-weight: bold;
        }
        .btn-custom {
            background-color: #00831D; /* Custom button color */
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .btn-custom:hover {
            background-color: #005F15; /* Darker green on hover */
        }
        h6 {
            font-size: 1.2rem;
            font-weight: 500;
            margin-top: 20px;
            color: #555; /* Slightly muted color for subtitles */
        }
        .divider {
            height: 1px;
            background-color: #dcdcdc;
            margin: 20px 0;
        }
        /* Additional styles for responsiveness and aesthetics */
        @media (max-width: 576px) {
            .card-header h2 {
                font-size: 1.8rem;
            }
            .card-title {
                font-size: 1.3rem;
            }
            .btn-custom {
                width: 100%; /* Full-width button on small screens */
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="card">
            <div class="card-header text-center">
                <h2>Booking Confirmation</h2>
            </div>
            <div class="card-body">
                <h5 class="card-title">Thank you, <?php echo htmlspecialchars($booking['customer_name']); ?>!</h5>
                <p class="card-text">Your booking ID is: <strong class="highlight"><?php echo htmlspecialchars($booking['booking_id']); ?></strong></p>
                <p class="card-text">Your booking is confirmed. A QR code has been sent to your email.</p>
                
                <!-- Bike Information -->
                <h6>Bike Information</h6>
                <div class="row">
                    <div class="col-md-6 text-center mb-3"> <!-- Image Column -->
                            <img src="<?php echo htmlspecialchars($booking['image']); ?>" 
                            alt="<?php echo htmlspecialchars($booking['bike_name']); ?>" 
                            class="img-fluid rounded" 
                            style="max-width: 300px; height: auto;" /> 
                    </div>
                    <div class="col-md-6"> <!-- Information Column -->
                        <p class="card-text">Bike Name: <strong class="highlight"><?php echo htmlspecialchars($booking['bike_name']); ?></strong></p>
                        <p class="card-text">Brand: <strong class="highlight"><?php echo htmlspecialchars($booking['bike_brand']); ?></strong></p>
                        <p class="card-text">Size: <strong class="highlight"><?php echo htmlspecialchars($booking['bike_size']); ?></strong></p>
                        <p class="card-text">Category: <strong class="highlight"><?php echo htmlspecialchars($booking['category']); ?></strong></p>
                        <p class="card-text">Description: <strong class="highlight"><?php echo htmlspecialchars($booking['description']); ?></strong></p>
                    </div>
                </div>
                
                <div class="divider"></div>
                
                <!-- Booking Details -->
                <h6>Booking Details</h6>
                <!-- Warning Note -->
                <?php if ($booking['rate_type'] === 'Daily Rate'): ?>
                <div class="alert alert-warning" role="alert">
                    <strong>NOTE:</strong> <span>For Daily Booking, NextGen Rental Bike Operational Hours is from 8:00 AM to 11:00 PM</span>
                </div>
                <?php endif; ?>
                
                <p class="card-text">Booking Date: <strong class="highlight"><?php echo htmlspecialchars($booking['booking_date']); ?></strong></p>

                <!-- Display Rate Type -->
                <p class="card-text">Rate Type: <strong class="highlight"><?php echo htmlspecialchars($booking['rate_type']); ?></strong></p>

                <!-- Show Pickup and Return Time only for Hourly Rate -->
                <?php if ($booking['rate_type'] === 'Hourly Rate'): ?>
                    <p class="card-text">Pickup Time: <strong class="highlight"><?php echo htmlspecialchars($booking['pickup_time']); ?></strong></p>
                    <p class="card-text">Return Time: <strong class="highlight"><?php echo htmlspecialchars($booking['return_time']); ?></strong></p>
                <?php endif; ?>

                <p class="card-text">Total Amount: <strong class="highlight">₱<?php echo htmlspecialchars(number_format($booking['total_cost'], 2)); ?></strong></p>

                <div class="divider"></div>

                <!-- Payment Information -->
                <h6>Payment Information</h6>
                <p class="card-text">Payment Method: <strong class="highlight"><?php echo htmlspecialchars($booking['payment_method']); ?></strong></p>
                <p class="card-text">Transaction ID: <strong class="highlight"><?php echo htmlspecialchars($booking['transaction_id']); ?></strong></p>
                <p class="card-text">Payment Status: <strong class="highlight"><?php echo htmlspecialchars($booking['payment_status']); ?></strong></p>

                <div class="text-center">
                    <a href="index.php" class="btn btn-custom">Return to Home</a>
                </div>
            </div>
            <div class="card-footer text-muted text-center">
                Thank you for choosing us! Enjoy your ride!
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
