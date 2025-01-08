<?php 
include('includes/header.php');

// Fetching total bookings
$bookingQuery = "SELECT COUNT(booking_id) AS totalBookings FROM bookings";
$bookingResult = mysqli_query($conn, $bookingQuery);
if (!$bookingResult) {
    die("Query failed: " . mysqli_error($conn));
}
$bookingData = mysqli_fetch_assoc($bookingResult);
$totalBookings = $bookingData['totalBookings'];

// Fetching total sales
$salesQuery = "SELECT SUM(total_cost) AS totalSales FROM payments"; // Adjust 'amount' as necessary
$salesResult = mysqli_query($conn, $salesQuery);
if (!$salesResult) {
    die("Query failed: " . mysqli_error($conn));
}
$salesData = mysqli_fetch_assoc($salesResult);
$totalSales = $salesData['totalSales'];

// Fetching available bikes
$bikesQuery = "SELECT COUNT(bikeid) AS availableBikes FROM bikes WHERE availability_status = 'available'"; // Check availability field
$bikesResult = mysqli_query($conn, $bikesQuery);
if (!$bikesResult) {
    die("Query failed: " . mysqli_error($conn));
}
$bikesData = mysqli_fetch_assoc($bikesResult);
$availableBikes = $bikesData['availableBikes'];

// Fetching total users
$usersQuery = "SELECT COUNT(user_id) AS totalUsers FROM users"; // Adjust 'user_id' and table name as necessary
$usersResult = mysqli_query($conn, $usersQuery);
if (!$usersResult) {
    die("Query failed: " . mysqli_error($conn));
}
$usersData = mysqli_fetch_assoc($usersResult);
$totalUsers = $usersData['totalUsers'];
// Fetching monthly bookings data
$bookingsMonthlyQuery = "
    SELECT MONTH(booking_date) AS month, COUNT(booking_id) AS totalBookings 
    FROM bookings 
    GROUP BY MONTH(booking_date)
";
$bookingsMonthlyResult = mysqli_query($conn, $bookingsMonthlyQuery);
$bookingsData = [];
while ($row = mysqli_fetch_assoc($bookingsMonthlyResult)) {
    $bookingsData[$row['month']] = $row['totalBookings'];
}

// Fetching monthly payments data
$paymentsMonthlyQuery = "
    SELECT MONTH(created_at) AS month, SUM(total_cost) AS totalPayments 
    FROM payments 
    GROUP BY MONTH(created_at)
";
$paymentsMonthlyResult = mysqli_query($conn, $paymentsMonthlyQuery);
$paymentsData = [];
while ($row = mysqli_fetch_assoc($paymentsMonthlyResult)) {
    $paymentsData[$row['month']] = $row['totalPayments'];
}

// Prepare data for the bookings chart
$bookingsChartLabels = [];
$bookingsChartData = [];
for ($i = 1; $i <= 12; $i++) {
    $bookingsChartLabels[] = date("F", mktime(0, 0, 0, $i, 1)); // Month names
    $bookingsChartData[] = isset($bookingsData[$i]) ? $bookingsData[$i] : 0; // Default to 0 if no data
}

// Prepare data for the payments chart
$paymentsChartLabels = [];
$paymentsChartData = [];
for ($i = 1; $i <= 12; $i++) {
    $paymentsChartLabels[] = date("F", mktime(0, 0, 0, $i, 1)); // Month names
    $paymentsChartData[] = isset($paymentsData[$i]) ? $paymentsData[$i] : 0; // Default to 0 if no data
}

// Fetching recent bookings
$bookingsSummaryQuery = "
    SELECT booking_id, booking_date, rate_type, customer_name, customer_email 
    FROM bookings 
    ORDER BY booking_date DESC 
    LIMIT 5"; // Adjust limit as necessary
$bookingsSummaryResult = mysqli_query($conn, $bookingsSummaryQuery);

// Fetching recent registered users
$usersSummaryQuery = "
    SELECT user_id, profile_image, full_name 
    FROM users 
    ORDER BY created_at DESC 
    LIMIT 5"; // Adjust limit as necessary
$usersSummaryQuery = "SELECT user_id, profile_image, fullname FROM users"; // Adjust your query
$usersSummaryResult = mysqli_query($conn, $usersSummaryQuery);

// Check for query success
if (!$usersSummaryResult) {
    die("Query failed: " . mysqli_error($conn)); // Output error message if query fails
}

