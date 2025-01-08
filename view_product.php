<?php 
session_start();
include('functions/userfunctions.php'); 
include('includes/header.php'); 

// Define constants for booking rate types
define('RATE_HOURLY', 'hourly');
define('RATE_DAILY', 'daily');

// Handle check availability request
$error_message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bikeid = $_POST['bikeid'];
    $quantity = $_POST['qty'];
    $rate_type = $_POST['rate_type'];
    $email = $_POST['email'];
    $booking_date = $_POST['booking_date'];

    // Check availability
    $sql = "SELECT qty, hourly_rate, daily_rate FROM bikes WHERE bikeid = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $bikeid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $qty = $row['qty'];

            if ($rate_type === RATE_HOURLY) {
                $total_cost = $row['hourly_rate'] * $quantity;
                if ($quantity <= $qty) {
                    $_SESSION['booking_details'] = [
                        'bikeid' => $bikeid,
                        'qty' => $quantity,
                        'rate_type' => RATE_HOURLY,
                        'total_cost' => $total_cost,
                        'booking_date' => $booking_date,
                        'email' => $email,
                        'start_time' => date('Y-m-d H:i:s'),
                        'end_time' => date('Y-m-d H:i:s', strtotime('+1 hour'))
                    ];
                    header("Location: booking_details.php");
                    exit();
                } else {
                    $error_message = "Insufficient bikes available for hourly booking.";
                }
            } elseif ($rate_type === RATE_DAILY) {
                $total_cost = $row['daily_rate'] * $quantity;
                if ($quantity <= $qty) {
                    $_SESSION['booking_details'] = [
                        'bikeid' => $bikeid,
                        'qty' => $quantity,
                        'rate_type' => RATE_DAILY,
                        'total_cost' => $total_cost,
                        'booking_date' => $booking_date,
                        'email' => $email,
                        'start_time' => date('Y-m-d H:i:s'),
                        'end_time' => date('Y-m-d H:i:s', strtotime('+1 day'))
                    ];
                    header("Location: booking_details.php");
                    exit();
                } else {
                    $error_message = "Insufficient bikes available for daily booking.";
                }
            }
        } else {
            $error_message = "Bike not found.";
        }
    } else {
        $error_message = "Database query failed.";
    }
}

// Fetch bike list for dropdown
$bike_sql = "SELECT bikeid, bike_name FROM bikes";
$bike_result = $conn->query($bike_sql);

// Fetch user's fullname
$fullname = '';
if (isset($_SESSION['user_id'])) {
    $sql = "SELECT fullname FROM users WHERE user_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('s', $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            $fullname = $row['fullname'];
        }
    }
}

// Assuming you have a database connection in $conn
$slug = $_GET['product'] ?? ''; // Get the slug from the URL

// Initialize reviews array
$reviews = [];

