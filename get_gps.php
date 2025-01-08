<?php
header('Content-Type: application/json');

// Read the stored GPS data from the file
$data = file_get_contents('gps_data.json');  // Assuming the data is saved in this file
echo $data;  // Send the data as JSON response
?>
