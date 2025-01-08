<?php
// Start output buffering
ob_start();

// Include header (if needed)
include('includes/header.php');

// Enable error reporting for MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Check if the required parameters are passed in the URL
if (isset($_GET['booking_id']) && isset($_GET['payment_method']) && isset($_GET['amount'])) {
    $booking_id = htmlspecialchars($_GET['booking_id']);
    $payment_method = htmlspecialchars($_GET['payment_method']); // downpayment or fullpayment
    $amount = htmlspecialchars($_GET['amount']);

    // Corrected SQL query - join using proper foreign key between 'bookings' and 'bikes'
    $query = "SELECT p.booking_id, p.payment_status, p.total_cost, p.remaining_amount, p.downpayment_amount, 
                     b.bike_name, bk.customer_name, bk.customer_email, bk.quantity, p.payment_method
              FROM payments p 
              JOIN bookings bk ON p.booking_id = bk.booking_id 
              JOIN bikes b ON bk.bikeid = b.bikeid
              WHERE p.booking_id = ?";
    
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("s", $booking_id);
    $stmt->execute();
    $stmt->bind_result($booking_id, $payment_status, $total_cost, $remaining_amount, $downpayment_amount, 
                       $bike_name, $customer_name, $customer_email, $quantity, $stored_payment_method);

    // Fetch the result
    if ($stmt->fetch()) {
        // Close the statement after fetching the result
        $stmt->close();

        // Determine the correct payment method label
        $payment_label = '';
        $paid_amount = 0;

        // Handle the correct payment method
        if ($stored_payment_method === 'downpayment') {
            $payment_label = 'Downpayment Amount';
            $paid_amount = $downpayment_amount;  // Downpayment value
            
            // If the remaining amount is 0, update payment status and payment method
            if ($remaining_amount == 0.00) {
                // Update the payment status to 'Completed'
                $updateQuery = "UPDATE payments SET payment_status = 'Completed', payment_method = 'downpayment' WHERE booking_id = ?";
                $updateStmt = $conn->prepare($updateQuery);
                $updateStmt->bind_param("s", $booking_id);
                $updateStmt->execute();
                $updateStmt->close();
            }
        } else if ($stored_payment_method === 'fullpayment') {
            $payment_label = 'Full Payment';
            $paid_amount = $total_cost;  // Full payment value
        } else {
            // Handle unexpected payment method
            echo "Invalid payment method.";
        }

        // Generate the receipt layout
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Payment Receipt</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #f7f7f7;
                }
                .receipt-container {
                    max-width: 600px;
                    margin: 30px auto;
                    padding: 20px;
                    border: 1px solid #ccc;
                    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
                    background-color: #fff;
                    border-radius: 8px;
                }
                .receipt-header {
                    text-align: center;
                    margin-bottom: 30px;
                }
                .receipt-header h2 {
                    margin: 0;
                    font-size: 30px;
                    color: #333;
                }
                .receipt-details p {
                    font-size: 16px;
                    color: #333;
                    margin: 8px 0;
                }
                .receipt-details strong {
                    font-weight: bold;
                }
                .receipt-footer {
                    margin-top: 20px;
                    text-align: center;
                    font-size: 14px;
                    color: #777;
                }
                .button {
                    background-color: #00831D;
                    color: white;
                    padding: 10px 20px;
                    font-size: 16px;
                    border: none;
                    cursor: pointer;
                    border-radius: 5px;
                    margin-top: 20px;
                }
                .button:hover {
                    background-color: #006d14;
                }
            </style>
            <script>
                // JavaScript function to print and redirect
                function printAndRedirect() {
                    window.print(); // Opens the print dialog

                    // You can redirect after a short delay to allow the print dialog to open
                    setTimeout(function() {
                        window.location.href = 'qr-scan.php'; // Redirect to the page you want
                    }, 2000); // Redirect after 2 seconds (can be adjusted)
                }
            </script>
        </head>
        <body>
            <div class="receipt-container">
                <div class="receipt-header">
                    <h2>Payment Receipt</h2>
                    <p><strong>Booking ID:</strong> <?php echo htmlspecialchars($booking_id); ?></p>
                </div>

                <div class="receipt-details">
                    <p><strong>Customer:</strong> <?php echo htmlspecialchars($customer_name); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($customer_email); ?></p>
                    <p><strong>Bike:</strong> <?php echo htmlspecialchars($bike_name); ?></p>
                    <p><strong>Quantity:</strong> <?php echo htmlspecialchars($quantity); ?></p>
                    <p><strong>Total Cost:</strong> PHP <?php echo htmlspecialchars($total_cost); ?></p>
                    <p><strong><?php echo $payment_label; ?>:</strong> PHP <?php echo htmlspecialchars($paid_amount); ?></p>
                    <?php if ($stored_payment_method === 'downpayment'): ?>
                        <p><strong>Remaining:</strong> PHP <?php echo htmlspecialchars($remaining_amount); ?></p>
                    <?php endif; ?>
                    <p><strong>Status:</strong> <?php echo 'Completed'; ?></p>
                    <p><strong>Payment Method:</strong> <?php echo ucfirst($stored_payment_method); ?></p>
                    <p><strong>Paid:</strong> PHP <?php echo htmlspecialchars($amount); ?></p>
                </div>

                <div class="receipt-footer">
                    <p>Thank you for your payment!</p>
                    <button class="button" type="button" onclick="printAndRedirect()">Print Receipt</button>
                </div>
            </div>
        </body>
        </html>

        <?php
    } else {
        echo "No payment information found for the provided booking ID.";
    }

} else {
    // If required parameters are not set, display an error
    echo "Invalid request. No payment information available.";
}
?>
