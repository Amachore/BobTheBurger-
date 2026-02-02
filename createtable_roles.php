<?php
include "connect.php";

$sql = "CREATE TABLE IF NOT EXISTS roles (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL
)";

echo ($mysqli->query($sql)) 
    ? "Roles table created successfully!"
    : "Error: " . $mysqli->error;
?>
