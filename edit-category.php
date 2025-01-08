<?php 
include('includes/header.php');
?>

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

    <div class="container mt-4">
      <?php
        // Check if the ID is present in the URL
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            // Fetch category data by ID
            $category = getByID("categories", $id);

            // Check if the query returned a result
            if(mysqli_num_rows($category) > 0) {
               $data = mysqli_fetch_array($category);
               ?>
                  <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h4>Edit Category</h4>
                      <a href="category.php" class="btn btn-primary">Back</a>
                    </div>
                    <div class="card-body">
                      <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 col-lg-4 mb-3">
                                <input type="hidden" name="category_id" value="<?= htmlspecialchars($data['category_id']) ?>">
                                <label for="category_name">Name</label>
                                <input type="text" name="category_name" id="category_name" value="<?= htmlspecialchars($data['category_name']) ?>" placeholder="Enter Category Name" class="form-control" required>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" id="slug" value="<?= htmlspecialchars($data['slug']) ?>" placeholder="Enter Slug" class="form-control" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="description">Description</label>
                                <textarea rows="3" name="description" id="description" placeholder="Enter Description" class="form-control" required><?= htmlspecialchars($data['description']) ?></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="image">Upload Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="mb-1" for="current_image">Current Image:</label>
                                <div class="current-image">
                                    <input type="hidden" name="old_image" value="<?= htmlspecialchars($data['image']) ?>">
                                    <img src="<?= htmlspecialchars(str_starts_with($data['image'], 'https://res.cloudinary.com') ? $data['image'] : '../uploads/default-image.png') ?>"width="180" height="180" alt="Current Image" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" name="meta_title" id="meta_title" value="<?= htmlspecialchars($data['meta_title']) ?>" placeholder="Enter Meta Title" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="meta_description">Meta Description</label>
                                <textarea rows="3" name="meta_description" id="meta_description" placeholder="Enter Meta Description" class="form-control"><?= htmlspecialchars($data['meta_description']) ?></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="meta_keywords">Meta Keywords</label>
                                <textarea rows="3" name="meta_keywords" id="meta_keywords" placeholder="Enter Meta Keywords" class="form-control"><?= htmlspecialchars($data['meta_keywords']) ?></textarea>
                            </div>
                            <div class="col-md-6 col-lg-3 mb-3">
                                <div class="form-check">
                                    <input type="checkbox" id="status" name="status" class="form-check-input" <?= $data['status'] ? "checked" : "" ?>>
                                    <label for="status" class="form-check-label">Inactive</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="update_category_btn">Update</button>
                            </div>
                        </div>
                      </form>
                    </div>
                  </div>
              <?php
            } else {
              echo "<div class='alert alert-danger'>Category not found.</div>";
            }
        } else {
          echo "<div class='alert alert-danger'>ID missing from URL.</div>";
        }
      ?>
    </div>
  </div>
</div>

<?php include('includes/footer.php'); ?>
