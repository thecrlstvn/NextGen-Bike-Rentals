<?php 
include('includes/header.php');

// Ensure database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set the number of results per page
$results_per_page = 10; // Adjust this number as needed

// Get selected year and month from the form submission
$selected_year = isset($_GET['year']) ? (int)$_GET['year'] : '';
$selected_month = isset($_GET['month']) ? (int)$_GET['month'] : '';

// Create SQL WHERE conditions for filtering
$where_conditions = [];
if ($selected_year) {
    $where_conditions[] = "YEAR(bk.booking_date) = $selected_year";
}
if ($selected_month) {
    $where_conditions[] = "MONTH(bk.booking_date) = $selected_month";
}

// Combine conditions for the query
$where_clause = !empty($where_conditions) ? 'WHERE ' . implode(' AND ', $where_conditions) : '';

// Find out the total sales data with filters
$query_total = "
    SELECT 
        SUM(p.total_cost) AS total_sales,
        SUM(p.downpayment_amount) AS total_downpayment,
        SUM(CASE WHEN p.payment_status = 'Completed' THEN p.total_cost ELSE 0 END) AS total_full_payment,
        COUNT(*) AS total_bookings
    FROM 
        bookings bk 
    JOIN 
        payments p ON bk.booking_id = p.booking_id
    $where_clause
";

// Execute the query
$result_total = mysqli_query($conn, $query_total);

// Check if the query was successful
if ($result_total === false) {
    // Query failed, display the error
    echo "Error executing query: " . mysqli_error($conn);
} else {
    // Fetch the result if the query was successful
    $row_total = mysqli_fetch_assoc($result_total);
    
    // Check if the result has data
    $totalSales = !empty($row_total['total_sales']) ? $row_total['total_sales'] : 0;

}

$total_sales = $row_total['total_sales'] ?? 0;
$total_downpayment = $row_total['total_downpayment'] ?? 0;
$total_full_payment = $row_total['total_full_payment'] ?? 0;
$total_bookings = $row_total['total_bookings'] ?? 0;

// Calculate the number of results for pagination
$query_count = "SELECT COUNT(*) AS total FROM bookings bk $where_clause";
$result_count = mysqli_query($conn, $query_count);
// Execute the query
$result_count = mysqli_query($conn, $query_count);

// Check if the query was successful
if ($result_count === false) {
    // Query failed, display the error
    echo "Error executing query: " . mysqli_error($conn);
} else {
    // Fetch the result if the query was successful
    $row_count = mysqli_fetch_assoc($result_count);

    // Check if the result has data
    $totalCount = !empty($row_count['total']) ? $row_count['total'] : 0;
}

$total_results = $row_count['total'] ?? 0;

// Calculate total pages
$total_pages = ceil($total_results / $results_per_page);

// Determine current page number
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$current_page = max(1, min($current_page, $total_pages)); // Ensure the current page is within valid bounds

// Calculate the starting limit for the SQL query
$starting_limit = ($current_page - 1) * $results_per_page;

// SQL query to fetch filtered and paginated data for sales and payments
$query = "
    SELECT
        bk.booking_id,
        b.bike_name,
        b.bike_brand,
        b.hourly_rate,
        b.daily_rate,
        bk.booking_date,
        bk.pickup_time,
        bk.return_time,
        bk.quantity,
        bk.rate_type,
        p.downpayment_amount,
        p.total_cost,
        p.payment_status,
        p.created_at AS payment_date,
        p.payment_method
    FROM 
        bookings bk
    JOIN 
        bikes b ON bk.bikeid = b.bikeid
    JOIN 
        payments p ON bk.booking_id = p.booking_id
    $where_clause
    ORDER BY 
        bk.booking_date DESC
    LIMIT $starting_limit, $results_per_page
";

// Initialize sales data for chart
$sales_data = [];
if ($result = mysqli_query($conn, $query)) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Group sales data by month
        $month = date('F', strtotime($row['booking_date']));
        if (!isset($sales_data[$month])) {
            $sales_data[$month] = 0;
        }
        $sales_data[$month] += $row['total_cost'];
    }
} else {
    // Handle SQL query error
    echo "Error executing query: " . mysqli_error($conn);
}

// Prepare data for the charts
$chart_labels = json_encode(array_keys($sales_data));
$chart_data = json_encode(array_values($sales_data));
$chart_pie_data = json_encode([$total_downpayment, $total_full_payment, $total_sales]);
$chart_pie_labels = json_encode(['Total Downpayment', 'Total Full Payment', 'Total Revenue']);
?>

