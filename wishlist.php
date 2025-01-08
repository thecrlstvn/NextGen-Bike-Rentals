<?php 
session_start();
include('functions/userfunctions.php');
include('includes/header.php');

// Check if the user is logged in
if (!isset($_SESSION['auth_user'])) {
    $_SESSION['message'] = "Please log in to view your wishlist";
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['auth_user']['user_id'];

// Fetch the wishlist for the logged-in user
$wishlist_query = "SELECT w.*, b.bike_name, b.bike_brand, b.hourly_rate, b.daily_rate, b.image, b.slug
                   FROM wishlists w 
                   JOIN bikes b ON w.bikeid = b.bikeid 
                   WHERE w.user_id = '$user_id' AND w.status = 'active'";

$wishlist_result = mysqli_query($conn, $wishlist_query);

// Error handling
if (!$wishlist_result) {
    echo "Error: " . mysqli_error($conn);
    exit();
}
?>

<div class="py-3 bg-success">
    <div class="container">
        <h6 class="text-white mb-0">
            <a class="text-white" href="index.php">Home ></a>
            <a class="text-white" href="wishlist.php">Wishlist</a>
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <h2 class="mb-4 text-center">My Wishlist</h2>

        <?php if (mysqli_num_rows($wishlist_result) > 0): ?>
            <div class="row">
                <?php foreach($wishlist_result as $item): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                        <img src="<?= htmlspecialchars($item['image']); ?>" class="card-img-top" alt="Product image">
                            <div class="card-body">
                                <h5 class="card-title"><?= $item['bike_brand']; ?></h5>
                                <h6 class="card-title"><?= $item['bike_name']; ?></h6>
                                <p class="card-text">
                                    <span style="display: flex; justify-content: space-between;">
                                        Hourly Rate <span style="color: #005F15; font-size: larger; font-weight: 600;">₱<?= $item['hourly_rate']; ?> / hour</span>
                                    </span>
                                    <span style="display: flex; justify-content: space-between;">
                                        Daily Rate <span style="color: #005F15; font-size: larger; font-weight: 600;">₱<?= $item['daily_rate']; ?> / day</span>
                                    </span>
                                </p>
                                <a href="view_product.php?product=<?= $item['slug']; ?>" class="btn btn-success">View Details</a>
                                <button class="btn btn-danger remove-item" data-id="<?= $item['wishlist_id']; ?>">Remove</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center">
                <img src="assets/img/no-bike.png" alt="No Wishlist" class="img-fluid mb-3" style="max-width: 200px;">
                <p class="text-center display-7">Your wishlist is currently empty.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<div style="background-color: #242424; width: 100%; padding: 20px 0;">
    <div style="max-width: 1413px; margin: 0 auto;">
      <img src="assets/images/rent.png" alt="Responsive Image" style="width: 100%; height: auto;">
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

<!-- Include SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $('.remove-item').click(function() {
        var wishlistId = $(this).data('id');

        // Use SweetAlert to confirm removal
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'remove_wishlist.php',
                    type: 'POST',
                    data: { wishlist_id: wishlistId },
                    success: function(response) {
                        const res = JSON.parse(response);
                        Swal.fire(
                            'Removed!',
                            res.message,
                            res.success ? 'success' : 'error'
                        );
                        if (res.success) {
                            location.reload();
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Error!',
                            'There was an error removing the item.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
</script>

<?php include('includes/footer.php'); ?>
