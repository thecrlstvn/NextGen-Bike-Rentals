<?php 
include('includes/header.php');

// Fetch admins from the database
$sql = "SELECT id, admin_name, email, admin_image FROM adminlogin";
$result = $conn->query($sql);
?>

<div class="main-content">
  <div class="container mt-2">
    <!-- Message Display -->
    <?php
    // Display success message
    if (isset($_GET['message'])) {
        echo '<div id="message" class="alert alert-success">' . htmlspecialchars($_GET['message']) . '</div>';
    }
    // Display error message
    if (isset($_GET['error'])) {
        echo '<div id="message" class="alert alert-danger">' . htmlspecialchars($_GET['error']) . '</div>';
    }
    ?>

    <!-- Header Section -->
    <div class="header d-flex align-items-center mb-4">
      <div class="logo mr-3">
        <img src="assets/img/nextgen.png" alt="Logo" style="height: 27px;">
      </div>
      <div class="title h4">Rental Operation on Admin Accounts</div>
    </div>

    <div class="card">
      <div class="card-header bg-success text-white">
        Admin List
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($result->num_rows > 0): ?>
              <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                  <td><?php echo htmlspecialchars($row['admin_name']); ?></td>
                  <td><?php echo htmlspecialchars($row['email']); ?></td>
                  <td>
                    <!-- Button to trigger modal -->
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#viewModal<?php echo $row['id']; ?>">View</button>

                    <!-- Modal for viewing admin details -->
                    <div class="modal fade" id="viewModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="viewModalLabel">Admin Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body text-center">
                            <img src="<?php echo htmlspecialchars($row['admin_image']); ?>" alt="Admin Image" class="img-fluid rounded-circle mb-3" style="width: 100px; height: 100px;">
                            <h6>Name: <?php echo htmlspecialchars($row['admin_name']); ?></h6>
                            <h6>Email: <?php echo htmlspecialchars($row['email']); ?></h6>
                          </div>
                          <div class="modal-footer">
                            <!-- Button to delete admin -->
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $row['id']; ?>)">Delete</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr>
                <td colspan="3" class="text-center">No admins found</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php
$conn->close(); // Close the database connection
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert/dist/sweetalert.min.js"></script>
<script>
function confirmDelete(adminId) {
  swal({
    title: "Are you sure?",
    text: "Once deleted, you will not be able to recover this admin account!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      // Make an AJAX call to delete the admin
      window.location.href = 'delete_admin.php?id=' + adminId; // Redirect to the delete script
    } else {
      swal("The admin account is safe!");
    }
  });
}

// Hide message after a few seconds
window.onload = function() {
  const message = document.getElementById('message');
  if (message) {
    setTimeout(() => {
      message.style.display = 'none';
    }, 5000); // 5000 milliseconds = 5 seconds
  }
};
</script>

<?php include('includes/footer.php'); ?>
