<?php
// Database connection
$host = "mysql-nextgen.alwaysdata.net";
$username = "nextgen";
$password = "NextgenBikes@20242025";
$database = "nextgen_database";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch bookings
$sql = "SELECT booking_id, user_id, customer_name, customer_email, bikeid AS bike_id, quantity, 
        rate_type, booking_date, pickup_time, return_time, status 
        FROM bookings";
$result = $conn->query($sql);

$events = [];
if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Ensure pickup_time and return_time are formatted correctly
            $pickup_time = !empty($row['pickup_time']) ? $row['pickup_time'] : '00:00';
            $return_time = !empty($row['return_time']) ? $row['return_time'] : '01:00'; // Default to 1 hour later

            $start = date('Y-m-d\TH:i', strtotime($row['booking_date'] . ' ' . $pickup_time));
            $end = date('Y-m-d\TH:i', strtotime($row['booking_date'] . ' ' . $return_time));

            // Assign a title based on customer name or another relevant field
            $title = "Booking by " . $row['customer_name'];

            $events[] = [
                'id' => $row['booking_id'],
                'user_id' => $row['user_id'],
                'customer_name' => $row['customer_name'],
                'customer_email' => $row['customer_email'],
                'bike_id' => $row['bike_id'],
                'quantity' => $row['quantity'],
                'rate_type' => $row['rate_type'],
                'booking_date' => $row['booking_date'],
                'pickup_time' => $pickup_time,
                'return_time' => $return_time,
                'status' => $row['status'],
                'title' => $title,
                'start' => $start,
                'end' => $end
            ];
        }
    } else {
        error_log("No bookings found.");
    }
} else {
    error_log("Query Error: " . $conn->error);
}

$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($events);
?>
