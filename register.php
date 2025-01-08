<?php
session_start();

// Redirect to index.php if user is already logged in
if (isset($_SESSION['auth'])) {
    $_SESSION['message'] = "You are already logged in";
    header('Location: index.php');
    exit();
}

// Include header.php which also starts the session
include('includes/header.php');
?>

<div class="py-5 bg-custom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php if (isset($_SESSION['message'])) { ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong></strong> <?= $_SESSION['message']; ?>.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php unset($_SESSION['message']); } ?>

<!-- Terms and Conditions Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Please read it first, before proceed to creating account</h5>
            </div>
        <div class="modal-body" id="termsContent" style="max-height: 400px; overflow-y: auto;">
        <img src="assets/images/nextlogo.png" alt="NextGen Bike Rentals Logo" class="img-fluid" style="max-width: 200px;">
        <h5>Terms and Conditions</h5>
        <p>Welcome to <strong>Nextgen Bicycle Rental</strong>! We are committed to providing you with a safe and enjoyable experience while renting bicycles from our fleet. By accessing or using our services, you agree to the following Terms and Conditions.</p>

        <h5>1. Rental Agreement</h5>
        <ul>
          <li><strong>Eligibility:</strong> You must be at least 18 years old to rent a bicycle from Nextgen Bicycle Rental. If you are under 18, you must have a parent or guardian sign the rental agreement on your behalf.</li>
          <li><strong>ID and Payment:</strong> You are required to provide valid government-issued identification (ID) and payment information at the time of rental. A valid credit card is required to secure your rental.</li>
          <li><strong>Bicycle Use:</strong> You agree to use the rented bicycle responsibly and in accordance with applicable laws and regulations. You are responsible for all activities related to the use of the bicycle during the rental period.</li>
        </ul>

        <h5>2. Rental Period</h5>
        <ul>
          <li><strong>Rental Duration:</strong> The rental period begins at the time of pickup and ends at the time of return. Rental rates are charged based on either hourly or daily usage as specified at the time of booking.</li>
          <li><strong>Late Return:</strong> If the bicycle is not returned by the agreed-upon time, additional charges may apply. You may be subject to late fees as outlined in the rental agreement.</li>
        </ul>

        <h5>3. Bicycle Availability and Condition</h5>
        <ul>
          <li><strong>Availability:</strong> Nextgen Bicycle Rental makes every effort to ensure the availability of bicycles at the time of your booking. However, due to unforeseen circumstances, availability may vary.</li>
          <li><strong>Condition:</strong> Upon receiving the bicycle, you must inspect it for any defects or damage. If you notice any issues, you must inform the staff immediately. You are responsible for the condition of the bicycle during your rental period. Any damage to the bicycle that occurs during the rental period may result in additional fees.</li>
        </ul>

        <h5>4. Safety and Equipment</h5>
        <ul>
          <li><strong>Helmet Requirement:</strong> A helmet is provided with each rental, and it is strongly recommended that you wear it at all times while riding.</li>
          <li><strong>Safety Laws:</strong> You must follow all local traffic laws and regulations while using the rented bicycle. This includes wearing a helmet, signaling when turning, and obeying traffic signs and signals.</li>
          <li><strong>Responsibility for Accidents:</strong> You are responsible for any accidents or injuries that occur during your use of the rented bicycle. Nextgen Bicycle Rental is not liable for any personal injury, property damage, or accidents that result from your use of the bicycle.</li>
        </ul>

        <h5>5. Payment and Charges</h5>
        <ul>
          <li><strong>Rental Charges:</strong> The rental fee will be determined at the time of booking and will be based on the duration of the rental and any additional services or equipment (e.g., child seats, baskets) requested.</li>
          <li><strong>Refunds and Cancellations:</strong> Cancellations made at least 24 hours before the rental time will receive a full refund. Cancellations made less than 24 hours before the rental time may be subject to a cancellation fee.</li>
          <li><strong>Additional Fees:</strong> You will be charged for any additional services, late returns, damage to the bicycle, or failure to comply with the terms of the rental agreement.</li>
        </ul>

        <h5>6. Liability and Insurance</h5>
        <ul>
          <li><strong>Liability Waiver:</strong> By renting a bicycle from Nextgen Bicycle Rental, you agree to waive any claims against the company for injuries, damages, or losses that may occur during the rental period.</li>
          <li><strong>Insurance:</strong> Insurance coverage is available for an additional fee at the time of booking. This coverage may provide compensation for certain damages or accidents during the rental period, subject to the terms and conditions of the insurance policy.</li>
        </ul>

        <h5>7. Prohibited Activities</h5>
        <ul>
          <li><strong>No Unauthorized Use:</strong> The bicycle must only be used by the person named in the rental agreement. You may not allow any other person to use the bicycle during the rental period.</li>
          <li><strong>No Modifications:</strong> You may not modify or alter the bicycle in any way. This includes adjusting or removing components or using the bicycle for purposes other than general riding.</li>
          <li><strong>Restricted Areas:</strong> You are prohibited from riding the bicycle in areas where bicycles are not permitted, including highways, restricted zones, or dangerous terrain.</li>
        </ul>

        <h5>8. Termination of Rental</h5>
        <ul>
          <li><strong>Termination by Customer:</strong> You may terminate the rental by returning the bicycle at any time. No refund will be issued for unused rental time.</li>
          <li><strong>Termination by Nextgen Bicycle Rental:</strong> We reserve the right to terminate your rental if we believe you are in violation of any of these Terms and Conditions, or if your conduct poses a risk to safety.</li>
        </ul>

        <h5>9. Privacy and Data Protection</h5>
        <ul>
          <li><strong>Personal Information:</strong> We collect personal information, such as your name, contact details, and payment information, to process your rental and improve our services. For more information, please refer to our Privacy Policy.</li>
          <li><strong>Data Usage:</strong> By using our service, you consent to the use of your personal data for rental-related purposes, including communication and marketing updates.</li>
        </ul>

        <h5>10. Amendments to Terms and Conditions</h5>
        <p>Nextgen Bicycle Rental reserves the right to modify or update these Terms and Conditions at any time. Any changes will be effective immediately upon posting to our website. It is your responsibility to review these terms periodically.</p>

      </div>
            <div class="modal-footer">
                <button type="button" id="agreeBtn" class="btn btn-primary" disabled>I Agree</button>
            </div>
        </div>
    </div>
