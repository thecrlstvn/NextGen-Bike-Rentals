<?php
session_start();
include 'config/dbcon.php';
include('includes/header.php');
include('functions/userfunctions.php');

if (!isset($_SESSION['auth_user']['user_id'])) {
    header('Location: login.php');
    exit();
}

$userId = $_SESSION['auth_user']['user_id']; // Get the user ID from session

// Check if the required GET parameters are present
if (!isset($_GET['bikeid'], $_GET['booking_date'], $_GET['quantity'])) {
    echo "<div class='alert alert-danger'>Error: Missing booking information.</div>";
    exit;
}

// Get parameters
$bike_id = $_GET['bikeid'];
$booking_date = $_GET['booking_date'];
$quantity = $_GET['quantity'];
$pickup_time = $_GET['pickup_time'] ?? '';  // Optional
$return_time = $_GET['return_time'] ?? '';  // Optional
$rate_type = $_GET['rate_type'] ?? '';       // New parameter for rate type

// Validate based on rate type
if ($rate_type === 'hourly') {
    if (empty($pickup_time) || empty($return_time)) {
        echo "<div class='alert alert-danger'>Error: Missing pickup or return time for hourly booking.</div>";
        exit;
    }
} elseif ($rate_type !== 'daily') {
    echo "<div class='alert alert-danger'>Error: Invalid rate type.</div>";
    exit;
}

// Get bike details
$query = "SELECT b.*, c.category_name FROM bikes b JOIN categories c ON b.category_id = c.category_id WHERE b.bikeid = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $bike_id);
$stmt->execute();
$result = $stmt->get_result();
$bike = $result->fetch_assoc();

// Check if the bike was found
if (!$bike) {
    echo "<div class='alert alert-danger'>Error: Bike not found.</div>";
    exit;
}

// Initialize total amount variable
$total_amount = 0;
$insurance_fee = 50; // Fixed insurance fee for all bookings

// Determine if the booking is hourly or daily
// Initialize $hours to a default value
$hours = 0; // Default value for daily rate

if ($rate_type === 'hourly') {
    $pickup_timestamp = strtotime($booking_date . ' ' . $pickup_time);
    $return_timestamp = strtotime($booking_date . ' ' . $return_time);
    $hours = ($return_timestamp - $pickup_timestamp) / 3600; // Calculate hours
    $total_amount = $bike['hourly_rate'] * $hours * $quantity + $insurance_fee;
} else {
    $total_amount = $bike['daily_rate'] * $quantity + $insurance_fee; // Daily rate calculation
}

?>

            <div class="container mt-5">
            <div class="d-flex justify-content-center mb-3">
        <img src="assets/img/logo-nextgen.png" alt="Logo" class="img-fluid" style="max-width: 30%; height: auto;">
    </div>
    <h1 class="text-center mb-3">Booking Details</h1>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-lg p-4 mb-4">
                <h2 class="h5">Customer Information</h2>
                <form id="booking-form" action="process_booking.php" method="POST">
                    <input type="hidden" name="bike_id" value="<?php echo $bike_id; ?>">
                    <input type="hidden" name="booking_date" value="<?php echo $booking_date; ?>">
                    <input type="hidden" name="pickup_time" value="<?php echo $pickup_time; ?>">
                    <input type="hidden" name="return_time" value="<?php echo $return_time; ?>">
                    <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
                    <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">
                    
                    <div class="form-group mb-3">
                        <label for="customer_name">Name:</label>
                        <input type="text" class="form-control" name="customer_name" value="<?= htmlspecialchars($_SESSION['auth_user']['fullname']); ?>" required readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="customer_email">Email:</label>
                        <input type="email" class="form-control" name="customer_email" value="<?= htmlspecialchars($_SESSION['auth_user']['email']); ?>" required readonly>
                    </div>

                    <h2 class="h5">Payment Method</h2>
                    <select class="form-select mb-3" name="payment_method" id="payment-method" required>
                        <option value="" disabled selected>Choose Payment Method</option>
                        <option value="downpayment">Downpayment via Paypal + Walk-in Remaining Amount</option>
                        <option value="full">Full Payment via PayPal</option>
                    </select>
                </form>
            </div>

            <div class="col-md-12">
            <div class="card shadow-lg p-4 mb-4">
        <h2 class="h4 mb-4 text-center">Booking Bike Information</h2>
        
        <!-- Bike Image -->
        <div class="mb-3 text-center">
        <img src="<?php echo htmlspecialchars($bike['image']); ?>"
        class="img-fluid rounded" 
        alt="Bike Image" 
        style="max-width: 50%; height: auto; border: 5px solid #ddd; border-radius: 20px;">

        </div>

        <div class="bike-details mt-3 text-start border rounded p-3" style="background-color: #f8f9fa;">
    <div class="mb-2">
        <strong>Category:</strong> 
        <span class="text-muted"><?= htmlspecialchars($bike['category_name']); ?></span>
    </div>
    <div class="mb-2">
        <strong>Bike Name:</strong> 
        <span class="text-muted"><?= htmlspecialchars($bike['bike_name']); ?></span>
    </div>
    <div class="mb-2">
        <strong>Brand:</strong> 
        <span class="text-muted"><?= htmlspecialchars($bike['bike_brand']); ?></span>
    </div>
    <div class="mb-2">
        <strong>Bike Size:</strong> 
        <span class="text-muted"><?= htmlspecialchars($bike['bike_size']); ?></span>
    </div>
    <div class="mb-2">
        <strong>Rate Type:</strong> 
        <span class="text-muted"><?= htmlspecialchars($rate_type); ?></span>
    </div>
    <div class="mb-2">
        <strong>Quantity:</strong> 
        <span class="text-muted"><?= htmlspecialchars($quantity); ?> Bike(s)</span>
    </div>

    <?php if ($rate_type === 'daily'): ?>
        <div class="mb-2">
            <strong>Booking Date:</strong> 
            <span class="text-muted">
                <?= date("F j, Y", strtotime($booking_date)); ?>
            </span>
        </div>
    <?php elseif ($rate_type === 'hourly'): ?>
        <div class="mb-2">
            <strong>Booking Date:</strong> 
            <span class="text-muted">
                <?= date("F j, Y", strtotime($booking_date)); ?>
            </span>
        </div>
        <div class="mb-2">
            <strong>Pickup Time:</strong> 
            <span class="text-muted">
                <?= date("g:i A", strtotime($pickup_time)); ?>
            </span>
        </div>
        <div class="mb-2">
            <strong>Return Time:</strong> 
            <span class="text-muted">
                <?= date("g:i A", strtotime($return_time)); ?>
            </span>
        </div>
    <?php endif; ?>
