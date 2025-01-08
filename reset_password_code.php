<?php
session_start();
include('config/dbcon.php'); // Include your database connection file

if (isset($_POST['reset_password_btn'])) {
    $token = $_POST['token'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

    // Get user_id from the token
    $stmt = $conn->prepare("SELECT user_id FROM reset_tokens WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();

    if ($user_id) {
        // Update the user's password
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $new_password, $user_id);
        $stmt->execute();

        // Optionally delete the token
        $stmt = $conn->prepare("DELETE FROM reset_tokens WHERE token = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();

        $_SESSION['message'] = "Your password has been reset successfully.";
        header('Location: login.php'); // Redirect to login or home page
        exit();
    } else {
        $_SESSION['message'] = "Invalid token.";
        header('Location: forgot-password.php');
        exit();
    }
}
?>
