<?php
session_start();
include('config/dbcon.php');

// Check if user is logged in
if (!isset($_SESSION['auth_user'])) {
    $_SESSION['message'] = "Please log in to add items to your wishlist.";
    header('Location: login.php');
    exit();
}

// Retrieve user_id from session
$user_id = $_SESSION['auth_user']['user_id'];

// Debugging: Check if user_id is set
if (empty($user_id)) {
    echo "User ID is NULL or empty. Please check session variables.";
    print_r($_SESSION); // Check session contents
    exit();
}

// Get bike ID from request
if (isset($_POST['bike_id'])) {
    $bike_id = $_POST['bike_id'];

    // Validate bike_id
    if (filter_var($bike_id, FILTER_VALIDATE_INT) === false) {
        $_SESSION['message'] = "Invalid bike ID.";
        header('Location: index.php');
        exit();
    }

    // Check if the item is already in the wishlist
    $check_query = "SELECT * FROM wishlists WHERE user_id = ? AND bikeid = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ii", $user_id, $bike_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['message'] = "This bike is already in your wishlist.";
    } else {
        // Add item to wishlist
        $insert_query = "INSERT INTO wishlists (user_id, bikeid) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("ii", $user_id, $bike_id);
        
        if ($stmt->execute()) {
            $_SESSION['message'] = "Bike added to wishlist!";
        } else {
            $_SESSION['message'] = "Error adding bike to wishlist: " . $stmt->error; // Added error details
        }
    }
} else {
    $_SESSION['message'] = "No bike ID provided.";
}

// Redirect to the wishlist page
header('Location: wishlist.php');
exit();
