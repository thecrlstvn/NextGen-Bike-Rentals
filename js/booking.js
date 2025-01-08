console.log("Script Loaded");

document.addEventListener('DOMContentLoaded', function() {
    const rateTypeSelect = document.getElementById('rate_type');
    const quantityInput = document.getElementById('quantity');
    const quantityAlert = document.getElementById('quantityAlert');
    const timeSelection = document.getElementById('time_selection');
    const pickupTime = document.getElementById('pickup_time');
    const returnTime = document.getElementById('return_time');
    const bookingDate = document.getElementById('booking_date');

    // Ensure the quantity alert is initially hidden
    hideAlert();

    // Check if rateTypeSelect exists
    if (rateTypeSelect) {
        rateTypeSelect.addEventListener('change', showBookingFields);
    } else {
        console.error("Element with ID 'rate_type' not found.");
    }

    // Initial display of the booking fields on page load
    showBookingFields();

    // Increment and decrement quantity logic
    document.getElementById('decrementQty').addEventListener('click', function() {
        let currentQty = parseInt(quantityInput.value);
        if (currentQty > 1) {
            quantityInput.value = currentQty - 1;
            hideAlert();
        }
    });

    document.getElementById('incrementQty').addEventListener('click', function() {
        let currentQty = parseInt(quantityInput.value);
        let maxQty = parseInt(quantityInput.max);

        if (currentQty < maxQty) {
            quantityInput.value = currentQty + 1;
            hideAlert();
        } else {
            showAlert(`Maximum available quantity is ${maxQty}`);
        }
    });

    // Show booking fields based on rate type
    function showBookingFields() {
        hideAlert();
        timeSelection.style.display = 'block'; // Always show time selection for both rate types

        // Logic for specific validations can be added here
    }

    // Show alert function
    function showAlert(message) {
        if (quantityAlert) {
            quantityAlert.innerText = message;
            quantityAlert.style.display = 'block';
        }
    }

    // Hide alert function
    function hideAlert() {
        if (quantityAlert) {
            quantityAlert.style.display = 'none';
        }
    }
});
