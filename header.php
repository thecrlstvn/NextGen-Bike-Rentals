<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");  // Redirect to login if not logged in
    exit();
}
include('../functions/myfunctions.php');
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

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

      <!-- Load jQuery first -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Then Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Then your custom script -->
    <script src="assets/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.5"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    
       <!----Alertify JS-----> 
    <link href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" rel="stylesheet"/>
    <link href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" rel="stylesheet"/>

    <!--ALERTIFY JS-->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <title>NextGen AOR</title>
    <link rel="icon" href="admin-assets/img/favicon-admin.ico" type="image/x-icon">

    <style>
      * {
  font-family: 'Aloevera-SemiBold', sans-serif;
  font-weight: normal;
}
  /* Sidebar container */
  #sidebar {
    background-color: #00831D;
    color: white;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    width: 250px;
    z-index: 1000;
  }

  /* Main content margin */
  .main-content {
    margin-left: 250px;
    padding: 20px;
  }

  /* Nav link styling */
  .nav-link {
    color: white;
  }

  /* Active state */
  .nav-link.active {
    background-color: white; /* Background color for active state */
    color: #00831D; /* Text color for active state */
    border-radius: 5px; /* Optional: add rounded corners to the active link */
  }

  /* Accordion button */
  .accordion-button {
    color: white;
    background-color: #00831D;
    border: none;
  }

  /* Accordion button when expanded */
  .accordion-button:not(.collapsed) {
    color: white;
    background-color: #005F15;
  }

  /* Accordion body background */
  .accordion-body {
    background-color: #274e13;
  }

  #sidebar a {
  color: white;
}

#sidebar a:hover {
  color: #cccccc; /* Optional: Hover state color */
}

#sidebar a:focus, #sidebar a:active {
  color: white;
  text-decoration: none; /* Remove underline on click */
}