if (!empty($slug)) {
    // Prepare the SQL statement
    if ($stmt = $conn->prepare("
        SELECT r.review_id, r.user_id, r.review_text, r.rating, r.date_posted, 
               u.fullname, u.profile_image
        FROM reviews r
        JOIN users u ON r.user_id = u.user_id
        WHERE r.slug = ?")) {

        // Bind parameters and execute
        $stmt->bind_param("s", $slug);
        $stmt->execute();
        $result = $stmt->get_result();
        $reviews = $result->fetch_all(MYSQLI_ASSOC); // Fetch all reviews as an associative array
        $stmt->close();
    } else {
        // Handle SQL preparation error
        echo "Error preparing statement: " . $conn->error;
    }
}

if (isset($_GET['product'])) {
    $product_slug = $_GET['product'];
    $product_data = getSlugActive("bikes", $product_slug);
    $product = mysqli_fetch_array($product_data);

    // Check if the product exists
    if ($product) {
        $slug = $product['slug']; // Get slug from the fetched product data

        // Query to get the average rating based on slug
        $stmt = $conn->prepare("SELECT AVG(rating) AS average_rating FROM reviews WHERE slug = ?");
        $stmt->bind_param("s", $slug); // Bind the slug

        $stmt->execute();
        $result = $stmt->get_result();
        $average_rating = $result->fetch_assoc();

        // Check if an average rating is available
        $average_rating_value = $average_rating['average_rating'] !== null ? round($average_rating['average_rating'], 2) : null;

        // Close the statement
        $stmt->close();
    } else {
        echo "Product not found.";
    }
}

// Check if the user is logged in
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if(isset($_GET['product'])) {
    $product_slug = $_GET['product'];
    $product_data = getSlugActive("bikes", $product_slug);
    $product = mysqli_fetch_array($product_data);
    
    if($product) {
        $availableQuantity = $product['qty'];
        ?>
        <div class="py-3 bg-success">
            <div class="container">
                <h6 class="text-white mb-0">
                    <a class="text-white" href="categories.php"> 
                        Home > 
                    </a>
                    <a class="text-white" href="categories.php">
                        Our Bikes > 
                    </a>
                    <?= htmlspecialchars($product['bike_name']); ?>
                </h6>
            </div>
        </div>

        <div class="bg-light py-4">
            <div class="container product_data mt-5">
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                            <img src="<?= htmlspecialchars($product['image']); ?>" alt="Product Image" class="w-100" style="object-fit: cover; height: auto;">
                            </div>

                            <div class="col-md-6 mb-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 style="font-size: 22px; font-weight: 600; color: #005F15;">
                                            &#8369;<?= number_format($product['hourly_rate'], 2); ?> / hour
                                        </h5>
                                        <h6 style="font-size: 16px; color: #005F15;">
                                            &#8369;<?= number_format($product['daily_rate'], 2); ?> / day
                                        </h6>

                                        <?php if(isset($error_message)): ?>
                                            <div class="alert alert-danger" style="display: none; font-size: 0.8rem; padding: 5px;"><?= htmlspecialchars($error_message); ?></div>
                                        <?php endif; ?>

                                        <form id="bookingForm" action="check_availability.php" method="POST">
                                            <input type="hidden" id="bikeId" name="bikeid" value="<?= htmlspecialchars($product['bikeid']); ?>">

                                            <!-- Rate Type Selection -->
                                            <div class="mt-3">
                                                <label for="rate_type" class="form-label">Booking Rate Type:</label>
                                                <select id="rate_type" name="rate_type" class="form-select" required>
                                                    <option value="" disabled selected>Choose a rate type</option>
                                                    <option value="<?= RATE_HOURLY; ?>">Hourly</option>
                                                    <option value="<?= RATE_DAILY; ?>">Daily</option>
                                                </select>
                                            </div>

                                            <!-- Booking Date -->
                                            <div class="mt-3" id="booking_date_container">
                                                <label for="booking_date" class="form-label">Booking Date:</label>
                                                <input type="date" id="booking_date" name="booking_date" class="form-control" required>
                                            </div>

                                            <!-- Pickup Time -->
                                            <div class="mt-3" id="pickup_time_container" style="display: none;">
                                                <label for="pickup_time" class="form-label">Pickup Time:</label>
                                                <input type="time" id="pickup_time" name="pickup_time" class="form-control" required>
                                            </div>

                                            <!-- Return Time -->
                                            <div class="mt-3" id="return_time_container" style="display: none;">
                                                <label for="return_time" class="form-label">Return Time:</label>
                                                <input type="time" id="return_time" name="return_time" class="form-control" required>
                                            </div>

                                            <!-- Bike Size (Read-only) -->
                                            <div class="mt-3 d-flex justify-content-between">
                                                <div class="me-2">
                                                    <label for="bike_size" class="form-label">Bike Size:</label>
                                                    <input type="text" id="bike_size" name="bike_size" class="form-control" value="<?= htmlspecialchars($product['bike_size']); ?>" readonly>
                                                </div>

                                                <!-- Quantity with Increment/Decrement -->
                                                <div class="ms-2 w-50">
                                                    <label for="quantity" id="quantityLabel" class="form-label">Quantity:</label>
                                                    <div class="input-group">
                                                        <button class="btn btn-success" type="button" id="decrementQty">-</button>
                                                        <input type="text" id="quantity" name="qty" class="form-control text-center" value="1" min="1" max="<?= $availableQuantity; ?>" required>
                                                        <button class="btn btn-success" type="button" id="incrementQty">+</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="mt-3">
                                                <button id="checkAvailabilityButton" onclick="checkAvailability(event)" class="btn btn-success px-4" type="submit">Check Availability</button>
                                            </div>
                                        </form>

                                        <div id="quantityAlert" class="mt-3 alert alert-danger text-center" style="display: none; font-size: 0.8rem; padding: 5px;"></div>
                                        <div class="mt-3">
                                            <div class="d-flex align-items-center alert alert-success">
                                                <div class="me-2">
                                                    <i class="fas fa-info-circle" style="color: danger; font-size: 1rem;"></i>
                                                </div>
                                                <p class="mb-0" style="color: success; font-size: 0.9rem;">All Bikes are required to have a &#8369;50 security deposit.</p>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <div class="d-flex align-items-center alert alert-warning">
                                                <div class="me-2">
                                                    <i class="fas fa-info-circle" style=" font-size: 1rem;"></i>
                                                </div>
                                                <p class="mb-0" style=" font-size: 0.8rem;">For Hourly Rate: Pickup and return Time must be within operational hours from 8:00 AM to 11:00 PM</p>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <div class="d-flex align-items-center alert alert-warning">
                                                <div class="me-2">
                                                    <i class="fas fa-info-circle" style=" font-size: 1rem;"></i>
                                                </div>
                                                <p class="mb-0" style=" font-size: 0.8rem;">For Daily Rate: Our operational hours is from 8:00 AM to 11:00 PM</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12 mt-4">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <h4 style="color: black; font-weight: 800; margin-bottom: 0;">
                                    <?= htmlspecialchars($product['bike_name']); ?>
                                </h4>
                                

                                <div class="d-flex align-items-center">
                                    <?php if ($product['trending']) { ?>
                                        <span class="badge bg-danger text-white me-2" style="font-size: 1.25rem; padding: 0.6rem 1rem; width: 120px; text-align: center;">Trending</span>
                                    <?php } ?>

                                    <!-- Availability Badge -->
                                    <span class="badge" style="font-size: 1.25rem; padding: 0.6rem 1rem; text-align: center; background-color: <?= htmlspecialchars($product['availability_status']) == 'Available' ? '#28a745' : (htmlspecialchars($product['availability_status']) == 'Under Maintenance' ? '#ffc107' : '#dc3545'); ?>;">
                                        <?= htmlspecialchars($product['availability_status']) ?: 'Not Available'; ?>
                                    </span>
                                </div>
                            </div>

                            <p class="small-text" style="font-size: 1.25rem; font-weight: 300; color: #333;"><?= htmlspecialchars($product['bike_brand']); ?></p>

                            <div class="average-rating mb-3">
                                <?php if ($average_rating_value !== null): ?>
                                    <div class="rating" style="font-size: 1.2em;">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <i class="fa fa-star <?php echo ($i <= $average_rating_value) ? 'text-warning' : 'text-secondary'; ?>"></i>
                                        <?php endfor; ?>
                                        (<?php echo htmlspecialchars($average_rating_value); ?> Ratings)
                                    </div> 
                                <?php else: ?>
                                    No ratings available.
                                <?php endif; ?>
                            </div>

                            <h5 style="font-weight: 600;">Product Description:</h5>
                            <p><?= htmlspecialchars($product['description']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
    <div class="reviews-section">
        <!-- Customer Feedback Card -->
        <div class="card shadow-lg mb-4 rounded">
            <div class="card-header bg-success text-white text-center rounded-top">
                <h4 class="mb-0">Customer Feedback</h4>
            </div>
            <div class="card-body">
                <?php if (count($reviews) > 0): ?>
                    <div class="row">
                        <?php foreach ($reviews as $review): ?>
                            <div class="col-md-6 mb-3">
                                <div class="review-card p-3 border rounded bg-light shadow-sm">
                                    <div class="d-flex align-items-center mb-2">
                                        <?php
                                            // Construct Cloudinary URL
                                            $cloudinary_url = 'https://res.cloudinary.com/dsyt4e4fp/image/profile_image/';
                                            $profile_image = htmlspecialchars($review['profile_image'] ?? 'default-avatar.png');
                                            $image_url = filter_var($profile_image, FILTER_VALIDATE_URL) ? $profile_image : $cloudinary_url . $profile_image;
                                        ?>
                                        <img src="<?php echo $image_url; ?>" class="rounded-circle me-3" alt="User Avatar" width="50" height="50">
                                        <div>
                                            <strong><?php echo htmlspecialchars($review['fullname'] ?? 'Anonymous'); ?></strong>
                                        </div>
                                    </div>
                                    <div class="rating mb-2" style="font-size: 1.5em;">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <i class="fa fa-star <?php echo ($i <= $review['rating']) ? 'text-warning' : 'text-secondary'; ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <p class="mb-1"><?php echo htmlspecialchars($review['review_text']); ?></p>
                                        <small class="text-muted">Posted on: 
                                            <?php 
                                            $datePosted = new DateTime($review['date_posted']);
                                            echo htmlspecialchars($datePosted->format('F j, Y \a\t g:i A')); 
                                            ?>
                                        </small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-center">No reviews available for this bike.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Review Submission Form -->
        <div class="card shadow-lg rounded">
            <div class="card-body">
                <?php if (isset($_SESSION['auth_user']['user_id'])): ?>
                    <h3 class="text-center mb-2">Say your Bike Rental Experiences</h3>
                    <form method="POST" action="submit_review.php" class="mt-4">
                        <input type="hidden" name="slug" value="<?php echo htmlspecialchars($slug); ?>">
                        
                        <!-- Rating Input -->
                        <div class="mb-3">
                            <div class="rating mb-2 d-flex justify-content-center align-items-center" style="font-size: 2em;">
                                <input type="hidden" name="rating" id="ratingValue">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fa fa-star text-secondary" data-value="<?php echo $i; ?>"></i>
                                <?php endfor; ?>
                            </div>
                            <!-- Display the selected number of stars -->
                            <div class="text-center mt-2" style="font-size: 1.3em;" id="ratingText">Rate us!</div>
                        </div>

                        <!-- Review Textarea -->
                        <div class="mb-3">
                            <label for="reviewText" class="form-label" style="font-size: 1.3em;">Your Review</label>
                            <textarea class="form-control" id="reviewText" name="review_text" rows="4" required></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Submit Review</button>
                        </div>
                    </form>
                <?php else: ?>
                    <div class="text-center">
                        <p class="fw-bold">You must be logged in to submit a review.</p>
                        <a href="login.php" class="btn btn-primary me-2">Login</a>
                        <a href="register.php" class="btn btn-secondary">Register</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Footer Section -->
<div class="py-5" style="background-color: #005F15;">
    <div class="container">
        <div class="row">
            <!-- Column 1: Company Info -->
            <div class="col-12 col-md-3 mb-4">
                <h4 class="text-white fs-5 fw-bold">NextGen Bike Rentals</h4>
                <a href="terms-of-use.php" class="text-white d-block">Terms of Use</a>
                <a href="privacy-policy.php" class="text-white d-block">Privacy Policy</a>
            </div>
            <!-- Column 3: Social Media Links -->
            <div class="col-12 col-md-3 mb-4">
                <h4 class="text-white fs-5 fw-bold">Get in touch</h4>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fi fi-brands-facebook me-2"></i><a href="#" class="text-white">Facebook</a>
                    </li>
                    <li class="mb-2">
                        <i class="fi fi-brands-instagram me-2"></i><a href="#" class="text-white">Instagram</a>
                    </li>
                    <li class="mb-2">
                        <i class="fi fi-brands-twitter me-2"></i><a href="#" class="text-white">X (Formerly Twitter)</a>
                    </li>
                    <li class="mb-2">
                        <i class="fi fi-sr-circle-envelope me-2"></i><a href="#" class="text-white">Email Us</a>
                    </li>
                </ul>
            </div>

            <!-- Column 2: Learn More -->
            <div class="col-12 col-md-3 mb-4">
                <h4 class="text-white fs-5 fw-bold">Store Location</h4>
                <div class="text-white d-block">
                    <i class="fas fa-map-marker-alt"></i> Quezon City Memorial Circle, Elliptical Rd, Diliman, Quezon City, Metro Manila
                </div>
            </div>

            <!-- Column 4: Footer Image -->
            <div class="col-12 col-md-3 d-flex justify-content-md-end justify-content-center">
                <img src="assets/images/img-footer.png" alt="Footer Image" class="img-fluid" style="max-width: 60%; height: auto; border-radius: 8px;">
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
        <?php 
    } else {
        // Product not found error handling
        echo "<div class='container'><h4 class='text-danger'>Product not found!</h4></div>";
    }
} else {
    // Redirect to home or show an error
    echo "
    <div class='container text-center mt-5'>
        <img src='assets/img/motorbike.png' alt='Error Logo' style='width: 100px; height: auto;'>
        <h4 class='text-warning mt-3'>
            If you see this message, the bike you are looking for might already be out of stock, 
            or you might have encountered an issue while browsing. 
            Please check again.
        </h4>
    </div>";
    
}

include('includes/footer.php'); 
?>