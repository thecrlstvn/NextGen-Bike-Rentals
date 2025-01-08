<?php
$host = "mysql-nextgen.alwaysdata.net";
$username = "nextgen";
$password = "NextgenBikes@20242025";
$database = "nextgen_database";

$conn = new mysqli($host, $username, $password, $database);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the latest location from the database
$sql = "SELECT latitude, longitude FROM biketracking ORDER BY id DESC LIMIT 1"; // Get latest inserted data
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the latest coordinates
    $row = $result->fetch_assoc();
    $latitude = $row['latitude'];
    $longitude = $row['longitude'];

    // Return the coordinates as JSON
    echo json_encode([
        'latitude' => $latitude,
        'longitude' => $longitude
    ]);
} else {
    // Return a default value if no data found
    echo json_encode([
        'latitude' => 0,
        'longitude' => 0
    ]);
}

$conn->close();
?>
