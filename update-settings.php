<?php  
session_start();
include "config/dbcon.php"; // Path to your database connection
require 'vendor/autoload.php'; // Cloudinary library

// Import Cloudinary namespace
use Cloudinary\Cloudinary;

if (isset($_SESSION['auth']) && $_SESSION['auth'] === true && isset($_SESSION['auth_user']['user_id'])) {
    if (isset($_POST['fullname']) && isset($_POST['email'])) {

        // Cloudinary configuration
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => 'dsyt4e4fp',
                'api_key'    => '399586786843443',
                'api_secret' => 'HH4mh7xMDej9XRNY06BPrgAEn6M',
            ],
        ]);

        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'] ?? '';
        $user_id = $_SESSION['auth_user']['user_id'];

        // Validation
        if (empty($fullname)) {
            $_SESSION['message'] = "Full name is required";
            header("Location: ./settings.php");
            exit;
        } else if (empty($email)) {
            $_SESSION['message'] = "Email is required";
            header("Location: ./settings.php");
            exit;
        }

        // Hash password only if it's not empty
        $hashed_password = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : null;

        // Handle Cloudinary profile image upload
        if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === UPLOAD_ERR_OK) {
            try {
                $uploadedFile = $_FILES['profileImage']['tmp_name'];
                $result = $cloudinary->uploadApi()->upload($uploadedFile, [
                    'folder' => 'profile_image',
                ]);
                $profile_image = $result['secure_url'];
            } catch (Exception $e) {
                $_SESSION['message'] = "Failed to upload image to Cloudinary: " . $e->getMessage();
                header("Location: ./settings.php");
                exit;
            }
        } else {
            $profile_image = $_SESSION['auth_user']['profile_image'] ?? 'assets/img/profile.png';
        }

        // Prepare SQL query
        if ($hashed_password) {
            $sql = "UPDATE users SET fullname=?, email=?, password=?, profile_image=? WHERE user_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $fullname, $email, $hashed_password, $profile_image, $user_id);
        } else {
            $sql = "UPDATE users SET fullname=?, email=?, profile_image=? WHERE user_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $fullname, $email, $profile_image, $user_id);
        }

        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['auth_user']['fullname'] = $fullname;
            $_SESSION['auth_user']['email'] = $email;
            $_SESSION['auth_user']['profile_image'] = $profile_image;
            $_SESSION['message'] = "Your account has been updated successfully";
        } else {
            $_SESSION['message'] = "Failed to update profile: " . $stmt->error;
        }

        $stmt->close();
        header("Location: ./settings.php");
        exit;

    } else {
        $_SESSION['message'] = "Please fill out all required fields";
        header("Location: ./settings.php");
        exit;
    }
} else {
    $_SESSION['message'] = "You must be logged in to update your profile";
    header("Location: ./login.php");
    exit;
}
?>
