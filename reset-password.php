<?php
session_start();
ob_start(); // Start output buffering
include('config/dbcon.php'); // Include your database connection file
include('includes/header.php'); // Include your header file

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Validate the token
    $query = "SELECT user_id FROM reset_tokens WHERE token = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        if (isset($_POST['update_password_btn'])) {
            // Validate the new password
            if ($_POST['new_password'] === $_POST['confirm_password']) {
                $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                $userId = $user['user_id'];

                // Update the user's password
                $updateQuery = "UPDATE users SET password = ? WHERE user_id = ?";
                $updateStmt = $conn->prepare($updateQuery);
                if (!$updateStmt) {
                    die("Prepare failed: " . $conn->error);
                }
                $updateStmt->bind_param("si", $new_password, $userId);
                $updateStmt->execute();

                // Optionally delete the token after use
                $deleteQuery = "DELETE FROM reset_tokens WHERE token = ?";
                $deleteStmt = $conn->prepare($deleteQuery);
                if (!$deleteStmt) {
                    die("Prepare failed: " . $conn->error);
                }
                $deleteStmt->bind_param("s", $token);
                $deleteStmt->execute();

                $_SESSION['message'] = "Your password has been reset successfully. You can now log in.";
                header('Location: login.php');
                exit();
            } else {
                $_SESSION['message'] = "Passwords do not match.";
            }
        }
    } else {
        $_SESSION['message'] = "Invalid or expired token. Please request a new password reset link.";
        header('Location: forgot-password.php');
        exit();
    }
} else {
    $_SESSION['message'] = "No token provided. Please request a new password reset link.";
    header('Location: forgot-password.php');
    exit();
}

// The rest of your HTML form code...
?>

<!-- HTML Form for Resetting Password -->
<div class="py-5" style="background-color: #005F15;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card" style="border-radius: 20px;">
                    <div class="card-header text-center">
                        <img src="assets/images/login-side.png" alt="Reset Password" class="img-fluid" style="max-width: 100%; height: auto; margin-bottom: 15px;">
                        <h2 style="color: #00791B; font-weight: 900;">Reset Your Password</h2>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_SESSION['message'])): ?>
                            <div class='alert alert-warning'><?= $_SESSION['message']; ?></div>
                            <?php unset($_SESSION['message']); ?>
                        <?php endif; ?>

                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Enter your new password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Re-enter your new password" required>
                            </div>
                            <button type="submit" name="update_password_btn" class="btn btn-success" style="width: 100%; height: 50px; font-size: 17px;">Update Password</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <a href="login.php" style="color: #606060; text-decoration: none;">Back to Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<?php
ob_end_flush(); // End output buffering and flush output
?>
