<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="assets/css/styles1.css">
    <link rel="preconnect" href="//fdn.fontcdn.ir">
    <link rel="preconnect" href="//v1.fontapi.ir">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-brands/css/uicons-brands.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/owl.theme.default.min.css" rel="stylesheet">
    <link href="assets/css/owl.carousel.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=Ab9thVtSfSPe4Fc8gzR_5JI3ItQoqgP-V7ej6DbquvE7d9CYRsrpnnoruExBWRPrz9pCJ9tSFP9Tyb7o&buyer-country=PH&currency=PHP&components=buttons&enable-funding=venmo"data-sdk-integration-source="developer-studio"></script>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <title>Welcome to NextGen</title>
    <link rel="icon" href="assets/img/favicon-user.ico" type="image/x-icon">

    <!----Alertify JS-----> 
    <link href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" rel="stylesheet"/>
    <link href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" rel="stylesheet"/>

    <style> 
        .owl-carousel .item {
            padding: 15px; /* Space around each card */
            box-sizing: border-box; /* Include padding in the element's total width and height */
        }
        .card {
            margin: 0 auto; /* Center the card within its container */
            border: 1px solid #ddd; /* Optional: Add a border to visualize the card area */
        }
        .btn-custom {
            background-color: #005F15;
            color: white;
        }

        .bg-light-green {
            background-color: #E0F9DE;
        }
        .bg-dark-gray {
            background-color: #282828;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 1365px;
            height: 434px;
            margin: 0 auto;
            padding: 0;
            box-sizing: border-box;
        }
        .custom-img {
            max-width: 80%; /* Adjust based on your preference */
            max-height: 100%;
            object-fit: contain;
        }
        .custom-img-developers {
            max-width: 80%;
            max-height: 100%;
            object-fit: contain;
        }

    .logo-text-container {
    display: inline-flex; /* Align logo and text horizontally */
    align-items: center; /* Vertically center items */
    padding: 8px 20px; /* Increased padding for a larger container */
    border: 1px solid darkgrey; /* Black border around the container */
    border-radius: 8px; /* Rounded corners */
  }

  .menu-icon {
    width: 25px; /* Larger icon size */
    height: 25px;
    cursor: pointer;
    margin-right: 15px; /* Increased space between icon and text */
    transition: transform 0.3s ease, opacity 0.3s ease; /* Smooth hover animation */
  }

  .menu-icon:hover {
    transform: scale(1.1); /* Slightly enlarge the icon on hover */
    opacity: 0.8; /* Slight opacity change on hover */
  }

  .nav-text {
    vertical-align: middle;
    color: black; /* Ensure text is visible */
    font-size: 20px; /* Increase font size of the text */
    font-weight: normal; /* Optional: Make the text bold for better visibility */
  }

  /* Dropdown menu */
  .dropdown-menu {
    background-color: white; /* or any contrasting color */
    color: #fff;
    display: none;
    opacity: 0;
    transition: opacity 0.4s ease; /* Smooth fade-in for dropdown */
  }

  .dropdown-show {
    display: block;
    opacity: 1;
  }

  .btn-custom {
    background-color: #00831D;
    color: #fff;
    border-radius: 20px;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    text-decoration: none;
  }
  
  .btn-custom:hover {
    background-color: #006d14; /* Slightly darker shade for hover effect */
  }
  
    .password-container {
      position: relative;
    }
    .password-toggle {
      position: absolute;
      right: 10px;
      top: 105px; 
      transform: translateY(-50%);
      cursor: pointer;
      width: 30px; /* Adjust size as needed */
      height: 30px; /* Adjust size as needed */
    }
    .forgot-password {
      color: #606060;
      text-decoration: none;
      font-size: 14px; /* Adjust font size as needed */
      display: inline-block;
      vertical-align: middle;
      margin-left: 10px; /* Space between the password input and link */
    }
        .bg-custom {
            background-color: #005F15;
        }
        .card-custom {
            border-radius: 20px;
            width: 100%;
            max-width: 370px;
            height: auto;
            margin: auto;
        }
        .card-header img {
            width: 60%;
            height: auto;
            margin-bottom: 10px;
        }
        .checkbox-label {
            color: green;
            font-size: 14px;
        }
        .checkbox-label a {
            color: green;
            text-decoration: underline;
        }
        .image-upload {
            position: relative;
            margin-bottom: 20px;
            text-align: center;
        }
        .image-upload input[type="file"] {
            display: none;
        }
        .avatar-container {
            position: relative;
            display: inline-block;
        }
        .avatar-container img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #00791B;
        }
        .avatar-container label {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            padding: 10px;
            cursor: pointer;
            color: white;
            font-size: 1.2rem; /* Adjust icon size */
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100px; /* Match the avatar size */
            height: 100px; /* Match the avatar size */
        }
        .avatar-container label::before {
            font-weight: 900; /* Adjust icon weight */
            color: white;
            font-size: 24px;
        }
        .avatar-container span {
            display: block;
            margin-top: 10px;
            color: #00791B;
        }

        .profile-img {
        border: 2px solid #00791B; /* Optional: Border color */
        background-color: #f0f0f0; /* Optional: Background color for the image */
    }

        .custom-profile-img {
            width: 150px; /* Adjust size as needed */
            height: 150px; /* Adjust size as needed */
            object-fit: cover;
            border: 2px solid #00831D; /* Green border */
            border-radius: 50%; /* Optional: for circular image */
        }
        .mt-3 {
            margin-top: 1rem; /* Spacing between image and button */
        }
        .custom-vertical-line {
            border-left: 1px solid #dee2e6;
            height: 100%;
            margin: 0 20px;
        }
        .custom-section-title {
            margin-bottom: 20px;
        }
        .custom-delete-account-btn {
            background-color: #dc3545;
            color: white;
            border: none;
        }
        .custom-delete-account-btn:hover {
            background-color: #c82333;
        }
        .custom-form-container {
            padding: 20px;
        }
        
        .dropdown-item img {
            width: 20px; /* Adjust size of the logo */
            height: auto; /* Keep aspect ratio */
            margin-right: 8px; /* Space between logo and text */
        }
        
        .custom-alert {
        width: 100%; /* You can adjust this width */
        padding: 5px; /* Reduce padding */
        font-size: 14px; /* Adjust font size */
        margin-bottom: 5px; /* Control space between alerts */
        }

        #termsContent {
        max-height: 400px; /* Adjust this to suit your design */
        overflow-y: auto;
    }
    </style>

  </head>
  <body>
    <?php include('navbar.php'); ?>