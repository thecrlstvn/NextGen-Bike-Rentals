<?php
// Database connection
$servername = "localhost"; // Your database server
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "final_project"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get bikeid from query string
$bikeid = $_GET['bikeid'];

// SQL query to fetch bike product
$sql = "SELECT * FROM bikes WHERE bikeid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $bikeid);
$stmt->execute();
$result = $stmt->get_result();

// Check if bike exists
if ($result->num_rows > 0) {
    // Fetch the product data
    $bike = $result->fetch_assoc();
    echo json_encode($bike); // Convert to JSON format
} else {
    echo json_encode(["error" => "Bike not found"]);
}

// Close the connection
$conn->close();
?>
