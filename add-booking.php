<?php 
include('includes/header.php');

// Fetch bikes from the database
$resultBikes = $conn->query("SELECT bikeid, bike_name, hourly_rate, daily_rate, category_id FROM bikes WHERE availability_statuszzzzz = 'Available'");
if (!$resultBikes) {
    die("Bikes query failed: " . $conn->error); // Check for errors in bike query
}

// Fetch categories from the database
$resultCategories = $conn->query("SELECT category_id, category_name FROM categories WHERE status = 'Active'"); 
if (!$resultCategories) {
    die("Categories query failed: " . $conn->error); // Check for errors in category query
}

$categories = [];
while ($row = $resultCategories->fetch_assoc()) {
    $categories[$row['category_id']] = $row['category_name']; // Make sure 'name' matches your database
}
?>

<div class="main-content">
  <div class="container mt-2">
    <div class="header">
      <div class="logo">
        <img src="assets/img/nextgen.png" alt="Logo" style="height: 27px;">
      </div>
      <div class="title">
        Rental Operations on Bookings 
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header bg-success text-white">
              <h5>Booking Calendar</h5>
            </div>

            <div class="card-body">
              <div id="calendar" style="max-width: 100%; margin: 0 auto;"></div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-header bg-success text-white">
              <h4>Manual Booking Form</h4>
            </div>
            <div class="card-body">
              <form id="manualBookingForm" action="process_manual_booking.php" method="POST">
                <div class="form-group">
                    <label for="customerName">Customer Name</label>
                    <input type="text" class="form-control" id="customerName" name="customerName" placeholder="Enter Customer Name" required>
                </div>
                
                <div class="form-group">
                    <label for="bikeName">Bike Name</label>
                    <select class="form-control" id="bikeName" name="bikeid" required onchange="updateBikeCategoryAndRates()">
                        <option value="">Select Bike</option>
                        <?php 
                        while ($row = $resultBikes->fetch_assoc()) {
                            $categoryName = isset($categories[$row['category_id']]) ? $categories[$row['category_id']] : 'Unknown';
                            echo "<option value='" . $row['bikeid'] . "' 
                                    data-hourly='" . $row['hourly_rate'] . "' 
                                    data-daily='" . $row['daily_rate'] . "' 
                                    data-category='" . $categoryName . "'>" . 
                                    $row['bike_name'] . 
                                   "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="bikeCategory">Bike Category</label>
                    <input type="text" class="form-control" id="bikeCategory" placeholder="Bike Category" disabled>
                </div>

                <div class="form-group">
                    <label for="rentType">Rental Type</label>
                    <select id="rentType" class="form-control" name="rentType" onchange="updateRates()">
                        <option value="">Select Rental Type</option>
                        <option value="daily">Daily Rate</option>
                        <option value="hourly">Hourly Rate</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="startRentDate">Start Date:</label>
                    <input type="date" class="form-control" id="startRentDate" name="startRentDate" required onchange="calculateTotal()">
                </div>
                
                <div class="form-group">
                    <label for="endRentDate">End Date:</label>
                    <input type="date" class="form-control" id="endRentDate" name="endRentDate" required onchange="calculateTotal()">
                </div>

                <div class="form-group">
                    <label for="startRentTimeHourly">Start Time:</label>
                    <input type="time" class="form-control" id="startRentTimeHourly" name="startRentTimeHourly" required onchange="calculateTotal()">
                </div>

                <div class="form-group">
                    <label for="endRentTimeHourly">End Time:</label>
                    <input type="time" class="form-control" id="endRentTimeHourly" name="endRentTimeHourly" required onchange="calculateTotal()">
                </div>
                
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="1" required onchange="calculateTotal()">
                </div>
                
                <div class="form-group">
                    <label for="total">Total Payment</label>
                    <input type="number" class="form-control" id="total" name="total" placeholder="Total Payment" readonly>
                </div>
                
                <button type="submit" class="btn btn-success btn-block">Submit Booking</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('includes/footer.php'); ?>