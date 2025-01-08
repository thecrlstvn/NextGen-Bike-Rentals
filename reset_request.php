<?php
session_start();
include('config/dbcon.php'); // Include your database connection file

if (isset($_POST['reset_request'])) {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id);
        $stmt->fetch();

        // Generate a secure token
        $token = bin2hex(random_bytes(16)); // 32 characters

        // Insert the token into the reset_tokens table
        $stmt = $conn->prepare("INSERT INTO reset_tokens (token, user_id, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("si", $token, $user_id);
        $stmt->execute();

        // Send the reset link to the user's email (implement email logic)
        $reset_link = "http://yourwebsite.com/reset-password.php?token=$token";
        // Use mail() or any email library to send the link
        // mail($email, "Password Reset", "Click here to reset your password: $reset_link");

        $_SESSION['message'] = "If the email exists, a password reset link has been sent.";
    } else {
        $_SESSION['message'] = "Email not found.";
    }

    header('Location: ../forgot-password.php');
    exit();
}
?>
