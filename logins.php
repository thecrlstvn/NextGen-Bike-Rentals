<?php
// Database connection
$servername = "mysql-nextgen.alwaysdata.net";
$username = "nextgen";
$password = "NextgenBikes@20242025";
$dbname = "nextgen_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(array("success" => false, "message" => "Connection failed: " . $conn->connect_error)));
}

// Get data from POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Validate inputs
    if (empty($email) || empty($pass)) {
        echo json_encode(array("success" => false, "message" => "Email and password are required."));
        exit;
    }

    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verify the password (make sure passwords are hashed in the database)
        if (password_verify($pass, $row['password'])) {
            // Password is correct
            header('Content-Type: application/json');
            echo json_encode(array("success" => true, "message" => "Login successful."));
        } else {
            // Wrong password
            echo json_encode(array("success" => false, "message" => "Incorrect password."));
        }
    } else {
        // User not found
        echo json_encode(array("success" => false, "message" => "User not found."));
    }

    $stmt->close();
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request method."));
}

$conn->close();
?>
