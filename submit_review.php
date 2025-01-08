<?php
session_start();
require 'config/dbcon.php'; // Assuming you have this file to connect to your database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the values from the form
    $user_id = $_SESSION['auth_user']['user_id'];
    $slug = $_POST['slug'];
    $rating = (int) $_POST['rating']; // Ensure rating is an integer
    $review_text = $_POST['review_text'];

    // Insert the review into the database
    $stmt = $conn->prepare("INSERT INTO reviews (user_id, slug, rating, review_text, date_posted) VALUES (?, ?, ?, ?, NOW())");
    
    // Check if prepare() was successful
    if ($stmt) {
        // Correct the types and ensure the number of bind variables matches
        $stmt->bind_param("isis", $user_id, $slug, $rating, $review_text);
        if ($stmt->execute()) {
            // Set success message in session
            $_SESSION['message'] = "Review submitted successfully!";
            // Redirect back to the product view page
            header("Location: view_product.php?product=$slug");
        } else {
            // Set error message in session
            $_SESSION['error'] = "Error executing statement: " . $stmt->error;
            // Redirect back to the product view page
            header("Location: view_product.php?product=$slug");
        }
    } else {
        // Set error message in session if prepare failed
        $_SESSION['error'] = "Error preparing statement: " . $conn->error;
        // Redirect back to the product view page
        header("Location: view_product.php?product=$slug");
    }

    $stmt->close();
    $conn->close();
    exit();
}
?>
