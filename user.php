<?php 
include('includes/header.php');

// Fetch users from the database
$sql = "SELECT user_id, fullname, email, profile_image FROM users";
$result = $conn->query($sql);
?>

<div class="main-content">
  <div class="container mt-2">
    <!-- Header Section -->
    <div class="header d-flex align-items-center mb-4">
      <div class="logo mr-3">
        <img src="assets/img/nextgen.png" alt="Logo" style="height: 27px;">
      </div>
      <div class="title h4">Rental Operations on User Accounts</div>
    </div>

    <div class="card">
      <div class="card-header bg-success text-white">
        Users List
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
                  <td><?php echo htmlspecialchars($row['fullname']); ?></td>
                  <td><?php echo htmlspecialchars($row['email']); ?></td>
                  <td>
                    <!-- Button to trigger the modal -->
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#viewModal" 
                            data-id="<?php echo $row['user_id']; ?>" 
                            data-name="<?php echo htmlspecialchars($row['fullname']); ?>" 
                            data-email="<?php echo htmlspecialchars($row['email']); ?>" 
                            data-image="<?php echo htmlspecialchars($row['profile_image']); ?>">
                      View
                    </button>
                  </td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr>
                <td colspan="3" class="text-center">No users found</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="viewModalLabel">User Details</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <!-- Profile Image -->
        <div class="profile-image mb-4">
          <img src="" id="userProfileImage" class="img-fluid rounded-circle border border-success" alt="Profile Image" style="width: 150px; height: 150px; object-fit: cover;">
        </div>
        
        <!-- User Information -->
        <div class="user-info">
          <h4 class="font-weight-bold mb-2" id="userName" style="font-size: 1.5em;"></h4>
          <p class="text-muted mb-3" id="userEmail" style="font-size: 1.2em;"></p>
          <hr class="my-4" style="width: 70%; margin: 0 auto; border-color: #dee2e6;">
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <!-- Delete Button with SweetAlert Confirmation -->
        <button type="button" class="btn btn-danger" id="deleteUserButton">Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  var userId; // Variable to hold the user ID

  // Populate modal with user details
  $('#viewModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    userId = button.data('id'); // Get the user ID
    var name = button.data('name'); // Extract info from data-* attributes
    var email = button.data('email');
    var image = button.data('image');

    var modal = $(this);
    modal.find('#userName').text(name);
    modal.find('#userEmail').text(email);
    modal.find('#userProfileImage').attr('src', image);
  });

  // Confirm delete function
  $('#deleteUserButton').on('click', function () {
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this user!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        // Perform the delete action using AJAX
        $.ajax({
          type: "POST",
          url: "delete_user.php", // Make sure this file exists
          data: { user_id: userId },
          success: function(response) {
            response = JSON.parse(response);
            if (response.status === 'success') {
              swal("User has been deleted successfully.", {
                icon: "success",
              }).then(() => {
                location.reload(); // Reload the page to see the changes
              });
            } else {
              swal("Error", response.message, "error");
            }
          }
        });
      } else {
        swal("User is safe.");
      }
    });
  });
</script>

<?php
$conn->close(); // Close the database connection
include('includes/footer.php'); 
?>
