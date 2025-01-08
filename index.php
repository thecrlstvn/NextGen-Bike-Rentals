<?php 
session_start();

// Redirect to index.php if user is already logged in
if (isset($_SESSION['admin'])) {
  $_SESSION['message'] = "You are already logged in.";
  header('Location: dashboard.php');
  exit();
}

include('includes/header_admin.php');
?>

<div class="full-bg d-flex justify-content-center align-items-center">
  <div class="glassy-form">
    <img src="admin-assets/images/admin.png" alt="Logo" class="logo">
    <h2 class="text-center mb-3">ADMINISTRATOR ACCESS</h2>
    
    <form action="login.php" method="POST"> <!-- Submit to login.php for processing -->
      <div class="form-floating mb-3">
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="name@example.com" aria-describedby="emailHelp" required>
        <label for="exampleInputEmail1" class="form-label">Email address</label>
      </div>

      <div class="form-floating mb-3 position-relative password-container">
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
        <img id="password-toggle" class="password-toggle" src="admin-assets/img/close-eye.png" alt="Toggle Password" onclick="togglePassword()" style="position: absolute; right: 15px; top: 30px; transform: translateY(-50%); cursor: pointer;">
        <label for="exampleInputPassword1" class="form-label">Password</label>
      </div>

      <button type="submit" class="btn btn-success w-100">Submit</button>

      <?php if (isset($_GET['error'])): ?>
        <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
          <?php echo htmlspecialchars($_GET['error']); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <script>
          // Hide the alert after 5 seconds
          setTimeout(function() {
            document.querySelector('.alert').style.display = 'none';
          }, 5000); // 5000 milliseconds = 5 seconds
        </script>
      <?php endif; ?>
    </form>

    <div class="text-center mt-4">
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pinModal">Create Admin Account</button>
    </div>
  </div>
</div>

<!-- Modal for PIN Entry -->
<div class="modal fade" id="pinModal" tabindex="-1" aria-labelledby="pinModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pinModalLabel">Enter PIN Code</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="pinForm">
          <div class="mb-3">
            <label for="pinCode" class="form-label">PIN Code</label>
            <input type="password" name="pin" class="form-control" id="pinCode" placeholder="Enter PIN" required>
          </div>
          <button type="submit" class="btn btn-primary">Verify PIN</button>
        </form>
        <div id="pinError" class="alert alert-danger mt-2 d-none" role="alert"></div>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('pinForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const pinCode = document.getElementById('pinCode').value;
    
    // Replace this with your actual PIN verification logic
    const validPin = '6398436'; // Example hardcoded PIN for demonstration

    if (pinCode === validPin) {
      // Redirect to create_admin.php
      window.location.href = 'create_admin.php';
    } else {
      // Show error message
      const pinErrorDiv = document.getElementById('pinError');
      pinErrorDiv.classList.remove('d-none');
      pinErrorDiv.innerText = 'Invalid PIN. Please try again.';
    }
  });
</script>

<?php include('includes/footer.php'); ?>
