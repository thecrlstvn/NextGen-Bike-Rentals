<!-- Announcement Bar -->
<div class="announcement-bar">
  <div class="container d-flex justify-content-between">
    <div>
    <a href="#" target="_blank">
        <img src="assets/img/phone-call.png" alt="Facebook" class="social-icon">
      </a>
    Call us: 415-1111 / 924-2684
    </div>
    <div>
      <a href="#" target="_blank">
        <img src="assets/img/facebook1.png" alt="Facebook" class="social-icon">
      </a>
      <a href="#" target="_blank">
        <img src="assets/img/twitter1.png" alt="X" class="social-icon">
      </a>
      <a href="#" target="_blank">
        <img src="assets/img/instagram1.png" alt="Instagram" class="social-icon">
      </a>
    </div>
  </div>
</div>

<nav class="navbar navbar-expand-lg navbar-white sticky-top bg-white shadow">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img src="assets/images/nextlogo.png" alt="Navbar Logo" class="img-fluid" style="width: 150px;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav flex-grow-1 justify-content-center">
        <li class="nav-item">
          <a class="nav-link" href="index.php">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="aboutus.php">ABOUT US</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="rentals.php">RENTALS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="categories.php">BIKES</a>
        </li>
      </ul>

      <!-- Add the new button here, conditionally displayed -->
      <?php if (isset($_SESSION['auth'])) { ?>
        <div class="d-flex ms-auto">
          <a class="btn-custom" href="categories.php">Book Now</a>
        </div>
      <?php } ?>

      <!-- Show user dropdown if logged in -->
      <?php if (isset($_SESSION['auth'])) { ?>
  <ul class="navbar-nav ms-auto">
    <li class="nav-item dropdown" style="color: white;">
      <a class="nav-link" href="#" id="menuToggle" role="button">
        <div class="logo-text-container d-flex align-items-center">
          <!-- Toggle Icons -->
          <img id="menuIcon" src="assets/img/menu.png" alt="Menu" class="menu-icon ms-2">
          <img id="closeIcon" src="assets/img/close.png" alt="Close" class="menu-icon ms-2 d-none">

  <!-- Profile Image -->
  <img src="<?= !empty($_SESSION['auth_user']['profile_image']) ? htmlspecialchars($_SESSION['auth_user']['profile_image']) : 'assets/img/profile.png'; ?>" 
          class="profile-img rounded-circle" 
          style="width: 40px; height: 40px; object-fit: cover;">
  </div>
      </a>
      <ul class="dropdown-menu dropdown-menu-end" id="dropdownMenu">
        <li><a class="dropdown-item" href="wishlist.php">My Wishlist</a></li>
        <li><a class="dropdown-item" href="mybookings.php">My Bookings</a></li>
        <li><a class="dropdown-item" href="settings.php">Settings</a></li>
        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
      </ul>
    </li>
  </ul>
<?php } ?>


      <!-- Show login/register buttons if not logged in -->
      <?php if (!isset($_SESSION['auth'])) { ?>
        <div class="d-flex ms-auto">
          <!-- Login Button with Text Color 00791B -->
          <a class="btn btn-outline-success me-2" href="login.php" style="color: #00791B; border-color: #00791B;">Login</a>
          <!-- Get Started Button with Background Color 00791B and White Text -->
          <a class="btn btn-success" href="register.php" style="background-color: #00791B; border-color: #00791B; color: #fff;">Get Started</a>
        </div>
      <?php } ?>
    </div>
  </div>
</nav>
