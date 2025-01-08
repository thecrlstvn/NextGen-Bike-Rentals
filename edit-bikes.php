<?php 
include('includes/header.php');

// Handle bike status update
if (isset($_POST['bike_id'])) {
    $bike_id = intval($_POST['bike_id']);
    $status = $_POST['status'] === 'on' ? '1' : '0'; // Check if status is checked

    // Update the bike status in the database
    $query = "UPDATE bikes SET status = ? WHERE bikeid = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $status, $bike_id);
    
    if ($stmt->execute()) {
        $success_message = "Bike status updated successfully.";
    } else {
        $error_message = "Error updating bike status: " . $conn->error;
    }

    $stmt->close();
}

// Main Content
?>
<div class="main-content">
  <div class="container mt-2">
    <!-- Header Section -->
    <div class="header">
      <div class="logo">
        <img src="assets/img/nextgen.png" alt="Logo" style="height: 27px;">
      </div>
      <div class="title">
        Rental Operations on Bikes
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <?php
          // Check if 'id' is set in the URL
          if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];
            $product = getByBikeID("bikes", $id); // Fetch bike details

            // Check if the product exists
            if (mysqli_num_rows($product) > 0) {
              $data = mysqli_fetch_array($product);
          ?>
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h4 class="mb-0">Edit Bike</h4>
              <a href="bikes.php" class="btn btn-primary btn-sm">Back</a>
            </div>
            <div class="card-body">
              <form action="code.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <label for="category_id" class="form-label">Select Category</label>
                    <select name="category_id" id="category_id" class="form-select mb-3" required>
                      <option value="" disabled>Select Category</option>
                      <?php 
                        $categories = getAll("categories");
                        if (mysqli_num_rows($categories) > 0) {
                          foreach ($categories as $item) {
                            ?>
                            <option value="<?= htmlspecialchars($item['category_id']); ?>" <?= $data['category_id'] == $item['category_id'] ? 'selected' : ''; ?>><?= htmlspecialchars($item['category_name']); ?></option>
                            <?php
                          }
                        } else {
                          echo "<option>No Category available</option>";
                        }
                      ?>
                    </select>
                  </div>
                  <input type="hidden" name="bikeid" value="<?= htmlspecialchars($data['bikeid']); ?>">
                  <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Bike Name</label>
                    <input type="text" name="bike_name" id="bike_name" value="<?= htmlspecialchars($data['bike_name']); ?>" placeholder="Update Product Name" class="form-control" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug" id="slug" value="<?= htmlspecialchars($data['slug']); ?>" placeholder="Update Slug" class="form-control" required>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="bike_brand" class="form-label">Bike Brand</label>
                    <textarea rows="3" name="bike_brand" id="bike_brand" placeholder="Update Small Description" class="form-control" required><?= htmlspecialchars($data['bike_brand']); ?></textarea>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea rows="3" name="description" id="description" placeholder="Update Description" class="form-control" required><?= htmlspecialchars($data['description']); ?></textarea>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="hourly_rate" class="form-label">Hourly Rate</label>
                    <input type="text" name="hourly_rate" id="hourly_rate" value="<?= htmlspecialchars($data['hourly_rate']); ?>" placeholder="Update Hourly Rate" class="form-control" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="daily_rate" class="form-label">Daily Rate</label>
                    <input type="text" name="daily_rate" id="daily_rate" value="<?= htmlspecialchars($data['daily_rate']); ?>" placeholder="Update Daily Rate" class="form-control" required>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="image" class="form-label">Upload Image</label>
                    <input type="hidden" name="old_image" value="<?= htmlspecialchars($data['image']); ?>">
                    <input type="file" name="image" id="image" class="form-control">
                    <img src="<?= htmlspecialchars($data['image']); ?>" alt="Product Image" width="100" height="100">
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                      <label for="quantity" class="form-label">Quantity Available</label>
                      <input type="number" name="qty" id="qty" value="<?= htmlspecialchars($data['qty']); ?>" placeholder="Update Quantity" class="form-control" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                      <label for="bike_size" class="form-label">Bike Size</label>
                      <input type="text" name="bike_size" id="bike_size" value="<?= htmlspecialchars($data['bike_size']); ?>" placeholder="Update Bike Size" class="form-control" required>
                    </div>
                <div class="col-md-6 mb-3">
                    <label for="availability_status" class="form-label">Availability Status</label>
                    <select name="availability_status" id="availability_status" class="form-select mb-3" required>
                        <option value="available">Available</option>
                        <option value="under_maintenance">Not Available &</option>
                    </select>
                </div>
                    <div class="col-md-12 mb-3">
                      <label for="meta_title" class="form-label">Meta Title</label>
                      <input type="text" name="meta_title" id="meta_title" value="<?= htmlspecialchars($data['meta_title']); ?>" placeholder="Update Meta Title" class="form-control" required>
                    </div>
                    <div class="col-md-12 mb-3">
                      <label for="meta_description" class="form-label">Meta Description</label>
                      <input type="text" name="meta_description" id="meta_description" value="<?= htmlspecialchars($data['meta_description']); ?>" placeholder="Update Meta Description" class="form-control" required>
                    </div>
                    <div class="col-md-12 mb-3">
                      <label for="meta_keywords" class="form-label">Meta Keywords</label>
                      <textarea rows="3" name="meta_keywords" id="meta_keywords" placeholder="Update Meta Keywords" class="form-control" required><?= htmlspecialchars($data['meta_keywords']); ?></textarea>
                    </div>
                    <div class="col-md-3 mb-3">
                      <div class="form-check">
                        <input type="checkbox" name="status" id="status" class="form-check-input" <?= $data['status'] == '0' ? '' : 'checked'; ?>>
                        <label for="status" class="form-check-label">Hidden</label>
                      </div>
                    </div>
                    <div class="col-md-3 mb-3">
                      <div class="form-check">
                        <input type="checkbox" name="trending" id="trending" class="form-check-input" <?= $data['trending'] == '0' ? '' : 'checked'; ?>>
                        <label for="trending" class="form-check-label">Frequently Used</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 mb-3">
                    <button type="submit" class="btn btn-primary" name="update_product_btn">Update</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <?php
            } else {
              echo "<p class='text-danger'>No bike found with the specified ID.</p>";
            }
          } else {
            echo "<p class='text-danger'>Invalid request. Please provide a valid bike ID.</p>";
          }

          // Display success or error messages
          if (isset($success_message)) {
              echo "<div class='alert alert-success'>$success_message</div>";
          }
          if (isset($error_message)) {
              echo "<div class='alert alert-danger'>$error_message</div>";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('includes/footer.php'); ?>
