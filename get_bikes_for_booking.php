<?php
$host = "mysql-nextgen.alwaysdata.net";
$username = "nextgen";
$password = "NextgenBikes@20242025";
$database = "nextgen_database";

 $conn = mysqli_connect($host, $username, $password, $database);

 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT bikeid, bike_name, bike_brand, bike_size, hourly_rate, daily_rate, qty, image 
        FROM bikes WHERE availability_status = 'available' AND qty > 0";
$result = $conn->query($sql);

$bikes = array();
while ($row = $result->fetch_assoc()) {
    $bikes[] = $row;
}

echo json_encode($bikes); // Return bikes data as JSON

$conn->close();
?>