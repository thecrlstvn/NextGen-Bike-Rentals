<?php 
session_start();
include('functions/userfunctions.php'); 
include('includes/header.php'); 

$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (isset($_GET['product'])) {
    $product_slug = $_GET['product'];
    $product_data = getSlugActive("bikes", $product_slug);
    $product = mysqli_fetch_array($product_data);
    
    if ($product) {
        $bikeName = htmlspecialchars($product['bike_name']); // Dynamically getting bike name
        $hourlyRate = $product['hourly_rate'];
        $dailyRate = $product['daily_rate'];
        $availableQuantity = $product['qty'];

        // Assuming you get these values from user input
        $rentalType = $_GET['rentalType'] ?? 'hourly'; // Either 'hourly' or 'daily'
        $rentalDuration = $_GET['rentalDuration'] ?? 1; // Number of hours/days
        $totalCost = ($rentalType === 'hourly') ? ($hourlyRate * $rentalDuration) : ($dailyRate * $rentalDuration);
        
        ?>
        <div class="container">
            <h2>Booking Confirmation</h2>
            <p>Bike Name: <?php echo $bikeName; ?></p>
            <p>Rental Type: <?php echo ucfirst($rentalType); ?> (<?php echo htmlspecialchars($rentalDuration); ?> <?php echo $rentalType === 'hourly' ? 'hour(s)' : 'day(s)'; ?>)</p>
            <p>Total Cost: $<?php echo number_format($totalCost, 2); ?></p>
            
            <form id="paymentForm" action="process_payment.php" method="POST">
                <h3>Payment Details</h3>
                <label for="paymentMethod">Select Payment Method:</label>
                <select id="paymentMethod" name="paymentMethod" required onchange="togglePaymentFields()">
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                </select>
                <div id="creditCardDetails" style="display: none;">
                    <label for="cardNumber">Card Number:</label>
                    <input type="text" id="cardNumber" name="cardNumber" required>
                    <label for="expiry">Expiry Date:</label>
                    <input type="text" id="expiry" name="expiry" placeholder="MM/YY" required>
                    <label for="cvv">CVV:</label>
                    <input type="text" id="cvv" name="cvv" required>
                </div>
                <input type="hidden" name="totalCost" value="<?php echo htmlspecialchars($totalCost); ?>">
                <input type="hidden" name="rentalType" value="<?php echo htmlspecialchars($rentalType); ?>">
                <input type="hidden" name="rentalDuration" value="<?php echo htmlspecialchars($rentalDuration); ?>">
                <button type="submit">Proceed to Payment</button>
            </form>

            <button onclick="goBack()">Edit Booking</button>
        </div>

        <!-- Footer -->
        <div style="background-color: #242424; width: 100%; padding: 20px 0;">
            <div style="max-width: 1413px; margin: 0 auto;">
                <img src="assets/images/rent.png" alt="Responsive Image" style="width: 100%; height: auto;">
            </div>
        </div>

        <div class="py-5" style="background-color: #005F15;">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h4 class="text-white fs-4 fw-bold">NextGen Bike Rentals</h4>
                        <a href="#" class="text-white">Cancellation Policy</a><br>
                        <a href="#" class="text-white">Payment FAQs</a><br>
                        <a href="#" class="text-white">Order and Payments</a><br>
                        <a href="#" class="text-white">Return and Refund</a><br>
                    </div>
                    <div class="col-md-2">
                        <h4 class="text-white fs-4 fw-bold">Learn More</h4>
                        <a href="#" class="text-white">Careers</a><br>
                        <a href="#" class="text-white">Contact Us</a><br>
                    </div>
                    <div class="col-md-3">
                        <h4 class="text-white fs-4 fw-bold">Get in touch</h4>
                        <i class="fi fi-brands-facebook"></i><a href="#" class="text-white"> Facebook</a><br>
                        <i class="fi fi-brands-instagram"></i><a href="#" class="text-white"> Instagram</a><br>
                        <i class="fi fi-brands-twitter"></i><a href="#" class="text-white"> X (Formerly Twitter)</a><br>
                        <i class="fi fi-sr-circle-envelope"></i><a href="#" class="text-white"> Email Us</a><br>
                    </div>
                    <div class="col-md-3 d-flex flex-column align-items-end">
                        <!-- Image Only -->
                        <img src="assets/images/img-footer.png" alt="Footer Image" style="width: 70%; height: auto; border-radius: 8px;">
                    </div>
                </div>
            </div>
        </div>

        <div class="py-2 bg-white">
            <div class="container">
                <div class="text-center">
                    <p class="mb-1 text-black" style="font-size: 1.1rem;">NextGen Bicycle Rental and Tracking System | © Design by Karl Creatives | Inspect Portfolio 2024</p>
                </div>
            </div>
        </div>

        <script>
            // Function to toggle payment fields based on selected method
            function togglePaymentFields() {
                var paymentMethod = document.getElementById("paymentMethod").value;
                var creditCardDetails = document.getElementById("creditCardDetails");
                if (paymentMethod === "credit_card") {
                    creditCardDetails.style.display = "block";
                } else {
                    creditCardDetails.style.display = "none";
                }
            }

            // Function to handle the Edit Booking button action
            function goBack() {
                window.history.back();
            }
        </script>

        <?php
    } else {
        echo "Booking Confirmation Not Found";
    } 
} else {
    echo "Something went wrong";
}
include('includes/footer.php'); 
?>
