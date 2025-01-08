<?php 
include('includes/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex; /* Added for centering */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            height: 100vh; /* Full height */
        }
        .main-content {
            max-width: 600px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            height: 40px;
        }
        .title {
            font-size: 1.5em;
            margin-top: 10px;
            color: #00831D;
        }
        #reader {
            width: 100%; /* Full width of the container */
            max-width: 600px; /* Increased max width */
            height: 360px; /* Increased height */
            border: 2px dashed #00831D;
            border-radius: 8px;
            margin: 20px 0;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f9f9f9;
        }
        #result {
            margin-top: 10px;
            font-size: 1.2em;
            color: #333;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            background-color: #e0ffe0;
            border: 1px solid #00831D;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #00831D;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #005F15;
        }
    </style>
</head>
<body>
<div class="main-content mt-5">
    <div class="header">
        <div class="logo">
            <img src="assets/img/nextgen.png" alt="Logo">
        </div>
        <div class="title">Booking Bike Confirmation</div>
    </div>

    <div id="reader"></div>
    <div id="result">Scan a QR code to see the result here!</div>

    <a href="#" class="btn" onclick="resetScanner()">Reset Scanner</a>
</div>

<script>
    let html5QrCode;

    function onScanSuccess(decodedText) {
        // Redirect to booking details page
        window.location.href = `qr-booking-details.php?booking_id=${decodedText}`;
    }

    function onScanError(errorMessage) {
        console.warn(`Code scan error: ${errorMessage}`);
    }

    function resetScanner() {
        document.getElementById('result').innerText = "Scan a QR code to see the result here!";
        startScanner(); // Restart scanning
    }

    function startScanner() {
        html5QrCode = new Html5Qrcode("reader");
        const config = { fps: 20, qrbox: 260, }; // Adjusted qrbox size

        html5QrCode.start(
            { facingMode: "environment" }, config,
            onScanSuccess,
            onScanError
        ).catch(err => {
            console.error(`Unable to start scanning: ${err}`);
            alert('Could not start camera. Please check your permissions.');
        });
    }

    startScanner(); // Start scanning when the page loads
</script>

<?php include('includes/footer.php'); ?>
</body>
</html>

