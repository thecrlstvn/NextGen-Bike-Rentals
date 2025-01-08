<?php
require 'vendor/autoload.php'; // Include Composer's autoloader

use GuzzleHttp\Client;

$clientId = 'Ab9thVtSfSPe4Fc8gzR_5JI3ItQoqgP-V7ej6DbquvE7d9CYRsrpnnoruExBWRPrz9pCJ9tSFP9Tyb7o'; // Replace with your Client ID
$clientSecret = 'EJua1jhpWmPlrY474raq_Wb4yFh0ykPv_q5d5cSEOnCTsXiQuhyqAVlviYF8vwbJD4-4YvLdjW9HrGaQ'; // Replace with your Client Secret

// Create a Guzzle client
$client = new Client();

// Function to get access token
function getAccessToken($client, $clientId, $clientSecret) {
    $response = $client->request('POST', 'https://api.sandbox.paypal.com/v1/oauth2/token', [
        'auth' => [$clientId, $clientSecret],
        'form_params' => [
            'grant_type' => 'client_credentials',
        ],
    ]);

    $body = json_decode($response->getBody());
    return $body->access_token;
}

// Function to create payment
function createPayment($client, $accessToken, $total_amount, $bike_id, $quantity) {
    // Prepare the payment details
    $payment = [
        'intent' => 'sale',
        'payer' => [
            'payment_method' => 'paypal',
        ],
        'transactions' => [[
            'amount' => [
                'total' => number_format($total_amount, 2, '.', ''), // Format the amount
                'currency' => 'PHP', // Currency code
            ],
            'description' => 'Booking for bike ID: ' . htmlspecialchars($bike_id), // Description of the payment
        ]],
        'redirect_urls' => [
            'return_url' => 'http://localhost/final_project/success.php', // Change this to your project path
            'cancel_url' => 'http://localhost/final_project/cancel.php', // Change this to your project path
        ],
    ];

    // JSON encode the payment array
    $paymentJson = json_encode($payment);

    // Send the payment request to the payment gateway API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/payments/payment");
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $accessToken,
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $paymentJson);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the request
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($httpCode == 201) {
        // Payment created successfully
        $paymentResponse = json_decode($response, true);
        // Redirect the user to the approval URL
        $approvalUrl = $paymentResponse['links'][1]['href']; // The approval link to redirect
        header("Location: $approvalUrl");
        exit();
    } else {
        // Handle errors
        echo "Error creating payment: " . $response;
    }

    // Close the cURL session
    curl_close($ch);
}

// Function to execute payment
function executePayment($client, $accessToken, $paymentId, $payerId) {
    $response = $client->request('POST', "https://api.sandbox.paypal.com/v1/payments/payment/$paymentId/execute", [
        'headers' => [
            'Authorization' => "Bearer $accessToken",
            'Content-Type' => 'application/json',
        ],
        'json' => [
            'payer_id' => $payerId,
        ],
    ]);

    // Decode the response
    $paymentResponse = json_decode($response->getBody(), true);

    // Check if the payment was successful and get the transaction_id
    if (isset($paymentResponse['transactions'][0]['related_resources'][0]['sale']['id'])) {
        return $paymentResponse['transactions'][0]['related_resources'][0]['sale']['id']; // Return the transaction_id
    }

    return null; // Return null if not found
}

// Retrieve bike_id and rate type from URL parameters
$bike_id = $_GET['bikeid']; // Assume bike_id is passed as a URL parameter
$rate_type = $_GET['rate_type']; // Assume rate_type is also passed as a URL parameter ('hourly' or 'daily')
$quantity = $_GET['quantity']; // Quantity of bikes being booked
$customer_name = $_GET['customer_name']; // Customer's name
$customer_email = $_GET['customer_email']; // Customer's email

// Get the price based on the rate type
$total_amount = getBikePrice($bike_id, $rate_type, $quantity); // This gets the actual price from the database

// Check if bike_id is valid and amount is correct
if (!$bike_id || $total_amount <= 0 || !$customer_name || !$customer_email) {
    die("Invalid input data.");
}

