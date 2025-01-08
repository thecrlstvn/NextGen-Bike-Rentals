<?php 
ob_start(); // Start output buffering
include('includes/header.php');

// Enable error reporting for MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['booking_id']) && isset($_POST['payment_method'])) {
        $booking_id = htmlspecialchars($_POST['booking_id']);
        $payment_method = htmlspecialchars($_POST['payment_method']);

        // Retrieve payment details for the booking ID
        $query = "SELECT total_cost, remaining_amount, payment_status FROM payments WHERE booking_id = ?";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }
        if (!$stmt->bind_param("s", $booking_id)) {
            die("Bind failed: (" . $stmt->errno . ") " . $stmt->error);
        }
        if (!$stmt->execute()) {
            die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
        }

        $stmt->bind_result($total_amount, $remaining_amount, $payment_status);
        $stmt->fetch();
        $stmt->close();

        if ($total_amount === null || $remaining_amount === null) {
            die("Error: Payment information not found for booking ID: $booking_id");
        }

        // If payment is full or remaining amount is zero, update payment status to "Completed"
        if ($payment_method === 'fullpayment' || $remaining_amount <= 0) {
            $payment_status = 'Completed';
            $remaining_amount = 0;

            $update_query = "UPDATE payments SET payment_status = ?, remaining_amount = ? WHERE booking_id = ?";
            $update_stmt = $conn->prepare($update_query);
            if (!$update_stmt) {
                die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
            }

            $update_stmt->bind_param("sds", $payment_status, $remaining_amount, $booking_id);
            if ($update_stmt->execute()) {
                // Redirect to print_receipt.php after the payment is made
                header("Location: print_receipt.php?booking_id=" . urlencode($booking_id) . "&payment_method=" . urlencode($payment_method) . "&amount=" . urlencode($total_amount) . "&payment_status=" . urlencode($payment_status));
                exit;                
            } else {
                echo "Error updating payment status: " . $update_stmt->error;
            }
            $update_stmt->close();
        } else {
            $error = 'An error occurred. Please try again.';
        }
    } else {
        $error = 'Invalid booking ID or payment method.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details</title>
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
        h2 {
            color: #00831D;
            text-align: center;
            margin-bottom: 20px;
        }
        .details {
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #00831D;
            border-radius: 5px;
            background-color: #e0ffe0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        button {
            padding: 12px 25px;
            margin-top: 20px;
            background-color: #00831D;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: 100%;
        }
        button:hover {
            background-color: #005F15;
        }
        .error {
            color: red;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
    <script>
        function confirmPayment(event) {
            event.preventDefault(); // Prevent form submission
            
            Swal.fire({
                title: 'Confirm Payment',
                text: "Are you sure you want to proceed with the payment?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#00831D',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, pay now!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('payment-form').submit(); // Submit form if confirmed
                }
            });
        }
    </script>
</head>
<body>

<div class="main-content">
    <h2>Payment Details</h2>
    <?php if (isset($error)): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <?php
    if (isset($_GET['booking_id'])) {
        $booking_id = htmlspecialchars($_GET['booking_id']);
        
        $query = "SELECT total_cost, downpayment_amount, remaining_amount, payment_status FROM payments WHERE booking_id = ?";
        $stmt = $conn->prepare($query);

        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }

        if (!$stmt->bind_param("s", $booking_id)) {
            die("Bind failed: (" . $stmt->errno . ") " . $stmt->error);
        }

        if (!$stmt->execute()) {
            die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
        }

        $stmt->bind_result($total_cost, $downpayment_amount, $remaining_amount, $payment_status);
        if ($stmt->fetch()) {
            echo '<div class="details">';
            echo '<strong>Total Cost:</strong> ' . htmlspecialchars($total_cost) . '<br>';
            echo '<strong>Downpayment Amount:</strong> ' . htmlspecialchars($downpayment_amount) . '<br>';
            echo '<strong>Remaining Amount:</strong> ' . htmlspecialchars($remaining_amount) . '<br>';
            echo '<strong>Payment Status:</strong> ' . htmlspecialchars($payment_status) . '<br>';
            echo '</div>';

            echo '<form method="POST" id="payment-form" action="">';
            echo '<input type="hidden" name="booking_id" value="' . htmlspecialchars($booking_id) . '">';
            echo '<input type="hidden" name="payment_method" value="fullpayment">';
            echo '<button type="submit" onclick="confirmPayment(event)">Pay</button>';
            echo '</form>';
        } else {
            echo '<div class="error">No payment information found for this booking.</div>';
        }
        $stmt->close();
    } else {
        echo '<div class="error">No booking ID provided.</div>';
    }
    ?>
</div>

</body>
</html>

<?php
ob_end_flush(); // Flush the output buffer and turn off output buffering
?>
