    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    
    <!----ALERTIFY JS---->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
      
      alertify.set('notifier','position', 'top-center');
      <?php 
      if(isset($_SESSION['message'])) 
      { 
        ?>
         alertify.success('<?= $_SESSION['message']; ?>');
         <?php 
          unset($_SESSION['message']);
      } 
    ?>
    </script>

    
    <script>
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1 // 1 item for mobile
                },
                600: {
                    items: 2 // 2 items for tablets
                },
                1000: {
                    items: 3 // 3 items for desktop
                }
            }
            
        });
    });
    </script>

<script>
    // Select only the stars in the user rating section
    const userStars = document.querySelectorAll('.rating i[data-value]');
    const ratingText = document.getElementById('ratingText');
    let selectedRating = 0;

    userStars.forEach(star => {
        // On hover, animate the stars and update the color
        star.addEventListener('mouseover', () => {
            const ratingValue = star.getAttribute('data-value');
            userStars.forEach(s => {
                s.classList.remove('text-warning');
                s.classList.add('text-secondary');
            });
            for (let i = 0; i < ratingValue; i++) {
                userStars[i].classList.add('text-warning');
            }
        });

        // On click, save the rating value or reset if clicked twice
        star.addEventListener('click', () => {
            const ratingValue = star.getAttribute('data-value');

            // Toggle the rating: if the same star is clicked again, reset the rating
            if (selectedRating == ratingValue) {
                selectedRating = 0;
                document.getElementById('ratingValue').value = ""; // Clear hidden rating input
                ratingText.innerText = "Select a rating";
            } else {
                selectedRating = ratingValue;
                document.getElementById('ratingValue').value = ratingValue; // Set hidden rating input
                ratingText.innerText = ratingValue + (ratingValue == 1 ? " Star" : " Stars");
            }

            // Update the stars visual after selection/reset
            userStars.forEach(s => {
                s.classList.remove('text-warning');
                s.classList.add('text-secondary');
            });
            for (let i = 0; i < selectedRating; i++) {
                userStars[i].classList.add('text-warning');
            }
        });

        // Reset to saved rating when not hovering
        star.addEventListener('mouseleave', () => {
            userStars.forEach(s => {
                s.classList.remove('text-warning');
                s.classList.add('text-secondary');
            });
            for (let i = 0; i < selectedRating; i++) {
                userStars[i].classList.add('text-warning');
            }
        });
    });
</script>



<script>
  document.getElementById('menuToggle').addEventListener('click', function (e) {
    e.preventDefault();
    var menuIcon = document.getElementById('menuIcon');
    var closeIcon = document.getElementById('closeIcon');
    var dropdownMenu = document.getElementById('dropdownMenu');

    // Toggle visibility of the menu and close icons
    menuIcon.classList.toggle('d-none');
    closeIcon.classList.toggle('d-none');

    // Toggle dropdown menu visibility
    dropdownMenu.classList.toggle('dropdown-show');
  });
</script>

<script>
  function togglePassword() {
      var passwordInput = document.getElementById("exampleInputPassword1");
      var passwordToggle = document.getElementById("password-toggle");
      if (passwordInput.type === "password") {
          passwordInput.type = "text";
          passwordToggle.src = "assets/img/view.png"; // Change to open eye icon
      } else {
          passwordInput.type = "password";
          passwordToggle.src = "assets/img/close-eye.png"; // Change back to closed eye icon
      }
  }
</script>

<script>
  function togglePassword1(inputId, toggleId) {
      var passwordInput = document.getElementById(inputId);
      var passwordToggle = document.getElementById(toggleId);
      if (passwordInput.type === "password") {
          passwordInput.type = "text";
          passwordToggle.src = "assets/img/view.png"; // Change to open eye icon
      } else {
          passwordInput.type = "password";
          passwordToggle.src = "assets/img/close-eye.png"; // Change back to closed eye icon
      }
  }
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('profileImage').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImage').src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                // Reset to default image if no file is selected
                document.getElementById('previewImage').src = 'assets/img/profile.png';
            }
        });
    });
</script>

