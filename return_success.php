<?php include('includes/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Successful</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #e9ecef;
            color: #333;
            font-family: 'Arial', sans-serif;
        }
        .main-content {
            max-width: 600px;
            margin: 100px auto; /* Center the content vertically */
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center; /* Center text within the card */
        }
        h2 {
            color: #00831D; /* Change heading color to match your theme */
            margin-bottom: 20px;
        }
        .btn-custom {
            background-color: #00831D;
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .btn-custom:hover {
            background-color: #005F15;
        }
    </style>
</head>
<body>

<div class="main-content">
    <h2>Return Successful!</h2>
    <p>Thank you for returning our bike. We appreciate your cooperation!</p>
    <a href="return-bike-scan.php" class="btn btn-custom">Go Back to Home</a>
</div>

<?php include('includes/footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.5.2.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
