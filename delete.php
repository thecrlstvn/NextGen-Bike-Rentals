<?php
// Include database connection
include('../config/dbcon.php'); // Adjust this path as necessary

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $review_id = $_GET['id'];

    // SQL query to delete the review by ID
    $sql = "DELETE FROM reviews WHERE review_id = ?";

    // Prepare and execute the query
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $review_id); // Bind the review_id parameter
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to reviews page with a success message
            header("Location: reviews.php?success=Review+deleted+successfully");
            exit;
        } else {
            echo "Error deleting review: " . mysqli_error($conn);
        }
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
} else {
    echo "No review ID provided."; // Handle the error if no review ID is provided
}

// Close the database connection
mysqli_close($conn);
?>