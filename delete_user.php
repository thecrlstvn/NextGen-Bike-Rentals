<?php
include('../config/dbcon.php'); // Include your database connection file

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    
    // Prepare a DELETE statement
    $sql = "DELETE FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete user.']);
    }

    $stmt->close();
}
$conn->close();
?>