// Check for payment approval
if (isset($_GET['paymentId']) && isset($_GET['PayerID'])) {
    $paymentId = $_GET['paymentId'];
    $payerId = $_GET['PayerID'];

    // Execute the payment
    $accessToken = getAccessToken($client, $clientId, $clientSecret);
    $transaction_id = executePayment($client, $accessToken, $paymentId, $payerId);

    // Check if the transaction was successful
    if ($transaction_id) {
        echo "Payment successful! Transaction ID: " . htmlspecialchars($transaction_id);
        
        // Store the booking first
        $booking_id = storeBookingDetails($bike_id, $quantity, $rate_type, $customer_name, $customer_email);

        // Store the transaction ID and other payment details in the payments table
        storePaymentDetails($booking_id, $transaction_id, $total_amount);
    } else {
        echo "Payment failed!";
    }
} else {
    // Get an access token and create a payment
    $accessToken = getAccessToken($client, $clientId, $clientSecret);
    createPayment($client, $accessToken, $total_amount, $bike_id, $quantity);
}

// Function to get bike price based on rate type and quantity
function getBikePrice($bike_id, $rate_type, $quantity) {
    global $pdo; // Assume you have a PDO connection set up

    // Prepare the query based on rate type
    if ($rate_type === 'hourly') {
        $stmt = $pdo->prepare("SELECT hourly_rate AS rate FROM bikes WHERE bikeid = :bikeid");
    } elseif ($rate_type === 'daily') {
        $stmt = $pdo->prepare("SELECT daily_rate AS rate FROM bikes WHERE bikeid = :bikeid");
    } else {
        return 0; // Invalid rate type
    }

    $stmt->execute(['bikeid' => $bike_id]);
    $bike = $stmt->fetch();

    return $bike ? $bike['rate'] * $quantity : 0; // Return the total price based on quantity
}

// Function to store booking details in the bookings table
function storeBookingDetails($bike_id, $quantity, $rate_type, $customer_name, $customer_email) {
    global $pdo; // Ensure you have a PDO connection set up

    try {
        // Prepare the SQL statement
        $stmt = $pdo->prepare("INSERT INTO bookings (bikeid, booking_date, pickup_time, return_time, quantity, rate_type, status, bike_size, customer_name, customer_email) 
                                VALUES (:bikeid, NOW(), NULL, NULL, :quantity, :rate_type, 'confirmed', NULL, :customer_name, :customer_email)");
        $stmt->execute([
            'bikeid' => $bike_id,
            'quantity' => $quantity,
            'rate_type' => $rate_type,
            'customer_name' => $customer_name,
            'customer_email' => $customer_email,
        ]);

        return $pdo->lastInsertId(); // Return the booking ID
    } catch (PDOException $e) {
        // Handle errors (log, notify, etc.)
        error_log("Database error: " . $e->getMessage());
        die("Failed to store booking details.");
    }
}

// Function to store payment details in the payments table
function storePaymentDetails($booking_id, $transaction_id, $total_amount) {
    global $pdo; // Ensure you have a PDO connection set up

    try {
        // Calculate downpayment and remaining amount
        $downpayment_amount = $total_amount * 0.1; // For example, 10% downpayment
        $remaining_amount = $total_amount - $downpayment_amount;

        // Prepare the SQL statement
        $stmt = $pdo->prepare("INSERT INTO payments (downpayment_amount, remaining_amount, payment_status, created_at, total_cost, payment_method, booking_id, transaction_id) 
                                VALUES (:downpayment_amount, :remaining_amount, 'completed', NOW(), :total_cost, 'paypal', :booking_id, :transaction_id)");
        $stmt->execute([
            'downpayment_amount' => $downpayment_amount,
            'remaining_amount' => $remaining_amount,
            'total_cost' => $total_amount,
            'booking_id' => $booking_id,
            'transaction_id' => $transaction_id,
        ]);
    } catch (PDOException $e) {
        // Handle errors (log, notify, etc.)
        error_log("Database error: " . $e->getMessage());
        die("Failed to store payment details.");
    }
}
?>
