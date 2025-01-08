<?php
session_start(); // Ensure the session is started

// Include database connection and mailer
include 'config/dbcon.php';
include 'mailer.php';
require_once 'phpqrcode/qrlib.php';
require 'vendor/autoload.php';
include('functions/userfunctions.php');

use Cloudinary\Cloudinary;
use Cloudinary\Transformation\Resize;

$cloudinary = new Cloudinary([
    'cloud' => [
        'cloud_name' => 'dsyt4e4fp',
        'api_key'    => '399586786843443',
        'api_secret' => 'HH4mh7xMDej9XRNY06BPrgAEn6M',
    ],
]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure user session is started
    if (!isset($_SESSION['auth_user']['user_id'])) {
        echo "You must be logged in to make a booking.";
        exit();
    }
}
    
    // Retrieve booking information from the POST request
    $userId = $_SESSION['auth_user']['user_id']; // Get user ID from session
    $bike_id = $_POST['bike_id'] ?? null;
    $booking_date = $_POST['booking_date'] ?? null;
    $customer_name = $_POST['customer_name'] ?? null;
    $customer_email = $_POST['customer_email'] ?? null;
    $quantity = $_POST['quantity'] ?? null;
    $pickup_time = $_POST['pickup_time'] ?? null;
    $return_time = $_POST['return_time'] ?? null;
    $payment_method = $_POST['payment_method'] ?? null;
    $insurance = $_POST['insurance'] ?? 50.00;

    // Validate required fields
    $errors = [];
    if (!$bike_id) $errors[] = "Bike ID is missing.";
    if (!$booking_date) $errors[] = "Booking date is missing.";
    if (!$customer_name) $errors[] = "Customer name is missing.";
    if (!$customer_email) $errors[] = "Customer email is missing.";
    if (!$quantity) $errors[] = "Quantity is missing.";
    if (!$payment_method) $errors[] = "Payment option is missing.";

    if (!empty($errors)) {
        die("Error: " . implode(", ", $errors));
    }

    // Fetch bike details
    $query = "SELECT * FROM bikes WHERE bikeid = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $bike_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $bike = $result->fetch_assoc();

    if ($bike) {
        // Calculate total amount
        $total_amount = ($pickup_time && $return_time) ? 
            ($bike['hourly_rate'] * ((strtotime($return_time) - strtotime($pickup_time)) / 3600)) + $insurance :
            $bike['daily_rate'] * $quantity;

        $rate_type = $pickup_time && $return_time ? 'Hourly Rate' : 'Daily Rate';

        $downpayment_percentage = 0.5;
        $downpayment_amount = $payment_method === 'downpayment' ? $total_amount * $downpayment_percentage : 0;
        $remaining_amount = $payment_method === 'downpayment' ? $total_amount - $downpayment_amount : 0;
        $payment_status = $payment_method === 'full' ? 'Completed' : 'Pending';

        // Generate a unique transaction ID based on payment method
        $transaction_id = $payment_method === 'full' ? 'NXTGNFLL-' . uniqid() : 'NXTGNDWN-' . uniqid();

        // Insert booking
        $query = "INSERT INTO bookings (bikeid, booking_date, pickup_time, return_time, quantity, customer_name, customer_email, rate_type, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssssss", $bike_id, $booking_date, $pickup_time, $return_time, $quantity, $customer_name, $customer_email, $rate_type, $userId);
        if ($stmt->execute()) {
            $booking_id = $stmt->insert_id;
    
            // Insert payment record
            $query_payment = "INSERT INTO payments (transaction_id, downpayment_amount, remaining_amount, payment_status, total_cost, payment_method, booking_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt_payment = $conn->prepare($query_payment);
            $stmt_payment->bind_param("ssssdsi", $transaction_id, $downpayment_amount, $remaining_amount, $payment_status, $total_amount, $payment_method, $booking_id);
            $stmt_payment->execute();

            // Generate QR code
            $temp_file = tempnam(sys_get_temp_dir(), 'qr_');
            QRcode::png($booking_id, $temp_file, QR_ECLEVEL_L, 10, 2); // 10 = size, 2 = margin

            // Upload to Cloudinary
            try {
                $cloudinary_upload = $cloudinary->uploadApi()->upload($temp_file, [
                    'folder' => 'qrcodes/',
                    'public_id' => 'booking_' . $booking_id,
                    'overwrite' => true,
                    'resource_type' => 'image',
                    'access_mode' => 'public', // Explicitly make the image public
                ]);

                // Get Cloudinary URL
                $qr_code_url = $cloudinary_upload['secure_url'];

                // Verify upload result (For debugging)
                if (!$qr_code_url) {
                    die("Error: Unable to generate QR code. Please try again.");
                }

                // Insert QR code record
                $query_qr = "INSERT INTO qr_codes (qr_code, booking_id, status, sent_at) VALUES (?, ?, ?, NOW())";
                $stmt_qr = $conn->prepare($query_qr);
                $stmt_qr->bind_param("sis", $qr_code_url, $booking_id, $payment_status);
                $stmt_qr->execute();

                // Prepare email content
                $body = '
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                margin: 0;
                                padding: 0;
                                background-color: #f4f4f4;
                            }
                            .container {
                                width: 100%;
                                max-width: 600px;
                                margin: 20px auto;
                                background-color: #ffffff;
                                border-radius: 8px;
                                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                                overflow: hidden;
                            }
                            .header {
                                background-color: #005F15; /* Your brand color */
                                color: #ffffff;
                                padding: 20px;
                                text-align: center;
                            }
                            .body {
                                padding: 20px;
                                color: #333333;
                            }
                            .footer {
                                background-color: #e9e9e9;
                                text-align: center;
                                padding: 10px;
                                font-size: 12px;
                                color: #666666;
                            }
                            .qr-code {
                                margin: 20px 0;
                            }
                            .btn {
                                display: inline-block;
                                padding: 10px 15px;
                                background-color: #00831D; /* Your brand color */
                                color: #ffffff;
                                text-decoration: none;
                                border-radius: 5px;
                                font-weight: bold;
                                margin-top: 20px;
                            }
                            .btn:hover {
                                background-color: #006d15; /* Darker shade for hover effect */
                            }
                            .booking-details {
                                margin-top: 20px;
                            }
                            .logo {
                                width: 100%; /* Adjust the width as necessary */
                                max-width: 200px; /* Limit max width */
                                margin: 0 auto; /* Center the logo */
                                display: block; /* Ensure it behaves like a block element */
                            }
                        </style>
                    </head>
                    <body>
                        <div class="container">
                            <div class="header">
                            <img src="https://res.cloudinary.com/dsyt4e4fp/image/upload/f_auto,q_auto/ynosdap0nwgcvpde09yl" alt="Logo" class="logo">
                                <h1>Booking Confirmation</h1>
                            </div>
                            <div class="body">
                                <p>Dear <strong>' . htmlspecialchars($customer_name) . '</strong>,</p>
                                <p>Thank you for choosing NextGen Bike Rentals! We are pleased to confirm your booking.</p>
                                <p>Your booking ID is: <strong>' . htmlspecialchars($booking_id) . '</strong></p>
                                <p>This QR code contains your Booking ID that you can present to the staff for Booking Confirmation and Return Bike Confirmation:</p>
                                <div class="qr-code">
                                    <img src="' . htmlspecialchars($qr_code_url) . '" alt="QR Code" style="width: 100%; max-width: 200px;">
                                </div>

                                <div class="booking-details">
                                    <h2>Booking Details</h2>';

                                    // Adding the booking details based on rate type
                                    if (isset($rate_type) && $rate_type == 'Hourly Rate') {
                                        $body .= '<p><strong>Pickup Time:</strong> ' . htmlspecialchars($pickup_time) . '</p>';
                                        $body .= '<p><strong>Return Time:</strong> ' . htmlspecialchars($return_time) . '</p>';
                                        $body .= '<p><strong>Insurance:</strong> 50.00</p>';
                                    } else {
                                        $body .= '<p><strong>Booking Date:</strong> ' . htmlspecialchars($booking_date) . '</p>';
                                    }
                                    
                                    $body .= '<p><strong>Quantity:</strong> ' . htmlspecialchars($quantity) . '</p>
                                    <p><strong>Total Amount:</strong> ' . htmlspecialchars($total_amount) . '</p>
                                    <p><strong>Payment Method:</strong> ' . htmlspecialchars($payment_method) . '</p>
                                    <p>Your transaction ID is: <strong>' . htmlspecialchars($transaction_id) . '</strong></p>
                                </div>
                                <p>We look forward to serving you! If you have any questions, please feel free to contact us.</p>
                            </div>
                            <div class="footer">
                                <p>NextGen Bike Rentals. All Rights Reserved</p>
                            </div>
                        </div>
                    </body>
                    </html>
                ';

                 // Send email
            if (sendEmail($customer_email, "Booking Confirmation", $body)) {
                header("Location: book_confirmation.php?booking_id=$booking_id");
                exit();
            } else {
                echo "Error: Unable to send email confirmation.";
            }

        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }

    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Error: Bike not found.";
}

$stmt->close();
$conn->close();
?>