</div>
    </div>
</div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-lg p-4 mb-4">
                <h2 class="h5">Price Summary</h2>
                <div class="text-center alert alert-success">All Bikes are required to have a &#8369;50 security deposit.</div>
                <ul class="list-group mb-3" id="price-summary">
                    <?php if ($rate_type === 'hourly'): ?>
                        <li class="list-group-item d-flex justify-content-between" id="hourly-rate-summary">
                            <span>Hourly Rate (₱<?= number_format($bike['hourly_rate'], 2); ?>/hr)</span>
                            <span>₱<?= number_format($bike['hourly_rate'] * $hours * $quantity, 2); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Booking Hours</span>
                            <span><?= number_format($hours, 2); ?> hr(s)</span>
                        </li>
                    <?php else: ?>
                        <li class="list-group-item d-flex justify-content-between" id="daily-rate-summary">
                            <span>Daily Rate (₱<?= number_format($bike['daily_rate'], 2); ?>/day)</span>
                            <span>₱<?= number_format($bike['daily_rate'] * $quantity, 2); ?></span>
                        </li>
                    <?php endif; ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Insurance</span>
                        <span>₱<?= number_format($insurance_fee, 2); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-light" id="total-summary">
                        <strong>Total</strong>
                        <strong>₱<?= number_format($total_amount, 2); ?></strong>
                    </li>
                </ul>
                <!-- Message prompting the user to select a payment method -->
                <div id="payment-method-warning" class="alert alert-danger" role="alert" style="display: none;">
                    Please select a payment method before proceeding.
                </div>

                <!-- PayPal button container, initially hidden -->
                <div id="paypal-button-container" style="display: none;"></div>
            </div>
        </div>
    </div>
</div>

<script>
    let paymentMethod = ''; // Initially empty to force user selection

    // Function to render the PayPal button
    function renderPayPalButton(amountToCharge) {
        // Clear previous PayPal button container (if any)
        document.getElementById('paypal-button-container').innerHTML = '';

        // Render the PayPal button
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: amountToCharge.toFixed(2) // Set the dynamic amount
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Submit the booking form after successful payment
                    document.getElementById('booking-form').submit();
                });
            },
            onError: function(err) {
                console.error(err);
            }
        }).render('#paypal-button-container'); // Render PayPal button container
    }

    // Function to calculate the amount based on payment method
    function updatePayPalButton() {
        const totalAmount = <?= json_encode($total_amount); ?>;
        const downpaymentAmount = totalAmount / 2; // Assuming 50% downpayment

        // Determine the correct amount based on the payment method
        const amountToCharge = paymentMethod === 'downpayment' ? downpaymentAmount : totalAmount;

        // Re-render the PayPal button with the updated amount
        renderPayPalButton(amountToCharge);
    }

    // Event listener for the payment method dropdown
    document.getElementById('payment-method').addEventListener('change', function() {
        paymentMethod = this.value; // Update payment method based on selection

        // Show PayPal button and hide warning message
        if (paymentMethod) {
            document.getElementById('paypal-button-container').style.display = 'block';
            document.getElementById('payment-method-warning').style.display = 'none';
            updatePayPalButton(); // Update PayPal button dynamically
        }
    });

    // Initial check to display warning if no payment method is selected
    document.addEventListener('DOMContentLoaded', function() {
        if (!paymentMethod) {
            document.getElementById('payment-method-warning').style.display = 'block';
        }
    });
