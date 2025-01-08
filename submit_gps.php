<?php
$host = "mysql-nextgen.alwaysdata.net";
$username = "nextgen";
$password = "NextgenBikes@20242025";
$database = "nextgen_database";

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Log incoming POST data
file_put_contents("debug.log", "POST Data: " . json_encode($_POST) . "\n", FILE_APPEND);

// Check if latitude and longitude are provided in the POST request
if (isset($_POST['latitude']) && isset($_POST['longitude'])) {
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Prepare and execute SQL query to insert data into the database
    $stmt = $conn->prepare("INSERT INTO biketracking (latitude, longitude) VALUES (?, ?)");
    $stmt->bind_param("dd", $latitude, $longitude);

    if ($stmt->execute()) {
        echo "Data inserted successfully.";
    } else {
        echo "Database error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Latitude and longitude are missing.";
}

$conn->close();
?>
