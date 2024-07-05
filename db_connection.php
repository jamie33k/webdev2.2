<?php
$host = "localhost";
$port = "5432";
$dbname = "rianab_logistics";
$user = "your_username";
$password = "your_password";

// Create connection
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// Check connection
if (!$conn) {
    die("Connection failed: " . pg_last_error());
}
?>
