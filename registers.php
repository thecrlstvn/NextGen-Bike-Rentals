<?php
// Database connection
$servername = "mysql-nextgen.alwaysdata.net";
$username = "nextgen";
$password = "NextgenBikes@20242025";
$dbname = "nextgen_database";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from POST request
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];
$profile_image = ""; // Set default value or empty string

// Check if the email already exists
$checkUser = $conn->query("SELECT * FROM users WHERE email='$email'");
if ($checkUser->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "Email already registered"]);
} else {
    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert user into database
    $sql = "INSERT INTO users (fullname, email, password, profile_image) VALUES ('$fullname', '$email', '$hashed_password', '$profile_image')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "User registered successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
    }
}

// Close the connection
$conn->close();
?>