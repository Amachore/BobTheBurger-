<?php
include "connect.php";

$sql = "CREATE TABLE IF NOT EXISTS storage_locations (
    location_id INT AUTO_INCREMENT PRIMARY KEY,
    location_name VARCHAR(50) NOT NULL
)";

echo ($mysqli->query($sql))
    ? "Storage locations table created successfully!"
    : "Error: " . $mysqli->error;
?>
