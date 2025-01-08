<?php

include('functions/userfunctions.php');
include('includes/header.php');

?>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center ">
            <h1 style="font-weight: 900;">OUR BIKES</h1>
            <br>
                <div class="row">
                    <?php
                    $categories = getAllActive("categories");

                    if (mysqli_num_rows($categories) > 0) {
                        foreach ($categories as $item) {
                            ?>
                            <div class="col-md-3 mb-2">
                                <a href="bikeproducts.php?category=<?= $item['slug']; ?>" class="text-decoration-none">
                                    <div class="card shadow">
                                        <div class="card-body">
                                        <img src="<?= htmlspecialchars($item['image']); ?>" alt="Category image" class="w-100">

                                            <h4 class="text-center"><?= $item['category_name']; ?></h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<div class="text-center">';
                        echo '<img src="assets/img/no-bike.png" alt="Logo" class="img-fluid mb-3" style="max-width: 200px;">';
                        echo '<p class="text-center, display-7">NO BIKES AVAILABLE</p>';
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
                    <i class="fas fa-map-marker-alt"></i> Colegio De Montalban, Kasiglahan Village, Brgy. San Jose, Rodriguez, Rizal
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

<?php include('includes/footer.php'); ?>
