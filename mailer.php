<?php
// Import the necessary classes from PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php'; // Ensure this path is correct based on your project structure

// Function to send an email
function sendEmail($to, $subject, $body) {
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com'; // Your SMTP server
        $mail->SMTPAuth   = true; // Enable SMTP authentication
        $mail->Username   = 'rental.nextgenbikes@gmail.com'; // SMTP username
        $mail->Password   = 'aknr jzlc xjfi mroy'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port       = 587; // TCP port to connect to

        // Recipients
        $mail->setFrom('rental.nextgenbikes@gmail.com', 'NextGen AOR Integrated Mail'); // Sender must match your username
        $mail->addAddress($to); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject; // Email subject
        $mail->Body    = $body; // Email body

        // Send the email
        $mail->send(); // Send the email
        return true; // Return true if sent successfully
    } catch (Exception $e) {
        // Debugging output
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false; // Return false if there was an error
    }
}
?>
