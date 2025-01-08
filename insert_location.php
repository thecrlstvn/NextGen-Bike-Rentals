<?php
    // Database configuration
    $host = "mysql-nextgen.alwaysdata.net"; // Your host
    $username = "nextgen"; // Your username
    $password = "NextgenBikes@20242025"; // Your password
    $database = "nextgen_database"; // Your database name
    
    $conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the latitude and longitude from the POST data
    $latitude = isset($_POST['lat']) ? $_POST['lat'] : null;
    $longitude = isset($_POST['lng']) ? $_POST['lng'] : null;

    // Check if latitude and longitude are valid
    if ($latitude !== null && $longitude !== null) {
        // Insert data into the bike_tracking table
        $stmt = $conn->prepare("INSERT INTO biketracking (latitude, longitude) VALUES (?, ?)");
        $stmt->bind_param("dd", $latitude, $longitude);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Invalid data received.";
    }
}

$conn->close();
?>
