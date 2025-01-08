<?php 
include('includes/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .main-content {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .details {
            margin: 20px 0;
            padding: 10px;
            border: 1px solid #00831D;
            border-radius: 5px;
            background-color: #e0ffe0;
        }
        button {
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #00831D;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #005F15;
        }
    </style>
</head>
<body>

<div class="main-content">
    <h2>Booking Confirmation</h2>
    <?php
    // Check if the booking ID is set and valid
    if (isset($_GET['booking_id']) && !empty($_GET['booking_id'])) {
        $booking_id = htmlspecialchars($_GET['booking_id']);

        // Fetch booking details from the database
        $query = "
            SELECT b.booking_id, b.bikeid, b.booking_date, b.pickup_time, b.return_time, 
                   b.quantity, b.rate_type, b.status, p.transaction_id, 
                   b.customer_name, b.customer_email 
            FROM bookings b
            LEFT JOIN payments p ON b.booking_id = p.booking_id
            WHERE b.booking_id = ?";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $booking_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch the booking details
            $booking_details = $result->fetch_assoc();

            // Display booking details
            ?>
            <div class="details">
                <p><strong>Booking ID:</strong> <?php echo htmlspecialchars($booking_details['booking_id']); ?></p>
                <p><strong>Customer Name:</strong> <?php echo htmlspecialchars($booking_details['customer_name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($booking_details['customer_email']); ?></p>
                <p><strong>Bike ID:</strong> <?php echo htmlspecialchars($booking_details['bikeid']); ?></p>
                <p><strong>Booking Date:</strong> <?php echo htmlspecialchars($booking_details['booking_date']); ?></p>

                <?php if ($booking_details['rate_type'] === 'Hourly') { ?>
                    <p><strong>Pickup Time:</strong> <?php echo htmlspecialchars($booking_details['pickup_time']); ?></p>
                    <p><strong>Return Time:</strong> <?php echo htmlspecialchars($booking_details['return_time']); ?></p>
                <?php } ?>
                
                <p><strong>Quantity:</strong> <?php echo htmlspecialchars($booking_details['quantity']); ?></p>
                <p><strong>Rate Type:</strong> <?php echo htmlspecialchars($booking_details['rate_type']); ?></p>
                <p><strong>Transaction ID:</strong> <?php echo htmlspecialchars($booking_details['transaction_id']); ?></p>
                <p><strong>Status:</strong> <?php echo htmlspecialchars($booking_details['status']); ?></p>
            </div>

            <button id="confirmBookingBtn">Confirm Booking</button>

            <script>
    document.getElementById('confirmBookingBtn').onclick = function() {
        Swal.fire({
            title: 'Confirm Booking',
            text: "Are you sure you want to confirm this booking?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#00831D',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, confirm!'
        }).then((result) => {
            if (result.isConfirmed) {
                const bookingId = <?php echo json_encode($booking_id); ?>; // Get booking ID
                const status = 'confirmed'; // Set the new status

                // AJAX request to update booking status
                fetch('update_booking_status.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ booking_id: bookingId, status: status })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Server Response:', data); // Log the response for debugging
                    if (data.success) {
                        Swal.fire({
                            title: 'Booking Confirmed!',
                            text: 'The booking has been confirmed.',
                            icon: 'success'
                        }).then(() => {
                            window.location.href = `qr-payment.php?booking_id=${bookingId}`; // Redirect to payment page
                        });
                    } else {
                        Swal.fire({
                            title: 'Notice!',
                            text: data.message || 'There was an issue confirming the booking. Proceeding to payment details.',
                            icon: 'info'
                        }).then(() => {
                            window.location.href = `qr-payment.php?booking_id=${bookingId}`; // Redirect to payment page
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'There was an issue confirming the booking.',
                        icon: 'error'
                    });
                });
            }
        });
    };
</script>

            <?php
        } else {
            // Handle case where booking is not found
            echo '<div class="details" style="color: red;">No booking found for the given ID.</div>';
        }

        $stmt->close();
    } else {
        // Handle invalid booking ID case
        echo '<div class="details" style="color: red;">Invalid booking ID. Please try again.</div>';
    }
    ?>
</div>

<?php include('includes/footer.php'); ?>
</body>
</html>
