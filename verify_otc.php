<?php
session_start();

// Check if OTC is set in the session
if (!isset($_SESSION['otc'])) {
    header("Location: index.php?error=" . urlencode("OTC not found!"));
    exit();
}

// Handle form submission
$message = ""; // Variable for success/error messages
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entered_otc = $_POST['otc']; // Get the entered OTC from the form

    if ($entered_otc == $_SESSION['otc']) {
        // OTC is correct, redirect to admin page
        unset($_SESSION['otc']); // Clear the OTC from the session
        header("Location: index.php"); // Redirect to admin.php
        exit();
    } else {
        $message = "Incorrect OTC. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTC Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #00831D, #004F1A);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            max-width: 450px;
            padding: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            font-weight: bold;
            color: #005F15;
            margin-bottom: 20px;
        }
        .form-control {
            height: 45px;
            font-size: 16px;
        }
        .btn-success {
            width: 100%;
            height: 45px;
            font-size: 18px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-success:hover {
            background-color: #006f1a;
        }
        .alert {
            font-size: 14px;
        }
        a.link-secondary {
            color: #006f1a;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        a.link-secondary:hover {
            color: #005015;
        }
        .logo {
            display: block;
            margin: 0 auto 20px auto;
            width: 370px; /* Adjust as per logo size */
        }
    </style>
</head>
<body>
    <div class="container">
    <img src="admin-assets/images/nextgen.png" alt="Logo" class="logo">
        <h2>Verify Your One-Time Code</h2>
        <?php if ($message): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="otc" class="form-label">Enter your One-Time Code:</label>
                <input type="text" id="otc" name="otc" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Verify</button>
        </form>
    </div>
</body>
</html>
