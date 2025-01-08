<?php
$host = "mysql-nextgen.alwaysdata.net";
$username = "nextgen";
$password = "NextgenBikes@20242025";
$database = "nextgen_database";

 $conn = mysqli_connect($host, $username, $password, $database);

 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$bikeid = $_POST['bikeid'];
$booking_date = $_POST['booking_date'];
$pickup_time = $_POST['pickup_time'];
$return_time = $_POST['return_time'];
$quantity = $_POST['quantity'];
$rate_type = $_POST['rate_type'];
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$user_id = $_POST['user_id'];

// Get bike details
$sql_get_bike = "SELECT bike_name, hourly_rate, daily_rate, qty FROM bikes WHERE bikeid = '$bikeid'";
$result = $conn->query($sql_get_bike);
$bike = $result->fetch_assoc();

// Calculate booking duration
$pickup_datetime = strtotime("$booking_date $pickup_time");
$return_datetime = strtotime("$booking_date $return_time");

$duration_in_hours = ($return_datetime - $pickup_datetime) / 3600; // Duration in hours

$price = 0;
if ($rate_type == 'hourly') {
    $price = $bike['hourly_rate'] * $duration_in_hours;  // Calculate price based on hourly rate
} elseif ($rate_type == 'daily') {
    $duration_in_days = ceil($duration_in_hours / 24);  // Round up to nearest day
    $price = $bike['daily_rate'] * $duration_in_days;  // Calculate price based on daily rate
}

// Check bike availability
if ($bike['qty'] >= $quantity) {
    // Update bike quantity
    $new_qty = $bike['qty'] - $quantity;
    $update_qty_sql = "UPDATE bikes SET qty = '$new_qty' WHERE bikeid = '$bikeid'";
    $conn->query($update_qty_sql);

    // Insert booking into database
    $insert_sql = "INSERT INTO bookings (bikeid, booking_date, pickup_time, return_time, quantity, rate_type, customer_name, customer_email, user_id, total_price)
                   VALUES ('$bikeid', '$booking_date', '$pickup_time', '$return_time', '$quantity', '$rate_type', '$fullname', '$email', '$user_id', '$price')";

    if ($conn->query($insert_sql) === TRUE) {
        echo "Success";  // Return success response
    } else {
        echo "Error: " . $conn->error;  // Handle errors
    }
} else {
    echo "Not enough bikes available.";  // If not enough bikes are available
}

$conn->close();
?>