.sidebar-logo {
    width: 100px; /* Adjust the width as needed */
    height: auto;
  }

  .nav-icon {
    width: 24px; /* Adjust the width as needed */
    height: 24px; /* Adjust the height as needed */
  }
    .header {
      display: flex;
      align-items: center;
      margin-bottom: 20px; /* Space between header and card */
    }
    .header .logo {
      margin-right: 15px; /* Space between logo and text */
    }
    .header .title {
      font-size: 1.5rem; /* Adjust font size as needed */
      font-weight: bold; /* Makes the text bold */
    }
    .card {
      border: none; /* Remove default card border */
      border-radius: 10px; /* Rounds the corners of the card */
      box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Adds a subtle shadow */
    }
    .card-header {
      background-color: #00831D; /* Your preferred color */
      color: white; /* White text color for contrast */
      padding: 15px 20px; /* Adds padding inside the header */
      border-bottom: 1px solid #ddd; /* Subtle bottom border */
      border-radius: 10px 10px 0 0; /* Rounds the top corners */
      font-size: 1.25rem; /* Increases the font size */
      font-weight: bold; /* Makes the text bold */
    }
    .form-control {
      border-radius: 5px; /* Rounds the corners of the input fields */
      box-shadow: inset 0 1px 2px rgba(0,0,0,0.1); /* Adds a subtle inner shadow */
    }
    .img-preview {
      max-width: 150px; /* Adjusts the image preview size */
      height: auto;
      border: 1px solid #ddd; /* Adds a border around the preview */
      border-radius: 5px; /* Rounds the corners of the preview */
      padding: 5px; /* Adds padding inside the border */
    }
    .btn-primary {
      background-color: #00831D; /* Matches your preferred color */
      border-color: #00831D; /* Matches the button border color */
      border-radius: 5px; /* Rounds the corners of the button */
      font-size: 1rem; /* Adjusts the font size of the button */
      padding: 10px 20px; /* Adds padding inside the button */
    }
    .btn-primary:hover {
      background-color: #006b1f; /* Darkens the button color on hover */
      border-color: #006b1f; /* Darkens the button border color on hover */
    }
    .form-label {
      font-weight: bold; /* Makes label text bold */
    }
    .form-group {
      margin-bottom: 1rem; /* Reduces spacing between form groups */
    }
    .form-check {
    display: flex;
    align-items: center;
    }

    .form-check-input {
      margin-right: 10px; /* Adjust spacing between checkbox and label */
    }

    .form-check-label {
      margin-bottom: 0; /* Remove bottom margin for better alignment */
    }

    /* Larger badges */
    .badge {
      font-size: 1rem; /* Slightly smaller font size */
      padding: 0.35rem 0.6rem; /* Slightly reduced padding */
    }

    /* Improved button styles */
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
      font-size: 0.875rem; /* Smaller font size */
      padding: 0.475rem 0.75rem; /* Adjusted padding */
      border-radius: 0.25rem; /* Slightly rounded corners */
      transition: background-color 0.2s, border-color 0.2s; /* Smooth transition */
    }

    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #004085;
    }

    .btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
      font-size: 0.875rem; /* Smaller font size */
      padding: 0.475rem 0.75rem; /* Adjusted padding */
      border-radius: 0.25rem; /* Slightly rounded corners */
      transition: background-color 0.2s, border-color 0.2s; /* Smooth transition */
    }

    .btn-danger:hover {
      background-color: #c82333;
      border-color: #bd2130;
    }

    /* Adjust table styling */
    .table {
      font-size: 0.875rem; /* Slightly smaller font size */
    }

    .table td, .table th {
      padding: 0.5rem; /* Reduced padding */
    }

    .table img {
      max-width: 80px; /* Smaller image size */
      max-height: 80px; /* Smaller image size */
    }

  .back-button {
        display: inline-block;
        margin-bottom: 15px;
        color: #005F15;
        text-decoration: none;
      }
      .back-button:hover {
        text-decoration: underline;
      }
      .card-header {
        background-color: #005F15;
        color: white;
      }
      .card-body {
        padding: 20px;
      }
      .form-control {
        border-radius: 0.25rem;
      }
      .form-control:focus {
        box-shadow: none;
        border-color: #005F15;
      }
      .form-check-input {
        margin-right: 10px;
      }

      .dashboard-card {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            background-color: #f8f9fa; /* Light background for uniformity */
            border: 1px solid #dee2e6; /* Light border for distinction */
            border-radius: 0.375rem; /* Rounded corners */
        }
        .card-logo {
            width: 50px;
            height: 50px;
            margin-right: 20px;
        }
        .dashboard-card-body {
            display: flex;
            align-items: center;
            padding: 1rem;
        }
        .dashboard-card-content {
            text-align: left;
        }
        .dashboard-card-content h3 {
            margin: 0;
            font-size: 2rem; /* Larger font size for emphasis */
        }
        .dashboard-card-description {
            margin-top: 10px;
            color: #6c757d; /* Darker color for description text */
            font-size: 1rem;
        }
        .calendar {
      background-color: white;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .fc-daygrid-event {
      background-color: #28a745;
      color: white;
      border-radius: 5px;
    }
    .fc-toolbar-title {
      font-size: 1.5rem;
      color: #005F15;
    }

    .text-warning {
    color: #ffc107 !important;
}

.btn-outline-success {
    border-color: #28a745;
    color: #28a745;
}
.btn-outline-success:hover {
    background-color: #28a745;
    color: white;
}

.btn-outline-warning {
    border-color: #ffc107;
    color: #ffc107;
}
.btn-outline-warning:hover {
    background-color: #ffc107;
    color: black;
}

.btn-outline-danger {
    border-color: #dc3545;
    color: #dc3545;
}
.btn-outline-danger:hover {
    background-color: #dc3545;
    color: white;
}
        canvas {
            width: 100% !important;  /* Force canvas to be 100% width */
            height: auto !important;  /* Maintain aspect ratio */
        }

        .splash-screen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: #00831D; /* Splash background color */
    z-index: 1000;
}

.splash-logo {
    width: 150px;
    height: auto;
    animation: fade-in 1.5s ease-in-out;
}

@keyframes fade-in {
    from { opacity: 0; }
    to { opacity: 1; }
}

.dropdown-menu-dark {
    background-color: #000000; /* Explicitly set background to black */
}

.dropdown-item {
    color: #ffffff; /* White text color for dropdown items */
}

.dropdown-item:hover {
    background-color: rgba(255, 255, 255, 0.1); /* Optional: Light hover effect */
}
.badge-confirmed {
    background-color: darkgreen;
    color: white;
}

.badge-returned {
    background-color: gold;
    color: black;
}

.badge-pending {
    background-color: darkred;
    color: white;
}

</style>

</head>
<body>
  <?php include('sidebar.php'); ?>