// Fetching recent payments
$paymentsSummaryQuery = "
    SELECT payment_id, booking_id, total_cost, payment_method, payment_status, transaction_id 
    FROM payments 
    ORDER BY created_at DESC 
    LIMIT 5"; // Adjust limit as necessary
$paymentsSummaryResult = mysqli_query($conn, $paymentsSummaryQuery);

// Fetching bike details
$bikesSummaryQuery = "
    SELECT bikeid, image, bike_name, availability_status, hourly_rate, daily_rate, status 
    FROM bikes 
    LIMIT 5"; // Adjust limit as necessary
$bikesSummaryResult = mysqli_query($conn, $bikesSummaryQuery);

// Fetching category details
$categoriesSummaryQuery = "
    SELECT category_name, image, status 
    FROM categories 
    LIMIT 5"; // Adjust limit as necessary
$categoriesSummaryResult = mysqli_query($conn, $categoriesSummaryQuery);

?>

<div class="main-content">
    <div class="container mt-2">
        <!-- Header Section -->
        <div class="header">
            <div class="logo">
                <img src="assets/img/nextgen.png" alt="Logo" style="height: 27px;">
            </div>
            <div class="title">
                Dashboard Rental Operations
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card-body text-left text-black">
                    <h5>Philippine Standard Date and time</h5>
                    <h5 id="current-date"></h5>
                    <h5 id="current-time"></h5>
                </div>
            </div>
        </div>

        <div class="container mt-4">
            <div class="row">
                <!-- Booking Overview Card -->
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="dashboard-card-body">
                            <img src="assets/img/bookmark.png" alt="Booking Logo" class="card-logo">
                            <div class="dashboard-card-content">
                                <h3><?php echo $totalBookings; ?></h3>
                                <div class="dashboard-card-description">Total Bookings</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sales Overview Card -->
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="dashboard-card-body">
                            <img src="assets/img/growth.png" alt="Sales Logo" class="card-logo">
                            <div class="dashboard-card-content">
                                <h3>
                                    <?php 
                                        echo !empty($totalSales) ? $totalSales : '0'; 
                                    ?>
                                </h3>
                                <div class="dashboard-card-description">Total Sales</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bikes Overview Card -->
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="dashboard-card-body">
                            <img src="assets/img/available-bikes.png" alt="Available Bikes Logo" class="card-logo">
                            <div class="dashboard-card-content">
                                <h3><?php echo $availableBikes; ?></h3>
                                <div class="dashboard-card-description">Available Bikes</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Users Overview Card -->
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="dashboard-card-body">
                            <img src="assets/img/user.png" alt="Users Logo" class="card-logo">
                            <div class="dashboard-card-content">
                                <h3><?php echo $totalUsers; ?></h3>
                                <div class="dashboard-card-description">Total Users</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<div class="row mt-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" style="background-color: #005F15;">
                <h5 class="text-white">Monthly Overview</h5>
            </div>
            <div class="card-body">
                <!-- Booking Chart -->
                <h5>Monthly Bookings Overview</h5>
                <canvas id="bookingsChart" style="width: 100%; height: 300px;"></canvas> <!-- Adjust height as needed -->

                <!-- Payment Chart -->
                <h5>Monthly Payments Overview</h5>
                <canvas id="paymentsChart" style="width: 100%; height: 300px;"></canvas> <!-- Adjust height as needed -->
            </div>
        </div>
    </div>
</div>
        </div>
    </div>

        <div class="card">
        <div class="card-header">
            <h5>Booking Calendar</h5>
        </div>
        <div class="card-body">
            <div id="calendar"></div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Booking Details</h5>
            </div>
            <div class="modal-body" id="eventDetails">
                <!-- Details will be populated here -->
            </div>
        </div>
    </div>