<!-- Your HTML and PHP for displaying results, cards, charts, and table goes here -->
<div class="main-content">
    <div class="container mt-4">
        <div class="header d-flex align-items-center mb-4">
            <div class="logo mr-3">
                <img src="assets/img/nextgen.png" alt="Logo" style="height: 40px;">
            </div>
            <h4 class="mb-0" style="color: #005F15;">Sales Overview</h4>
        </div>

        <!-- Filter Form -->
        <form method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <select name="year" class="form-control">
                        <option value="">All Years</option>
                        <?php
                        for ($i = date('Y'); $i >= 2000; $i--) {
                            $selected = ($i == $selected_year) ? 'selected' : ''; // Preserve selected year
                            echo "<option value='$i' $selected>$i</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <select name="month" class="form-control">
                        <option value="">All Months</option>
                        <?php
                        for ($m = 1; $m <= 12; $m++) {
                            $selected = ($m == $selected_month) ? 'selected' : ''; // Preserve selected month
                            echo "<option value='$m' $selected>" . date('F', mktime(0, 0, 0, $m, 1)) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <!-- Sales Summary Cards -->
        <div class="row mb-4">
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card text-white bg-success mb-3 shadow-sm rounded">
                    <div class="card-header text-center"><strong>Total Revenue</strong></div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo number_format($total_sales, 2); ?> PHP</h5>
                        <p class="card-text">Total revenue from all bookings.</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card text-white bg-info mb-3 shadow-sm rounded">
                    <div class="card-header text-center"><strong>Downpayments</strong></div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo number_format($total_downpayment, 2); ?> PHP</h5>
                        <p class="card-text">Total downpayments collected.</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card text-white bg-warning mb-3 shadow-sm rounded">
                    <div class="card-header text-center"><strong>Full Payments</strong></div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo number_format($total_full_payment, 2); ?> PHP</h5>
                        <p class="card-text">Total full payments completed.</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card text-white bg-danger mb-3 shadow-sm rounded">
                    <div class="card-header text-center"><strong>Total Bookings</strong></div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo $total_bookings; ?></h5>
                        <p class="card-text">Total number of bookings made.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sales Chart Section -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h5 class="mb-3">Sales Trend</h5>
                <canvas id="salesChart" style="max-width: 600px; height: 400px;"></canvas>
            </div>
            <div class="col-md-6">
                <h5 class="mb-3">Payment Types</h5>
                <canvas id="paymentChart" style="max-width: 600px; height: 400px;"></canvas>
            </div>
        </div>

<!-- Booking Data Table -->
<div class="card mb-4 shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Summary of Sales</h5>
    </div>
    <div class="card-body">
    <!-- Search Input -->
    <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search...">
        <table class="table table-striped table-bordered" id="salesTable">
            <thead>
                <tr>
                    <th>Booking Date</th>
                    <th>Bike Name</th>
                    <th>Bike Brand</th>
                    <th>Quantity</th>
                    <th>Rate Type</th>
                    <th>Total Cost</th>
                    <th>Payment Method</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Reset the pointer of the result set to iterate through again for the table
                mysqli_data_seek($result, 0);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . date('Y-m-d', strtotime($row['booking_date'])) . '</td>';
                    echo '<td>' . htmlspecialchars($row['bike_name']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['bike_brand']) . '</td>';
                    echo '<td>' . $row['quantity'] . '</td>';
                    echo '<td>' . htmlspecialchars($row['rate_type']) . '</td>';
                    echo '<td>' . number_format($row['total_cost'], 2) . ' PHP</td>';
                    echo '<td>' . htmlspecialchars($row['payment_method']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['payment_status']) . '</td>';
                    echo '<td><a href="view_sales.php?id=' . $row['booking_id'] . '" class="btn btn-primary btn-sm">View</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

        <!-- Pagination Links -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php for ($page = 1; $page <= $total_pages; $page++): ?>
                    <li class="page-item <?php if ($page == $current_page) echo 'active'; ?>">
                        <a class="page-link" href="sales.php?page=<?php echo $page; ?>"><?php echo $page; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Sales Chart
    const ctxSales = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctxSales, {
        type: 'line',
        data: {
            labels: <?php echo $chart_labels; ?>,
            datasets: [{
                label: 'Sales',
                data: <?php echo $chart_data; ?>,
                borderColor: '#00831D',
                fill: false
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                },
                tooltip: {
                    enabled: true
                }
            }
        }
    });

    // Payment Chart
    const ctxPayment = document.getElementById('paymentChart').getContext('2d');
    const paymentChart = new Chart(ctxPayment, {
        type: 'pie',
        data: {
            labels: <?php echo $chart_pie_labels; ?>,
            datasets: [{
                label: 'Payment Types',
                data: <?php echo $chart_pie_data; ?>,
                backgroundColor: ['#6BCB77', '#FFD60A', '#FF6B6B'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                },
                tooltip: {
                    enabled: true
                }
            }
        }
    });
</script>

<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('#salesTable tbody tr');
        
        rows.forEach(row => {
            const rowText = row.innerText.toLowerCase();
            row.style.display = rowText.includes(searchValue) ? '' : 'none';
        });
    });
</script>
<?php include('includes/footer.php'); ?>
