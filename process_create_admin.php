<?php
session_start();
include('../config/dbcon.php');

// Include Composer's autoloader for Cloudinary
require_once __DIR__ . '/../vendor/autoload.php'; // Adjust path to vendor/autoload.php

use Cloudinary\Cloudinary;

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initialize Cloudinary
$cloudinary = new Cloudinary([
    'cloud' => [
        'cloud_name' => 'dsyt4e4fp',
        'api_key'    => '399586786843443',
        'api_secret' => 'HH4mh7xMDej9XRNY06BPrgAEn6M',
    ],
]);

// Include the mailer file
require_once __DIR__ . '/../mailer.php'; // Adjust path to mailer.php

// Define a secure PIN code for admin creation
define('ADMIN_PIN', '6398436'); // Change this to a secure PIN

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entered_pin = $_POST['pin']; // Get the entered PIN

    // Check if the entered PIN is correct
    if ($entered_pin === ADMIN_PIN) {
        // Check if an image file is uploaded
        if (isset($_FILES['admin_image']) && $_FILES['admin_image']['error'] == 0) {
            $admin_image = $_FILES['admin_image']['tmp_name']; // Temporary file path

            // Upload the image to Cloudinary
            try {
                $cloudinary_upload = $cloudinary->uploadApi()->upload($admin_image, [
                    'folder' => 'admin_images/', // Specify the folder for admin images
                    'public_id' => 'admin_' . uniqid(), // Unique public ID for each admin
                    'overwrite' => true,
                    'resource_type' => 'image',
                    'access_mode' => 'public',
                ]);

                // Get the secure URL of the uploaded image
                $admin_image_url = $cloudinary_upload['secure_url'];

                // Retrieve other admin details
                $email = $_POST['email'];
                $admin_name = $_POST['admin_name'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

                // Insert the admin account details into the database
                $query = "INSERT INTO adminlogin (email, admin_name, admin_image, password) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($query);

                // Check for SQL preparation error
                if (!$stmt) {
                    error_log("SQL Preparation Error: " . $conn->error);
                    header("Location: index.php?error=" . urlencode("Database error: " . $conn->error));
                    exit();
                }

                // Bind parameters and execute the statement
                $stmt->bind_param("ssss", $email, $admin_name, $admin_image_url, $password);
                
                if ($stmt->execute()) {
                    // Generate a random One-Time Code (OTC)
                    $otc = rand(100000, 999999);
                    $_SESSION['otc'] = $otc; // Store OTC in session for verification
                    $_SESSION['otc_email'] = $email; // Store email to send OTC

                    // Prepare the email content
                    $subject = 'Your One-Time Code for Admin Account Verification';
                    $body = '
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Admin Account Verification</title>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                background-color: #f4f4f4;
                                padding: 20px;
                                color: #333;
                            }
                            .container {
                                background-color: #fff;
                                padding: 20px;
                                border-radius: 8px;
                                box-shadow: 0 0 10px rgba(0,0,0,0.1);
                            }
                            h1 {
                                color: #00831D;
                            }
                            .code {
                                font-size: 24px;
                                font-weight: bold;
                                color: #ff5722;
                            }
                        </style>
                    </head>
                    <body>
                        <div class="container">
                            <h1>Welcome, ' . htmlspecialchars($admin_name) . '!</h1>
                            <p>Your admin account has been successfully created.</p>
                            <p>Please use and enter the following One-Time Code (OTC) to complete your setup:</p>
                            <div class="code">' . $otc . '</div>
                            <p>Thank you for joining us!</p>
                        </div>
                    </body>
                    </html>';

                    // Send OTC via the mailer function
                    if (sendEmail($email, $subject, $body)) {
                        header("Location: verify_otc.php"); // Redirect to OTC verification page
                        exit();
                    } else {
                        error_log("Error sending email to " . $email);
                        header("Location: index.php?error=" . urlencode("Error sending email!"));
                        exit();
                    }
                } else {
                    error_log("Error creating admin account: " . $stmt->error);
                    header("Location: index.php?error=" . urlencode("Error creating admin account: " . $stmt->error));
                    exit();
                }
            } catch (Exception $e) {
                error_log("Error uploading image: " . $e->getMessage());
                header("Location: index.php?error=" . urlencode("Error uploading image: " . $e->getMessage()));
                exit();
            }
        } else {
            error_log("Error uploading image: " . $_FILES['admin_image']['error']);
            header("Location: index.php?error=" . urlencode("Error uploading image!"));
            exit();
        }
    } else {
        // Redirect back with an error message for incorrect PIN
        header("Location: index.php?error=" . urlencode("Incorrect PIN Code!"));
        exit();
    }
}
?>
