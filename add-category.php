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
          Rental Operations on Bikes
        </div>
      </div>
      <!-- Form Section -->
      <div class="row justify-content-center">
        <div class="col-md-10">
          <div class="card">
            <div class="card-header">
              <h4 class="mb-0">Add Category</h4>
            </div>
            <div class="card-body">
              <form action="code.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" name="category_name" id="category_name" placeholder="Enter Category Name" class="form-control" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug" id="slug" placeholder="Enter Slug" class="form-control" required>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea rows="3" name="description" id="description" placeholder="Enter Description" class="form-control" required></textarea>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="image" class="form-label">Upload Image</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="previewImage()">
                    <div id="imagePreview" class="mt-3"></div>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="meta_title" class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" placeholder="Enter Meta Title" class="form-control" required>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="meta_description" class="form-label">Meta Description</label>
                    <textarea rows="2" name="meta_description" id="meta_description" placeholder="Enter Meta Description" class="form-control" required></textarea>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="meta_keywords" class="form-label">Meta Keywords</label>
                    <textarea rows="2" name="meta_keywords" id="meta_keywords" placeholder="Enter Meta Keywords" class="form-control" required></textarea>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Inactive</label>
                    <input type="checkbox" name="status" id="status">
                    <label for="status">Active</label>
                  </div>
                  <div class="col-md-12 mb-3">
                    <button type="submit" class="btn btn-primary" name="add_category_btn">Save</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include('includes/footer.php'); ?>
