<?php
require 'vendor/autoload.php'; // Include Composer's autoloader for Guzzle

use GuzzleHttp\Client;

// Use the same PayPal credentials
$clientId = 'YOUR_CLIENT_ID'; // Replace with your PayPal Client ID
$clientSecret = 'YOUR_CLIENT_SECRET'; // Replace with your PayPal Client Secret

// Initialize Guzzle Client for API communication
$client = new Client();

// Obtain an access token
$response = $client->request('POST', 'https://api.sandbox.paypal.com/v1/oauth2/token', [
    'auth' => [$clientId, $clientSecret],
    'form_params' => [
        'grant_type' => 'client_credentials'
    ]
]);

$body = json_decode($response->getBody());
$accessToken = $body->access_token;

// Capture the payment after approval
$orderId = $_GET['token']; // Get the PayPal order ID from the return URL

$response = $client->request('POST', "https://api.sandbox.paypal.com/v2/checkout/orders/$orderId/capture", [
    'headers' => [
        'Authorization' => "Bearer $accessToken",
        'Content-Type' => 'application/json'
    ]
]);

$paymentResult = json_decode($response->getBody());

if ($paymentResult->status === 'COMPLETED') {
    // Payment completed successfully!
    echo "Payment completed successfully!";

    // Extract transaction ID and other relevant details
    $transactionId = $paymentResult->id; // Get the transaction ID
    $totalAmount = $paymentResult->purchase_units[0]->payments->captures[0]->amount->value; // Get the total amount
    $bookingId = $_SESSION['booking_id']; // Assuming booking_id is stored in session

    // Save the booking details to your database (implement this as per your design)
    savePaymentDetails($transactionId, $bookingId, $totalAmount);
} else {
    echo "Payment failed!";
}

// Function to save payment details in the database
function savePaymentDetails($transactionId, $bookingId, $totalAmount) {
    // Assuming you have a PDO connection set up as $pdo
    global $pdo;

    // Prepare and execute the insert statement
    $stmt = $pdo->prepare("INSERT INTO payments (transaction_id, booking_id, total_cost, payment_status, created_at) VALUES (:transaction_id, :booking_id, :total_cost, 'completed', NOW())");
    $stmt->execute([
        'transaction_id' => $transactionId,
        'booking_id' => $bookingId,
        'total_cost' => $totalAmount,
    ]);

    echo "Transaction ID: $transactionId has been stored successfully.";
}
?>
