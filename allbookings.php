<?php
include('includes/header.php');

// Get current page number from the query string, default to 1 if not set
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10; // Number of items per page
$offset = ($page - 1) * $limit;

// Handle search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch the total number of rows based on search
$sql_total = "SELECT COUNT(*) AS total FROM bookings WHERE customer_name LIKE '%$search%'";
$result_total = $conn->query($sql_total);
$row_total = $result_total->fetch_assoc();
$total_records = $row_total['total'];
$total_pages = ceil($total_records / $limit);

// Fetch the current page records based on search
$sql = "
    SELECT booking_id, customer_name, customer_email, bikeid, booking_date, pickup_time, return_time, quantity, rate_type, status
    FROM bookings
    WHERE customer_name LIKE '%$search%'
    LIMIT $offset, $limit
";
$result = $conn->query($sql);
?>

<div class="main-content">
  <div class="container mt-2">
    <!-- Header Section -->
    <div class="header">
      <div class="logo">
        <img src="assets/img/nextgen.png" alt="Logo" style="height: 27px;">
      </div>
      <div class="title">
        <h3>Rental Operations on Bookings</h3>
      </div>
    </div>

<!-- Table Section -->
<div class="container mt-5">
  <div class="card shadow">
    <div class="card-header bg-dark text-white">
      <h3 class="mb-0">All Bookings</h3>
    </div>

    <!-- Search Form -->
    <div class="container mt-4">
      <form action="" method="GET" class="form-inline justify-content-center">
        <div class="input-group mb-3">
          <input type="text" name="search" class="form-control" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search by customer name">
          <div class="input-group-append">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </div>
        </div>
      </form>
    </div>

    <!-- Table -->
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover table-sm">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Booking ID</th>
              <th scope="col">Customer Name</th>
              <th scope="col">Customer Email</th>
              <th scope="col">Bike ID</th>
              <th scope="col">Booking Date</th>
              <th scope="col">Pickup Time</th>
              <th scope="col">Return Time</th>
              <th scope="col">Quantity</th>
              <th scope="col">Rate Type</th>
              <th scope="col">Status</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>
                            <td>' . htmlspecialchars($row["booking_id"]) . '</td>
                            <td>' . htmlspecialchars($row["customer_name"]) . '</td>
                            <td>' . htmlspecialchars($row["customer_email"]) . '</td>
                            <td>' . htmlspecialchars($row["bikeid"]) . '</td>
                            <td>' . date('F j, Y', strtotime($row['booking_date'])) . '</td>
                            <td>' . date('h:i A', strtotime($row['pickup_time'])) . '</td>
                            <td>' . date('h:i A', strtotime($row['return_time'])) . '</td>
                            <td>' . htmlspecialchars($row["quantity"]) . '</td>
                            <td>' . htmlspecialchars($row["rate_type"]) . '</td>
                            <td>' . ucfirst($row["status"]) . '</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-primary btn-sm viewBooking mr-2" data-toggle="modal" data-target="#viewBookingModal" data-booking-id="' . htmlspecialchars($row["booking_id"]) . '">View</button>
                                    <button class="btn btn-danger btn-sm deleteBooking" data-booking-id="' . htmlspecialchars($row["booking_id"]) . '">Delete</button>
                                </div>
                            </td>
                          </tr>';
                }
            } else {
                echo '<tr><td colspan="11" class="text-center">No bookings found.</td></tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


    <!-- Pagination Section -->
    <div class="pagination-container mt-4">
      <nav>
        <ul class="pagination justify-content-center">
          <!-- Previous Page Button -->
          <li class="page-item <?php if($page == 1) echo 'disabled'; ?>">
            <a class="page-link" href="?page=1&search=<?php echo urlencode($search); ?>" aria-label="First">
              <span aria-hidden="true">&laquo;&laquo;</span>
            </a>
          </li>
          <li class="page-item <?php if($page == 1) echo 'disabled'; ?>">
            <a class="page-link" href="?page=<?php echo $page-1; ?>&search=<?php echo urlencode($search); ?>" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          
          <!-- Page Number Buttons -->
          <?php for($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?php if($i == $page) echo 'active'; ?>">
              <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"><?php echo $i; ?></a>
            </li>
          <?php endfor; ?>

          <!-- Next Page Button -->
          <li class="page-item <?php if($page == $total_pages) echo 'disabled'; ?>">
            <a class="page-link" href="?page=<?php echo $page+1; ?>&search=<?php echo urlencode($search); ?>" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>

          <!-- Last Page Button -->
          <li class="page-item <?php if($page == $total_pages) echo 'disabled'; ?>">
            <a class="page-link" href="?page=<?php echo $total_pages; ?>&search=<?php echo urlencode($search); ?>" aria-label="Last">
              <span aria-hidden="true">&raquo;&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>

  </div>
</div>

<!-- Modal for viewing booking details -->
<div class="modal fade" id="viewBookingModal" tabindex="-1" role="dialog" aria-labelledby="viewBookingLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewBookingLabel">Booking Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Booking details will be dynamically loaded here using JavaScript -->
        <div id="bookingDetailsContent">
          <!-- Dynamic booking details content here -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  // Handle the click event for "View" button
  document.querySelectorAll('.viewBooking').forEach(button => {
    button.addEventListener('click', function() {
      const bookingId = this.getAttribute('data-booking-id');

      // Use AJAX to fetch booking details
      fetch('fetch_booking_details.php?booking_id=' + bookingId)
        .then(response => response.json())
        .then(data => {
          const modalBody = document.querySelector('#bookingDetailsContent');
          
          if (data.error) {
            modalBody.innerHTML = `<p>${data.error}</p>`;
          } else {
            // Construct the booking details content dynamically
            modalBody.innerHTML = `
              <p><strong>Booking ID:</strong> ${data.booking_id}</p>
              <p><strong>Customer Name:</strong> ${data.customer_name}</p>
              <p><strong>Customer Email:</strong> ${data.customer_email}</p>
              <p><strong>Bike ID:</strong> ${data.bikeid}</p>
              <p><strong>Booking Date:</strong> ${data.booking_date}</p>
              <p><strong>Pickup Time:</strong> ${data.pickup_time}</p>
              <p><strong>Return Time:</strong> ${data.return_time}</p>
              <p><strong>Quantity:</strong> ${data.quantity}</p>
              <p><strong>Rate Type:</strong> ${data.rate_type}</p>
              <p><strong>Status:</strong> ${data.status}</p>
            `;
          }
        });
    });
  });
</script>
<?php
include('includes/footer.php');
?>
