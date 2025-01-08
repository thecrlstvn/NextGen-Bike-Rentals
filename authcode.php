<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");


session_start();
include('../config/dbcon.php');
require '../vendor/autoload.php'; // Ensure you have this path correct
include '../mailer.php'; 

use Cloudinary\Cloudinary;

// Set up Cloudinary configuration
$cloudinary = new Cloudinary([
    'cloud' => [
        'cloud_name' => 'dsyt4e4fp', // Replace with your Cloudinary cloud name
        'api_key'    => '399586786843443', // Replace with your Cloudinary API key
        'api_secret' => 'HH4mh7xMDej9XRNY06BPrgAEn6M', // Replace with your Cloudinary API secret
    ],
]);


// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['register_btn'])) {
    // reCAPTCHA configuration
    $recaptchaSecret = '6Leb_GcqAAAAAJVN5-JeuSExFWkpUsWRTvm9v0Mr';
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Verify the reCAPTCHA response
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecret&response=$recaptchaResponse");
    $responseKeys = json_decode($response, true);

    if (intval($responseKeys["success"]) !== 1) {
        // If reCAPTCHA is not completed or invalid
        $_SESSION['message'] = "Please complete the CAPTCHA.";
        header('Location: ../register.php');
        exit();
    }

    // Proceed with the registration process if reCAPTCHA is verified
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

    // Check if email already exists
    $check_email_query = "SELECT email FROM users WHERE LOWER(email) = LOWER(?)";
    $stmt = $conn->prepare($check_email_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $check_email_query_run = $stmt->get_result();

    if ($check_email_query_run->num_rows > 0) {
        $_SESSION['message'] = "Email already exists";
        header('Location: ../register.php');
        exit();
    } else {
        if ($password === $cpassword) {
            // Handle profile image upload to Cloudinary
            $profile_image = 'profile.png'; // Default profile image

            if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === UPLOAD_ERR_OK) {
                // Upload to Cloudinary
                try {
                    $uploadedFile = $_FILES['profileImage']['tmp_name'];
                    $result = $cloudinary->uploadApi()->upload($uploadedFile, [
                        'folder' => 'profile_image', // Optional: specify a folder
                    ]);

                    // Retrieve the secure URL of the uploaded image
                    $profile_image = $result['secure_url'];
                } catch (Exception $e) {
                    $_SESSION['message'] = 'Failed to upload image to Cloudinary: ' . $e->getMessage();
                    header('Location: ../register.php');
                    exit();
                }
            }

            // Hash the password before saving it
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user into the database using prepared statement
            $insert_query = "INSERT INTO users (fullname, email, password, profile_image) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param("ssss", $fullname, $email, $hashed_password, $profile_image);
            $insert_query_run = $stmt->execute();

            if ($insert_query_run) {
                $_SESSION['message'] = "Registered Successfully";
                header('Location: ../login.php');
                exit();
            } else {
                $_SESSION['message'] = "Something went wrong during registration. Please try again.";
                header('Location: ../register.php');
                exit();
            }
        } else {
            $_SESSION['message'] = "Passwords do not match.";
            header('Location: ../register.php');
            exit();
        }
    }

} if (isset($_POST['login_btn'])) {
        // reCAPTCHA configuration
        $recaptchaSecret = '6Leb_GcqAAAAAJVN5-JeuSExFWkpUsWRTvm9v0Mr';
        $recaptchaResponse = $_POST['g-recaptcha-response'];
    
        // Verify the reCAPTCHA response
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecret&response=$recaptchaResponse");
        $responseKeys = json_decode($response, true);
    
        if (intval($responseKeys["success"]) !== 1) {
            // If reCAPTCHA is not completed or invalid
            $_SESSION['message'] = "Please complete the CAPTCHA.";
            header('Location: ../login.php');
            exit();
        }
    
        // Continue with the login process if reCAPTCHA is verified
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
    
        // Check if user exists
        $query = "SELECT user_id, fullname, email, profile_image, password FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
    
            // Verify password
            if (password_verify($password, $user['password'])) {
                // Set user_id in the session
                $_SESSION['auth_user'] = [
                    'user_id' => $user['user_id'], // Ensure 'user_id' is correctly assigned
                    'fullname' => $user['fullname'],
                    'email' => $user['email'],
                    'profile_image' => $user['profile_image'],
                ];
                $_SESSION['auth'] = true;
    
                $_SESSION['message'] = "Logged in successfully!";
                header('Location: ../index.php');
                exit();
            } else {
                $_SESSION['message'] = "Invalid password.";
                header('Location: ../login.php');
                exit();
            }
        } else {
            $_SESSION['message'] = "Email not found.";
            header('Location: ../login.php');
            exit();
        }
    }
    
?>