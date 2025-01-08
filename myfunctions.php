<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('../config/dbcon.php');

function getAll($table)
{
    global $conn;
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($conn, $query);
}

function getByID($table, $id)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE category_id = '$id'";
    return $query_run = mysqli_query($conn, $query);
}

function getByBikeID($table, $id)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE bikeid = '$id'";
    return $query_run = mysqli_query($conn, $query);
}

function getBikeDetails($bikeId) {
    global $conn;

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM bikes WHERE bikeid = ?");
    if (!$stmt) {
        echo "Prepare failed: " . $conn->error;
        return null; // Return null if preparation fails
    }

    // Bind the parameters
    $stmt->bind_param("i", $bikeId); // "i" for integer

    // Execute the statement
    if ($stmt->execute()) {
        // Get the result
        $result = $stmt->get_result();

        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Fetch the bike data as an associative array
            return mysqli_fetch_array($result, MYSQLI_ASSOC); // Return as associative array
        } else {
            // No bike found
            return null;
        }
    } else {
        // Query failed, handle the error
        echo "Error executing query: " . $stmt->error;
        return null;
    }
}


// Function to check availability for a specific date
function checkBikeAvailability($rateType, $bookingDate, $startTime, $endTime, $bikeSize, $quantity) {
    global $conn;

    // Check for existing bookings
    $query = "
        SELECT b.qty, COUNT(*) AS booking_count 
        FROM Bookings AS bo
        JOIN Bikes AS b ON b.bike_size = ?
        WHERE bo.booking_date = ? 
        AND (
            (bo.start_time < ? AND bo.end_time > ?) OR 
            (bo.start_time < ? AND bo.end_time > ?)
        )
        AND bo.status = 'confirmed'
        GROUP BY b.qty;";

    // Prepare and execute the query
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssss', $bikeSize, $bookingDate, $startTime, $endTime, $startTime, $endTime);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // If no existing bookings are found
    if (!$row) {
        return true; // Available
    }

    // Calculate the total booked quantity
    $totalBooked = $row['booking_count'];

    // Fetch the total quantity available for the bike
    $queryAvailable = "SELECT qty FROM Bikes WHERE bike_size = ?";
    $stmtAvailable = $conn->prepare($queryAvailable);
    $stmtAvailable->bind_param('s', $bikeSize);
    $stmtAvailable->execute();
    $resultAvailable = $stmtAvailable->get_result();
    $availableRow = $resultAvailable->fetch_assoc();

    // Check if the requested quantity can be fulfilled
    if ($availableRow && ($availableRow['qty'] - $totalBooked) >= $quantity) {
        return true; // Available
    }

    return false; // Not available
}

function getAllActive($table)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE status='0' ";
    return $query_run = mysqli_query($conn, $query);
}
 
function redirect($url, $message)
 {   
    $_SESSION['message'] = $message;
    header('Location:'.$url);
    exit(0);
}

function createSlug($string, $conn) {
    // Convert the string to lowercase and replace spaces with dashes
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));

    // Check for existing slugs
    $query = "SELECT COUNT(*) FROM categories WHERE slug='$slug'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_fetch_array($result)[0];

    // If the slug exists, append a number to make it unique
    if ($count > 0) {
        $i = 1;
        while ($count > 0) {
            $new_slug = $slug . '-' . $i;
            $query = "SELECT COUNT(*) FROM categories WHERE slug='$new_slug'";
            $result = mysqli_query($conn, $query);
            $count = mysqli_fetch_array($result)[0];
            $i++;
            $slug = $new_slug; // Update the slug to the new one
        }
    }
    return $slug;
}


function handleImageUpload($file, $path) {
    if (empty($file['name'])) {
        return null; // No new image
    }

    // Validate image type
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    $image_ext = pathinfo($file['name'], PATHINFO_EXTENSION);

    if (!in_array($image_ext, $allowed_types)) {
        return "Invalid image format. Only JPG, JPEG, PNG, and GIF are allowed.";
    }

    // Generate a unique filename
    $filename = time() . '.' . $image_ext;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($file['tmp_name'], $path . $filename)) {
        return $filename; // Return the filename on success
    } else {
        return "Failed to upload image.";
    }
}

?>