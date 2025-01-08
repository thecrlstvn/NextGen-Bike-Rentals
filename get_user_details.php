<?php
// Database connection
$servername = "mysql-nextgen.alwaysdata.net"; // or your database host
$username = "nextgen";    // MySQL username
$password = "NextgenBikes@20242025";    // MySQL password
$dbname = "nextgen_database"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming user_id is passed through a session or query parameter
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    echo "User not logged in.";
    exit;
}

// SQL query to fetch customer name and email
$sql = "SELECT fullname, email FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);  // "i" is the type for integer
$stmt->execute();
$stmt->bind_result($name, $email);
$stmt->fetch();

$stmt->close();
$conn->close();

// Output the data in JSON format for App Inventor to use
if ($name && $email) {
    echo json_encode(array("fullname" => $name, "email" => $email));
} else {
    echo json_encode(array("error" => "User not found"));
}
?>

