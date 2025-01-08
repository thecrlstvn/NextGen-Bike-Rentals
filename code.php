<?php
include_once('../config/dbcon.php');
include_once('../functions/myfunctions.php');
require '../vendor/autoload.php'; // Include the Composer autoload file

// Cloudinary configuration
$cloudinary = new \Cloudinary\Cloudinary(array(
    'cloud' => array(
        'cloud_name' => 'dsyt4e4fp',
        'api_key'    => '399586786843443',
        'api_secret' => 'HH4mh7xMDej9XRNY06BPrgAEn6M',
    )
));

// WAG NA GALAWIN LAHAT!!!

if (isset($_POST['add_category_btn'])) {
    $category_name = $_POST['category_name'];
    $slug = createSlug($_POST['slug'] ?? $category_name, $conn);
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';

    $image = $_FILES['image']['tmp_name'];

    if (!empty($image)) {
        try {
            // Upload to Cloudinary
            $cloudinary_upload = $cloudinary->uploadApi()->upload($image, [
                'folder' => 'categories/',
                'public_id' => 'category_' . uniqid(), // Use unique ID for each upload
                'overwrite' => true,
                'resource_type' => 'image',
                'access_mode' => 'public', // Make the image public
            ]);
            $filename = $cloudinary_upload['secure_url'];

            // Prepare SQL query
            $sql = "INSERT INTO categories (category_name, slug, description, meta_title, meta_description, meta_keywords, status, image) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            // Check if the query prepares successfully
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die('Prepare failed: ' . $conn->error); // Show error if prepare() fails
            }

            // Bind parameters (8 parameters)
            $stmt->bind_param('ssssssss', $category_name, $slug, $description, $meta_title, $meta_description, $meta_keywords, $status, $filename);

            // Execute the query
            $cate_query_run = $stmt->execute();

            if ($cate_query_run) {
                redirect("category.php", "Category Added Successfully");
            } else {
                $error = $stmt->error; // Get the error message
                redirect("add-category.php", "Something Went Wrong: " . $error);
            }

            // Close the statement
            $stmt->close();
        } catch (Exception $e) {
            redirect("add-category.php", "Failed to upload image: " . $e->getMessage());
        }
    } else {
        redirect("add-category.php", "Image is required");
    }


} else if (isset($_POST['update_category_btn'])) {
    // Fetching form data
    $category_id = $_POST['category_id'];

    $category_name = $_POST['category_name'];
    $slug = createSlug($_POST['slug'] ?? $category_name, $conn);
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';

    $old_image = $_POST['old_image'];
    $new_image = $_FILES['image']['tmp_name'];

    if ($new_image != "") {
        try {
            // Upload to Cloudinary
            $cloudinary_upload = $cloudinary->uploadApi()->upload($new_image, [
                'folder' => 'categories/',
                'public_id' => 'category_' . $category_id, // Use category ID for consistency
                'overwrite' => true,
                'resource_type' => 'image',
                'access_mode' => 'public',
            ]);
            $update_filename = $cloudinary_upload['secure_url'];
        } catch (Exception $e) {
            redirect("edit-category.php?id=$category_id", "Failed to upload new image: " . $e->getMessage());
        }
    } else {
        $update_filename = $old_image; // Keep the old image if no new image is uploaded
    }

    // Prepare the SQL statement to avoid SQL injection
    $stmt = $conn->prepare("UPDATE categories SET 
        category_name=?, 
        slug=?, 
        description=?, 
        meta_title=?, 
        meta_description=?, 
        meta_keywords=?, 
        status=?, 
        image=? 
        WHERE category_id=?");
    
    if (!$stmt) {
        error_log("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        redirect("edit-category.php?id=$category_id", "SQL Prepare Error: " . $conn->error);
        exit;
    }

    // Correct the bind_param call
    $stmt->bind_param('ssssssisi', // 6 strings and 2 integers
        $category_name, 
        $slug, 
        $description, 
        $meta_title, 
        $meta_description, 
        $meta_keywords, 
        $status, // should be an integer
        $update_filename, 
        $category_id // should be the last parameter
    );

    // Execute the statement
    if ($stmt->execute()) {
        if ($new_image != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        }
        redirect("category.php?id=$category_id", "Category Updated Successfully");
    } else {
        // Fetch and show the specific error message
        $error_message = $stmt->error; // Get error from the statement
        redirect("edit-category.php?id=$category_id", "Something Went Wrong: $error_message");
    }

    // Close the prepared statement
    $stmt->close();
}

else if(isset($_POST['delete_category_btn'])) {

    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);

    $category_query = "SELECT * FROM categories WHERE category_id='$category_id' ";
    $category_query_run = mysqli_query($conn, $category_query);
    $category_data = mysqli_fetch_array($category_query_run);

    $image_url = $category_data['image'];
    
    // Extract public ID for deletion from Cloudinary
    $public_id = pathinfo($image_url, PATHINFO_FILENAME);

    $delete_query = "DELETE FROM categories WHERE category_id='$category_id' ";
    $delete_query_run = mysqli_query($conn, $delete_query);

    // Delete the image from Cloudinary
    try {
        $cloudinary->uploadApi()->destroy($public_id, ['resource_type' => 'image']);
        redirect("category.php", "Category deleted successfully");
    } catch (Exception $e) {
        redirect("category.php", "Failed to delete image from Cloudinary: " . $e->getMessage());
    }
}

else if (isset($_POST['add_product_btn'])) {
    $category_id = $_POST['category_id'];
    $bike_name = $_POST['bike_name'];
    $slug = createSlug($_POST['slug'] ?? $bike_name, $conn);
    $bike_brand = $_POST['bike_brand'];
    $description = $_POST['description'];
    $hourly_rate = $_POST['hourly_rate'];
    $daily_rate = $_POST['daily_rate'];
    $qty = $_POST['qty'];
    $bike_size = $_POST['bike_size'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';
    $availability_status = $_POST['availability_status'];

    // Ensure availability status is set correctly based on qty and status
    if ($availability_status === 'under_maintenance') {
        $availability_status = 'under_maintenance'; // This ensures the status is set to under_maintenance if selected
    } elseif ($qty <= 0) {
        $availability_status = 'not_available'; // If qty is 0 or less, set to not_available
    } else {
        $availability_status = 'available'; // Otherwise, set to available
    }

    $image = $_FILES['image']['tmp_name'];

    if (!empty($image) && $_FILES['image']['error'] == 0) {
        try {
            // Upload to Cloudinary
            $cloudinary_upload = $cloudinary->uploadApi()->upload($image, [
                'folder' => 'products/',
                'public_id' => 'product_' . uniqid(), // Use unique ID for each upload
                'overwrite' => true,
                'resource_type' => 'image',
                'access_mode' => 'public',
            ]);
            $filename = $cloudinary_upload['secure_url'];
        } catch (Exception $e) {
            redirect("add-bikes.php", "Image upload failed: " . $e->getMessage());
            exit;
        }
    } else {
        redirect("add-bikes.php", "Image upload failed. Error: " . $_FILES['image']['error']);
        exit;
    }

    // Validate required fields
    if (!empty($bike_name) && !empty($slug) && !empty($description) && !empty($hourly_rate) && !empty($daily_rate)) {
        // Prepare SQL query with prepared statement
        $product_query = "INSERT INTO bikes (category_id, bike_name, slug, bike_brand, description, hourly_rate, daily_rate, qty, bike_size, meta_title, meta_description, meta_keywords, status, availability_status, trending, image) 
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($product_query);
        $stmt->bind_param("issssddssssssiss", $category_id, $bike_name, $slug, $bike_brand, $description, $hourly_rate, $daily_rate, $qty, $bike_size, $meta_title, $meta_description, $meta_keywords, $status, $availability_status, $trending, $filename);

        if ($stmt->execute()) {
            redirect("add-bikes.php", "Bike Added Successfully");
        } else {
            echo "SQL Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        redirect("add-bikes.php", "All fields are mandatory");
    }

} else if (isset($_POST['update_product_btn'])) {
    $bikeid = $_POST['bikeid'];
    $category_id = $_POST['category_id'];
    $bike_name = $_POST['bike_name'];
    $slug = createSlug($_POST['slug'] ?? $bike_name, $conn);
    $bike_brand = $_POST['bike_brand'];
    $description = $_POST['description'];
    $hourly_rate = $_POST['hourly_rate'];
    $daily_rate = $_POST['daily_rate'];
    $qty = $_POST['qty'];
    $bike_size = $_POST['bike_size'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';
    $availability_status = $_POST['availability_status'];

    // Ensure availability status is set correctly based on qty and status
    if ($availability_status === 'under_maintenance') {
        $availability_status = 'under_maintenance'; // This ensures the status is set to under_maintenance if selected
    } elseif ($qty <= 0) {
        $availability_status = 'not_available'; // If qty is 0 or less, set to not_available
    } else {
        $availability_status = 'available'; // Otherwise, set to available
    }

    $old_image = $_POST['old_image'];
    $new_image = $_FILES['image']['tmp_name'];

    if ($new_image != "") {
        try {
            $cloudinary_upload = $cloudinary->uploadApi()->upload($new_image, [
                'folder' => 'products/',
                'public_id' => 'product_' . $bikeid,
                'overwrite' => true,
                'resource_type' => 'image',
                'access_mode' => 'public',
            ]);
            $update_filename = $cloudinary_upload['secure_url'];
        } catch (Exception $e) {
            redirect("edit-bikes.php?id=$bikeid", "Failed to upload new image: " . $e->getMessage());
            exit;
        }
    } else {
        $update_filename = $old_image;
    }

    $update_product_query = "UPDATE bikes SET 
        category_id = ?, 
        bike_name = ?, 
        slug = ?, 
        bike_brand = ?, 
        description = ?, 
        hourly_rate = ?, 
        daily_rate = ?, 
        qty = ?, 
        bike_size = ?, 
        meta_title = ?, 
        meta_description = ?, 
        meta_keywords = ?, 
        status = ?, 
        trending = ?, 
        availability_status = ?, 
        image = ? 
    WHERE bikeid = ?";

    $stmt = $conn->prepare($update_product_query);
    $stmt->bind_param("issssddssssssissi", $category_id, $bike_name, $slug, $bike_brand, $description, $hourly_rate, $daily_rate, $qty, $bike_size, $meta_title, $meta_description, $meta_keywords, $status, $trending, $availability_status, $update_filename, $bikeid);

    if ($stmt->execute()) {
        if ($new_image != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        }
        redirect("edit-bikes.php?id=$bikeid", "Bike Updated Successfully");
    } else {
        redirect("edit-bikes.php?id=$bikeid", "Something Went Wrong");
    }
    $stmt->close();

} else if(isset($_POST['delete_product_btn'])) {

    $bikeid = mysqli_real_escape_string($conn, $_POST['bikeid']);

    $product_query = "SELECT * FROM bikes WHERE bikeid='$bikeid' ";
    $product_query_run = mysqli_query($conn, $product_query);
    $product_data = mysqli_fetch_array($product_query_run);
    $image_url = $product_data['image'];
    
    // Extract public ID for deletion from Cloudinary
    $public_id = pathinfo($image_url, PATHINFO_FILENAME);
    
    $delete_query = "DELETE FROM bikes WHERE bikeid='$bikeid' ";
    $delete_query_run = mysqli_query($conn, $delete_query);

    // Delete the image from Cloudinary
    try {
        $cloudinary->uploadApi()->destroy($public_id, ['resource_type' => 'image']);
        redirect("bikes.php", "Product deleted successfully");
    } catch (Exception $e) {
        redirect("bikes.php", "Failed to delete image from Cloudinary: " . $e->getMessage());
    }
} 

// Close the database connection
$conn->close();
?>