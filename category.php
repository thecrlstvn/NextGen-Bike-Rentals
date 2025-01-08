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

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header bg-green">
              <h4 class="text-white">Categories</h4>
            </div>
            <div class="card-body" id="category_table">

              <!-- Search Form -->
              <form method="GET" action="" class="mb-4">
                <div class="input-group">
                  <input type="text" class="form-control" name="search" placeholder="Search Categories..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </div>
              </form>

              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th class="text-center">Category ID</th>
                    <th class="text-center">Category Name</th>
                    <th class="text-center">Image</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead> 
                <tbody>
                  <?php
                    // Get search term if exists
                    $search = isset($_GET['search']) ? $_GET['search'] : '';

                    // Modify the query to filter based on the search term
                    $query = "SELECT * FROM categories WHERE category_name LIKE '%$search%'";

                    $category = mysqli_query($conn, $query);

                    if(mysqli_num_rows($category) > 0) {
                      while($item = mysqli_fetch_assoc($category)) {
                        ?>
                        <tr>
                          <td class="text-center"><?= htmlspecialchars($item['category_id']); ?></td>
                          <td class="text-center"><?= htmlspecialchars($item['category_name']); ?></td>
                          <td class="text-center">
                            <img src="<?= htmlspecialchars($item['image']); ?>" alt="Category image" class="w-100">
                          </td>
                          <td class="text-center">
                            <?= $item['status'] == '0' ? "<span class='badge bg-success'>Active</span>" : "<span class='badge bg-danger'>Inactive</span>" ?>
                          </td>
                          <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center">
                              <a href="edit-category.php?id=<?= $item['category_id']; ?>" class="btn btn-primary">Edit</a>
                              <button type="button" class="btn btn-danger btn-sm ms-2 delete_category_btn" value="<?= $item['category_id']; ?>">Delete</button>
                            </div>
                          </td>
                        </tr>
                        <?php
                      }
                    } else {
                      echo "<tr><td colspan='5' class='text-center'>No records found</td></tr>";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  
<?php include('includes/footer.php'); ?>
