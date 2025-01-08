<?php
include 'mailer.php'; // Ensure this path is correct

$to = 'raffyrapsing1113@gmail.com'; // Replace with the recipient's email address
$subject = 'Test Email';
$body = '<h1>This is a test email</h1><p>If you received this, the mailer is working!</p>';

if (sendEmail($to, $subject, $body)) {
    echo 'Email sent successfully!';
} else {
    echo 'Email could not be sent.';
}
?>
