<?php

$host = "mysql-nextgen.alwaysdata.net";
$username = "nextgen";
$password = "NextgenBikes@20242025";
$database = "nextgen_database";

 $conn = mysqli_connect($host, $username, $password, $database);

 if(!$conn)
 {
    die("Connection Failed ". mysqli_connect_error());
 }
 else
 {
    // echo "Connected Successfully";
 }


 // Default Database

// $host = "mysql-nextgen.alwaysdata.net";
// $username = "nextgen";
// $password = "NextgenBikes@20242025";
// $database = "nextgen_database";
?>