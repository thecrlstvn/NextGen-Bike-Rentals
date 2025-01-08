<?php
include('../config/dbcon.php'); // Include your database connection file

// Check if the ID is set
if (isset($_GET['id'])) {
    $adminId = intval($_GET['id']); // Ensure the ID is an integer

    // Prepare the delete statement
    $sql = "DELETE FROM adminlogin WHERE id = ?";
    
    // Create a prepared statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameter
        $stmt->bind_param("i", $adminId);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Success - redirect back to admin accounts page with a success message
            $stmt->close(); // Close the statement
            $conn->close(); // Close the database connection
            header("Location: admin_accounts.php?message=Admin deleted successfully");
            exit();
        } else {
            // Error - redirect back with an error message
            $stmt->close(); // Close the statement
            $conn->close(); // Close the database connection
            header("Location: admin_accounts.php?error=Error deleting admin");
            exit();
        }
    } else {
        // Error preparing statement
        $conn->close(); // Close the database connection
        header("Location: admin_accounts.php?error=Error preparing statement");
        exit();
    }
} else {
    // No ID provided
    $conn->close(); // Close the database connection
    header("Location: admin_accounts.php?error=No admin ID provided");
    exit();
}
