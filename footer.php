    
    
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!--ALERTIFY JS-->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
      <?php 
      
      if(isset($_SESSION['message'])) 
      { 
        ?>
        alertify.set('notifier','position', 'top-right'); 
         alertify.success('<?= $_SESSION['message']; ?>');
         <?php 
          unset($_SESSION['message']);
      } 
    ?>
    </script>

<script>
    function togglePassword() {
      var passwordField = document.getElementById('exampleInputPassword1');
      var passwordToggle = document.getElementById('password-toggle');
      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        passwordToggle.src = 'admin-assets/img/view.png'; // Correct path to show password image
      } else {
        passwordField.type = 'password';
        passwordToggle.src = 'admin-assets/img/close-eye.png'; // Correct path to hide password image
      }
    }
  </script>

<script>
    function previewImage() {
      const file = document.getElementById('image').files[0];
      const preview = document.getElementById('imagePreview');

      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.innerHTML = `<img src="${e.target.result}" alt="Image Preview" class="img-preview">`;
        };
        reader.readAsDataURL(file);
      } else {
        preview.innerHTML = '';
      }
    }

    function validateForm() {
      const requiredFields = document.querySelectorAll('input[required], textarea[required]');
      let isValid = true;

      requiredFields.forEach(field => {
        if (!field.value.trim()) {
          field.style.borderColor = '#dc3545';
          isValid = false;
        } else {
          field.style.borderColor = '';
        }
      });

      return isValid;
    }
  </script>

<script>
  function previewImage() {
    const file = document.getElementById('image').files[0];
    const preview = document.getElementById('imagePreview');
    const reader = new FileReader();

    reader.onloadend = function () {
      preview.src = reader.result;
      preview.style.display = 'block';
    }

    if (file) {
      reader.readAsDataURL(file);
    } else {
      preview.src = '';
      preview.style.display = 'none';
    }
  }
</script>

<!-- JavaScript for Real-Time Date and Time -->
<script>
  function updateDateTime() {
    const now = new Date();
    const date = now.toLocaleDateString('en-US', {
      weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
    });
    const time = now.toLocaleTimeString('en-US', {
      hour: '2-digit', minute: '2-digit', second: '2-digit'
    });

    document.getElementById('current-date').textContent = date;
    document.getElementById('current-time').textContent = time;
  }

  setInterval(updateDateTime, 1000); // Update every second
</script>


<script>
function updateBikeCategoryAndRates() {
    var bikeSelect = document.getElementById("bikeName");
    var selectedOption = bikeSelect.options[bikeSelect.selectedIndex];
    var bikeCategoryInput = document.getElementById("bikeCategory");
    
    // Set the bike category based on selected bike
    bikeCategoryInput.value = selectedOption.getAttribute('data-category');
    
    // Clear total if needed
    document.getElementById("total").value = "";
}

function updateRates() {
    calculateTotal();
}

function calculateTotal() {
    var bikeSelect = document.getElementById("bikeName");
    var selectedOption = bikeSelect.options[bikeSelect.selectedIndex];
    var quantity = document.getElementById("quantity").value || 1; // Default to 1 if no quantity is provided
    var rentType = document.getElementById("rentType").value;
    var total = 0;

    // Retrieve date and time values
    var startDate = document.getElementById("startRentDate").value;
    var endDate = document.getElementById("endRentDate").value;
    var startTime = document.getElementById("startRentTimeHourly").value;
    var endTime = document.getElementById("endRentTimeHourly").value;

    if (rentType === "daily") {
        var dailyRate = parseFloat(selectedOption.getAttribute('data-daily'));
        
        // Calculate the number of days between startDate and endDate
        var date1 = new Date(startDate);
        var date2 = new Date(endDate);
        var timeDifference = date2.getTime() - date1.getTime();
        var daysDifference = Math.ceil(timeDifference / (1000 * 3600 * 24)); // Get total days

        // Multiply by daysDifference and quantity
        total = dailyRate * daysDifference * quantity;
    } 
    else if (rentType === "hourly") {
        var hourlyRate = parseFloat(selectedOption.getAttribute('data-hourly'));
        
        // Calculate the number of hours between startTime and endTime
        var start = new Date("1970-01-01T" + startTime);
        var end = new Date("1970-01-01T" + endTime);
        var timeDifference = end.getTime() - start.getTime();
        var hoursDifference = Math.ceil(timeDifference / (1000 * 3600)); // Get total hours

        // Multiply by hoursDifference and quantity
        total = hourlyRate * hoursDifference * quantity;
    }

    // Display the total with two decimal points
    document.getElementById("total").value = total.toFixed(2);
}
</script>

<script>
$(document).ready(function() {
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        events: 'fetch_bookings.php', // Ensure this path is correct
        editable: false,
        eventLimit: true,
        eventRender: function(event, element) {
            // Style based on status
            if (event.status === 'confirmed') {
                element.css('background-color', 'darkgreen'); // Green for confirmed
            } else if (event.status === 'returned') {
                element.css('background-color', 'gold'); // Gold for returned
            } else if (event.status === 'pending') {
                element.css('background-color', 'darkred'); // Dark red for pending
            }
        },
        eventClick: function(event) {
            if (event) {

                // Start building modal content
                var bookingDetails = `
                    <strong>User ID:</strong> ${event.user_id}<br>
                    <strong>Customer Name:</strong> ${event.customer_name}<br>
                    <strong>Customer Email:</strong> ${event.customer_email}<br>
                    <strong>Bike ID:</strong> ${event.bike_id}<br>
                    <strong>Quantity:</strong> ${event.quantity}<br>
                    <strong>Rate Type:</strong> ${event.rate_type}<br>
                    <strong>Booking Date:</strong> ${moment(event.booking_date).format('MMMM Do, YYYY')}<br>
                `;

                // Check rate type and add appropriate fields
                if (event.rate_type.toLowerCase() === 'hourly') {
                    bookingDetails += `
                        <strong>Pickup Time:</strong> ${formattedPickupTime}<br>
                        <strong>Return Time:</strong> ${formattedReturnTime}<br>
                    `;
                }

                // Create a badge for Status
                var statusBadgeClass = event.status.toLowerCase(); // Ensure class name is in lower case
                bookingDetails += `
                    <strong>Booking ID:</strong> ${event.id}<br>
                    <strong>Status:</strong> <span class="badge badge-${statusBadgeClass}">${event.status}</span><br>
                `;

                // Format pickup and return times
                var formattedPickupTime = event.pickup_time ? moment(event.pickup_time).format('hh:mm A') : 'Not specified';
                var formattedReturnTime = event.return_time ? moment(event.return_time).format('hh:mm A') : 'Not specified';

                // Update the modal content
                $('#eventDetails').html(bookingDetails);
                $('#eventModal').modal('show'); // Show the modal
            }
        },
        eventAfterAllRender: function(view) {
            if ($('#calendar').find('.fc-event').length === 0) {
                $('#calendar').append('<div>No bookings available</div>');
            }
        }
    });
});

    </script>

</body>
</html>