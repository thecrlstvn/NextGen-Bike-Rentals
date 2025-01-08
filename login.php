<?php
session_start();

// Redirect to index.php if user is already logged in
if (isset($_SESSION['auth'])) {
    $_SESSION['message'] = "You are already logged in.";
    header('Location: index.php');
    exit();
}

// Include header.php which also starts the session
include('includes/header.php');

?>

<div class="py-5" style="background-color: #005F15;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8 col-sm-10"> <!-- Adjusted the column size for responsiveness -->
        <?php 
        // Display session messages
        if (isset($_SESSION['message'])) { 
          ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?= $_SESSION['message']; ?>.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <?php
          unset($_SESSION['message']);
        }
        ?>
        <div class="card" style="border-radius: 20px;">
          <div class="card-header text-center">
            <img src="assets/images/login-side.png" alt="Header Image" class="img-fluid" style="max-width: 70%; margin-top: 5px; margin-bottom: 5px;">
            <h4 style="font-weight: 900; margin-top: 10px;">Login with <span style="color: #00791B;">account</span></h4>
          </div>
          <div class="card-body">
            <form action="functions/authcode.php" method="POST">
              <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="name@example.com" required style="height: 50px;">
                <label for="exampleInputEmail1">Email address</label>
              </div>

              <div class="form-floating mb-3 position-relative">
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required style="height: 50px;">
                <label for="exampleInputPassword1">Password</label>
                <img id="password-toggle" class="password-toggle" src="assets/img/close-eye.png" alt="Toggle Password" onclick="togglePassword()" style="position: absolute; right: 15px; top: 30px; transform: translateY(-50%); cursor: pointer;">
                <div class="text-end mt-2">
                  <a href="forgot-password.php" style="color: #606060; text-decoration: none;">Forgot Password?</a>
                </div>
              </div>

                  <div class="form-group text-center">
                <div class="g-recaptcha" data-sitekey="6Leb_GcqAAAAAKtVd46lWff_LWftZc5Yibm6dFE_"></div>
            </div>

              <button type="submit" name="login_btn" class="btn btn-block" style="background-color: #00831D; color: white; width: 100%; height: 60px; font-size: 17px;">LOGIN</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('includes/footer.php'); ?>
