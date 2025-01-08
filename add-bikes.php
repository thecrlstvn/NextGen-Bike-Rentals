<?php
include('includes/header.php');
?>

<!-- Main Content -->
<div class="main-content">
  <div class="container mt-2">
    <!-- Header Section -->
    <div class="header">
      <div class="logo">
        <!-- Logo Placeholder -->
        <img src="assets/img/nextgen.png" alt="Logo" style="height: 27px;">
      </div>
      <div class="title">
        Rental Operations on Content Management for Bikes
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">
            <h4 class="mb-0">Add Rent Bike</h4>
          </div>
          <div class="card-body">
          <form action="code.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="category_id" class="form-label">Select Category</label>
                    <select name="category_id" id="category_id" class="form-select mb-3">
                        <option selected>Select Category</option>
                        <?php 
                        $categories = getAll("categories");
                        if(mysqli_num_rows($categories) > 0) {
                            foreach ($categories as $item) {
                                ?>
                                <option value="<?= $item['category_id']; ?>"><?= $item['category_name']; ?></option>
                                <?php
                            }
                        } else {
                            echo "<option>No Category available</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="bike_name" class="form-label">Bike Name</label>
                    <input type="text" name="bike_name" id="bike_name" placeholder="Enter Bike Name" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug" id="slug" placeholder="Enter Slug" class="form-control" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="bike_brand" class="form-label">Bike Brand</label>
                    <textarea rows="3" name="bike_brand" id="bike_brand" placeholder="Enter Bike Brand" class="form-control" required></textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="description" class="form-label">Bike Description</label>
                    <textarea rows="3" name="description" id="description" placeholder="Enter Bike Description" class="form-control" required></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="hourly_rate" class="form-label">Hourly Rate (Price per Hour)</label>
                    <input type="text" name="hourly_rate" id="hourly_rate" placeholder="Enter Price per Hour (e.g., $15.00)" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="daily_rate" class="form-label">Daily Rate (Price per Day)</label>
                    <input type="text" name="daily_rate" id="daily_rate" placeholder="Enter Price per Day (e.g., $100.00)" class="form-control" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="bike_size" class="form-label">Bike Size (e.g., 175 cm - 185 cm)</label>
                    <input type="text" name="bike_size" id="bike_size" placeholder="Enter Bike Size" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="availability_status" class="form-label">Availability Status</label>
                    <select name="availability_status" id="availability_status" class="form-select mb-3" required>
                        <option value="available">Available</option>
                        <option value="under_maintenance">Not Available</option>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="image" class="form-label">Upload Image</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="previewImage()">
                    <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 100%; margin-top: 10px;">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="qty" class="form-label">Quantity Availability</label>
                    <input type="number" name="qty" id="qty" placeholder="Enter Bike Available" class="form-control" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="meta_title" class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" placeholder="Enter Meta Title" class="form-control" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="meta_description" class="form-label">Meta Description</label>
                    <input type="text" name="meta_description" id="meta_description" placeholder="Enter Meta Description" class="form-control" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="meta_keywords" class="form-label">Meta Keywords</label>
                    <textarea rows="3" name="meta_keywords" id="meta_keywords" placeholder="Enter Meta Keywords" class="form-control" required></textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input type="checkbox" name="status" id="status" class="form-check-input">
                            <label for="status" class="form-check-label">Hidden</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input type="checkbox" name="trending" id="trending" class="form-check-input">
                            <label for="trending" class="form-check-label">Frequently Used</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <button type="submit" class="btn btn-primary" name="add_product_btn">Save</button>
                </div>
            </div>
        </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<?php
    if(isset($_POST['Logout'])) {
      session_destroy();
      header("Location: ADMIN_LOGIN.php");
    }
?>

<?php include('includes/footer.php'); ?>