</div>
                
                <div class="card card-custom mx-auto">
                    <div class="card-header text-center">
                        <img src="assets/images/login-side.png" alt="Header Image">
                        <h4 class="font-weight-bold">
                            <span style="color: black;">Start an</span> 
                            <span style="color: #00791B;">account</span>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="functions/authcode.php" method="POST" enctype="multipart/form-data">

                            <!-- Profile Image Upload -->
                            <div class="image-upload mb-3">
                                <div class="avatar-container">
                                    <img id="previewImage" src="assets/img/profile.png" alt="Profile Preview">
                                    <label for="profileImage" style="cursor: pointer;"></label>
                                    <input type="file" name="profileImage" id="profileImage" accept="image/*" style="display: none;">
                                </div>
                                <p>Choose Profile Image</p>
                            </div>

                            <!-- Name Input -->
                            <div class="form-floating mb-3">
                                <input type="text" name="fullname" class="form-control" id="nameInput" placeholder="Enter your Full Name" required>
                                <label for="nameInput">Full Name</label>
                            </div>
                            
                            <!-- Email Input -->
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your Email Address" required>
                                <label for="exampleInputEmail1">Email Address</label>
                                <small class="form-text text-muted">
                                Please enter a valid email address. This will be used for resetting your password if you forget it.
                                </small>
                            </div>
                            
                            <!-- Password Input -->
                            <div class="form-floating mb-3" style="position: relative;">
                                <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Enter your Password" required>
                                <img id="password-toggle2" class="password-toggle" src="assets/img/close-eye.png" alt="Toggle Password" 
                                    onclick="togglePassword1('passwordInput', 'password-toggle2')" 
                                    style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                <label for="passwordInput">Password</label>
                                
                                <!-- Password Strength Checker -->
                                <div id="passwordFeedback" class="mt-2"></div>
                            </div>

                            <!-- Confirm Password Input -->
                            <div class="form-floating mb-3" style="position: relative;">
                                <input type="password" name="cpassword" class="form-control" id="confirmPasswordInput" placeholder="Confirm Password" required>
                                <img id="password-toggle3" class="password-toggle" src="assets/img/close-eye.png" alt="Toggle Password" 
                                    onclick="togglePassword1('confirmPasswordInput', 'password-toggle3')" 
                                    style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                <label for="confirmPasswordInput">Confirm Password</label>
                            </div>
                            
                            <!-- Terms and Conditions Checkbox -->
                            <div class="mb-3 d-flex align-items-center">
                                <label for="termsCheckbox" class="checkbox-label">
                                    By checking this box using reCAPTCHA means you’re agree with our 
                                    <a href="terms-of-use.php">Terms of Use</a> 
                                    and 
                                    <a href="privacy-policy.php">Privacy Policy</a>.
                                </label>
                            </div>

                            <div class="form-group text-center">
                                <div class="g-recaptcha" data-sitekey="6Leb_GcqAAAAAKtVd46lWff_LWftZc5Yibm6dFE_"></div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" name="register_btn" class="btn btn-custom">Create Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const passwordInput = document.getElementById('passwordInput');
    const passwordFeedback = document.getElementById('passwordFeedback');

    passwordInput.addEventListener('input', function () {
        const password = passwordInput.value;
        let feedbackHtml = '';

        // Only display feedback if there is input
        if (password.length > 0) {
            // Check for lowercase letters
            if (/[a-z]/.test(password)) {
                feedbackHtml += '<div class="alert alert-success custom-alert">✓ Lowercase letter</div>';
            } else {
                feedbackHtml += '<div class="alert alert-danger custom-alert">✗ Lowercase letter</div>';
            }

            // Check for uppercase letters
            if (/[A-Z]/.test(password)) {
                feedbackHtml += '<div class="alert alert-success custom-alert">✓ Uppercase letter</div>';
            } else {
                feedbackHtml += '<div class="alert alert-danger custom-alert">✗ Uppercase letter</div>';
            }

            // Check for numbers
            if (/\d/.test(password)) {
                feedbackHtml += '<div class="alert alert-success custom-alert">✓ Number</div>';
            } else {
                feedbackHtml += '<div class="alert alert-danger custom-alert">✗ Number</div>';
            }

            // Check for special characters
            if (/[!@%&*]/.test(password)) {
                feedbackHtml += '<div class="alert alert-success custom-alert">✓ Special character (!@%&*)</div>';
            } else {
                feedbackHtml += '<div class="alert alert-danger custom-alert">✗ Special character (!@%&*)</div>';
            }

            // Check for length
            if (password.length >= 10) {
                feedbackHtml += '<div class="alert alert-success custom-alert">✓ At least 10 characters</div>';
            } else {
                feedbackHtml += '<div class="alert alert-danger custom-alert">✗ At least 10 characters</div>';
            }
            
            // Show the feedback section
            passwordFeedback.style.display = 'block';
        } else {
            // Hide the feedback section if input is empty
            passwordFeedback.style.display = 'none';
        }

        // Update the feedback section
        passwordFeedback.innerHTML = feedbackHtml;
    });
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Initialize the Terms and Conditions modal with the backdrop option set to 'static'
    const termsModal = new bootstrap.Modal(document.getElementById('termsModal'), {
        backdrop: 'static', // Prevent closing the modal when clicking outside
        keyboard: false // Prevent closing the modal when pressing the ESC key
    });
    termsModal.show();

    const agreeBtn = document.getElementById('agreeBtn');
    const termsContent = document.getElementById('termsContent');
    const registrationForm = document.getElementById('registrationForm');

    // Initially disable the "Agree & Continue" button
    agreeBtn.disabled = true;
    agreeBtn.classList.add('disabled');

    // Enable the "Agree & Continue" button only after scrolling to the bottom of the Terms and Conditions
    termsContent.addEventListener('scroll', function () {
        // Check if scrolled to the bottom
        if (termsContent.scrollTop + termsContent.clientHeight >= termsContent.scrollHeight) {
            agreeBtn.disabled = false; // Enable the button
            agreeBtn.classList.remove('disabled'); // Remove disabled class
        } else {
            agreeBtn.disabled = true; // Keep the button disabled if not scrolled to the bottom
            agreeBtn.classList.add('disabled'); // Re-add the disabled class
        }
    });

    // When "Agree & Continue" is clicked, hide the modal and show the registration form
    agreeBtn.addEventListener('click', function () {
        termsModal.hide();
        registrationForm.style.display = 'block';
    });
});
</script>

<?php include('includes/footer.php'); ?>
