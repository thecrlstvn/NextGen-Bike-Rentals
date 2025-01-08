<?php
session_start(); // Start the session

include('../functions/myfunctions.php'); // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']); // Trim whitespace
    $password = $_POST['password'];

    // Validate email and password inputs
    if (empty($email) || empty($password)) {
        $error = "Email and Password are required!";
        header("Location: index.php?error=" . urlencode($error));
        exit();
    }

    // Prepare query to check if the admin exists
    $query = "SELECT * FROM adminlogin WHERE email = ?";
    $stmt = $conn->prepare($query);
    
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $admin['password'])) {
            // Clear any existing sessions
            session_unset(); // Clear all session variables
            session_destroy(); // Destroy the previous session
            session_start(); // Start a new session
            
            // Set session with admin details
            $_SESSION['admin'] = $admin['admin_name'];  // Store admin name in session
            $_SESSION['admin_id'] = $admin['id'];        // Store admin ID in session

            header("Location: ./dashboard.php"); // Redirect to the admin dashboard
            exit();
        } else {
            // Handle incorrect password
            $error = "Invalid email or password!";
            header("Location: index.php?error=" . urlencode($error));
            exit();
        }
    } else {
        // Handle case where email is not found
        $error = "Invalid email or password!";
        header("Location: index.php?error=" . urlencode($error));
        exit();
    }
}
?>
