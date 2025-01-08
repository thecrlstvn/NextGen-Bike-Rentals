<?php
ob_start(); // Start output buffering
include('includes/header.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking_id'];
    $return_time = date('Y-m-d H:i:s'); // Automatically set the return time
    $notes = $_POST['notes'];

    // Check the current status of the booking
    $status_sql = "SELECT status FROM bookings WHERE booking_id = ?";
    $status_stmt = $conn->prepare($status_sql);
    $status_stmt->bind_param("i", $booking_id);
    $status_stmt->execute();
    $status_result = $status_stmt->get_result();
    $booking = $status_result->fetch_assoc();

    // Initialize variables for SweetAlert
    $message = "";
    $icon = "";

    // Check if booking exists
    if ($booking) {
        if ($booking['status'] === 'returned' || $booking['status'] === 'Cancelled') {
            $message = "This booking has already been returned";
            $icon = "warning";
        } else {
            // Insert into returned_bikes table
            $sql = "INSERT INTO returned_bikes (booking_id, return_time, confirmator) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iss", $booking_id, $return_time, $notes);

            if ($stmt->execute()) {
                // Update the original booking status
                $update_sql = "UPDATE bookings SET status = 'returned' WHERE booking_id = ?";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bind_param("i", $booking_id);
                $update_stmt->execute();

                $message = "The bike has been successfully returned.";
                $icon = "success";
            } else {
                $message = "Error occurred while processing the return.";
                $icon = "error";
            }
        }
    } else {
        $message = "Booking not found.";
        $icon = "error";
    }

    // Output SweetAlert script
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
            Swal.fire({
                title: '" . addslashes($message) . "',
                icon: '" . addslashes($icon) . "',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href='" . ($icon === 'success' ? 'return_success.php' : 'return_bike.php?booking_id=' . $booking_id) . "';
                }
            });
          </script>";
    exit;
}

ob_end_flush(); // Flush the output buffer
?>
