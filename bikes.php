<?php 
// Include the header and any other necessary files
include('includes/header.php');
?>

<div class="main-content">
    <div class="container mt-2">
        <!-- Header Section -->
        <div class="header">
            <div class="logo">
                <img src="assets/img/nextgen.png" alt="Logo" style="height: 27px;">
            </div>
            <div class="title">
                Rental Operations on Content Management for Bikes
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-green">
                            <h4 class="text-white">Bike Products</h4>
                        </div>
                        <div class="card-body" id="products_table" style="max-height: 500px; overflow-y: auto;">
                            <!-- Search Form -->
                            <form method="GET" class="mb-3">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search by Bike Name, Category, or Brand" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th class="text-center">Bike Name</th>
                                            <th class="text-center">Category</th>
                                            <th class="text-center">Image</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Hourly Rate</th>
                                            <th class="text-center">Daily Rate</th>
                                            <th class="text-center">Bike Brand</th>
                                            <th class="text-center">Bike Size</th>
                                            <th class="text-center">Quantity Available</th>
                                            <th class="text-center">Availability Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Retrieve search query if set
                                        $search = isset($_GET['search']) ? $_GET['search'] : '';

                                        // SQL query to fetch bike data along with category, filtered by search input
                                        $query = "
                                            SELECT 
                                                bikes.bikeid, bikes.bike_name, bikes.image, bikes.status, 
                                                bikes.hourly_rate, bikes.daily_rate, bikes.bike_brand, 
                                                bikes.bike_size, bikes.qty, bikes.availability_status,
                                                categories.category_name 
                                            FROM bikes 
                                            JOIN categories ON bikes.category_id = categories.category_id
                                            WHERE bikes.bike_name LIKE ? OR categories.category_name LIKE ? OR bikes.bike_brand LIKE ?";

                                        // Prepare statement
                                        $stmt = $conn->prepare($query);

                                        // Add wildcard characters to search query for partial matching
                                        $searchTerm = "%" . $search . "%";
                                        $stmt->bind_param('sss', $searchTerm, $searchTerm, $searchTerm);

                                        // Execute query
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        // Check for query errors
                                        if (!$result) {
                                            die("Query failed: " . $conn->error);
                                        }

                                        // If records are found, display them
                                        if ($result->num_rows > 0) {
                                            while ($item = $result->fetch_assoc()) {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?= htmlspecialchars($item['bikeid']); ?></td>
                                                    <td class="text-center"><?= htmlspecialchars($item['bike_name']); ?></td>
                                                    <td class="text-center"><?= htmlspecialchars($item['category_name']); ?></td>
                                                    <td class="text-center">
                                                        <img src="<?= htmlspecialchars(str_starts_with($item['image'], 'https://res.cloudinary.com') ? $item['image'] : '../uploads/default-image.png'); ?>" width="80" height="80" alt="<?= htmlspecialchars($item['bike_name']); ?>" class="img-fluid">
                                                    </td>
                                                    <td class="text-center">
                                                        <?= $item['status'] == '0' ? "<span class='badge bg-success'>Visible</span>" : "<span class='badge bg-danger'>Hidden</span>" ?>
                                                    </td>
                                                    <td class="text-center"><?= htmlspecialchars($item['hourly_rate']); ?></td>
                                                    <td class="text-center"><?= htmlspecialchars($item['daily_rate']); ?></td>
                                                    <td class="text-center"><?= htmlspecialchars($item['bike_brand']); ?></td>
                                                    <td class="text-center"><?= htmlspecialchars($item['bike_size']); ?></td>
                                                    <td class="text-center"><?= htmlspecialchars($item['qty']); ?></td>
                                                    <td class="text-center">
                                                        <?php
                                                        // Set availability badge based on bike quantity and status
                                                        if ($item['qty'] <= 0) {
                                                            echo "<span class='badge bg-danger'>Not Available</span>";
                                                        } elseif ($item['availability_status'] == 'Available') {
                                                            echo "<span class='badge bg-success'>Available</span>";
                                                        } elseif ($item['availability_status'] == 'Under Maintenance') {
                                                            echo "<span class='badge bg-warning text-dark'>Under Maintenance</span>";
                                                        } else {
                                                            echo "<span class='badge bg-danger'>Not Available</span>";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="d-flex justify-content-center">
                                                            <a href="edit-bikes.php?id=<?= htmlspecialchars($item['bikeid']); ?>" class="btn btn-outline-primary btn-sm me-1">Edit</a>
                                                            <button type="button" class="btn btn-outline-danger btn-sm ms-1 delete_product_btn" value="<?= htmlspecialchars($item['bikeid']); ?>">Delete</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            // If no records found
                                            echo "<tr><td colspan='12' class='text-center'>No records found</td></tr>";
                                        }

                                        // Close statement and result
                                        $stmt->close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
// Include footer
include('includes/footer.php'); 

// Close the database connection
$conn->close();
?>
