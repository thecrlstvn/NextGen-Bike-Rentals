<?php 
include('includes/header.php');

// Initialize the $reviews array to avoid undefined variable warnings
$reviews = [];

// SQL query to fetch all reviews along with user information ordered by date_posted
$sql = "
    SELECT r.*, u.fullname, u.profile_image 
    FROM reviews r 
    JOIN users u ON r.user_id = u.user_id 
    ORDER BY r.date_posted DESC
";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    // If there are rows returned, fetch and store them in the $reviews array
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $reviews[] = $row;
        }
    } else {
        echo "<p>No reviews found.</p>";
    }
} else {
    echo "Error executing query: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>

<!-- Include Font Awesome for the star ratings -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="main-content">
  <div class="container mt-2">
    <!-- Header Section -->
    <div class="header">
      <div class="logo">
        <img src="assets/img/nextgen.png" alt="Logo" style="height: 27px;">
      </div>
      <div class="title">
        Rental Operations on Reviews
      </div>
    </div>

    <!-- Reviews Section -->
    <div class="row">
      <?php if (!empty($reviews)): ?>
          <?php foreach ($reviews as $review): ?>
              <div class="col-lg-4 col-md-6 mb-4">
                  <div class="card shadow-sm border-light">
                      <div class="card-body">
                          <!-- Display User Profile Image -->
                          <div class="d-flex align-items-center mb-3">
                              <img src="<?= htmlspecialchars($review['profile_image']) ?>" alt="Profile Image" class="rounded-circle" style="width: 50px; height: 50px; margin-right: 10px;">
                              <h5 class="card-title mb-0"><?= htmlspecialchars($review['fullname']) ?></h5>
                          </div>
                          <h6 class="card-subtitle mb-2 text-muted">Slug: <?= htmlspecialchars($review['slug']) ?></h6>
                          
                          <!-- Star Rating System -->
                          <p class="card-text">
                              <strong>Rating:</strong> 
                              <?php for ($i = 1; $i <= 5; $i++): ?>
                                  <i class="<?= $i <= $review['rating'] ? 'fas' : 'far' ?> fa-star text-warning"></i>
                              <?php endfor; ?>
                          </p>

                          <!-- Review Text and Time -->
                          <p class="card-text">
                              <strong>Review:</strong> <?= nl2br(htmlspecialchars($review['review_text'])) ?><br>
                              <strong>Date Posted:</strong> <?= htmlspecialchars($review['date_posted']) ?><br>
                          </p>

                          <!-- Delete Button Only -->
                          <div class="d-flex justify-content-center">
                              <a href="javascript:void(0);" class="btn btn-outline-danger btn-sm" 
                                 onclick="confirmDelete(<?= urlencode($review['review_id']) ?>)">Delete</a>
                          </div>
                      </div>
                  </div>
              </div>
          <?php endforeach; ?>
      <?php else: ?>
          <div class="col-12">
              <div class="alert alert-info text-center">No reviews available.</div>
          </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<script>
// JavaScript function to confirm deletion with a simple browser prompt
function confirmDelete(reviewId) {
    // Use the built-in JavaScript confirmation dialog
    var confirmation = confirm("Are you sure you want to delete this review? You will not be able to recover it.");

    if (confirmation) {
        // Redirect to delete.php with the review ID as a query parameter
        window.location.href = "delete.php?id=" + reviewId;
    }
}
</script>

<?php include('includes/footer.php'); ?>