</div>


    <div class="container mt-4">
    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="bookings-tab" data-toggle="tab" href="#bookings" role="tab" aria-controls="bookings" aria-selected="true">Recent Bookings</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="false">Recent Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="payments-tab" data-toggle="tab" href="#payments" role="tab" aria-controls="payments" aria-selected="false">Recent Payments</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="bikes-tab" data-toggle="tab" href="#bikes" role="tab" aria-controls="bikes" aria-selected="false">Bikes Summary</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="categories-tab" data-toggle="tab" href="#categories" role="tab" aria-controls="categories" aria-selected="false">Categories Summary</a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="bookings" role="tabpanel" aria-labelledby="bookings-tab">
            <div class="card mt-4">
                <div class="card-header" style="background-color: #005F15;">
                    <h5 class="text-white">Recent Bookings</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Booking Date</th>
                                <th>Rate Type</th>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($bookingsSummaryResult)): ?>
                                <tr>
                                    <td><?php echo $row['booking_id']; ?></td>
                                    <td><?php echo date('Y-m-d', strtotime($row['booking_date'])); ?></td>
                                    <td><?php echo $row['rate_type']; ?></td>
                                    <td><?php echo $row['customer_name']; ?></td>
                                    <td><?php echo $row['customer_email']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
            <div class="card mt-4">
                <div class="card-header" style="background-color: #005F15;">
                    <h5 class="text-white">Recent Users</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Profile Image</th>
                                <th>Full Name</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = mysqli_fetch_assoc($usersSummaryResult)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                                <td><img src="<?php echo htmlspecialchars($row['profile_image']); ?>" alt="Profile Image" style="height: 50px;"></td>
                                <td><?php echo htmlspecialchars($row['fullname']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="payments-tab">
            <div class="card mt-4">
                <div class="card-header" style="background-color: #005F15;">
                    <h5 class="text-white">Recent Payments</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Payment ID</th>
                                <th>Booking ID</th>
                                <th>Total Cost</th>
                                <th>Payment Method</th>
                                <th>Payment Status</th>
                                <th>Transaction ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($paymentsSummaryResult)): ?>
                                <tr>
                                    <td><?php echo $row['payment_id']; ?></td>
                                    <td><?php echo $row['booking_id']; ?></td>
                                    <td><?php echo number_format($row['total_cost'], 2); ?></td>
                                    <td><?php echo $row['payment_method']; ?></td>
                                    <td><?php echo $row['payment_status']; ?></td>
                                    <td><?php echo $row['transaction_id']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="bikes" role="tabpanel" aria-labelledby="bikes-tab">
            <div class="card mt-4">
                <div class="card-header" style="background-color: #005F15;">
                    <h5 class="text-white">Bikes Summary</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Bike Image</th>
                                <th>Bike Name</th>
                                <th>Availability Status</th>
                                <th>Hourly Rate</th>
                                <th>Daily Rate</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($bikesSummaryResult)): ?>
                                <tr>
                                    <td><img src="<?php echo $row['image']; ?>" alt="Bike Image" style="height: 50px;"></td>
                                    <td><?php echo $row['bike_name']; ?></td>
                                    <td><?php echo $row['availability_status']; ?></td>
                                    <td><?php echo number_format($row['hourly_rate'], 2); ?></td>
                                    <td><?php echo number_format($row['daily_rate'], 2); ?></td>
                                    <td>
                                        <span class="badge <?php echo $row['status'] == 0 ? 'badge-success' : 'badge-danger'; ?>">
                                            <?php echo $row['status'] == 0 ? 'Visible' : 'Hidden'; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="categories" role="tabpanel" aria-labelledby="categories-tab">
            <div class="card mt-4">
                <div class="card-header" style="background-color: #005F15;">
                    <h5 class="text-white">Categories Summary</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Image</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($categoriesSummaryResult)): ?>
                                <tr>
                                    <td><?php echo $row['category_name']; ?></td>
                                    <td><img src="<?php echo $row['image']; ?>" alt="Category Image" style="height: 50px;"></td>
                                    <td>
                                    <span class="badge <?php echo $row['status'] == 0 ? 'badge-success' : 'badge-danger'; ?>">
                                        <?php echo $row['status'] == 0 ? 'Visible' : 'Hidden'; ?>
                                    </span>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<script>
    // Monthly Bookings Chart
    var ctxBookings = document.getElementById('bookingsChart').getContext('2d');
    var bookingsChart = new Chart(ctxBookings, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($bookingsChartLabels); ?>,
            datasets: [{
                label: 'Total Bookings',
                data: <?php echo json_encode($bookingsChartData); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Monthly Payments Chart
    var ctxPayments = document.getElementById('paymentsChart').getContext('2d');
    var paymentsChart = new Chart(ctxPayments, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($paymentsChartLabels); ?>,
            datasets: [{
                label: 'Total Payments',
                data: <?php echo json_encode($paymentsChartData); ?>,
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<?php include('includes/footer.php'); ?>