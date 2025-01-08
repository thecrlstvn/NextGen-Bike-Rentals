<?php
session_start(); // Start the session

// Assuming you have validated the user credentials and have $user_id
$_SESSION['user_id'] = $user_id; // Set user ID or any other identifier

// Redirect to the homepage or dashboard
header("Location: index.php");
exit();
?>
