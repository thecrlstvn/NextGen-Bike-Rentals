<?php 
include('includes/header.php');

// Include Dompdf library
require '../vendor/autoload.php'; // Adjust the path if necessary

use Dompdf\Dompdf;

$reportMessage = '';

if (isset($_POST['generateReport'])) {
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $reportFile = "reports/report_" . date("Ymd_His") . ".pdf"; // PDF file name

    // Check if the reports directory exists, if not, create it
    if (!is_dir('reports')) {
        mkdir('reports', 0755, true); // Creates the directory with proper permissions
    }

    // Array to hold summaries
    $summaries = [
        'bookings' => [],
        'payments' => [],
        'returned_bikes' => [],
        'bikes' => [],
        'users' => [],
        'reviews' => [],
    ];

    function fetchData($conn, $query, ...$params) {
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }
        if (!empty($params)) {
            $stmt->bind_param(...$params);
        }
        if (!$stmt->execute()) {
            die("Error executing statement: " . $stmt->error);
        }
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Fetching summaries from the database
    $summaries['bookings']['total'] = fetchData($conn, "SELECT COUNT(*) as count FROM bookings WHERE booking_date BETWEEN ? AND ?", 'ss', $startDate, $endDate)['count'];
    $summaries['bookings']['total_quantity'] = fetchData($conn, "SELECT SUM(quantity) as total FROM bookings WHERE booking_date BETWEEN ? AND ?", 'ss', $startDate, $endDate)['total'];
    $summaries['bookings']['total_revenue'] = fetchData($conn, "SELECT SUM(quantity * CASE WHEN rate_type = 'hourly' THEN hourly_rate ELSE daily_rate END) as revenue FROM bookings b JOIN bikes bi ON b.bikeid = bi.bikeid WHERE booking_date BETWEEN ? AND ?", 'ss', $startDate, $endDate)['revenue'];

    $summaries['payments']['total_received'] = fetchData($conn, "SELECT SUM(downpayment_amount + remaining_amount) as total FROM payments WHERE created_at BETWEEN ? AND ?", 'ss', $startDate, $endDate)['total'];
    $summaries['payments']['total_outstanding'] = fetchData($conn, "SELECT SUM(remaining_amount) as total FROM payments WHERE created_at BETWEEN ? AND ?", 'ss', $startDate, $endDate)['total'];

    $summaries['returned_bikes']['total'] = fetchData($conn, "SELECT COUNT(*) as count FROM returned_bikes WHERE return_time BETWEEN ? AND ?", 'ss', $startDate, $endDate)['count'];

    $summaries['bikes']['total'] = fetchData($conn, "SELECT COUNT(*) as count FROM bikes")['count'];
    $summaries['bikes']['available'] = fetchData($conn, "SELECT COUNT(*) as count FROM bikes WHERE availability_status = 'available'")['count'];

    $summaries['users']['total'] = fetchData($conn, "SELECT COUNT(*) as count FROM users")['count'];

    $summaries['reviews']['total'] = fetchData($conn, "SELECT COUNT(*) as count FROM reviews")['count'];
    $summaries['reviews']['average_rating'] = fetchData($conn, "SELECT AVG(rating) as average FROM reviews")['average'];

    // Create PDF Report using Dompdf
    $dompdf = new Dompdf();

// Prepare HTML content for the PDF
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            background-color: #f9f9f9;
        }
        .header, .footer {
            text-align: center;
            background-color: #00831D;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .header img {
            height: 50px;
            margin-bottom: 10px;
        }
        h1, h2, h3 {
            margin: 5px 0;
        }
        .summary-title {
            margin-top: 20px;
            font-weight: bold;
            font-size: 24px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .details {
            text-align: left;
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Nextgen Bike Rentals Store</h1>
        <h4>Elliptical Road, Barangay Pinyahan, Quezon City Philippines</h4>
        <p>Tel No: 415-1111 / 924-2684</p>
        <p>Email: rentals.nextgenbikes@gmail.com</p>
    </div>
    <h2 class="summary-title">Summary Report</h2>
    <h3 class="summary-title">From ' . htmlspecialchars($startDate ?? 'N/A') . ' to ' . htmlspecialchars($endDate ?? 'N/A') . '</h3>
    
    <table>
        <thead>
            <tr>
                <th>Data Table</th>
                <th>Total</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Bookings</td>
                <td>' . htmlspecialchars($summaries['bookings']['total'] ?? '0') . '</td>
                <td class="details">Total Quantity: ' . htmlspecialchars($summaries['bookings']['total_quantity'] ?? '0') . '<br>Total Revenue: PHP ' . number_format($summaries['bookings']['total_revenue'] ?? 0, 2) . '</td>
            </tr>
            <tr>
                <td>Payments</td>
                <td>PHP ' . number_format($summaries['payments']['total_received'] ?? 0, 2) . '</td>
                <td class="details">Total Outstanding: PHP ' . number_format($summaries['payments']['total_outstanding'] ?? 0, 2) . '</td>
            </tr>
            <tr>
                <td>Returned Bikes</td>
                <td>' . htmlspecialchars($summaries['returned_bikes']['total'] ?? '0') . '</td>
                <td class="details"></td>
            </tr>
            <tr>
                <td>Bikes</td>
                <td>' . htmlspecialchars($summaries['bikes']['total'] ?? '0') . '</td>
                <td class="details">Available: ' . htmlspecialchars($summaries['bikes']['available'] ?? '0') . '</td>
            </tr>
            <tr>
                <td>Users</td>
                <td>' . htmlspecialchars($summaries['users']['total'] ?? '0') . '</td>
                <td class="details"></td>
            </tr>
            <tr>
                <td>Reviews</td>
                <td>' . htmlspecialchars($summaries['reviews']['total'] ?? '0') . '</td>
                <td class="details">Average Rating: ' . round($summaries['reviews']['average_rating'] ?? 0, 2) . '</td>
            </tr>
        </tbody>
    </table>

</body>
</html>
';


    // Load HTML content to Dompdf
    $dompdf->loadHtml($html);
    
    // Set paper size and orientation
    $dompdf->setPaper('A4', 'portrait');
    
    // Render the PDF
    $dompdf->render();
    
    // Save the PDF file
    file_put_contents($reportFile, $dompdf->output());

    // Check if the PDF was generated successfully
    if (file_exists($reportFile)) {
        $reportMessage = "PDF generated successfully: <a href='" . htmlspecialchars($reportFile) . "'>" . htmlspecialchars($reportFile) . "</a>";
    } else {
        $reportMessage = "Failed to generate PDF.";
    }
}
?>

<div class="main-content">
    <div class="container mt-2">
        <!-- Header Section -->
        <div class="header">
            <div class="logo">
                <img src="assets/img/nextgen.png" alt="Logo" style="height: 27px;">
            </div>
            <div class="title">
                Rental Operations on Reports 
            </div>
        </div>

        <!-- Report Section -->
        <div class="report-section mt-4">
            <h2 class="text-center mb-4">Generate Reports</h2>
            <form action="" method="post" class="form-inline justify-content-center mb-4">
                <div class="form-group mx-2">
                    <label for="startDate" class="mr-2">Start Date:</label>
                    <input type="date" id="startDate" name="startDate" required class="form-control">
                </div>
                <div class="form-group mx-2">
                    <label for="endDate" class="mr-2">End Date:</label>
                    <input type="date" id="endDate" name="endDate" required class="form-control">
                </div>
                <button type="submit" name="generateReport" class="btn btn-primary">Generate Report</button>
            </form>

            <?php if ($reportMessage): ?>
                <div class="alert alert-info text-center">
                    <?= $reportMessage; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
