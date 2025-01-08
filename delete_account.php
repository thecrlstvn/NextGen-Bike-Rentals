<?php
session_start();
include('config/dbcon.php'); // Include your database connection

// Check if the user is logged in
if (!isset($_SESSION['auth_user'])) {
    $_SESSION['message'] = "You need to be logged in to delete your account.";
    header('Location: login.php');
    exit();
}

// Get the user_id from session
$user_id = $_SESSION['auth_user']['user_id'];

try {
    // Check if the connection is valid
    if (!$conn) {
        throw new Exception("Database connection failed.");
    }

    // Prepare the SQL statement to delete the user account
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    
    // Check if the statement was prepared successfully
    if (!$stmt) {
        throw new Exception("Failed to prepare the SQL statement: " . $conn->error);
    }

    // Bind parameters (the second argument is the type: "i" for integer)
    $stmt->bind_param('i', $user_id); // 'i' indicates that $user_id is an integer

    // Execute the query
    if ($stmt->execute()) {
        // Account successfully deleted
        session_destroy(); // Destroy the session
        $_SESSION['message'] = "Your account has been successfully deleted.";
        header('Location: index.php'); // Redirect to homepage or login page
        exit();
    } else {
        $_SESSION['message'] = "Failed to delete your account. Please try again.";
        header('Location: settings.php'); // Redirect back to profile settings
        exit();
    }
} catch (mysqli_sql_exception $e) {
    // Handle any mysqli errors
    $_SESSION['message'] = "MySQLi Error: " . $e->getMessage();
    header('Location: settings.php');
    exit();
} catch (Exception $e) {
    // Handle other exceptions
    $_SESSION['message'] = "Error: " . $e->getMessage();
    header('Location: settings.php');
    exit();
} finally {
    // Close the statement and database connection if they exist
    if (isset($stmt) && $stmt instanceof mysqli_stmt) {
        $stmt->close();
    }
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->close();
    }
}