<script>
    document.getElementById('profileImage').addEventListener('change', function(event) {
        const preview = document.getElementById('profilePicture');
        const file = event.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>

<script>
    // Get the button that deletes the account
    var confirmDeleteButton = document.getElementById('confirmDeleteButton');

    // When the user clicks the confirm button, submit the form
    confirmDeleteButton.addEventListener('click', function() {
        // Create a form for deleting the account
        var deleteForm = document.createElement('form');
        deleteForm.action = 'delete_account.php'; // Set the action to the delete account script
        deleteForm.method = 'POST';
        document.body.appendChild(deleteForm); // Append the form to the body
        deleteForm.submit(); // Submit the form
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const rateTypeSelect = document.getElementById('rate_type');
    const quantityInput = document.getElementById('quantity');
    const quantityAlert = document.getElementById('quantityAlert');
    const timeAlert = document.getElementById('timeAlert');
    const pickupTimeContainer = document.getElementById('pickup_time_container');
    const returnTimeContainer = document.getElementById('return_time_container');
    const pickupTime = document.getElementById('pickup_time');
    const returnTime = document.getElementById('return_time');
    const bookingDate = document.getElementById('booking_date');
    const bookingForm = document.getElementById('bookingForm');

    // Hide alerts on load
    hideAlert(quantityAlert);
    hideAlert(timeAlert);

    // Show/hide booking fields based on rate type
    rateTypeSelect.addEventListener('change', showBookingFields);
    showBookingFields(); // Call on load to set initial state

    // Quantity increment and decrement logic
    document.getElementById('decrementQty').addEventListener('click', function() {
        let currentQty = parseInt(quantityInput.value);
        if (currentQty > 1) {
            quantityInput.value = currentQty - 1;
            hideAlert(quantityAlert);
        }
    });

    document.getElementById('incrementQty').addEventListener('click', function() {
        let currentQty = parseInt(quantityInput.value);
        let maxQty = parseInt(quantityInput.max);

        if (currentQty < maxQty) {
            quantityInput.value = currentQty + 1;
            hideAlert(quantityAlert);
        } else {
            showAlert(quantityAlert, `Maximum available quantity is ${maxQty}`);
        }
    });

    // Show or hide time selection based on rate type
    function showBookingFields() {
        hideAlert(quantityAlert);
        hideAlert(timeAlert);

        const isHourlyRate = rateTypeSelect.value === "<?= RATE_HOURLY; ?>";
        pickupTimeContainer.style.display = isHourlyRate ? 'block' : 'none';
        returnTimeContainer.style.display = isHourlyRate ? 'block' : 'none';

        if (!isHourlyRate) {
            // Remove required attributes when not visible
            pickupTime.removeAttribute('required');
            returnTime.removeAttribute('required');
        } else {
            // Set required attributes when visible
            pickupTime.setAttribute('required', 'required');
            returnTime.setAttribute('required', 'required');
        }
    }

    // Convert time format to 24 hours
    function convertTo24HourFormat(time) {
        const [timeString, modifier] = time.split(" ");
        let [hours, minutes] = timeString.split(":").map(Number);

        if (modifier === "PM" && hours < 12) {
            hours += 12;
        } else if (modifier === "AM" && hours === 12) {
            hours = 0;
        }

        return { hours, minutes };
    }

    // Validate pickup and return times
    function validateTime() {
        let isValid = true; // Flag to track validity

        if (rateTypeSelect.value === "<?= RATE_HOURLY; ?>" && pickupTimeContainer.style.display !== 'none' && returnTimeContainer.style.display !== 'none') {
            const pickupTimeValue = pickupTime.value;
            const returnTimeValue = returnTime.value;
            const bookingDateValue = bookingDate.value;

            const { hours: pickupHours, minutes: pickupMinutes } = convertTo24HourFormat(pickupTimeValue);
            const { hours: returnHours, minutes: returnMinutes } = convertTo24HourFormat(returnTimeValue);

            const pickupDateTime = new Date(bookingDateValue);
            pickupDateTime.setHours(pickupHours, pickupMinutes);

            const returnDateTime = new Date(bookingDateValue);
            returnDateTime.setHours(returnHours, returnMinutes);

            // Validate pickup before return
            if (pickupDateTime >= returnDateTime) {
                showAlert(timeAlert, "Pickup time must be before return time.");
                pickupTime.focus(); // Set focus to pickup time
                isValid = false;
            }
        }

        return isValid; // Return the validity flag
    }

    // Form submission handling
    bookingForm.addEventListener('submit', function(event) {
        if (rateTypeSelect.value === "<?= RATE_HOURLY; ?>" && !validateTime()) {
            event.preventDefault(); // Prevent form submission if invalid
        }
    });

    // Show alert function
    function showAlert(alertElement, message) {
        if (alertElement) {
            alertElement.innerText = message;
            alertElement.style.display = 'block';
        }
    }

    // Hide alert function
    function hideAlert(alertElement) {
        if (alertElement) {
            alertElement.style.display = 'none';
        }
    }
});
</script>

<script>
    // Function to check availability
    function checkAvailability(event) {
        const isAvailable = <?= json_encode($product['availability_status'] === 'Available'); ?>;
        
        if (!isAvailable) {
            alert("Warning: This bike is currently not available and cannot be booked.");
            event.preventDefault(); // Prevent form submission
        } else {
            console.log("Bike is available!");
        }
    }

    // Disabling the button if the bike is not available
    window.onload = function() {
        const isAvailable = <?= json_encode($product['availability_status'] === 'Available'); ?>;
        const checkAvailabilityButton = document.getElementById("checkAvailabilityButton");

        if (!isAvailable) {
            checkAvailabilityButton.disabled = true;
            checkAvailabilityButton.style.opacity = "0.6"; // Optional styling to show button is disabled
            checkAvailabilityButton.style.cursor = "not-allowed";
        }
    };

</script>


  </body>
</html>