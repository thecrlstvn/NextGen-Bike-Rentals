<?php 
session_start();

if (!isset($_SESSION['student_no'])) {
    header("Location: login.php");
    exit();
}

$servername = "mysql-irans.alwaysdata.net";
$username = "irans";
$db_password = "iransdatabase@2024";
$dbname = "irans_database";

$conn = new mysqli($servername, $username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$student_no = $_SESSION['student_no'];
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" href="/www/uploads/logo.png" type="image/png">
    <link href="css/home.css" rel="stylesheet" />
</head>

<body>

<!-- Side Menu -->
<div id="sideMenu" class="side-menu">
    <br><br>
    <!-- Centered Logo and Title -->
    <div class="side-logo-container">
        <span class="system-title">INCIDENT REPORTS AND NOTIFICATION SYSTEM</span><br><br>
        <img src="images/logo.png" alt="Logo" class="logo">
    </div>
    
    <!-- Navigation Links -->
    <a href="Home.php">HOME</a>
    <a href="report.php">REPORT</a>
    <a href="Notification.php">NOTIFICATION</a>
    <a href="send_message.php">MESSAGE</a>
    <a href="profile.php">PROFILE</a>
    <a href="login.html">LOG OUT</a>
</div>

<button class="menu-toggle" onclick="toggleMenu()">☰</button>

<!-- Image Grid -->
 <br><br><br> <br><br><br>
<div class="image-grid">
    <div class="image-item">
        <img src="images/image1.jpg" alt="Label 1" class="grid-image">
        <p>GRASS FIRE</p>
    </div>
    <div class="image-item">
        <img src="images/image2.jpg" alt="Label 2" class="grid-image">
        <p>WEATHER</p>
    </div>
    <div class="image-item">
        <img src="images/image3.jpg" alt="Label 3" class="grid-image">
        <p>FLOOD</p>
    </div>
    <div class="image-item">
        <img src="images/image4.jpg" alt="Label 4" class="grid-image">
        <p>Label 4</p>
    </div>
    <div class="image-item">
        <img src="images/image5.jpg" alt="Label 5" class="grid-image">
        <p>Label 5</p>
    </div>
    <div class="image-item">
        <img src="images/image6.jpg" alt="Label 6" class="grid-image">
        <p>Label 6</p>
    </div>
    <div class="image-item">
        <img src="images/image7.jpg" alt="Label 7" class="grid-image">
        <p>Label 7</p>
    </div>
    <div class="image-item">
        <img src="images/image9.jpg" alt="Label 8" class="grid-image">
        <p>Label 8</p>
    </div>
</div>

<script>
function toggleMenu() {
    document.getElementById("sideMenu").classList.toggle("open");
}
</script>

</body>
</html>
