<?php 
session_start();
include('functions/userfunctions.php'); 
include('includes/header.php'); 

$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;

if(isset($_GET['category']))
{

$category_slug = $_GET['category'];
$category_data = getSlugActive("categories", $category_slug);
$category = mysqli_fetch_array($category_data); 

    if($category)
    {

    $cid = $category['category_id'];

        ?>

<div class="py-3 bg-success">
  <div class="container">
    <h6 class="text-white mb-0">
      <a class="text-white" href="index.php"> 
        Home > 
      </a>
      <a class="text-white" href="categories.php">
        Our Bikes > 
      </a>
      <?= $category['category_name']; ?>
    </h6>
  </div>
</div>

        
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4 text-center display-6"><?= $category['category_name']; ?></h2>
                <br>
                <div class="row">
                    <?php
                    $products = getProdByCategory($cid);

                    if(mysqli_num_rows($products) > 0)
                    {
                        foreach($products as $item)
                        {
                            // Output each product card
                            ?>
<div class="col-md-4 mb-4">
    <div class="card" style="width: 18rem;">
    <img src="<?= htmlspecialchars($item['image']); ?>" class="card-img-top" alt="Product image">

        <div class="card-body">
            <h5 class="card-title" style="color: blue"><?= $item['bike_brand']; ?></h5>
            <h6 class="card-title"><?= $item['bike_name']; ?></h6> 
            
            <p class="card-text">
                <span style="display: flex; justify-content: space-between;">
                   Hourly Rate <span style="color: #005F15; font-size: larger; font-weight: 600;">₱<?= $item['hourly_rate']; ?> / hour</span>
                </span>
                <span style="display: flex; justify-content: space-between;">
                    Daily Rate <span style="color: #005F15; font-size: larger; font-weight: 600;">₱<?= $item['daily_rate']; ?> / day</span>
                </span>
            </p>
            <div class="d-flex justify-content-between">
                <a href="view_product.php?product=<?= $item['slug']; ?>" class="btn btn-success">Book Now</a>
                <form action="add_to_wishlist.php" method="POST">
                    <input type="hidden" name="bike_id" value="<?= $item['bikeid']; ?>">
                    <button type="submit" class="btn btn-outline-success">
                        Add to Wishlist
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


     <?php
                        }
                    }
                    else
                    {
                        // Output the logo and "No bikes available" message
                        echo '<div class="text-center">';
                        echo '<img src="assets/img/no-bike.png" alt="Logo" class="img-fluid mb-3" style="max-width: 200px;">';
                        echo '<p class="text-center, display-7">BIKES HERE ARE NOT AVAILABLE</p>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

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

        <?php 
    }
    else
    {
        echo "Something went wrong";
    }
}
else
{
    echo "Something went wrong";
}


include('includes/footer.php'); ?>