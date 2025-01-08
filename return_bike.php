<?php 
include('includes/header.php'); 

$booking_id = $_GET['booking_id']; // Get the booking_id from the URL

// Fetch booking details along with bike name and status using the booking_id
$sql = "SELECT b.*, bk.bike_name 
        FROM bookings b 
        JOIN bikes bk ON b.bikeid = bk.bikeid 
        WHERE b.booking_id = ?";
$stmt = $conn->prepare($sql);

// Check for errors in preparing the statement
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();

if (!$booking) {
    echo "No booking found!";
    exit;
}

// Define badge color based on status
$badgeColor = '';
switch ($booking['status']) {
    case 'Completed':
        $badgeColor = 'success'; // Bootstrap class for success
        break;
    case 'Pending':
        $badgeColor = 'warning'; // Bootstrap class for warning
        break;
    case 'Cancelled':
        $badgeColor = 'danger'; // Bootstrap class for danger
        break;
    default:
        $badgeColor = 'secondary'; // Default badge color
        break;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Bike</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert@2"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e9ecef;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .main-content {
            max-width: 600px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            margin: auto;
            margin-top: 50px;
            text-align: center; /* Center text within the card */
        }
        .logo {
            max-width: 150px; /* Adjust logo size as needed */
            margin-bottom: 20px; /* Space between logo and title */
        }
        .btn-custom {
            background-color: #00831D;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn-custom:hover {
            background-color: #005F15;
        }
        .form-control, .form-control:focus {
            border-color: #00831D;
            box-shadow: none;
        }
        .form-label {
            font-weight: bold;
        }
        h2 {
            color: #00831D;
            margin-bottom: 20px;
        }
        .badge-lg {
            font-size: 1rem; /* Moderate font size */
            padding: 0.4em 0.8em; /* Moderate padding */
            border-radius: 0.25rem; /* Slightly round the corners */
        }
    </style>
</head>
<body>
<div class="container">
    <div class="main-content">
        <img src="assets/img/nextgen.png" alt="Logo" class="logo"> <!-- Replace with your logo path -->
        <h2>Return Bike</h2>
        <p><strong>Bike Name:</strong> <?php echo htmlspecialchars($booking['bike_name']); ?></p>
        <p><strong>Customer Name:</strong> <?php echo htmlspecialchars($booking['customer_name']); ?></p>
        <p>
            <strong>Status:</strong> 
            <span class="badge badge-<?php echo $badgeColor; ?> badge-lg">
                <?php echo htmlspecialchars($booking['status']); ?>
            </span>
        </p>

        <form method="POST" action="process_return.php">
            <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
            <div class="form-group">
                <label for="notes" class="form-label">Confirmed by:</label>
                <textarea class="form-control" name="notes" rows="4" placeholder="Please put return Bike Confirmator" required></textarea>
            </div>
            <button type="submit" class="btn btn-custom btn-block">Submit Return</button>
        </form>
    </div>
</div>

<?php include('includes/footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.5.2.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
