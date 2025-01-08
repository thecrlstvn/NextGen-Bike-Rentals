<?php
$servername = "mysql-nextgen.alwaysdata.net";
$username = "nextgen";
$password = "NextgenBikes@2024205";
$dbname = "nextgen_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$customer_name = $_POST['customer_name'];
$customer_email = $_POST['customer_email'];
$bike_id = $_POST['bike_id'];
$pickup_time = $_POST['pickup_time'];
$booking_date = $_POST['booking_date'];

// Insert data into the database
$sql = "INSERT INTO customers (customer_name, customer_email, bike_id, pickup_time, booking_date)
        VALUES ('$customer_name', '$customer_email', '$bike_id', '$pickup_time', '$booking_date')";

if ($conn->query($sql) === TRUE) {
  echo "Booking submitted successfully!";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
