<?php
session_start();
ob_start(); // Start output buffering
include('config/dbcon.php'); // Include your database connection file
include('includes/header.php'); // Include your header file
include 'mailer.php'; // Ensure the mailer is included

if (isset($_POST['reset_password_btn'])) {
    $email = $_POST['email'];

    // Check if email exists in the database
    $query = "SELECT user_id FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Generate a secure token and reset link
        $token = bin2hex(random_bytes(50));
        $resetLink = "http://nextgen.alwaysdata.net/reset-password.php?token=" . urlencode($token);

        // Store the token in the reset_tokens table
        $userId = $user['user_id'];
        $insertQuery = "INSERT INTO reset_tokens (token, user_id, created_at) VALUES (?, ?, NOW())";
        $insertStmt = $conn->prepare($insertQuery);
        if (!$insertStmt) {
            die("Prepare failed: " . $conn->error);
        }
        $insertStmt->bind_param("si", $token, $userId);
        $insertStmt->execute();

        // Call sendEmail function with a nicely formatted HTML email
        $subject = "Password Reset Request";
        // Define your Cloudinary image URL
        $cloudinaryImageUrl = "https://res.cloudinary.com/dsyt4e4fp/image/upload/v1729317127/logo-nextgen_vhrnan.png"; // replace with your actual URL

        $message = "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 20px;
                }
                .container {
                    max-width: 600px;
                    margin: auto;
                    background: #fff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                h2 {
                    color: #00791B;
                    text-align: center; /* Center the heading */
                    margin-top: 10px; /* Add some margin to the top */
                }
                img {
                    display: block; /* Makes the image a block element */
                    margin: 0 auto; /* Center the image */
                    max-width: 100%; /* Responsive image */
                    height: auto; /* Maintain aspect ratio */
                }
                p {
                    line-height: 1.5;
                }
                a {
                    display: inline-block;
                    padding: 10px 15px;
                    background-color: #00831D;
                    color: white;
                    text-decoration: none;
                    border-radius: 5px;
                    text-align: center; /* Center text in the button */
                }
                a:hover {
                    background-color: #006d14;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <img src='$cloudinaryImageUrl' alt='Logo' style='max-width: 200px; height: auto; margin-bottom: 15px;'>
                <h2>Password Reset Request</h2>
                <p>Hello, Nexties!</p>
                <p>We received a request to reset your password. Please click the button below to reset it:</p>
                <a href='$resetLink'>Reset Your Password</a>
                <p>If you did not request this, please ignore this email.</p>
                <p>Thank you!</p>
            </div>
        </body>
        </html>
        ";

        // Send the email
        $sendStatus = sendEmail($email, $subject, $message);


        if ($sendStatus === true) {
            $_SESSION['message'] = "A reset link has been sent to your email.";
        } else {
            $_SESSION['message'] = "Failed to send reset link. " . $sendStatus;
        }
    } else {
        $_SESSION['message'] = "Email not found. Please try again.";
    }

    header('Location: forgot-password.php');
    exit();
}
?>

<div class="py-5" style="background-color: #005F15;">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card" style="border-radius: 20px;">
                    <div class="card-header text-center">
                        <img src="assets/images/login-side.png" alt="Header Image" class="img-fluid" style="max-width: 70%; margin-top: 5px; margin-bottom: 5px;">
                        <h4 style="font-weight: 900; margin-top: 10px;">Reset your <span style="color: #00791B;">Password</span></h4>
                    </div>
                    <div class="card-body">
                        <form action="forgot-password.php" method="POST">
                            <?php if (isset($_SESSION['message'])): ?>
                                <div class='alert alert-warning'><?= $_SESSION['message']; ?></div>
                                <?php unset($_SESSION['message']); ?>
                            <?php endif; ?>

                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="name@example.com" style="height: 50px;" required>
                                <label for="exampleInputEmail1">Email address</label>
                            </div>

                            <button type="submit" name="reset_password_btn" class="btn" style="background-color: #00831D; color: white; width: 100%; height: 60px; font-size: 17px;">Send Reset Link</button>
                        </form>
                        <div class="text-end mt-3">
                            <a href="login.php" style="color: #606060; text-decoration: none;">Back to Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
ob_end_flush(); // End output buffering
include('includes/footer.php'); 
?>
