<?php
session_start();
include('config/dbcon.php'); // Include your database connection

// Check if the user is logged in
if (!isset($_SESSION['auth_user'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

// Check if the wishlist_id is set
if (isset($_POST['wishlist_id'])) {
    $wishlist_id = $_POST['wishlist_id'];
    $user_id = $_SESSION['auth_user']['user_id'];

    // Prepare SQL to remove the item from the wishlist
    $remove_query = "DELETE FROM wishlists WHERE wishlist_id = ? AND user_id = ?";
    $stmt = $conn->prepare($remove_query);
    $stmt->bind_param("ii", $wishlist_id, $user_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Item removed from wishlist successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error removing item: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'No wishlist ID provided']);
}

$conn->close();
?>
