<?php
session_start();
include('includes/header.php'); 

// Check if the user is logged in
if (!isset($_SESSION['auth_user'])) {
    $_SESSION['message'] = "You need to be logged in to access this page.";
    header('Location: login.php');
    exit();
}

// Display alert message if session message exists
if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
    echo htmlspecialchars($_SESSION['message']);
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    unset($_SESSION['message']); // Clear the message after displaying it
}
?>

<div class="container custom-form-container mt-3">
    <form id="profileForm" action="update-settings.php" method="POST" enctype="multipart/form-data">
        <div class="row">
            <!-- Profile Update Section on the Left -->
            <div class="col-md-5">
                <h2 class="custom-section-title">Profile Settings</h2>
                <p class="text-muted">
                    Please upload only formats as <strong>JPG, JPEG, PNG</strong>. Maximum size is <strong>20MB</strong>. Minimum dimension is <strong>100px x 100px</strong>.
                </p>
                <div class="text-center">
                    <!-- Profile Image Display -->
                    <img 
                        src="<?= !empty($_SESSION['auth_user']['profile_image']) ? htmlspecialchars($_SESSION['auth_user']['profile_image']) : 'assets/img/profile.png'; ?>" 
                        alt="Profile Picture" 
                        class="custom-profile-img border-green" 
                        id="profilePicture"
                    />
                    <div class="form-group mt-3">
                        <!-- File Input -->
                        <input 
                            type="file" 
                            name="profileImage" 
                            id="profileImage" 
                            class="form-control-file" 
                            style="display: none;"
                            accept=".jpg, .jpeg, .png"
                        >
                        <!-- Button to Trigger File Input -->
                        <button 
                            type="button" 
                            class="btn btn-secondary mt-2" 
                            onclick="document.getElementById('profileImage').click();"
                        >
                            Choose New Picture
                        </button>
                    </div>
                </div>
            </div>

            <!-- Vertical Line -->
            <div class="col-md-1 d-none d-md-block">
                <div class="custom-vertical-line"></div>
            </div>

            <!-- General Settings Section on the Right -->
            <div class="col-md-6">
                <h2 class="custom-section-title">General Settings</h2>
                <div class="form-group mt-3">
                    <label for="fullname">Full Name</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" value="<?= htmlspecialchars($_SESSION['auth_user']['fullname']); ?>" required>
                </div>
                <div class="form-group mt-3">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($_SESSION['auth_user']['email']); ?>" required>
                </div>
                <div class="form-group mt-3">
                    <label for="password">New Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Update a new password">
                </div>
                <!-- Update Profile Button -->
                <button type="submit" name="update_profile" class="btn btn-success mt-3">Update Profile</button>
            </div>
        </div>
    </form>

    <!-- Delete Account Section -->
    <div class="row mt-5">
        <div class="col-md-5">
            <h2 class="custom-section-title">Delete Account</h2>
            <p class="text-danger">Here you can delete your NextGen account. This step cannot be undone.</p>
            <button type="button" class="btn btn-danger custom-delete-account-btn" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                Delete Account
            </button>
        </div>
    </div>
</div>

<!-- Delete Account Confirmation Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAccountModalLabel">Confirm Account Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-danger">Are you sure you want to delete your account? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete Account</button>
            </div>
        </div>
    </div>
</div>

<!-- Footer Section -->
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

<?php include('includes/footer.php'); ?>