</script>


<script>
    document.getElementById('payment-method').addEventListener('change', function() {
        const hourlyRate = <?= json_encode($bike['hourly_rate']); ?>;
        const dailyRate = <?= json_encode($bike['daily_rate']); ?>;
        const insuranceFee = <?= json_encode($insurance_fee); ?>;
        const quantity = <?= json_encode($quantity); ?>;
        const hours = <?= json_encode($hours); ?>;

        const priceSummary = document.getElementById('price-summary');
        priceSummary.innerHTML = ''; // Clear previous summary

        let totalAmount;

        // Function to format currency
        const formatCurrency = (amount) => '₱' + amount.toFixed(2);

        if (this.value === 'downpayment') {
            // Calculate the total for hourly
            if (<?= json_encode($rate_type); ?> === 'hourly') {
                const totalHourly = (hourlyRate * hours * quantity) + insuranceFee; // Total for hourly
                totalAmount = totalHourly; // This is the total including insurance

                // Calculate downpayment
                const downpayment = totalAmount / 2; // Half for downpayment
                const remainingAmount = totalAmount - downpayment; // Remaining amount

                // Populate price summary
                priceSummary.innerHTML = `
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Hourly Rate (₱${hourlyRate.toFixed(2)}/hr)</span>
                        <span>${formatCurrency(hourlyRate * hours * quantity)}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Booking Hours</span>
                        <span>${hours.toFixed(2)} hr(s)</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Insurance</span>
                        <span>${formatCurrency(insuranceFee)}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <strong>Total</strong>
                        <strong>${formatCurrency(totalAmount)}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <strong>Downpayment via Paypal</strong>
                        <strong>${formatCurrency(downpayment)}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Remaining Amount (Walk-in Pay)</strong>
                        <strong>${formatCurrency(remainingAmount)}</strong>
                    </li>
                `;
            } else { // For daily rate
                const totalDaily = (dailyRate * quantity) + insuranceFee; // Total for daily
                totalAmount = totalDaily; // This is the total including insurance

                // Calculate downpayment
                const downpayment = totalAmount / 2; // Half for downpayment
                const remainingAmount = totalAmount - downpayment; // Remaining amount

                // Populate price summary
                priceSummary.innerHTML = `
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Daily Rate (₱${dailyRate.toFixed(2)}/day)</span>
                        <span>${formatCurrency(dailyRate * quantity)}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Insurance</span>
                        <span>${formatCurrency(insuranceFee)}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <strong>Total</strong>
                        <strong>${formatCurrency(totalAmount)}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <strong>Downpayment</strong>
                        <strong>${formatCurrency(downpayment)}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Remaining Amount (Walk-in Pay)</strong>
                        <strong>${formatCurrency(remainingAmount)}</strong>
                    </li>
                `;
            }
        } else if (this.value === 'full') {
            // For hourly rate full payment
            if (<?= json_encode($rate_type); ?> === 'hourly') {
                const totalHourly = (hourlyRate * hours * quantity) + insuranceFee; // Total for hourly
                totalAmount = totalHourly; // This is the total including insurance

                // Populate price summary
                priceSummary.innerHTML = `
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Hourly Rate (₱${hourlyRate.toFixed(2)}/hr)</span>
                        <span>${formatCurrency(hourlyRate * hours * quantity)}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Booking Hours</span>
                        <span>${hours.toFixed(2)} hr(s)</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Insurance</span>
                        <span>${formatCurrency(insuranceFee)}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <strong>Total</strong>
                        <strong>${formatCurrency(totalAmount)}</strong>
                    </li>
                `;
            } else { // For daily rate full payment
                const totalDaily = (dailyRate * quantity) + insuranceFee; // Total for daily
                totalAmount = totalDaily; // This is the total including insurance

                // Populate price summary
                priceSummary.innerHTML = `
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Daily Rate (₱${dailyRate.toFixed(2)}/day)</span>
                        <span>${formatCurrency(dailyRate * quantity)}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Insurance</span>
                        <span>${formatCurrency(insuranceFee)}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <strong>Total</strong>
                        <strong>${formatCurrency(totalAmount)}</strong>
                    </li>
                `;
            }
        }
    });
</script>

<!-- Include the footer -->
<?php include('includes/footer.php'); ?>
