<?php

include('config/dbcon.php');

function getAllActive($table)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE status='0' ";
    return $query_run = mysqli_query($conn, $query);
}

function getAllTrending()
{
    global $conn;
    $query = "SELECT * FROM bikes WHERE trending='1' ";
    return $query_run = mysqli_query($conn, $query);
}

function getSlugActive($table, $slug)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE slug = '$slug' AND status='0'LIMIT 1";
    return $query_run = mysqli_query($conn, $query);
}

function getProdByCategory($category_id)
{
    global $conn;
    $query = "SELECT * FROM bikes WHERE category_id = '$category_id' AND status='0' ";
    return $query_run = mysqli_query($conn, $query);
}

function getIDActive($table, $id)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE id = '$id' AND status='0' ";
    return $query_run = mysqli_query($conn, $query);
}

function redirect($url, $message)
 {   
    $_SESSION['message'] = $message;
    header('Location:'.$url);
    exit(0);
}

function getFilteredBookings($userId, $filter) {
    global $conn;

    // Check if user ID is received
    if (!$userId) {
        die("User ID is NULL. Check session management.");
    }

    // SQL query to fetch booking details along with bike information
    $query = "
        SELECT b.*, bi.bike_name, bi.image 
        FROM bookings AS b
        JOIN bikes AS bi ON b.bikeid = bi.bikeid
        WHERE b.user_id = ?
    ";
    
    // Add filter conditions
    if ($filter !== 'all') {
        if ($filter === 'past') {
            $query .= " AND b.booking_date < NOW()"; // Filter past bookings
        } elseif ($filter === 'active') {
            $query .= " AND b.booking_date >= NOW() AND b.status = 'active'";
        } elseif ($filter === 'canceled') {
            $query .= " AND b.status = 'canceled'";
        }
    }

    // Prepare statement
    $stmt = $conn->prepare($query);
    
    // Check if preparation was successful
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error); // Display error
    }
    
    // Bind the user ID parameter
    $stmt->bind_param("i", $userId);
    
    // Execute the statement
    if (!$stmt->execute()) {
        die("Error executing query: " . $stmt->error);
    }

    // Get the result
    $result = $stmt->get_result();

    // Fetch all results
    $bookings = $result->fetch_all(MYSQLI_ASSOC);

    // Free result and close statement
    $result->free();
    $stmt->close();

    // Return all bookings
    return $bookings;
}


function createBooking($bikeId, $bookingDate, $pickupTime, $returnTime, $quantity, $rateType, $bikeSize, $customerName, $customerEmail) {
    global $conn;

    // Check if user is logged in
    if (!isset($_SESSION['auth_user']['user_id'])) {
        die("User is not logged in. Cannot create booking.");
    }

    $userId = $_SESSION['auth_user']['user_id'];

    // Prepare your insert query
    $query = "INSERT INTO bookings (bikeid,booking_date, pickup_time, return_time, quantity, rate_type, status, bike_size, customer_name, customer_email, user_id) 
              VALUES (?, ?, ?, ?, ?, ?, 'active', ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issssisssi", $bikeId, $bookingDate, $pickupTime, $returnTime, $quantity, $rateType, $bikeSize, $customerName, $customerEmail, $userId);

    if ($stmt->execute()) {
        return true; // Booking created successfully
    } else {
        die("Error creating booking: " . $stmt->error);
    }
}

function getBookingDetails($bookingId) {
    global $conn; // Use your global database connection

    // Updated query with JOINs to include relevant details and the status field
    $query = "SELECT 
                b.bike_name, b.bike_brand, b.description, b.image, 
                bk.quantity, bk.booking_date, bk.pickup_time, bk.return_time, 
                bk.rate_type, bk.status, -- Assuming status is in the bookings table
                p.payment_method, p.total_cost AS total_amount, p.downpayment_amount, 
                p.remaining_amount, p.payment_status, 
                bk.customer_name, bk.customer_email -- Get customer details
              FROM bookings bk
              JOIN bikes b ON bk.bikeid = b.bikeid 
              JOIN payments p ON bk.booking_id = p.booking_id
              WHERE bk.booking_id = ?";

    // Prepare the SQL statement
    if ($stmt = $conn->prepare($query)) {
        // Bind the parameter and execute
        $stmt->bind_param('i', $bookingId);
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if the result is empty
        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); // Fetch associative array of booking details
        } else {
            // Booking not found
            echo "No booking found with ID: " . htmlspecialchars($bookingId);
            return false;
        }
    } else {
        // Debug error when query preparation fails
        echo "Query error: " . htmlspecialchars($conn->error);
        return false;
    }
}


// Function to generate a password reset token
function createPasswordResetToken($conn, $user_id) {
    // Generate a secure random token
    $token = bin2hex(random_bytes(16)); // 32 characters long

    // Insert the token into the reset_tokens table
    $stmt = $conn->prepare("INSERT INTO reset_tokens (token, user_id, created_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("si", $token, $user_id); // "si" means string and integer
    $stmt->execute();

    // Return the generated token
    return $token;
}

function addToWishlist($user_id, $bikeid, $note, $conn) {
    // Check if the item is already in the wishlist
    $check_query = "SELECT * FROM wishlist WHERE user_id = ? AND bikeid = ? AND status = 'active'";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ii", $user_id, $bikeid);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 0) {
        // If not in wishlist, insert it
        $insert_query = "INSERT INTO wishlist (user_id, bikeid, note) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("iis", $user_id, $bikeid, $note);
        if($stmt->execute()) {
            echo "Bike added to wishlist!";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "This bike is already in your wishlist.";
    }
}

function removeFromWishlist($wishlist_id, $conn) {
    $remove_query = "UPDATE wishlist SET status = 'removed' WHERE wishlist_id = ?";
    $stmt = $conn->prepare($remove_query);
    $stmt->bind_param("i", $wishlist_id);
    
    if($stmt->execute()) {
        echo "Item removed from wishlist!";
    } else {
        echo "Error: " . $stmt->error;
    }
}

function getWishlist($user_id, $conn) {
    $wishlist_query = "SELECT w.wishlist_id, b.bike_name, b.bike_brand, w.added_at, w.note 
                       FROM wishlist w 
                       JOIN bikes b ON w.bikeid = b.bikeid 
                       WHERE w.user_id = ? AND w.status = 'active'";
    $stmt = $conn->prepare($wishlist_query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while($row = $result->fetch_assoc()) {
        echo '
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">' . $row['bike_name'] . '</h5>
                <h6 class="card-subtitle text-muted">Brand: ' . $row['bike_brand'] . '</h6>
                <p class="card-text">Added on: ' . $row['added_at'] . '</p>
                <p class="card-text">Note: ' . $row['note'] . '</p>
                <a href="remove_from_wishlist.php?id=' . $row['wishlist_id'] . '" class="btn btn-danger">Remove</a>
            </div>
        </div>';
    }
}

function getReviews($bikeId) {
    global $conn; // Assuming you're using a database connection
    $query = "SELECT r.rating, r.comment, r.created_at, u.username 
              FROM reviews r 
              JOIN users u ON r.user_id = u.user_id 
              WHERE r.bike_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $bikeId);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

